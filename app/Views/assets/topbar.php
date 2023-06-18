<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url('assets/images/logo-mini.svg') ?>" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('assets/images/logo.svg') ?>" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url('assets/images/logo-mini.svg') ?>" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('assets/images/logo.svg') ?>" alt="logo-light" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

         


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>





            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot" id="noti-icon"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown" style="">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar="init" style="max-height: 230px;" class="">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;" id="notification">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none; height: 147px;"></div>
                        </div>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $topUserImage = userImage(session()->get('user')['id']);
                    ?>
                    <img class="rounded-circle header-profile-user" src="<?= $topUserImage != null ? base_url('/user/profile-image-show/' . $topUserImage) : base_url('/user/profile-image-show/default.png') ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1"><?= session()->get('user')['name'] ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?= site_url('/user/my-profile') ?>"><i class="ri-user-line align-middle me-1"></i> Profile</a>  
                    <a class="dropdown-item " href="<?= site_url('/user/password-change') ?>"><i class="ri-settings-2-line align-middle me-1"></i>Change Password</a>
                 
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= site_url('/logout') ?>"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>



        </div>
    </div>
</header>
<script>
    //Get Rule

    let role = "<?= session()->get('user')['role'] ?>";
    //for admin  notification  
    if (role == 'admin') {
       
        notify("<?= site_url('/api/user-activity') ?>", 'admin');
        setInterval(()=>notify("<?= site_url('/api/user-activity') ?>", 'admin'), 15000);

    } else {
           notify("<?=site_url('/api/task/notify/'.session()->get('user')['id'])?>",'user');
    }


    //Notification function
    function notify(url, role) {
        
        let notiDiv = document.getElementById('notification');
        // console.log(notiDiv);
        //fetch operation
        fetch(url)
            .then(res => res.json())
            .then(res => {
                console.log(res);
                let html = '';
                if (res.errors) {
                    html = `<p class='text-center'>No new Notification!</p>`;
                    let notiIcon = document.getElementById('noti-icon');
                    notiIcon.innerText = '';
                    notiIcon.classList.remove('text-danger');
                    notiIcon.classList.remove('noti-dot');
                } else {
                    console.log(res);
                    let len = Object.keys(res.payload).length;
                    let notiIcon = document.getElementById('noti-icon');
                    notiIcon.innerText = len;
                    notiIcon.classList.add('text-light');
                    notiIcon.classList.add('noti-dot')
                    res.payload.forEach(function(item) {
                        let adminRedirect = '#';
                        if(role=='admin')
                        {
                            let type = item.activity.type??'';
                            if (type == '1') {
                            adminRedirect = "<?= site_url('/company/details/') ?>" + item.activity.company_id;
                        }
                        if (type == '2') {
                            adminRedirect = "<?= site_url('/meeting/details/') ?>" + item.activity.meeting_id;
                        }
                        if (type == '3') {
                            //adminRedirect="<?= site_url('/company/details/') ?>"+item.activity.company_id;
                        }
                        }
                     
                     
                       
                        let redirect = role == 'user' ? "<?= site_url('/my-task/pending') ?>" : `${adminRedirect}`;
                        html += `<a href="${redirect}" data-id=${role=='user'?item.id:item.activity.type} onclick="${role=='user'?'markRead(event)':''}" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class=" fab fa-telegram-plane"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">${role=='user'?'You are assigned for new task':item.userName + ' '+ item.title}</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">${role=='user'?'Please Complete it before deadline':item.message}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>${role=='admin'? moment(item.activity.created_at.date).fromNow():moment(item.created_at.date).fromNow()} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>`;
                    });

                }
                notiDiv.innerHTML = html;
            })
            .catch(err => {
                console.log(err);
            });


    }
</script>