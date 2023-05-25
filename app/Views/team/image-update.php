<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="row">


    <div class="col-md-12 ">
    <?=form_open_multipart(site_url('/team-management/user-image-update/'.$user->id))?>

<div class="mb-3">
    <label>Image:</label>
    <input type="file"   class="form-control" onchange="imagePreview(event)" name="image"  required="">
</div>
<div class="mb-3">
    <label></label>
    <div class="col-md-6">
    <img  id="preview" class="img-fluid" alt="">
    </div>
  
</div>


<button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>


</form>
       

    </div><!-- end col -->
    </div>


<?= $this->endSection() ?>
<?=$this->section('custom-js')?>
<script>
function imagePreview(event)
{
  if(event.target.files.length>0){
    var src=URL.createObjectURL( event.target.files[0]);
    let preview=document.getElementById('preview');
    preview.src=src;
  }
}
</script>
<?=$this->endSection()?>


