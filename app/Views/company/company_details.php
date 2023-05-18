<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="false" title="Basic Info">
                            <span class="d-block d-sm-none"><i class="fas fa-info-circle"></i></span>
                            <span class="d-none d-sm-block">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" id="meeting" href="#profile-1" role="tab" aria-selected="false" title="Meeting Reports">
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
                    <div class="tab-pane active" id="home-1" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border border-primary">
                                    <div class="card-header bg-transparent border-primary">
                                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i><?= $info->company_name ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Summery :</h5>
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
                                            <li>
                                                Added By: <a href="http://">
                                                    <?= getUsername($info->user_id)->name ?>
                                                </a>

                                            </li>
                                            <li>
                                                Created At:
                                                <?= date('jS F Y', strtotime($info->created_at)) ?>

                                            </li>
                                            <li>
                                                Last Updated At:
                                                <?= date('jS F Y', strtotime($info->updated_at)) ?>
                                            </li>
                                        </ul>
                                        <div class="col-md-4">
                                            <a href="<?= site_url('/company/edit/' . $info->id) ?>" class="btn btn-info">Edit Information</a>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>

                    </div>
                    <div class="tab-pane" id="profile-1" role="tabpanel">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Meeting Report of <?=$info->company_name?></h4>


                                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            
                                            <div class="row">
                                                <div class="col-sm-12" id="targetTable">

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-5">
                                                    <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"></div>
                                                </div>
                                                <div class="col-sm-12 col-md-7">
                                                    <div class="dataTables_paginate paging_simple_numbers" id="pagination">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="tab-pane" id="messages-1" role="tabpanel">

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
<script>
    
    let meetingTab=document.getElementById("meeting");
    meetingTab.addEventListener('click',function(){
      //Render Company Meeting Data
    //Get Meeting Table
    let targetTable = document.getElementById('targetTable');
    let pagination=document.getElementById('pagination');

    
    
      //APi calling
      async function apiCalling(url,type,data)
    {
        const request=await fetch(url,{
            method:type,
            headers:{
                "Content-Type":"application/json"
            },
            body:JSON.stringify(data),

        });
        const getRes= await request.json();
        return getRes;
    }
    async function tableDataFetch(limit=10,page=1)
    {
        let res=await apiCalling("<?= site_url('/api/company-report/'.$info->id.'?page=') ?>"+page+'&limit='+limit);
         tableLoad(res);
        return;
    }

    //Table load function
    function tableLoad(res)
    {
      targetTable.innerHTML='<h2>Loading......</h2>';
        if (res.errors == true) {
              targetTable.innerHTML = '';
              targetTable.innerHTML = `<h4 class='text-danger text-center'>${res.payload}</h4>`;
            } else {
                let html = `<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                       <th >Action</th>
                                        
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">Contact Person</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">Designation</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">Phone</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 745px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">Created at</th>
                                        
                                       
                                    </tr>
                                </thead>


                                <tbody>`;
                let sl =res.payload.currentPage? res.payload.currentPage*10-10:0;
                res.payload.records.forEach(function(item) {
                    ++sl;
                    html += `<tr class="even">
                    <td style=""><a href="<?= site_url('meeting/details/') ?>${item.id}" class="btn btn-info waves-effect waves-light"><i class="fas fa-eye" title="view"></i></a>


</td>
                                        
                                       
                                        <td style="">${item.contact_person}</td>
                                        <td style="">${item.desg}</td>
                                        <td style="">${item.mobile}</td>
                                        <td style="">${moment(item.created_at.date).format('Do MMM YY') }</td>
                                       
                                                                                       
                                       
                                    </tr>`
                });
                html += ` </tbody>
                            </table>`;

              targetTable.innerHTML = '';
              targetTable.innerHTML = html;
                pagination.innerHTML='';
                console.log(res);
                let pager=`<ul class="pagination pagination-rounded">
                                    <li class="paginate_button page-item previous ${res.payload.currentPage=='1'? 'disable':''}" id="datatable_previous"><a href="#" onclick="tableDataFetch(${10},${1})"  aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>`;
                                    for(let i=1;i<=res.payload.totalPage;i++)
                                    {
                                        pager+=`<li class="paginate_button page-item"><a href="#" aria-controls="datatable" onclick="tableDataFetch(${10},${i})" data-dt-idx="${i}" tabindex="0" class="page-link">${i}</a></li>`;
                                    }
                                    
                                   pager+=`...`;
                                   pager+=` <li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" onclick="tableDataFetch(${10},${res.payload.totalPage})" ${res.payload.currentPage==res.payload.totalPage? 'disable':''}" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>`;
             pagination.innerHTML=pager;
             document.getElementById('datatable_info').innerHTML=`Showing ${res.payload.currentPage*10+1-10} to ${sl} of ${res.payload.totalRecord} entries`;

            }
    }

    tableDataFetch();

    });

    //Pagination 
     //default fetch
   

   ///Work with Interest service
   let interest=document.getElementById("interest");
   interest.addEventListener('click',function(){
   //target element
   let targetElement=document.getElementById("messages-1");
     //Api calling
     fetch().then(res=>res.json()).then(res=>{

     }).catch(err=>console.log(err));
   });
    
    </script>
<?= $this->endSection() ?>