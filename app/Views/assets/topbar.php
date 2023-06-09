<header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/images/logo-mini.svg')?>" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/images/logo.svg')?>" alt="logo-dark" height="20">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/images/logo-mini.svg')?>" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/images/logo.svg')?>" alt="logo-light" height="20">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="ri-search-line"></span>
                            </div>
                        </form>

                      
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
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
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-notification-3-line"></i>
                                <span class="noti-dot"  id="noti-icon"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
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
                                <div data-simplebar style="max-height: 230px;" id="notification">
                                    
                                    
                                 

                                   
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
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $topUserImage=userImage(session()->get('user')['id']);
                                ?>
                                <img class="rounded-circle header-profile-user" src="<?=$topUserImage!=null?base_url('/user/profile-image-show/'.$topUserImage):base_url('/user/profile-image-show/default.png')?>"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1"><?=session()->get('user')['name']?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="<?=site_url('/user/my-profile')?>"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                                <a class="dropdown-item " href="<?=site_url('/user/password-change')?>"><i class="ri-settings-2-line align-middle me-1"></i>Change Password</a>
                                <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?=site_url('/logout')?>"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                        </div>

                       
            
                    </div>
                </div>
            </header>
            <script>
            //Notification
            let notiDiv=document.getElementById('notification');
           // console.log(notiDiv);
           //fetch operation
           fetch("<?=base_url('/api/task/notify/').session()->get('user')['id']?>")
           .then(res=>res.json())
           .then(res=>{
              //console.log(res);
              let html='';
              if(res.errors)
              {
                  html=`<p class='text-center'>No new Notification!</p>`;
                  let notiIcon=document.getElementById('noti-icon');
               notiIcon.innerText='';
               notiIcon.classList.remove('text-danger');
               notiIcon.classList.remove('noti-dot');
              } else{
               let len=Object.keys(res.payload).length;
               let notiIcon=document.getElementById('noti-icon');
               notiIcon.innerText=len;
               notiIcon.classList.add('text-danger');
               notiIcon.classList.add('noti-dot')
                res.payload.forEach(function(item){

                    html+=`<a href="<?=site_url('/my-task/pending')?>" data-id=${item.id} onclick="markRead(event)" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class=" fab fa-telegram-plane"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">You are assigned for new task</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">Please Complete it before deadline</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>${moment(item.created_at.date).fromNow()} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>`;
                });
                
              }
              notiDiv.innerHTML=html;
           })
           .catch(err=>{
             console.log(err);
           }); 


            </script>