<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>



    <div class="row">
                            <div class="col-xl-12">
                               
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add New User</h4>
                                       
                                        <p class="card-title-desc">Please Provide Proper and Authentic information</p>
        
                                        
                                        <?=form_open('/team-management/add-user',"class='custom-validation' novalidate=''")?>
                                            <div class="mb-3">
                                                <label>Name:</label>
                                                <input type="text" class="form-control" name="name" value="<?=old('name')?>" required>
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['name']??''?></span>
                                                    <?php endif?>
                                            </div>

                                            <div class="mb-3">
                                                <label>Employ ID:</label>
                                                <input type="text" class="form-control" name="employ_id" value="<?=old('employ_id')?>" required>
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['employ_id']??''?></span>
                                                    <?php endif?>
                                            </div>
        
                                            <div class="mb-3">
                                                <label>Mobile Number:</label>
                                                <div>
                                                    <input type="tel"  class="form-control" name="mobile" value="<?=old('mobile')?>" pattern="01[3-9][0-9]{8}" required="" >
                                                </div>
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['mobile']??''?></span>
                                                    <?php endif?>
                                            </div>
        
                                            <div class="mb-3">
                                                <label>E-Mail</label>
                                                <div>
                                                    <input type="email" class="form-control" name="email"  value="<?=old('email')?>" required="" parsley-type="email">
                                                    <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['email']??''?></span>
                                                    <?php endif?>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label>Password</label>
                                                <div>
                                                    <input parsley-type="password" name="password" type="password" class="form-control" required>
                                                    <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['password']??''?></span>
                                                    <?php endif?>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Confirm Password:</label>
                                                <div>
                                                <input parsley-type="password" name="confirm_password" type="password"  class="form-control" required>
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['confirm_password']??''?></span>
                                                    <?php endif?>
                                                </div>
                                            </div>
                                           
                                            <div class="mb-0">
                                               
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" onsubmit="confirm('Are You Sure?')">
                                                        Add new User
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                           
                      
    <?= $this->endSection() ?>

 
   

    <?=$this->section('custom-js')?>
    <script src="<?=base_url('/assets/libs/parsleyjs/parsley.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/pages/form-validation.init.js')?>"></script>
   
    <?=$this->endSection()?>