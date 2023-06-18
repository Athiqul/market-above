<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?= $this->section('custom-css') ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.min.css')?>">
<?= $this->endSection() ?>


<?= $this->section('content') ?>



<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <?php if ($task == null) : ?>
                    <h4>You Have No Schedule Task</h4>
                    <div class="col-md-4">

                                <div id="tasktable_filter" class="taskTables_filter">
                                    <p>Task Report on</p>
                                    <a href="<?= site_url('/my-task/incomplete') ?>" class="btn btn-primary">Incomplete</a>
                                    <a href="<?= site_url('/my-task/complete') ?>" class="btn btn-primary">Complete</a>
                                  
                                </div>
                            </div>
                <?php else : ?>
                    <div class="table-responsive">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="mb-sm-0">Task Report</h4>
                                <p>Total task reports are <?= $pager->getTotal() ?></p>
                                <p>Showing page number <?=$pager->getCurrentPage()?></p>
                            </div>
                           
                           
                    <div class="col-md-4">

                                <div id="tasktable_filter" class="taskTables_filter">
                                    <p>Task Report on</p>
                                    <a href="<?= site_url('/my-task/incomplete') ?>" class="btn btn-primary">Incomplete</a>
                                    <a href="<?= site_url('/my-task/complete') ?>" class="btn btn-primary">Complete</a>
                                  
                                </div>
                            </div>
                        </div>
                       
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr style="cursor: pointer;">
                                    <th>Start</th>
                                    <th>Deadline</th>
                                    <th>status</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($task as $item) : ?>

                                    <tr style="cursor: pointer;">
                                       
                                        <td>
                                            <?= date('Y-m-d', strtotime($item->job_date)) ?>
                                        </td>
                                        <td>
                                            <?= date('Y-m-d', strtotime($item->end_date)) ?>
                                        </td>
                                        
                                        <td><?= $item->complete == '1' ? 'Done' : 'Pending' ?></td>


                                        <td style="width: 100px">
                                            <a id="view" class="btn  <?=$item->noti=='0'?'btn-outline-danger':'btn-outline-info'?> btn-sm edit " onclick="showRecord(this)" data-id="<?= $item->id ?>" title="View">
                                                <i class=" fas fa-eye"></i>
                                            </a>

                                            <a onclick="alertItem(event)" href="<?= site_url('/my-task/make-complete/' . $item->id) ?>" data-status="<?=$item->complete=='1'?'Pending':'Completed'?>" class="btn <?=$item->complete=='0'?'btn-outline-primary':'btn-outline-danger'?>   btn-sm edit " title="Mark it when taskdone">
                                                <i class="<?=$item->complete=='0'? 'fas fa-thumbs-up':'fas fa-thumbs-down'?>"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>


                            </tbody>
                        </table>
                        <?= $pager->links() ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
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

<?= $this->endSection() ?>

<?= $this->section('custom-js') ?>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.min.js') ?>"></script>

<script>
    //Get view btn

    function showRecord(btn) {
        $("#staticBackdrop").modal('show');
        //get modal 
        let modalBody = document.getElementById('modal-body');
        modalBody.innerHTML = `<div>
           <button class='btn btn-primary mt-0 mb-0'>Loading......
           
           </button>
                                           
                                           
                                        </div>`;
        fetch('<?= site_url('/api/assign-task/') ?>' + btn.dataset.id)
            .then(res => res.json())
            .then(res => {
                if (res.errors == true) {
                    modalBody.innerHTML = '';
                    modalBody.innerHTML = `<h4 class='text-danger text-center'>${res.payload}</h4>`;
                } else {
                    modalBody.innerHTML = `<div class="row">
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
//mark as read

         fetch("<?=site_url('/api/task/mark-as-read/')?>"+btn.dataset.id)
         .then(res=>res.json())
         .then(res=>{
            console.log(res);
         })
         .catch(err=>{console.log(err);});
                }
            })
            .catch(err => {
                console.log(err);
            });



    }

    //Sweetalert
function alertItem(record)
{
    record.preventDefault();
    let status=record.target.closest('a').dataset.status;
    var link = record.target.closest('a').getAttribute('href');
                   
                  Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you want to update your task to ${status}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                      Swal.fire(
                        'Request Sent!',
                        'Check the alert',
                        'success'
                      )
                    }
                  }) 


}


</script>
<?= $this->endSection() ?>