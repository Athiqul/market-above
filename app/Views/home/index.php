<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>

                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                  
                                    <h4 class="mb-sm-0">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Above IT</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                      
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Company Added</p>
                                                <h4 class="mb-2"><?=$totalCompany?></h4>
                                              
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                            
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Meeting</p>
                                                <h4 class="mb-2"><?=$totalMeeting?></h4>
                                             
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Products & Services </p>
                                                <h4 class="mb-2"><?=$totalInterest?></h4>
                                               <span>Interest By Company</span>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-user-3-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Pending Task</p>
                                                <h4 class="mb-2"><?=$pendingTask?></h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <!-- end row -->
    
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="<?=site_url('/meeting/list')?>" class="dropdown-item">Meeting Report</a>
                                                <!-- item-->
                                                <a href="<?=site_url('/company/list')?>" class="dropdown-item">Company Report</a>
                                                <!-- item-->
                                                <a href="<?=site_url('/assign/task-report')?>" class="dropdown-item">Task</a>
                                                <!-- item-->
                                                <a href="<?=site_url('/emergency-contact/for-agents')?>" class="dropdown-item">Support</a>
                                            </div>
                                        </div>
    
                                        <h4 class="card-title mb-4">Latest Interest Shown By Company for services or Products</h4>
    
                                        <div class="table-responsive">
                                            <?php if($interestItems):?>
                                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <th>Service/Product</th>
                                                        <th>Meeting With</th>
                                                        <th>Agent</th>
                                                        <th>Date</th>
                                                       
                                                    </tr>
                                                </thead><!-- end thead -->
                                                <tbody>
                                                    <?php foreach($interestItems as $item):?>
                                                    <tr>
                                                        <td>
                                                            <h6 class="mb-0">
                                                            <a href="<?=site_url('/company/details/'.$item->company_id)?>">
                                                            <?=companyInfo($item->company_id)->company_name?>
                                                    </a>
                                                </h6>
                                            </td>

                                                        <td><?=servicesInfo($item->services_id)->service_name?></td>
                                                        <td>
                                                            <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                            <?php 
                                                            //get meeting info agent and contact person name
                                                            $record=meetingReport($item->meeting_id);
                                                            $agent=getUsername($record->user_id)->name;

                                                            ?>
                                                            <a href="<?=site_url('/meeting/details/'.$item->meeting_id)?>">
                                                            <?=$record->contact_person?>
                                                        </a>
                                                           
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <a href="<?=site_url('/team-management/user-info/'.$record->user_id)?>">
                                                            <?=$agent?>
                                                        </a>
                                                          
                                                        </td>
                                                        <td>
                                                           <?=date('h:s:i j M y ',strtotime($item->created_at))?>
                                                        </td>
                                                       
                                                    </tr>
                                                    <?php endforeach?>
                                                     <!-- end -->
                                                   
                                                </tbody><!-- end tbody -->
                                            </table> <!-- end table -->
                                            <?php else:?>
                                                <h4>No records!</h4>
                                                <?php endif?>
                                        </div>
                                    </div><!-- end card -->
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                          <!-- end col -->
                        </div>
                        <!-- end row -->
                   
<!--Modal-->

<?= $this->endSection() ?>


