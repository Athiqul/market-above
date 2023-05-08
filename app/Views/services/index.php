<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?= $this->section('custom-css') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Services Or Products</h4>
                <h6>Add New Services Or Product</h6>

                <?= form_open('/services/add', "class='needs-validation' novalidate=''") ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="validationCustom03" class="form-label">Service/Product Name</label>
                            <input id="validationCustom03" type="text" class="form-control" name="service_name" value="<?= old('service_name') ?>" required>
                            <div class="invalid-feedback">
                                Please Write a Service or Product Name.
                            </div>

                        </div>
                    </div>

                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>
<!--Data Table-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Services List</h4>


                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="datatable_length"><label>Show <select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="serviceTable">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <ul class="pagination pagination-rounded">
                                    <li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Static backdrop</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script src="<?= base_url('/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
<script src="<?= base_url('/assets/js/pages/form-validation.init.js') ?>"></script>
<script src="<?= base_url('/assets/js/moment.min.js') ?>"></script>
<script>
    let serviceTable = document.getElementById('serviceTable');

    // initial service record load
    fetch("<?= site_url('/api/service-list') ?>")
        .then(res => res.json())
        .then(res => {
            console.log(res);
            if (res.errors == true) {
                serviceTable.innerHTML = '';
                serviceTable.innerHTML = `<h4 class='text-danger text-center'>${res.payload}</h4>`;
            } else {
                let html = `<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>SL.</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>


                                <tbody>`;
                let sl = 0;
                res.payload.services.forEach(function(item) {
                    html += `<tr class="even">
                                        <td>${++sl}</td>
                                        <td>${item.service_name}</td>
                                        <td style="">${item.status=='1'?'Active':'Inactive'}</td>
                                        <td style="">${moment(item.created_at.date).format('Do MMM YY') }</td>
                                        <td style=""><button type="button" class="btn btn-info waves-effect waves-light" onclick='editRecord(this)' data-id=${item.id}><i class="fas fa-pencil-alt" title="delete"></i></button>
                                                            <a class="btn btn-danger btn-sm edit" title="delete">
                                                                <i class=" fas fa-trash" title="delete"></i>
                                                            </a>
                                                            </td>
                                       
                                    </tr>`
                });
                html += ` </tbody>
                            </table>`;

                serviceTable.innerHTML = '';
                serviceTable.innerHTML = html;

            }

        })
        .catch(err => {
            console.log(err);
        });

    //Edit Process
    async function editRecord(record)
    {
           $("#staticBackdrop").modal('show');
           console.log(record);

    }
     
</script>

<?= $this->endSection() ?>