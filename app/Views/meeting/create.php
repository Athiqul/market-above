<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>



<div class="row">
    <div class="col-xl-12">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Meeting Report</h4>

                <p class="card-title-desc">Please Provide Proper and Authentic information</p>


                <?= form_open('/company/add', "class='custom-validation' novalidate=''") ?>
                <div class="mb-3">
                    <label>Select Company:</label>
                    <input type="text" class="form-control" list="company" id="search" name="company_id" />
                    <datalist id="company">
                        
                    </datalist>
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>

                </div>
                <div class="mb-3">
                    <label>Contact Person:</label>
                    <div>
                        <input type="text" class="form-control" name="contact_person" value="<?= old('contact_person') ?>" required="">
                    </div>
                </div>
                <div class="mb-3">
                    <label>Designation:</label>
                    <div>
                        <input type="text" class="form-control" name="desg" value="<?= old('desg') ?>" required="">
                    </div>
                </div>
                <div class="mb-3">
                    <label>Contact Number:</label>
                    <div>
                        <input type="tel" class="form-control" name="mobile" value="<?= old('mobile') ?>" pattern="01[3-9][0-9]{8}||[0-9]{8}" required="">
                    </div>

                </div>

                <div class="mb-3">
                    <label>E-Mail</label>
                    <div>
                        <input type="email" class="form-control" name="email" value="<?= old('email') ?>" required="" parsley-type="email">
                    </div>
                </div>




                <div class="mb-3">
                    <label>Meeting Summery</label>
                    <div>
                        <textarea required="" class="form-control" rows="5" name="summery"><?= old('summery') ?></textarea>
                    </div>
                </div>


                <div class="mb-0">
                    <input type="hidden" name="user_id" value="<?= session()->get('user')['id'] ?>">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                            Submit
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




    <?= $this->section('custom-js') ?>
    <script src="<?= base_url('/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/pages/form-validation.init.js') ?>"></script>
    <script>

     
     //get search value
     let search=document.getElementById('search');
    // console.log(search);
     //get datalist company id
     let companyList=document.getElementById('company');

     search.addEventListener('keyup',function(){
        //console.log(this.value.length);
       if(this.value.length>=3)
       {
          let keyword=this.value;
          fetch('<?=site_url('/api/company-list?search')?>'+keyword)
          .then(res=> res.json())
          .then(res=>{
            console.log(res);
           let html='';
           if(res.errors==false)
           {
              res.payload.forEach(function(item){
                    html+=`<option value='${item.id}'>${item.company_name}</option>`;
              });

              companyList.innerHTML=html;
           }

          })
          .catch(err=>console.log(err));
       }

     });



    </script>
    <?= $this->endSection() ?>