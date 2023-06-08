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
<?= $this->section('content') ?>
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Meeting Report List</h4>
              

                <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 159px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">SL.</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 244px;" aria-label="Position: activate to sort column ascending">Company</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 114px;" aria-label="Office: activate to sort column ascending">Meet With</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 54px;" aria-label="Age: activate to sort column ascending">Designation</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 0px;" aria-label="Start date: activate to sort column ascending">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label="Salary: activate to sort column ascending">Mobile</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label="Salary: activate to sort column ascending">Summary</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label="Salary: activate to sort column ascending">Added By</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label="Salary: activate to sort column ascending">Created At</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label="Salary: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>


                                <tbody>



                                <?php if ($items) : ?>
                                        <?php foreach ($items as $key=>$item) : ?>
                                            <tr class="odd">
                                                <td style="width:40px;"><?= ++$key ?></td>
                                                <td class="sorting_1 dtr-control" style="width:40px;"><?= companyInfo($item->company_id)->company_name ?></td>
                                                <td style=""><?= $item->contact_person ?></td>
                                                <td style=""><?= $item->desg??'No website' ?></td>
                                                <td style="width:40px;"><?= $item->email??''?></td>
                                                <td style=""><?= $item->mobile??'' ?></td>
                                              
                                                <td style=""><?= $item->summary??'No description' ?></td>
                                           
                                       
                                                
                                                <td style=""><?= getUsername($item->user_id)->name ?></td>
                                                <td style=""><?= date('F jS Y ', strtotime($item->created_at)) ?></td>
                                                <td style=""><a href="<?= site_url('meeting/details/' . $item->id) ?>" class="btn btn-info waves-effect waves-light"><i class="fas fa-eye" title="view"></i></a>


                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php endif?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script src="<?= base_url('/assets/js/moment.min.js') ?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.min.js') ?>"></script>
<!-- Required datatable js -->
<script src="<?= base_url('assets/report/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<!-- Buttons examples -->
<script src="<?= base_url('assets/report/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/report/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>

<script src="<?= base_url('assets/report/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('assets/report/dataTables.select.min.js') ?>"></script>

<!-- Responsive examples -->
<script src="<?= base_url('assets/report/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/report/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>


<script src="<?= base_url('assets/report/dataTables.init.js') ?>"></script>

<?= $this->endSection() ?>