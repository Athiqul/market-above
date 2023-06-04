<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?= $this->section('custom-css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Emergency Contact</h4>
                <h6>Add Emergency Contact for agent</h6>

                <form id="addContact">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom03" class="form-label">Name:</label>
                                <input id="name" type="text" class="form-control" name="name" value="<?= old('name') ?>" required>
                                <div class="invalid-feedback">
                                    Please Write a Service or Product Name.
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="validationCustom03" class="form-label">Designation:</label>
                                <input id="designation" type="text" class="form-control" name="designation" value="<?= old('designation') ?>" required>
                                <div class="invalid-feedback">
                                    Please Write a Service or Product Name.
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="validationCustom03" class="form-label">Contact Number:</label>
                                <input id="contact" type="tel" class="form-control" name="contact" value="<?= old('contact') ?>" required>
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

                <h4 class="card-title">Emergency Contact List</h4>


                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="datatable_length"><label>Show <select name="datatable_length" id="recordType" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                        <option value="0">Default</option>
                                        <option value="1">Active</option>
                                        <option value="2">inactive</option>
                                    </select> Status</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" id="search"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="serviceTable">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"></div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="pagination">
                                <ul class="pagination pagination-rounded">
                                    <li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>

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
                <h5 class="modal-title" id="staticBackdropLabel">Update Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body">

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
<script src="<?= base_url('/assets/js/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    let serviceTable = document.getElementById('serviceTable');
    let pagination = document.getElementById('pagination');
    let addForm = document.getElementById('addContact');

    //Add Contact List
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(addForm);
        let bodyData = {};
        for (const [name, value] of formData) {
            bodyData[name] = value;
        }
        // console.log(bodyData); 
        try {
            const res = requestApiCall("<?= site_url('/api/emergency-contact-add') ?>", 'POST', bodyData);
            res.then(res => {
                if (res.errors) {
                    //console.log(res.payload);
                    for (let item in res.payload) {
                        toastr.error(`${res.payload[item]}`);
                        console.log(document.getElementById(`${item}`));
                        let span = document.createElement("span");
                        span.classList.add('text-danger');
                        span.innerHTML = res.payload[item];

                        document.getElementById(`${item}`).after(span);
                        document.getElementById(`${item}`).style.borderColor = "red";
                        setTimeout(function() {
                            span.remove();
                            document.getElementById(`${item}`).style.borderColor = "";
                        }, 3000)
                    }


                } else {

                    let inputs = addForm.querySelectorAll('input');
                    inputs.forEach(input => {
                        console.log(input)
                        input.value = '';
                    });
                    toastr.success(`${res.payload}`);


                    tableDataFetch();
                }
            }).catch(error => console.log(err));
        } catch (err) {
            console.log(err);
        }



    });
    //Api Calling
    async function requestApiCall(url, type, data) {
        const request = await fetch(url, {
            method: type,
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data),

        });
        const getRes = await request.json();
        return getRes;
    }
    //default fetch
    async function tableDataFetch(limit = 10, page = 1) {
        let res = await requestApiCall("<?= site_url('/api/emergency-contact-list?page=') ?>" + page + '&limit=' + limit);
        tableLoad(res);
        return;
    }
    //Table load function
    function tableLoad(res) {
        serviceTable.innerHTML = '<h2>Loading......</h2>';
        if (res.errors == true) {
            serviceTable.innerHTML = '';
            serviceTable.innerHTML = `<h4 class='text-danger text-center'>${res.payload}</h4>`;
        } else {
            let html = `<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>


                                <tbody>`;
            let sl = res.payload.currentPage ? res.payload.currentPage * 10 - 10 : 0;
            res.payload.contact.forEach(function(item) {
                html += `<tr class="even">
                                        <td>${++sl}</td>
                                        <td>${item.name}</td>
                                        <td>${item.designation}</td>
                                        <td>${item.contact}</td>
                                        
                                        <td style="">${item.status=='1'?'Active':'Inactive'}</td>
                                        <td style="">${moment(item.created_at.date).format('Do MMM YY') }</td>
                                        <td style=""><button type="button" class="btn btn-info waves-effect waves-light" onclick='editRecord(this)' data-id=${item.id}><i class="fas fa-pencil-alt" title="delete"></i></button>

                                        <button type="button" class="btn btn-danger waves-effect waves-light" id="delete" onclick="alertItem(this)" data-id=${item.id}><i class=" fas fa-trash" title="delete"></i></button>                                                          
                                       
                                    </tr>`
            });
            html += ` </tbody>
                            </table>`;

            serviceTable.innerHTML = '';
            serviceTable.innerHTML = html;
            pagination.innerHTML = '';
            console.log(res);
            let pager = `<ul class="pagination pagination-rounded">
                                    <li class="paginate_button page-item previous ${res.payload.currentPage=='1'? 'disable':''}" id="datatable_previous"><a href="#" onclick="tableDataFetch(${10},${1})"  aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>`;
            for (let i = 1; i <= res.payload.totalPage; i++) {
                pager += `<li class="paginate_button page-item"><a href="#" aria-controls="datatable" onclick="tableDataFetch(${10},${i})" data-dt-idx="${i}" tabindex="0" class="page-link">${i}</a></li>`;
            }

            pager += `...`;
            pager += ` <li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" onclick="tableDataFetch(${10},${res.payload.totalPage})" ${res.payload.currentPage==res.payload.totalPage? 'disable':''}" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>`;
            pagination.innerHTML = pager;
            document.getElementById('datatable_info').innerHTML=`Showing ${sl+1-10} to  ${sl} records of ${res.payload.totalRecord}`;

        }
    }
    tableDataFetch();


    //Edit Process
    async function editRecord(record) {
        $("#staticBackdrop").modal('show');
        //get modal 
        let modalBody = document.getElementById('modal-body');
        modalBody.innerHTML = `<div>
           <button class='btn btn-primary mt-0 mb-0'>Loading......
           
           </button>
                                           
                                           
                                        </div>`;
        let res = await requestApiCall('<?= site_url('/api/emergency-contact-edit/') ?>' + record.dataset.id);
        if (res.errors == true) {
            modalBody.innerHTML = '';
            modalBody.innerHTML = `<h4 class='text-danger text-center'>${res.payload}</h4>`;
        } else {
            modalBody.innerHTML = `<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="updateForm" method="post" data-id=${res.payload.id} class='needs-validation' novalidate=''>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="validationCustom03" class="form-label">Service/Product Name</label>
                            <input id="validationCustom03" type="text" class="form-control" name="name" value="${res.payload.name}" required>
                            <span id="errorUpdate" class='text-danger'></span>
                            <div class="invalid-feedback">
                                Please Write a Service or Product Name.
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="validationCustom03" class="form-label">Service/Product Name</label>
                            <input id="validationCustom03" type="text" class="form-control" name="designation" value="${res.payload.designation}" required>
                            <span id="errorUpdate" class='text-danger'></span>
                            <div class="invalid-feedback">
                                Please Write a Service or Product Name.
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="validationCustom03" class="form-label">Service/Product Name</label>
                            <input id="validationCustom03" type="tel" class="form-control" name="contact" value="${res.payload.contact}" required>
                            <span id="errorUpdate" class='text-danger'></span>
                            <div class="invalid-feedback">
                                Please Write a Service or Product Name.
                            </div>

                        </div>
                        <div class="form-check form-switch mb-3" dir="ltr">
                                           <input type="hidden" name="status" value="0">
                                            <input type="checkbox" name="status"  value='1' class="form-check-input" id="customSwitch1" ${res.payload.status=='1'?'checked':''} >
                                            <label class="form-check-label" for="customSwitch1">${res.payload.status=='1'?'Active':'Inactive'}</label>
                                        </div>
                    </div>

                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>`;
            //Update Process
            let form = document.getElementById('updateForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let serviceId = form.dataset.id;
                let formData = new FormData(form);
                let bodyData = {};
                for (const [name, value] of formData) {
                    bodyData[name] = value;
                }

                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        fetch('<?= site_url('/api/emergency-contact-update/') ?>' + serviceId, {
                                method: 'post',
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify(bodyData)

                            })
                            .then(res => res.json())
                            .then(res => {
                                console.log(res);
                                if (res.errors) {
                                    if (typeof res.payload == "string") {
                                        document.getElementById('errorUpdate').innerHTML = res.payload;
                                    } else {
                                        console.log(res.payload);
                                        for (let item in res.payload) {
                                            toastr.error(`${res.payload[item]}`);
                                        }
                                    }

                                } else {
                                    $("#staticBackdrop").modal('hide');
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: res.code == '1' ? 'success' : 'info',
                                        title: res.payload,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    tableDataFetch();
                                }

                            })
                            .catch(err => console.log(err));
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

            });
        }

    }

    //Delete Record
    async function deleteRecord(id) {
        let res = await requestApiCall('<?= site_url('/api/emergency-contact-delete/') ?>' + id);
        if (res.errors) {
            Swal.fire('Error', res.payload, 'error');
            return false;
        }
        Swal.fire('Deleted!', 'The item has been deleted.', 'success');
        return true;
    }

    //Working with Search
    let search = document.getElementById('search');
    search.addEventListener('click', function() {
        if (this.value == '') {
            tableDataFetch();
        }
    });
    search.addEventListener('keyup', function() {
        if (search.value.length >= 3) {
            requestApiCall('<?= site_url('/api/emergency-contact-search') ?>', 'POST', {
                search: search.value
            }).then(res => {
                console.log(res);
                tableLoad(res);
            })

        } else {
            tableDataFetch();
        }
    });

    //Sweetalert
    function alertItem(record) {


        let itemId = record.dataset.id;
        console.log(itemId);
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Emergency Contact?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteRecord(itemId) ?
                    $(record).closest('tr').fadeOut('slow') : '';
            }
        })


    }

    //Working with Filtering
    let filter = document.getElementById('recordType');
    filter.addEventListener('change', function() {
        console.log(this.value);
        if (this.value == 0) {
            tableDataFetch();
        } else if (this.value == 1) {
            requestApiCall("<?= site_url('/api/emergency-active-contact') ?>", 'get').then(res => {
                tableLoad(res);
            })

        } else if (this.value == 2) {
            requestApiCall("<?= site_url('/api/emergency-inactive-contact') ?>", 'get').then(res => {
                tableLoad(res);
            })
        }
    });
    // //Work with pagiantion

    // document.addEventListener('DOMContentLoaded', function() {
    //   var paginationItems = document.querySelectorAll('.pagination li');

    //   paginationItems.forEach(function(item) {
    //     item.addEventListener('click', function() {
    //       // Remove active class from all <li> elements
    //       paginationItems.forEach(function(item) {
    //         item.classList.remove('active');
    //       });

    //       // Add active class to the clicked <li> element
    //       this.classList.add('active');
    //     });
    //   });
    // });
</script>

<?= $this->endSection() ?>