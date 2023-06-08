
<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?= $this->section('custom-css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">

<link href="<?= site_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= site_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= site_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

           <?=$this->section('content')?>

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Meeting Report Tables</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=site_url('/')?>">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Meeting Report</li>
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
        
                                    <h4 class="card-title">Meeting Reports</h4>
                <p class="card-title-desc">All Meeting Report  List.
                </p>
        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr role="row">
                                            <th  style="width: 40px;" aria-sort="ascending" aria-label="SL.: activate to sort column descending">SL.</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">Company</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Contact Person: activate to sort column ascending">Contact Person</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Designation: activate to sort column ascending">Designation</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Email: activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Mobile: activate to sort column ascending">Mobile</th>
                                           
                                          
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Summary: activate to sort column ascending">Summary</th>
                                         
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Created At: activate to sort column ascending">Created At</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Action: activate to sort column ascending">Action</th>

                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php if ($items) : ?>
                                        <?php foreach ($items as $key=>$item) : ?>
                                            <tr class="odd">
                                                <td style="width:40px;"><?= ++$key ?></td>
                                                <td class="sorting_1 dtr-control" style="width:40px;"><?= companyInfo($item->company_id)->name ?></td>
                                                <td style=""><?= $item->contact_person ?></td>
                                                <td style=""><?= $item->desg??'No website' ?></td>
                                                <td style="width:40px;"><?= $item->email??''?></td>
                                                <td style=""><?= $item->mobile??'' ?></td>
                                              
                                                <td style=""><?= $item->summary??'No description' ?></td>
                                           
                                       
                                                
                                                <td style=""><?= getUsername($item->user_id)->name ?></td>
                                                <td style=""><?= date('F jS Y ', strtotime($item->created_at)) ?></td>
                                                <td style=""><a href="<?= site_url('company/details/' . $item->id) ?>" class="btn btn-info waves-effect waves-light"><i class="fas fa-eye" title="view"></i></a>


                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php endif?>
                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    







                  
                      <?=$this->endSection()?>  
                    

        
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
   
        <!-- /Right-bar -->

        <!-- Right bar overlay-->


       <?=$this->section('custom-js')?>
       <script src="<?= base_url('/assets/js/moment.min.js') ?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.min.js') ?>"></script>
        <!-- Required datatable js -->
        <script src="<?= base_url('assets/report/jquery.dataTables.min.js') ?>"></script>
        <script src="<?=base_url('assets/report/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
        <!-- Buttons examples -->
        <script src="<?= base_url('assets/report/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/report/buttons.bootstrap4.min.js') ?>"></script>
        <script src="<?=base_url('assets/report/libs/jszip/jszip.min.js')?>"></script>
        <script src="<?=base_url('assets/report/libs/pdfmake/build/pdfmake.min.js')?>"></script>
        <script src="<?=base_url('assets/report/libs/pdfmake/build/vfs_fonts.js')?>"></script>
        <script src="<?= base_url('assets/report/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>

<script src="<?= base_url('assets/report/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('assets/report/dataTables.select.min.js') ?>"></script>
        
        <!-- Responsive examples -->
        <script src="<?= base_url('assets/report/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

       
<script src="<?= base_url('assets/report/dataTables.init.js') ?>"></script>
    
   <?=$this->endSection()?>
 
