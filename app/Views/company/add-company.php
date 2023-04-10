<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>




<?= $this->section('content') ?>



    <div class="row">
                            <div class="col-xl-12">
                               
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Company Add</h4>
                                       
                                        <p class="card-title-desc">Please Provide Proper and Authentic information</p>
        
                                        <?=$this->include('assets/alert')?>
                                        <?=form_open('/company/add',"class='custom-validation' novalidate=''")?>
                                            <div class="mb-3">
                                                <label>Company Name:</label>
                                                <input type="text" class="form-control" name="company_name" value="<?=old('company_name')?>" required>
                                            </div>
        
                                            <div class="mb-3">
                                                <label>Contact Number:</label>
                                                <div>
                                                    <input type="tel"  class="form-control" name="mobile" value="<?=old('mobile')?>" pattern="01[3-9][0-9]{8}" required="" >
                                                </div>
                                          
                                            </div>
        
                                            <div class="mb-3">
                                                <label>E-Mail</label>
                                                <div>
                                                    <input type="email" class="form-control" name="email"  value="<?=old('email')?>" required="" parsley-type="email">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label>Website:(if any have:)</label>
                                                <div>
                                                    <input parsley-type="url" name="url" type="url" value="<?=old('url')?>" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Company Business type:</label>
                                                <div>
                                                    <textarea required="" class="form-control" rows="5" name="company_desc"><?=old('company_desc')?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="division" class="form-label">Division:</label>
                                                        <select class="form-select division" id="division" name="division" required="">
                                                           
                                                           
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid division.
                                                        </div>
        
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                    <label for="district" class="form-label">District:</label>
                                                    <select class="form-select district" id="district" name="district" required="">
                                                          
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid district.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                    <label for="thana" class="form-label">Thana:</label>
                                                    <select class="form-select thana" id="thana" name="thana" required="">
                                                           
                                                           
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid thana.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                    <label for="union" class="form-label">Union/Ward:</label>
                                                    <select class="form-select union" id="union" name="area" required="">
                                                            <option selected=""  value="">Choose...</option>
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid Union/Ward.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                    <label for="address">Street Address:</label>
                                                <div>
                                                    <input name="address" id="address" type="text" required="" value="<?=old('address')?>" class="form-control">
                                                </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-0">
                                                <input type="hidden" name="user_id" value="<?=session()->get('user')['id']?>">
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

 
   

    <?=$this->section('custom-js')?>
    <script src="<?=base_url('/assets/libs/parsleyjs/parsley.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/pages/form-validation.init.js')?>"></script>
    <script>
        //divisions

  let div=document.getElementById("division");
  let dis=document.getElementById("district");
  let thana=document.getElementById("thana");
  let union=document.getElementById('union');
  
//fetch divisions
  fetch('<?=site_url('/api/divisions')?>')
  .then(res=>res.json())
  .then((data)=>{
       // console.log(data);
        if(data.success==true)
        {
          let payload=data.msg;
          div.innerHTML='';
          let html='<option value="">Select Division</option>';
           payload.forEach(function(item){
             // console.log(item);
              html+=`<option value=${item.id}>${item.en_name}</option>`
           });

           div.innerHTML=html;
          
        }
  })
  .catch(err=>{
    console.log(err);
  });

  div.addEventListener('change',function(){
   //console.log(this.value);
   //fetch districts
   if(this.value=="")
   {
    dis.innerHTML='';
    thana.innerHTML='';
    union.innerHTML='';
    return;
   }
   fetch('<?=site_url('/api/division-to-districts/')?>'+this.value)
   .then(res=>res.json())
   .then(data=>{
      console.log(data.msg);
      let html='<option value="">Select Districts</option>';
      data.msg.forEach(function(item){
         html+=`<option value=${item.id}>${item.en_name}</option>`;
      });
      dis.innerHTML=html;
     
   }).catch(err=>console.log(err))
  });

  dis.addEventListener('change',function(){
   //console.log(this.value);
   //fetch districts
   if(this.value=="")
   {
    thana.innerHTML='';
    union.innerHTML='';
    return;
   }
   fetch('<?=site_url('/api/district-to-thana/')?>'+this.value)
   .then(res=>res.json())
   .then(data=>{
      console.log(data.msg);
      let html='<option value="">Select Thana</option>';
      data.msg.forEach(function(item){
         html+=`<option value=${item.id}>${item.en_name}</option>`;
      });
      thana.innerHTML=html;
     
   }).catch(err=>console.log(err))
  });

  thana.addEventListener('change',function(){
   //console.log(this.value);
   //fetch districts
   if(this.value=="")
   {
   
    union.innerHTML='';
    return;
   }
   fetch('<?=site_url('/api/thana-to-unions/')?>'+this.value)
   .then(res=>res.json())
   .then(data=>{
    console.log(data.msg);
      let html='<option value="">Select Union/Ward</option>';
      data.msg.forEach(function(item){
         html+=`<option value=${item.id}>${item.en_name}</option>`;
      });
      union.innerHTML=html;
     
   }).catch(err=>console.log(err))
  });

    </script>
    <?=$this->endSection()?>