<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?= $this->section('custom-css') ?>


<link href="<?= site_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= site_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= site_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>


<?= $this->section('content') ?>




<div class="row">


    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h2 class="card-title text-center mb-5"><?= $info->company_name ?> Company Information, Meeting Reports and interest Services</h2>


                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link " data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="false" title="Basic Info">
                            <span class="d-block d-sm-none"><i class="fas fa-info-circle"></i></span>
                            <span class="d-none d-sm-block">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" id="meeting" href="#profile-1" role="tab" aria-selected="false" title="Meeting Reports">
                            <span class="d-block d-sm-none"><i class="fas fa-handshake"></i></span>
                            <span class="d-none d-sm-block">Meeting Reports</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" id="interest" href="#messages-1" role="tab" aria-selected="false" title="Interest Services">
                            <span class="d-block d-sm-none"><i class="fas fa-hand-holding-medical"></i></span>
                            <span class="d-none d-sm-block">Interest Services</span>
                        </a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted" id="profile-info">
                    <div class="tab-pane " id="home-1" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border border-primary">
                                    <div class="card-header bg-transparent border-primary">
                                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i><?= $info->company_name ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Summary :</h5>
                                        <p class="card-text"><?= $info->company_desc ?></p>
                                        <h5 class="card-title">Contact :</h5>
                                        <ul class="list-unstyled">
                                            <li>
                                                Mobile: <a href="tel:<?= $info->mobile ?>" class="btn btn-link text-dark"><?= $info->mobile ?></a>
                                            </li>
                                            <li>
                                                Email: <a href="mailto:<?= $info->email ?>" class="btn btn-link text-dark"><?= $info->email ?></a>
                                            </li>
                                            <li>
                                                Website: <a href="<?= $info->url ?? '' ?>" target="_blank" class="btn btn-link text-dark"><?= $info->url ?? 'No website given' ?></a>
                                            </li>
                                            <li>
                                                Address: <address>
                                                    <?= $info->address . ',' . $info->area . ',' . $info->thana . ',' . $info->district . ',' . $info->division ?>
                                                </address>
                                            </li>
                                            <?php 
                                            $userData=getUsername($info->user_id);

                                            ?>
                                            <?php if($userData->role!=0):?>
                                            <li>
                                                Added By: <a href="<?=site_url('/team-management/user-info/'.$info->user_id)?>">
                                                    <?= $userData->name ?>
                                                </a>

                                            </li>
                                            <?php endif?>
                                            <li>
                                                Created At:
                                                <?= date('jS F Y', strtotime($info->created_at)) ?>

                                            </li>
                                            <li>
                                                Last Updated At:
                                                <?= date('jS F Y', strtotime($info->updated_at)) ?>
                                            </li>
                                        </ul>
                                        <?php if(session()->get('user')['id']==$info->user_id|| session()->get('user')['role']=='admin'):?>
                                        <div class="col-md-4">
                                            <a href="<?= site_url('/company/edit/' . $info->id) ?>" class="btn btn-info">Edit Information</a>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>
                            </div>




                        </div>

                    </div>
                    <div class="tab-pane active" id="profile-1" role="tabpanel">

                    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"><?=$info->company_name?> Latest Meeting Reports</h4>
                <p class="card-title-desc">Recent All client Meeting Report List.

                </p>
                <a href="<?=site_url('/meeting/add?company_id='.$info->id)?>" class="btn btn-success waves-effect waves-light"><i class="fas fa-calendar-plus" title="view"></i>Add Meeting Report</a>

                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ($payload!==null) : ?>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="SL.: activate to sort column descending">SL.</th>
                                          

                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Office: activate to sort column ascending">Meet With</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Meet With: activate to sort column ascending">Position</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Contact: activate to sort column ascending">Contact</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Agent: activate to sort column ascending">Agent</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Date: activate to sort column ascending">Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Action: activate to sort column ascending">Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        
                                        <?php foreach ($payload as  $key=>$item) : ?>
                                            <tr class="odd">
                                                <td class="sorting_1 dtr-control" style=""><?= ++$key ?></td>
                                               
                                                <td style=""><?= $item->contact_person ?></td>
                                                <td style=""><?= $item->desg ?></td>
                                                <td style=""><?= $item->mobile ?></td>
                                                <td style=""><?=getUsername( $item->user_id)->name ?></td>
                                                <td style=""><?= date('F jS Y ', strtotime($item->created_at)) ?></td>
                                                <td style=""><a href="<?= site_url('meeting/details/' . $item->id) ?>" class="btn btn-info waves-effect waves-light"><i class="fas fa-eye" title="view"></i></a>


                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <h4>No Records found!</h4>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <?=$pager->links()?>
                        
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>



</div>
                    </div>
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <?php if($serviceNames==null):?>
                            <h4 class="text-center ">No interest services found!</h4>
                        <?php else:?>
                        <div class="row">



                           <?php foreach($serviceNames as $item):?>
                            <div class="col-lg-3">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <div class="d-flex align-items-center">

                                            <div class="flex-grow-1">
                                                <h5 class="mt-0 font-size-18 mb-1"><?=$item->service_name?></h5>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <?php endforeach?>
                        </div>
                        <?php endif?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('custom-js') ?>
<!-- Required datatable js -->


<script src="<?= base_url('/assets/js/moment.min.js') ?>"></script>



<!-- Required datatable js -->
<script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Buttons examples -->
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>

<script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>

<script src="<?= base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js') ?>"></script>

<!-- Responsive examples -->
<script src="<?= base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- Datatable init js -->
<script src="<?= site_url('assets/js/pages/datatables.init.js') ?>"></script>

<?= $this->endSection() ?>