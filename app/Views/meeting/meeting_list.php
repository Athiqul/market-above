<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?= $this->section('custom-css') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Meeting Report</h4>
                <p class="card-title-desc">
                    Checkout All meeting reports here you can find it via search or use page number 
                </p>

                <div id="selection-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="selection-datatable_length"><label>Show <select name="selection-datatable_length" aria-controls="selection-datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="selection-datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="selection-datatable"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="selection-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="selection-datatable_info" style="width: 941px;">
                                <thead>
                                    <tr role="row">
                                        <th>Company</th>
                                        <th >Contact Person</th>
                                        <th >Designation</th>
                                        <th>Mobile</th>
                                        <th>Meeting Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody id="tableBody">



                                    <tr class="odd">
                                        <td class="sorting_1 dtr-control">Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td style="">2008/11/28</td>
                                        <td style="">$162,700</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="selection-datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="selection-datatable_paginate">
                                <ul class="pagination pagination-rounded">
                                    <li class="paginate_button page-item previous disabled" id="selection-datatable_previous"><a href="#" aria-controls="selection-datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="selection-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="selection-datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="selection-datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="selection-datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="selection-datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="selection-datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="selection-datatable_next"><a href="#" aria-controls="selection-datatable" data-dt-idx="7" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>



<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
    //get Table body
    let =document.getElementById('tableBody');
    //fetch data from api;
</script>
<?= $this->endSection() ?>