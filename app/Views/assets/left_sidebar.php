<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!-- User details -->
    <div class="user-profile text-center mt-3">
        <div class="">
            <img src="<?=base_url('/user/profile-image-show/'.session()->get('user')['user_info']->image_link)?>" alt="" class="avatar-md rounded-circle">
        </div>
        <div class="mt-3">
            <h4 class="font-size-16 mb-1">Julia Hudda</h4>
            <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
                <a href="index.html" class="waves-effect">
                    <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
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
                    <li><a href="email-read.html">Company List</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-handshake"></i>
                    <span>Meeting</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Report</a></li>
                    <li><a href="email-read.html">Meeting List</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="far fa-play-circle"></i>
                    <span>My activity</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Company List</a></li>
                    <li><a href="email-read.html">Attend Meeting</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-user-check"></i>
                    <span>Task</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Schedule</a></li>
                    <li><a href="email-read.html">Completed Task</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-user-plus"></i>
                    <span>Assign Task</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Add Task</a></li>
                    <li><a href="email-read.html">Task List</a></li>
                    <li><a href="email-read.html">Task Report</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-users-cog"></i>
                    <span>Team Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Add User</a></li>
                    <li><a href="email-read.html">Team List</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-file-export"></i>
                    <span>Report</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Company Report</a></li>
                    <li><a href="email-read.html">Meeting Report</a></li>
                    <li><a href="email-read.html">User Activity Report</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class=" waves-effect">
                    <i class="mdi-card-account-phone"></i>
                    <span>Emergency Contact</span>
                </a>
                
            </li>
            <li>
            <a href="javascript: void(0);" class=" waves-effect">
                    <i class="mdi-card-account-details-outline"></i>
                    <span>Manage Contact</span>
                </a>
                
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-hand-point-right"></i>
                    <span>Services</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Add Services</a></li>
                    <li><a href="email-read.html">Services List</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class=" fas fa-cart-plus"></i>
                    <span>Products</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Add Products</a></li>
                    <li><a href="email-read.html">Product List</a></li>
                </ul>
            </li>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-info-circle"></i>
                    <span>Company Portofolio</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email-inbox.html">Add Portofilo</a></li>
                    <li><a href="email-read.html">Portofolio List</a></li>
                </ul>
            </li>
            

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>