<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="row">


    <div class="col-md-12 ">
    <?=form_open(site_url('/user/password-change'))?>

<div class="mb-3">
    <label>Old Password:</label>
    <input type="password"   class="form-control"  name="old_pass"  required="">
</div>
<div class="mb-3">
    <label>New Password:</label>
    <input type="password"   class="form-control"  name="new_pass"  required="">
</div>
<div class="mb-3">
    <label>Confirm Password:</label>
    <input type="password"   class="form-control"  name="con_pass"  required="">
</div>



<button type="submit" class="btn btn-primary waves-effect waves-light">Update password</button>


</form>
       

    </div><!-- end col -->
    </div>
<?= $this->endSection() ?>



