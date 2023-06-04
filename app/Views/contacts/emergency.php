<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <?php if($items):?>
        <?php foreach($items as $item):?>
                            <div class="col-md-4">
                                <div class="card border border-primary">
                                    <div class="card-header bg-transparent border-primary">
                                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i><?=$item->name?></h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$item->designation?></h5>
                                        <p class="card-text"><a href="tel:<?=$item->contact?>"><i class="fas fa-phone-alt"></i><?=$item->contact?></a></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach?>
        <?php endif?>
                        </div>
<?=$this->endSection()?>