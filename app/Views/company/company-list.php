<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>



<div class="row">
                            <div class="col-12">
                                <?php if($companyList!=null):?>
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Company List</h4>
        
                                        <div class="table-responsive">
                                            <table class="table table-editable table-nowrap align-middle table-edits">
                                                <thead>
                                                    <tr style="cursor: pointer;">
                                                        <th>Name</th>
                                                        <th>Contact</th>
                                                        <th>Email</th>
                                                        <th>Added By</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($companyList as $item):?>
                                                    <tr  style="cursor: pointer;">
                                                        <td >
                                                            
                                                            <a href="<?=site_url('/company/details/'.$item->id)?>">
                                                            <?=$item->company_name?>
                                                            </a>
                                                        </td>
                                                        <td >
                                                            <a class="text-dark" href="tel:<?=$item->mobile?>">++88-<?=$item->mobile?></a>
                                                            
                                                        </td>
                                                        <td >
                                                        <a class="btn btn-link text-decoration-none text-dark" href="mailto:<?=$item->email?>"><?=$item->email?></a>        
                                                       
                                                    </td>
                                                        <td ><?=getUsername($item->user_id)->name?></td>
                                                        <td>
                                                        <?=date('jS \of F Y',strtotime($item->created_at))?>
                                                        </td>
                                                    </tr>
                                                  <?php endforeach?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php else:?>
                                    <h4>Yet no Company Added</h4>
                                <?php endif?>
                            </div> <!-- end col -->
                        </div>
                         
                           
                      
    <?= $this->endSection() ?>

 
   

  