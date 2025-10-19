<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Penilaian</p>
        <div class="right-button ms-auto">
        </div>
    </div>
    <div class="card-body">
        <?php if($error_msg): ?>
        <div class="alert alert-danger"><?=$error_msg?></div>
        <?php endif ?>
        
        <?php if($success_msg): ?>
        <div class="alert alert-success"><?=$success_msg?></div>
        <?php endif ?>
        <form action="<?=routeTo('puskesmas/penilaian/save')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="form-group mb-3 col-12">
                    <label class="mb-2 fw-bold">Puskesmas</label>
                    <select name="puskesmas_id" id="" class="form-control">
                        <?php foreach($puskesmas as $alternatif): ?>
                        <option value="<?=$alternatif->id?>"><?=$alternatif->nama?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <?php foreach($kriteria as $c): ?>
                <div class="form-group mb-3 col-12">
                    <label class="mb-2 fw-bold"><?=$c->nama?></label>
                    <div>
                        <?php foreach($skala as $s): ?>
                        <label for="kriteria-<?=$c->id?>-<?=$s->id?>">
                            <input type="radio" name="kriteria[<?=$c->id?>]" id="kriteria-<?=$c->id?>-<?=$s->id?>" value="<?=$s->id?>">
                            <?=$s->label?>
                        </label>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php get_footer() ?>
