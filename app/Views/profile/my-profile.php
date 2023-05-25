<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="row">


    <div class="col-md-12 ">

        <div class="card text-center ">
            <center>
                
            <?php 
            $profileImage=userImage($data['basic']->id);
            ?>
                <img class="card-img-top rounded avatar-lg img-fluid mt-2" src="<?=$profileImage!=null?base_url('/user/profile-image-show/'.$profileImage):base_url('/user/profile-image-show/default.png') ?>" alt="Card image cap">
                
               <br>
               <br>
                <a href="<?=site_url('/user/profile-image-change/'.$data['basic']->id)?>" class="btn btn-info btn-rounded waves-effect waves-light">Change Picture</a>
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
                    <button type="button" class="btn btn-info btn-rounded waves-effect waves-light" id="profile-update" data-bs-toggle="modal" data-bs-target="#myModal">Update Profile</button>
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="false">
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
                        <a class="nav-link" data-bs-toggle="tab" href="#settings-1" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="fas fa-cloud-download-alt"></i></span>
                            <span class="d-none d-sm-block">Resume</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted" id="profile-info">
                    <div class="tab-pane active" id="home-1" role="tabpanel">
                        

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
                    <div class="tab-pane " id="settings-1" role="tabpanel">
                        <?php if($data['info']==null || $data['info']->resume_link==null):?>
                            <h6 class="text-danger text-center">You have not uploaded any resume please upload your resume</h6>
                            <?php else:?>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center mb-3">
                                    <h6 class="text-center text-success">Your resume uploaded You can overview your resume</h6>
                                <a class=" btn btn-secondary btn-rounded waves-effect waves-light" href="<?= site_url('user/resume-show/'.$data['info']->resume_link) ?>" target="_blank">View Resume</a>
                                    </div>
                                </div>
                              </div>
                        <?php endif?>
                      <div class="row">
                     <div class="col-md-12">
                        <div class="text-center">
                        <a href="<?=site_url('/user/resume-upload')?>" class="btn btn-primary btn-rounded waves-effect waves-light" >Upload New Resume</a>
                        </div>
                     </div>
                      </div>
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

                        <?= $this->include('assets/alert') ?>
                        <form class="custom-validation" novalidate='' id="form_update">

                            <div class="mb-3">
                                <label>NID:</label>
                                <input type="text" pattern="^[0-9]{10,17}$" class="form-control" name="nid" id="nid" value="<?= old('nid', $data['info']->nid??'') ?>" required="">
                            </div>

                            <div class="mb-3">
                                <label>Designation:</label>
                                <div>
                                    <input type="text" class="form-control" name="desg" id="desg" value="<?= old('desg', $data['info']->desg??'') ?>" required>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="sex">Gender: </label>
                                <div>
                                    <select class="form-select" id="sex" name="sex" required>
                                        <option selected>Choose.....</option>
                                        <?php 
                                          $gender='';
                                        if($data['info']==null ||$data['info']->sex==null){ 
                                            $gender='9';
                                        }else{
                                            $gender=$data['info']->sex;
                                        }?>
                                        <option <?= ($gender == '0') ? 'Selected' : '' ?> value="0">Male</option>
                                        <option <?= ($gender == '1') ? 'Selected' : '' ?> value="1">Female</option>
                                        <option <?= ($gender == '2') ? 'Selected' : '' ?> value="2">Other</option>

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="about">About</label>
                                <div>
                                    <textarea name="about" class="form-control" id="about" rows="5" required><?= esc(old('about', $data['info']->about??'')) ?> </textarea>
                                                   
                                </div>
                            </div>

                            <div class=" mb-3">
                                <label for="example-date-input" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" value="<?= old('dob', date('Y-m-d', strtotime($data['info']->dob??''))) ?>" name="dob" min="<?= date('Y-m-d', strtotime('-60 years')) ?>" max="<?= date('Y-m-d', strtotime('-18 years')) ?>" id="dob" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="division" class="form-label">Division:</label>
                                        <select class="form-select division" id="division" name="division" required>


                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid division.
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="district" class="form-label">District:</label>
                                        <select class="form-select district" id="district" name="district" required>

                                           <?php if($data['info']->district??''!=''):?>
                                            <option value="" selected><?=$data['info']->district?></option>
                                           <?php endif?>  
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid district.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="thana" class="form-label">Thana:</label>
                                        <select class="form-select thana" id="thana" name="thana" required>

                                        <?php if($data['info']->thana??''!=''):?>
                                            <option value="" selected><?=$data['info']->thana?></option>
                                           <?php endif?> 
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
                                        <select class="form-select union" id="union" name="area" required>
                                        <?php if($data['info']->area??''!=''):?>
                                            <option value="" selected><?=$data['info']->area?></option>
                                           <?php endif?> 

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
                                            <input name="address" id="address" type="text" value="<?= old('address',$data['info']->address??'') ?>" class="form-control" required>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <input type="hidden" name="user_id" id="user_id" value="<?= session()->get('user')['id'] ?>">
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


