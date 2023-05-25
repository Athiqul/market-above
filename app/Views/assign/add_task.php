<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>
<?=$this->section('custom-css')?>
<link rel="stylesheet" href="<?=site_url('/assets/libs/tinymce/skins/ui/oxide/skin.min.css"')?>">
<?=$this->endSection()?>


<?= $this->section('content') ?>



    <div class="row">
                            <div class="col-xl-12">
                               
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Assign Task to the Team Member</h4>
                                       
                                        <p class="card-title-desc">Please Provide Proper and Authentic information</p>
        
                                        
                                        <?=form_open('/team-management/add-user',"class='custom-validation' novalidate=''")?>
                                            

                                            <div class="mb-3">
                    <label>Select Agent: (Write agent name or mobile or email or employ id to find)</label>
                    <input type="text" class="form-control" list="agent" id="search" />
                    <datalist id="agent">
                        
                    </datalist>
                    <span class="text-danger text-center"  id="errorMsgCompany"></span>
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>
                 
                </div>
                <div class="mb-3">
                    <label>Agent Name:</label>
                    
                    <input type="text" class="form-control" name="agent_name" value="<?=old('agent_name')?>" id="agentName" readonly />
                   
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>
                  <input type="hidden" name="to_user_id" value="<?=old('to_user_id')?>" id="agent_id" required >
                </div>
                <div class="mb-3">
                                                <label>Task Description:</label>
                                                <textarea id="elm1" name="msg" aria-hidden="true" ><?=old('msg')?></textarea>
                                              
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['msg']??''?></span>
                                                    <?php endif?>
                                            </div>


                                            

                                            <div class="mb-3">
                                                <label>Start Date:</label>
                                                <input class="form-control" name='job_date' type="date" value="<?=old('job_date')?>" id="example-datetime-local-input">
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['job_date']??''?></span>
                                                    <?php endif?>
                                            </div>
                                            <div class="mb-3">
                                                <label>End Date:</label>
                                                <input class="form-control" name='end_date' type="date" value="<?=old('end_date')?>" id="example-datetime-local-input">
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['end_date']??''?></span>
                                                    <?php endif?>
                                            </div>
                                          
        
                                           
                                        
                                           
                                            <div class="mb-0">
                                               
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" onsubmit="confirm('Are You Sure?')">
                                                       Add Task
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
    <script src="<?=site_url('/assets/libs/tinymce/tinymce.min.js')?>"></script>
    <script src="<?=site_url('/assets/js/pages/form-editor.init.js')?>"></script>
    <script>
          //get search value
     let search=document.getElementById('search');
    // console.log(search);
     //get datalist company id
     let agentList=document.getElementById('agent');

     search.addEventListener('keyup',function(){
        //console.log(this.value.length);
       if(this.value.length>=3)
       {
          let keyword=this.value;
          fetch('<?=site_url('/api/user-search?search')?>'+keyword)
          .then(res=> res.json())
          .then(res=>{
            console.log(res);
           let html='';
           if(res.errors==false)
           {
            document.getElementById('errorMsgCompany').innerHTML='';
              res.payload.forEach(function(item){
                    html+=`<option value='${item.id}'>${item.name}</option>`;
              });

              agentList.innerHTML=html;
              //get select company
              search.addEventListener('change',function(){
                let selectedAgent=agentList.querySelector(`option[value="${search.value}"]`);
                 if(selectedAgent)
                 {
                    //get id
                    let agentId=selectedAgent.value;
                    let agentName=selectedAgent.innerHTML;
                    console.log(agentId +' ' + agentName);
                    // Set Id And company name
                    document.getElementById('agent_id').value=agentId;
                    document.getElementById('agentName').value=agentName;
                    search.value='';

                 }
                 
              });
            

           } else{
               let error=document.getElementById('errorMsgCompany');
               error.innerHTML='No Company found!';
              // search.value='';
               document.getElementById('agentName').value='';
           }

          })
          .catch(err=>console.log(err));
       }

     });

    </script>
   
    <?=$this->endSection()?>