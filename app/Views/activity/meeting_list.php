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

                <h4 class="card-title">Meeting Reports of <?=session()->get('user')['name']?></h4>
                <p class="card-title-desc">You have attended <?=$payload->totalRecord?> + client Meeting.
                </p>

                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ($payload->records) : ?>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="SL.: activate to sort column descending">SL.</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">Company</th>

                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Office: activate to sort column ascending">Meet With</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Meet With: activate to sort column ascending">Position</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Contact: activate to sort column ascending">Contact</th>
                                            
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Date: activate to sort column ascending">Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Action: activate to sort column ascending">Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $sl = $payload->currentPage * 10 - 10; ?>
                                        <?php foreach ($payload->records as $item) : ?>
                                            <tr class="odd">
                                                <td class="" style=""><?= ++$sl ?></td>
                                                <td class="sorting_1 dtr-control" style=""><?= companyInfo( $item->company_id)->company_name ?></td>
                                                <td style=""><?= $item->contact_person ?></td>
                                                <td style=""><?= $item->desg ?></td>
                                                <td style=""><?= $item->mobile ?></td>
                                                
                                                <td style=""><?= date('F jS Y ', strtotime($item->created_at)) ?></td>
                                                <td style=""><a href="<?= site_url('meeting/details/' . $item->id) ?>" class="btn btn-info waves-effect waves-light"><i class="fas fa-eye" title="view"></i></a>


                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing <?=$sl+1-10?> to <?=$sl ?> of <?= $payload->totalRecord ?> entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            <ul class="pagination pagination-rounded">
                                    <li class="paginate_button page-item previous <?= $payload->currentPage == 1 ? 'disabled' : '' ?>" id="datatable_previous">
                                    <a href="<?=site_url('/my-activity/meeting-list?page=1')?>" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                    <i class="mdi mdi-chevron-left"></i>
                                </a>
                            </li>
                                    <?php for ($i = 1; $i <= $payload->totalPage; $i++) : ?>
                                        <li class="paginate_button page-item <?= ($payload->currentPage == $i ? 'active' : '') ?>">
                                        <a href="<?=site_url('/my-activity/meeting-list?page='.$i)?>" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link"><?=$i?></a></li>
                                    <?php endfor ?>
                                    <li class="paginate_button page-item next <?= $payload->currentPage == $payload->totalPage  ? 'disabled' : '' ?> <?= $payload->totalPage == "0"  ? 'disabled' : '' ?>"id="datatable_next">
                                    <a href="<?=site_url('/my-activity/meeting-list?page='.$payload->totalPage)?>" aria-controls="datatable" data-dt-idx="7" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                                <h4>No Records found!</h4>
                            <?php endif ?>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>



</div>

<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>

<script src="<?= base_url('/assets/js/moment.min.js') ?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.min.js') ?>"></script>


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