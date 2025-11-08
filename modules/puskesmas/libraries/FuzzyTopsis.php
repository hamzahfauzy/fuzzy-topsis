<?php

namespace Modules\Puskesmas\Libraries;


class FuzzyTopsis
{
    protected array $criteria;
    protected array $alternatives;
    public $normalizedResult = [];
    public $weightResult = [];
    public $distanceResult = [];
    public $fpfn = [];

    public function __construct(array $criteria, array $alternatives)
    {
        $this->criteria = $criteria;
        $this->alternatives = $alternatives;
    }

    public function process(): array
    {
        $normalized = $this->normalize();
        $weighted = $this->weight($normalized);
        [$fp, $fn] = $this->idealSolutions($weighted);
        $distances = $this->calculateDistances($weighted, $fp, $fn);
        return $this->calculateScores($distances);
    }

    protected function normalize(): array
    {
        $max = [];
        $min = [];

        // hitung min & max per kriteria
        foreach ($this->criteria as $crit) {
            $id = $crit['id'];
            $values = array_column(array_column($this->alternatives, 'values'), $id);
            $max[$id] = [max(array_column($values, 0)), max(array_column($values, 1)), max(array_column($values, 2))];
            $min[$id] = [min(array_column($values, 0)), min(array_column($values, 1)), min(array_column($values, 2))];
        }

        // normalisasi
        $normalized = [];
        foreach ($this->alternatives as $altIdx => $alt) {
            foreach ($this->criteria as $crit) {
                $id = $crit['id'];
                $type = $crit['type'];

                $divisor = ($type === 'benefit')
                    ? ($max[$id][2] != 0 ? $max[$id][2] : 1)
                    : ($min[$id][0] != 0 ? $min[$id][0] : 1);

                if ($type === 'benefit') {
                    $normalized[$altIdx][$id] = [
                        $alt['values'][$id][0] / $divisor,
                        $alt['values'][$id][1] / $divisor,
                        $alt['values'][$id][2] / $divisor,
                    ];
                } else { // cost
                    $normalized[$altIdx][$id] = [
                        $divisor / max($alt['values'][$id][2], 0.000001),
                        $divisor / max($alt['values'][$id][1], 0.000001),
                        $divisor / max($alt['values'][$id][0], 0.000001),
                    ];
                }
            }
        }

        $this->normalizedResult = $normalized;

        return $normalized;
    }

    protected function weight(array $normalized): array
    {
        $weighted = [];
        foreach ($normalized as $i => $alt) {
            foreach ($this->criteria as $crit) {
                $id = $crit['id'];
                $w = $crit['weight']; // 1 nilai saja
                $weighted[$i][$id] = [
                    $alt[$id][0] * $w,
                    $alt[$id][1] * $w,
                    $alt[$id][2] * $w,
                ];
            }
        }

        $this->weightResult = $weighted;
        return $weighted;
    }

    protected function idealSolutions(array $weighted): array
    {
        $fp = [];
        $fn = [];

        foreach ($this->criteria as $crit) {
            $id = $crit['id'];
            $type = $crit['type'];

            $vals = array_column($weighted, $id);

            if ($type === 'benefit') {
                $fp[$id] = [max(array_column($vals, 0)), max(array_column($vals, 1)), max(array_column($vals, 2))];
                $fn[$id] = [min(array_column($vals, 0)), min(array_column($vals, 1)), min(array_column($vals, 2))];
            } else {
                $fp[$id] = [min(array_column($vals, 0)), min(array_column($vals, 1)), min(array_column($vals, 2))];
                $fn[$id] = [max(array_column($vals, 0)), max(array_column($vals, 1)), max(array_column($vals, 2))];
            }
        }

        $this->fpfn = [$fp, $fn];

        return [$fp, $fn];
    }

    protected function calculateDistances(array $weighted, array $fp, array $fn): array
    {
        $distances = [];

        foreach ($weighted as $i => $alt) {
            $dPlus = 0;
            $dMinus = 0;

            foreach ($this->criteria as $crit) {
                $id = $crit['id'];
                $dPlus += pow(($alt[$id][1] - $fp[$id][1]), 2);
                $dMinus += pow(($alt[$id][1] - $fn[$id][1]), 2);
            }

            $distances[$i] = [
                'dPlus' => sqrt($dPlus),
                'dMinus' => sqrt($dMinus),
            ];
        }

        $this->distanceResult = $distances;

        return $distances;
    }

    protected function calculateScores(array $distances): array
    {
        $results = [];

        foreach ($distances as $i => $dist) {
            $dPlus = $dist['dPlus'];
            $dMinus = $dist['dMinus'];
            $score = ($dPlus + $dMinus) == 0 ? 0 : $dMinus / ($dPlus + $dMinus);

            if ($score >= 0.80) {
                $label = 'Sangat Baik';
            } elseif ($score >= 0.60) {
                $label = 'Baik';
            } elseif ($score >= 0.40) {
                $label = 'Cukup';
            } elseif ($score >= 0.20) {
                $label = 'Buruk';
            } else {
                $label = 'Sangat Buruk';
            }

            $results[$i] = [
                'id' => $this->alternatives[$i]['id'],
                'alternative' => $this->alternatives[$i]['name'],
                'score' => $score,
                'label' => $label
            ];
        }

        // Urutkan dari tertinggi ke terendah
        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

        // Tambahkan rank
        foreach ($results as $index => &$r) {
            $r['rank'] = $index + 1;
        }

        return $results;
    }

}
