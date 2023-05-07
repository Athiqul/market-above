<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>

<?=$this->section('custom-css')?>

<?=$this->endSection()?>

<?= $this->section('content') ?>



<div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Services Or Products</h4>
                                         <h6>Add New Services Or Product</h6>
                                        
                                          <?=form_open('/services/add',"class='needs-validation' novalidate=''")?> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="validationCustom03" class="form-label">Service/Product Name</label>
                                                        <input id="validationCustom03" type="text" class="form-control" name="service_name" value="<?=old('service_name')?>" required>
                                                        <div class="invalid-feedback">
                                                            Please Write a Service or Product Name.
                                                        </div>
        
                                                    </div>
                                                </div>
                                             
                                            </div>
                                           
                                            <div>
                                                <button class="btn btn-primary" type="submit">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
        
                           
                        </div>
<!--Data Table-->
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Datatable Editable</h4>
        
                                        <div class="table-responsive">
                                            <table class="table table-editable table-nowrap align-middle table-edits">
                                                <thead>
                                                    <tr style="cursor: pointer;">
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Gender</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-id="1" style="cursor: pointer;">
                                                        <td data-field="id" style="width: 216.344px;">1</td>
                                                        <td data-field="name" style="width: 311.219px;">David McHenry</td>
                                                        <td data-field="age" style="width: 216.422px;">24</td>
                                                        <td data-field="gender" style="width: 107.328px;">Male</td>
                                                        <td style="width: 100px">
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="2" style="cursor: pointer;">
                                                        <td data-field="id" style="width: 218px;">2</td>
                                                        <td data-field="name" style="width: 311.156px;">Frank Kirk</td>
                                                        <td data-field="age" style="width: 218px;">22</td>
                                                        <td data-field="gender" style="width: 108px;">Male</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="3" style="cursor: pointer;">
                                                        <td data-field="id" style="width: 218px;">3</td>
                                                        <td data-field="name" style="width: 311.156px;">Rafael Morales</td>
                                                        <td data-field="age" style="width: 218px;">26</td>
                                                        <td data-field="gender" style="width: 108px;">Male</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="4" style="cursor: pointer;">
                                                        <td data-field="id" style="width: 218px;">4</td>
                                                        <td data-field="name" style="width: 311.156px;">Mark Ellison</td>
                                                        <td data-field="age" style="width: 218px;">32</td>
                                                        <td data-field="gender" style="width: 108px;">Male</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="5" style="cursor: pointer;">
                                                        <td data-field="id" style="width: 218px;">5</td>
                                                        <td data-field="name" style="width: 311.156px;">Minnie Walter</td>
                                                        <td data-field="age" style="width: 218px;">27</td>
                                                        <td data-field="gender" style="width: 108px;">Female</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>


    <?= $this->endSection() ?>
    <?= $this->section('custom-js') ?>
    <script src="<?= base_url('/assets/libs/parsleyjs/parsley.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/pages/form-validation.init.js') ?>"></script>
    

    <?=$this->endSection()?>