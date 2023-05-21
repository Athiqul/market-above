<?php

use App\Controllers\Api\Company;
?>
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


                <?= form_open('/meeting/add', "class='custom-validation' novalidate=''") ?>
                <div class="mb-3">
                    <label>Select Company:</label>
                    <input type="text" class="form-control" list="company" id="search" />
                    <datalist id="company">
                        
                    </datalist>
                    <span class="text-danger text-center"  id="errorMsgCompany"></span>
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>
                 
                </div>
                <div class="mb-3">
                    <label>Company Name:</label>
                    
                    <input type="text" class="form-control" name="company_name" value="<?=old('company_name',$getComId!=null ? companyInfo($getComId)->company_name:'')?>" id="companyName" readonly />
                   
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>
                  <input type="hidden" name="company_id" value="<?=old('company_id',$getComId??'')?>" id="company_id" required >
                </div>
                <div class="mb-3">
                    <label>Contact Person:</label>
                    <div>
                        <input type="text" class="form-control" name="contact_person" value="<?= old('contact_person') ?>" required="">
                        <span class="text-center text-danger"><?=session()->get('warning')['contact_person']??''?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Designation:</label>
                    <div>
                        <input type="text" class="form-control" name="desg" value="<?= old('desg') ?>" required="">
                        <span class="text-center text-danger"><?=session()->get('warning')['desg']??''?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Contact Number:</label>
                    <div>
                        <input type="tel" class="form-control" name="mobile" value="<?= old('mobile') ?>" pattern="01[3-9][0-9]{8}|[0-9]{8,11}" required="">
                        <span class="text-center text-danger"><?=session()->get('warning')['mobile']??''?></span>
                    </div>

                </div>

                <div class="mb-3">
                    <label>E-Mail</label>
                    <div>
                        <input type="email" class="form-control" name="email" value="<?= old('email') ?>" parsley-type="email">
                    </div>
                </div>




                <div class="mb-3">
                    <label>Meeting Summery</label>
                    <div>
                        <textarea required="" class="form-control" rows="5" name="summary"><?= old('summary') ?></textarea>
                        <span class="text-center text-danger"><?=session()->get('warning')['summary']??''?></span>
                    </div>
                </div>
                <div class="row">
           <h6>Interest Services</h6>
    <div id="services">
      
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
            document.getElementById('errorMsgCompany').innerHTML='';
              res.payload.forEach(function(item){
                    html+=`<option value='${item.id}'>${item.company_name}</option>`;
              });

              companyList.innerHTML=html;
              //get select company
              search.addEventListener('change',function(){
                let selectedCompany=companyList.querySelector(`option[value="${search.value}"]`);
                 if(selectedCompany)
                 {
                    //get id
                    let companyId=selectedCompany.value;
                    let companyName=selectedCompany.innerHTML;
                    console.log(companyId +' ' + companyName);
                    // Set Id And company name
                    document.getElementById('company_id').value=companyId;
                    document.getElementById('companyName').value=companyName;
                    search.value='';

                 }
                 
              });
            

           } else{
               let error=document.getElementById('errorMsgCompany');
               error.innerHTML='No Company found!';
              // search.value='';
               document.getElementById('companyName').value='';
           }

          })
          .catch(err=>console.log(err));
       }

     });

//fetch Services List
let checkBoxServices=document.getElementById('services');
fetch("<?=site_url('/api/active-service?limit=20')?>").then(res=>res.json()).then(res=>{
    console.log(res);
    if(res.errors==true)
    {
        checkBoxServices.innerHTML='';
    }
    else{
        html='';
        res.payload.services.forEach(function(item){
            html+=`<div class="form-check form-check-inline mb-3 col-md-3">
        <input class="form-check-input" type="checkbox" id="formCheck1" name="services[]" value="${item.id}">
        <label class="form-check-label" for="formCheck1">
          ${item.service_name}
        </label>
      </div>`;
        });
        checkBoxServices.innerHTML=html;
        
    }
}).catch(err=>{
    console.log(err);
})

    </script>
    <?= $this->endSection() ?>