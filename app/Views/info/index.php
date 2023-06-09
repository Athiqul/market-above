<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">All Task List</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=site_url('/')?>">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Task List</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                       
                                        <?php if($docs==null):?>
                                            <h4>No Document Added Yet</h4>
                                            <?php else:?>
                                        <div class="table-responsive">
                                            <table class="table table-editable table-nowrap align-middle table-edits">
                                                <thead>
                                                    <tr style="cursor: pointer;">
                                                        <th>Title</th>
                                                        <th>Type</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $type=["Company Info","Service","Product"];
                                                    ?>
                                                    <?php foreach($docs as $item):?>
                                                        
                                                    <tr style="cursor: pointer;">
                                                        <td ><?=$item->title ?></td>
                                                        <td >
                                                            <?=$type[$item->type] ?>
                                                        </td>
                                                    
                                                       
                                                        
                                                       
                                                        <td>
                                                            <a href="<?=site_url("/company-info/document/".$item->doc_link)?>" target="_blank" class="btn btn-outline-info btn-sm edit " title="View">
                                                                <i class=" fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?=site_url('/company-info/edit/'.$item->id)?>" class="btn btn-outline-secondary btn-sm edit " title="Edit">
                                                                <i class=" fas fa-pencil-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                  <?php endforeach?>
                                                  
                                                  
                                                </tbody>
                                            </table>
                                            <?=$pager->links()?>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
<!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Task Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" id="modal-body">
                                                               
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

<?=$this->endSection()?>

<?=$this->section('custom-js')?>
<script>
    //Get view btn
   
     function showRecord(btn)
    {
           $("#staticBackdrop").modal('show');
           //get modal 
           let modalBody=document.getElementById('modal-body');
           modalBody.innerHTML=`<div>
           <button class='btn btn-primary mt-0 mb-0'>Loading......
           
           </button>
                                           
                                           
                                        </div>`;
            fetch('<?=site_url('/api/assign-task/')?>'+btn.dataset.id)
            .then(res=>res.json())
            .then(res=>{
                if(res.errors==true)
               {
                 modalBody.innerHTML='';
                 modalBody.innerHTML=`<h4 class='text-danger text-center'>${res.payload}</h4>`;
               }else{
                modalBody.innerHTML=`<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                       <h4>Task Instruction</h4>

                       ${res.payload.msg}
                      
                    </div>

                </div>

              
               
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>`;
               }
            })
            .catch(err=>{
                console.log(err);
            })                            
           
           

            }
</script>
<?=$this->endSection()?>