<?= $this->section('custom-js') ?>
<script src="<?= base_url('/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
<script src="<?= base_url('/assets/js/pages/form-validation.init.js') ?>"></script>
<script src="<?=base_url('/assets/js/moment.min.js')?>"></script>
<script>


     //Show profile information via api

     loadBasicInfo();
     function loadBasicInfo()
     {
        let profileInfo=document.getElementById('home-1');

fetch('<?=site_url('/api/user-information/'.session()->get('user')['id'])?>')
.then(res=>res.json())
.then(data=>{
   let html='';
   
   if(data.errors==false)
   {
       html+=` 
                  
                   <ul>
                       <li>
                          <b> Designation:</b> <strong class="text-danger">${data.payload.desg}</strong>
                       </li>
                       <li>
                           Gender: ${data.payload.sex=='0'?'Male':'Female'}
                       </li>
                       <li>
                           NID: ${data.payload.nid}
                       </li>
                       <li>
                           Date Of Birth: ${moment(data.payload.dob).format('MMM Do YYYY')}
                       </li>
                       <li>
                           Address: ${data.payload.address + ',' + data.payload.area + ',' + data.payload.district + ',' + data.payload.division}
                       </li>
                       <li>
                           Joint at: ${moment(data.payload.created_at.date).format('MMM Do YYYY')}
                       </li>
                       <li>
                           About Myself: ${data.payload.about}
                       </li>
                   </ul>
                  

              `
   }else{
           html+=`
          <p>Profile Is not updated yet, please update your profile</p>
          
        `               
          ;
   }

   profileInfo.innerHTML=html;
})
.catch(err=>console.log(err));
     }
    
    //divisions

    let div = document.getElementById("division");
    let dis = document.getElementById("district");
    let thana = document.getElementById("thana");
    let union = document.getElementById('union');


    //default load if exist

    //fetch divisions
    loadLoc("<?=site_url('/api/divisions')?>",
    '',div,"Choose","<?=$data['info']->division??''?>"
    );
      
    let checkdiv="<?=$data['info']->division??''?>";
    if(checkdiv!='')
    {
        console.log(div.value);
    //     loadLoc(""+div.value,
    // '',dis,"Choose","<?=$data['info']->district??''?>"
    // );
    } 

    div.addEventListener('change', function() {
        //console.log(this.value);
        //fetch districts
        if (this.value == "") {
            dis.innerHTML = '';
            thana.innerHTML = '';
            union.innerHTML = '';
            return;
        }

        loadLoc("<?=site_url('/api/division-to-districts/')?>",
    this.value,dis,"Choose","<?=$data['info']->district??''?>"
    );
        
    });

    dis.addEventListener('change', function() {
        //console.log(this.value);
        //fetch districts
        if (this.value == "") {
            thana.innerHTML = '';
            union.innerHTML = '';
            return;
        }
        loadLoc("<?=site_url('/api/district-to-thana/')?>",
    this.value,thana,"Choose","<?=$data['info']->thana??''?>"
    );
    });

    thana.addEventListener('change', function(){
        if (this.value == "") {
            union.innerHTML = '';
            return;
        }
        loadLoc("<?=site_url('/api/thana-to-unions/')?>",
    this.value,union,"Select Union/Ward.........","<?=$data['info']->area??''?>"
    );
    });


    //geo loc function

    function loadLoc(url, parentId='', element, optionText, existvalue = "",type='') {
      
        if (parentId !== "") {

           url=url+parentId;
        }
        fetch(url)
            .then(res => res.json())
            .then(data => {

                let html = `<option value="">${optionText}</option>`;
                data.msg.forEach(function(item) {
                    html += `<option value=${item.id} ${existvalue==item.en_name?'Selected':''}>${item.en_name}</option>`;
                });
                element.innerHTML = html;
               
            }).catch(err => console.log(err))
    }
    // Profile Upload
    let updateFrom = document.getElementById("form_update");
    updateFrom.addEventListener('submit', function(e) {
        e.preventDefault();
        let user_idcheck = document.getElementById('user_id').value;
        let nidcheck = document.getElementById('nid').value;
        let desgCheck = document.getElementById('desg').value;
        let sexCheck = document.getElementById('sex').value;
        let dobCheck = document.getElementById('dob').value;
        let aboutCheck = document.getElementById('about').value;
        let addressCheck = document.getElementById('address').value;
        let divisionCheck = div.options[div.selectedIndex].text;
        let districtCheck = dis.options[dis.selectedIndex].text;
        let thanaCheck = thana.options[thana.selectedIndex].text;
        let areaCheck = union.options[union.selectedIndex].text;
        if (user_idcheck == "" || nidcheck == "" || desgCheck == "" || sexCheck == "" || dobCheck == "" || aboutCheck == "" || addressCheck == "", divisionCheck == "" || districtCheck == "" || districtCheck == "" || thanaCheck == "" || areaCheck == "") {
            return;
        }
        if (confirm('Are you sure to update your profile information')) {
            //get form data


            const formData = new FormData();
            formData.append('user_id', user_idcheck);
            formData.append('nid', nidcheck);
            formData.append('desg', desgCheck);
            formData.append('sex', sexCheck);
            formData.append('dob', dobCheck);
            formData.append('about', aboutCheck);
            formData.append('address', addressCheck);
            formData.append('division', divisionCheck);
            formData.append('district', districtCheck);
            formData.append('thana', thanaCheck);
            formData.append('area', areaCheck);


            let obj = {};
            for (const [key, value] of formData.entries()) {
                obj[key] = value;
            }

            console.log(obj);

            fetch("<?= site_url('/api/user-update/') ?>" + user_idcheck, {
                    method: "POST",
                    headers: {
                        'Accept': 'application.json',
                        'Content-Type': 'application/json;charset=UTF-8',

                    },
                    body: JSON.stringify(obj)
                })
                .then(res => res.json())
                .then(res => {

                    console.log(res);
                    if (res.errors == true) {
                        if (typeof res.payload === 'string') {
                            $("#myModal").modal('hide');

                            alert(res.payload);

                        } else {
                            let msg = '';
                            for (let error in res.payload) {
                                msg += res.payload[error];

                            }

                            alert(msg);
                        }
                    } else {
                        // data updated successfully 

                        $("#myModal").modal('hide');
                        alert(res.payload);
                        loadBasicInfo();
                    }

                })
                .catch(err => {
                    console.log(err)
                });
        }

    })
</script>
<?= $this->endSection() ?>