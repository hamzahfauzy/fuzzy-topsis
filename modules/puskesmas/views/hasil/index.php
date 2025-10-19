<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Hasil</p>
        <div class="right-button ms-auto">
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="1%">Rank</th>
                <th>Puskesmas</th>
                <th>Skor</th>
            </tr>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?=$result['rank']?></td>
                <td><?=$result['alternative']?></td>
                <td><?=$result['score']?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<?php get_footer() ?>
