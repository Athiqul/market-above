<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!-- User details -->
    <div class="user-profile text-center mt-3">
        <div class="">
        <?php
                                $topUserImage=userImage(session()->get('user')['id']);
                                ?>
            <img src="<?=$topUserImage!=null?base_url('/user/profile-image-show/'.$topUserImage):base_url('/user/profile-image-show/default.png')?>" alt="" class="avatar-md rounded-circle">
        </div>
        <div class="mt-3">
            <h4 class="font-size-16 mb-1"><?=session()->get('user')['name']?></h4>
            <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
                <a href="<?=site_url('/')?>" class="waves-effect">
                    <i class="ri-dashboard-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-building"></i>
                    <span>Company</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/company/add')?>">Add Company</a></li>
                    <li><a href="<?=site_url('/company/list')?>">Company List</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-handshake"></i>
                    <span>Meeting</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/meeting/add')?>">Add Report</a></li>
                    <li><a href="<?=site_url('meeting/list')?>">Meeting List</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="far fa-play-circle"></i>
                    <span>My activity</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/my-activity/company-list')?>">Company List</a></li>
                    <li><a href="<?=site_url('/my-activity/meeting-list')?>">Attend Meeting</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-user-check"></i>
                    <span>Task</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/my-task/pending')?>">Schedule</a></li>
                    <li><a href="<?=site_url('/my-task/complete')?>">Completed Task</a></li>
                </ul>
            </li>
            <?php if(session()->get('user')['role']=='admin'):?>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-user-plus"></i>
                    <span>Assign Task</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/assign/add-task')?>">Add Task</a></li>
                    <li><a href="<?=site_url('/assign')?>">Task List</a></li>
                    <li><a href="<?=site_url('/assign/task-report')?>">Task Report</a></li>
                </ul>
            </li>
           
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-users-cog"></i>
                    <span>Team Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/team-management/add-user')?>">Add User</a></li>
                    <li><a href="<?=site_url('/team-management')?>">Team List</a></li>
                </ul>
            </li>
           
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-file-export"></i>
                    <span>Report</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?=site_url('/report/company')?>">Company Report</a></li>
                    <li><a href="<?=site_url('/report/meeting')?>">Meeting Report</a></li>
                    
                </ul>
            </li>
            <?php endif?>
            <li>
            <a href="<?=site_url('/emergency-contact/for-agents')?>" class=" waves-effect">
                    <i class="mdi-card-account-phone"></i>
                    <span>Emergency Contact</span>
                </a>
                
            </li>
            <?php if(session()->get('user')['role']=='admin'):?>
            <li>
            <a href="<?=site_url('/emergency-contact')?>" class=" waves-effect">
                    <i class="mdi-card-account-details-outline"></i>
                    <span>Manage Contact</span>
                </a>
                
            </li>
          
            <li>
            <a href="<?=site_url('/services')?>" class="has-arrow waves-effect">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Services & Products</span>
                </a>
               
            </li>
            <?php endif?>
          
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-info-circle"></i>
                    <span>Company Documents</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                <?php if(session()->get('user')['role']=='admin'):?>
                    <li><a href="<?=site_url('/company-info/add')?>">Add Document</a></li>
                    <?php endif?>
                    <li><a href="<?=site_url('/company-info')?>">Documents</a></li>
                </ul>
            </li>
            

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>