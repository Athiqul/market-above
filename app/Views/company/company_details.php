<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>




<div class="row">


    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h2 class="card-title text-center mb-5"><?=$info->company_name?> Company Information, Meeting Reports and interest Services</h2>


                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="false" title="Basic Info">
                            <span class="d-block d-sm-none"><i class="fas fa-info-circle"></i></span>
                            <span class="d-none d-sm-block">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="false" title="Meeting Reports" >
                            <span class="d-block d-sm-none"><i class="fas fa-handshake"></i></span>
                            <span class="d-none d-sm-block">Meeting Reports</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab" aria-selected="false" title="Interest Services">
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
                                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i><?=$info->company_name?></h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Summery :</h5>
                                        <p class="card-text"><?=$info->company_desc?></p>
                                        <h5 class="card-title">Contact :</h5>
                                        <ul class="list-unstyled">
                                            <li>
                                                Mobile: <a href="tel:<?=$info->mobile?>" class="btn btn-link text-dark"><?=$info->mobile?></a> 
                                            </li>
                                            <li>
                                                Email: <a href="mailto:<?=$info->email?>" class="btn btn-link text-dark"><?=$info->email?></a> 
                                            </li>
                                            <li>
                                                Website: <a href="<?=$info->url??''?>" target="_blank" class="btn btn-link text-dark"><?=$info->url??'No website given'?></a> 
                                            </li>
                                            <li>
                                                Address: <address>
                                                   <?= $info->address . ',' .$info->area. ',' .$info->thana . ',' .$info->district . ',' .$info->division?>
                                                </address>
                                            </li>
                                            <li>
                                                Added By: <a href="http://">
                                                    <?=getUsername($info->user_id)->name?>
                                                </a>
                                                
                                            </li>
                                            <li>
                                                Created At: 
                                                    <?=date('jS F Y',strtotime($info->created_at)) ?>
                                                
                                            </li>
                                            <li>
                                                Last Updated At: 
                                                    <?=date('jS F Y',strtotime($info->updated_at)) ?>
                                            </li>
                                        </ul>
                                        <div class="col-md-4">
                                            <a href="<?=site_url('/company/edit/'.$info->id)?>" class="btn btn-info">Edit Information</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            
        
                           
                        </div>

                    </div>
                    <div class="tab-pane" id="profile-1" role="tabpanel">
                        <p class="mb-0">
                            Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                            single-origin coffee squid. Exercitation +1 labore velit, blog
                            sartorial PBR leggings next level wes anderson artisan four loko
                            farm-to-table craft beer twee. Qui photo booth letterpress,
                            commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                            vinyl cillum PBR. Homo nostrud organic, assumenda labore
                            aesthetic magna 8-bit.
                        </p>
                    </div>
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <p class="mb-0">
                            Etsy mixtape wayfarers, ethical wes anderson tofu before they
                            sold out mcsweeney's organic lomo retro fanny pack lo-fi
                            farm-to-table readymade. Messenger bag gentrify pitchfork
                            tattooed craft beer, iphone skateboard locavore carles etsy
                            salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                            Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                            mi whatever gluten-free.
                        </p>
                    </div>
                   
                </div>

            </div>
        </div>
    </div>
</div>
        
                           
                      
    <?= $this->endSection() ?>

 
   
