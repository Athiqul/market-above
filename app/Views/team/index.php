<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">All User List</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=site_url('/')?>">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Team List</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                       
                                        <?php if($list==null):?>
                                            <h4>No Team member Added Yet</h4>
                                            <?php else:?>
                                        <div class="table-responsive">
                                            <table class="table table-editable table-nowrap align-middle table-edits">
                                                <thead>
                                                    <tr style="cursor: pointer;">
                                                        <th>EmployID</th>
                                                        <th>Name</th>
                                                        <th>Photo</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Role</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($list as $item):?>
                                                        <?php 
                                                            if($item->id==session()->get('user')['id'])
                                                            {
                                                                continue;
                                                            }
                                                            ?>
                                                    <tr style="cursor: pointer;">
                                                        <td style="width: 80px"><?=$item->employ_id?></td>
                                                        <td ><?=$item->name?></td>
                                                        <td>
                                                            <img src="<?=site_url('/user/profile-image-show/'.userImage($item->id))?>" style="width:50px;height:50px">
                                                        </td>
                                                        <td ><?=$item->mobile?></td>
                                                        <td ><?=$item->email?></td>
                                                        <td ><?=$item->status==1?'Active':'inactive'?></td>
                                                        <td ><?=$item->role==1?'Executive':'Admin'?></td>
                                                        <td style="width: 100px">
                                                            <a href="<?=site_url('/team-management/user-info/'.$item->id)?>" class="btn btn-outline-info btn-sm edit " title="View">
                                                                <i class=" fas fa-eye"></i>
                                                            </a>
                                                            <?php if(session()->get('user')['role']=='admin'):?>
                                                            <a href="<?=site_url('/team-management/action/'.$item->id)?>" class="btn <?=$item->status==1?'btn-outline-danger':'btn-outline-success'?>  btn-sm edit" title="<?=$item->status==1?'Make Inactive':'Make Active'?>">
                                                                <i class="<?=$item->status==1?'fas fa-user-minus':' fas fa-user-plus'?> "></i>
                                                            </a>
                                                            <?php endif?>
                                                        </td>
                                                    </tr>
                                                  <?php endforeach?>
                                                  
                                                  
                                                </tbody>
                                            </table>
                                            <?=$pager->links()?>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                  

<?=$this->endSection()?>