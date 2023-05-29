<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>
<?=$this->section('custom-css')?>
<link rel="stylesheet" href="<?=site_url('/assets/libs/tinymce/skins/ui/oxide/skin.min.css"')?>">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?=$this->endSection()?>


<?= $this->section('content') ?>



    <div class="row">
                            <div class="col-xl-12">
                               
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Assign Task Edit</h4>
                                       
                                       
        
                                        
                                        <?=form_open('/assign/task-update/'.$task->id,"class='custom-validation' novalidate=''")?>
                                            

                                            <div class="mb-3">
                    <label>Select Agent: (Write agent name or mobile or email or employ id to find)</label>
                    <input type="text" class="form-control" list="agent" id="search"   />
                    <datalist id="agent" >
                        
                    </datalist>
                    <span class="text-danger text-center"  id="errorMsgCompany"></span>
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>
                 
                </div>
                <div class="mb-3">
                    <label>Agent Name:</label>
                    
                    <input type="text" class="form-control" name="agent_name" value="<?=old('agent_name',getUsername($task->to_id)->name)?>" id="agentName" readonly />
                   
                    <div class="invalid-feedback">
                        Please select a valid thana.
                    </div>
                  <input type="hidden" name="to_id" value="<?=old('to_id',$task->to_id)?>" id="agent_id" required >
                </div>
                <div class="mb-3">
                                                <label>Task Description:</label>
                                                <textarea id="elm1" name="msg" aria-hidden="true" ><?=old('msg',$task->msg)?></textarea>
                                              
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['msg']??''?></span>
                                                    <?php endif?>
                                            </div>


                                            

                                            <div class="mb-3">
                                                <label>Start Date:</label>
                                                <input class="form-control" name='job_date' type="date" value="<?=old('job_date',date('Y-m-d',strtotime($task->job_date)))?>" id="startDate"  min='<?=date("Y-m-d")?>'>
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['job_date']??''?></span>
                                                    <?php endif?>
                                            </div>
                                            <div class="mb-3">
                                                <label>End Date:</label>
                                                <input class="form-control" name='end_date' type="date" value="<?=old('end_date',date('Y-m-d',strtotime( $task->end_date)))?>" id="endDate"  min='<?=date('Y-m-d')?>'>
                                                <?php if(session()->has('warning')):?>
                                                    <span class="text-danger"><?=session()->get('warning')['end_date']??''?></span>
                                                    <?php endif?>
                                            </div>
                                          
        
                                           
                                        
                                           
                                            <div class="mb-0">
                                               
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" onsubmit="confirm('Are You Sure?')">
                                                       Update Task
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
        
                           
    </div>
    <?= $this->endSection() ?>

 
   

    <?=$this->section('custom-js')?>
    <script src="<?=base_url('/assets/libs/parsleyjs/parsley.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/pages/form-validation.init.js')?>"></script>
    <script src="<?=site_url('/assets/libs/tinymce/tinymce.min.js')?>"></script>
    <script src="<?=site_url('/assets/js/pages/form-editor.init.js')?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      
//For date 
   let startDate=document.getElementById('startDate');
   let endDate=document.getElementById('endDate');

   startDate.addEventListener('change',function(){
         
     endDateMin= new Date(this.value);
     endDateMin.setDate(endDateMin.getDate()+1);
    // console.log(endDateMin);
     let format=endDateMin.toISOString().split('T')[0];
     console.log(format);
     endDate.setAttribute('min',format);

   });

          //get search value
     let search=document.getElementById('search');
    // console.log(search);
     //get datalist company id
     let agentList=document.getElementById('agent');

     $(document).ready(function() {
  $('#search').autocomplete({
    source: function(request, response) {
      let keyword = request.term;
      fetch('<?=site_url('/api/user-search?search=')?>' + keyword)
        .then(res => res.json())
        .then(res => {
          if (res.errors == false) {
            let options = res.payload.map(item => ({ label: item.name, value: item.id }));
            response(options);
          } else {
            document.getElementById('errorMsgCompany').innerHTML="No agent found";
          }
        })
        .catch(err => {
          console.log(err);
          response([]);
        });
    },
    minLength: 3, // Set the minimum length for suggestions
    select: function(event, ui) {
      // Handle selection of an option
      let agentId = ui.item.value;
      let agentName = ui.item.label;
      console.log(agentId + ' ' + agentName);

      // Set Id and company name
      document.getElementById('agent_id').value = agentId;
      document.getElementById('agentName').value = agentName;
      $('#search').val(''); // Clear the input field
      return false;
    }
  });
});


    </script>
   
    <?=$this->endSection()?>