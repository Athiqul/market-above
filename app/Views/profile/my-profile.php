<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="row">


    <div class="col-md-12 ">

        <div class="card text-center ">
            <center>
                <img class="card-img-top rounded avatar-lg img-fluid mt-2" src="<?= site_url('assets/images/small/img-2.jpg') ?>" alt="Card image cap">
            </center>

            <div class="card-body ">
                <h4 class="card-title"><?= $data['basic']->name ?></h4>
                <p class="text-muted"><?= $data['basic']->role == '0' ? 'Admin' : 'Marketing Executive' ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Mobile: <?= $data['basic']->mobile ?></li>
                <li class="list-group-item">email: <?= $data['basic']->email ?></li>
            </ul>
            <div class="card-body">
                <div class="my-4 text-center">
                    <p class="text-muted">Standard modal</p>
                    <button type="button" class="btn btn-info btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Update Profile</button>
                </div>

            </div>
        </div>

    </div><!-- end col -->




</div>

<div class="row">


    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title text-center text-info">User Information And Activity</h4>


                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">My Info</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="fas fa-calendar-week"></i></span>
                            <span class="d-none d-sm-block">Task</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="fas fa-chart-line"></i></span>
                            <span class="d-none d-sm-block">Activity</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#settings-1" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="fas fa-cloud-download-alt"></i></span>
                            <span class="d-none d-sm-block">Resume</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane" id="home-1" role="tabpanel">
                        <p class="mb-0">
                            Raw denim you probably haven't heard of them jean shorts Austin.
                            Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                            cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                            butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                            qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                            iphone. Seitan aliquip quis cardigan american apparel, butcher
                            voluptate nisi qui.
                        </p>
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
                    <div class="tab-pane active" id="settings-1" role="tabpanel">
                        <p class="mb-0">
                            Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                            art party before they sold out master cleanse gluten-free squid
                            scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                            art party locavore wolf cliche high life echo park Austin. Cred
                            vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                            farm-to-table.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Modal-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Profile Update</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="card">
                                    <div class="card-body"> 
                                        <p class="card-title-desc">Please Provide Proper and Authentic information</p>
        
                                        <?=$this->include('assets/alert')?>
                                        <form class="custom-validation" novalidate='' id="form_update">
                                     
                                            <div class="mb-3">
                                                <label>NID:</label>
                                                <input type="text" class="form-control" name="nid" value="<?=old('nid')?>">
                                            </div>
        
                                            <div class="mb-3">
                                                <label>Designation:</label>
                                                <div>
                                                    <input type="text"  class="form-control" name="desg" value="<?=old('desg')?>" >
                                                </div>
                                          
                                            </div>
        
                                            <div class="mb-3">
                                                <label for="gender">Gender: </label>
                                                <div>
                                                <select class="form-select" id="gender" name="sex">
                                                           <option selected>Choose.....</option>
                                                            <option  value="0">Male</option>
                                                            <option  value="1">Female</option>
                                                            <option  value="2">Other</option>
                                                            
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="about">About</label>
                                                <div>
                                                    <textarea name="about" class="form-control" id="about" rows="5">
                                                    <?=old('about')?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            
                                            <div class=" mb-3">
                                            <label for="example-date-input" class="col-sm-2 col-form-label">Date of Birth</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="date"  name="dob" value="1999-08-19" min="<?=date('Y-m-d',strtotime('-60 years'))?>" max="<?=date('Y-m-d',strtotime('-18 years'))?>" id="example-date-input">
                                            </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="division" class="form-label">Division:</label>
                                                        <select class="form-select division" id="division" name="division" >
                                                           
                                                           
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid division.
                                                        </div>
        
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                    <label for="district" class="form-label">District:</label>
                                                    <select class="form-select district" id="district" name="district">
                                                          
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid district.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                    <label for="thana" class="form-label">Thana:</label>
                                                    <select class="form-select thana" id="thana" name="thana" >
                                                           
                                                           
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
                                                    <select class="form-select union" id="union" name="area" >
                                                            <option selected="" value=""  >Choose...</option>
                                                            
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
                                                    <input name="address" id="address" type="text"  value="<?=old('address')?>" class="form-control">
                                                </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-0">
                                                <input type="hidden" name="user_id" value="<?=session()->get('user')['id']?>">
                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                                                            </div>
                                                           
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
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
      //console.log(data.msg);
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
     // console.log(data.msg);
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

  // Profile Upload
   let updateFrom= document.getElementById("form_update");
   updateFrom.addEventListener('submit',function(e){
      e.preventDefault();
      //get form data
      let obj={};
      const formData= new FormData(updateFrom);
      for (let [key, value] of formData.entries()) {
            let get=key;

     obj[`${key}`]=value;
  }
  console.log(obj);
  fetch("<?=site_url('/api/user-update/'.session()->get('user')['id'])?>",{
    method:"POST",
    headers: {
      "Content-Type": "application/json",
    },
    body:JSON.stringify(obj)
  })
  .then(res=>res.json())
  .then(res=> console.log(res))
  .catch(err=>console.log(err));
   })
    </script>
    <?=$this->endSection()?>