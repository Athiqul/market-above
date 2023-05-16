<?= $this->extend('layout/default') ?>
<?= $this->section('title') ?>
Above IT
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Meeting Report By <?=getUsername($report->user_id)->name?></h4>
                                        <p class="card-title-desc"><strong>Summary:</strong> <br> <?=$report->summary?></p>
        
                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                <tr>
                                                    <th style="width: 50%;">Report</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Company Name</td>
                                                    <td>
                                                        <a href="#" id="inline-username" data-type="text" data-pk="1" data-title="Enter username" class="editable editable-click"><?=companyInfo($report->company_id)->company_name?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact With:</td>
                                                    <td>
                                                        <a href="#" id="inline-firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname" class="editable editable-click editable-empty"><?=$report->contact_person?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Designation:</td>
                                                    <td>
                                                        <a href="#" id="inline-sex" data-type="select" data-pk="1" data-value="" data-title="Select sex" class="editable editable-click" style="color: rgb(152, 166, 173);"><?=$report->desg?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact Number</td>
                                                    <td>
                                                        <a href="#" id="inline-status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-title="Select status" class="editable editable-click"><?=$report->mobile?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>
                                                        <a href="#" id="inline-dob" data-type="combodate" data-value="2015-04-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1" data-title="Select Date of birth" class="editable editable-click"><?=$report->email??''?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Meeting Date:</td>
                                                    <td>
                                                        <a href="#" id="inline-comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click"><?=date('j F Y',strtotime($report->created_at))?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Interested Services:</td>
                                                    <td>
                                                        <?php
                                                        $res=interestServices($report->id);
                                                    
                                                        ?>
                                                        <?php if($res==null):?>
                                                            <a href="#" id="inline-comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click">NO Interest in Services or Products </a>
                                                            <?php else:?>
                                                                <ul class="list-unstyled">
                                                         <?php foreach($res as $item):?>
                                                             <li>
                                                                <i class=" fas fa-check-double"></i>
                                                                <?=ucfirst($item->service_name)?></li>
                                                        <?php endforeach?>
                                                        </ul>
                                                        <?php endif?>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Action</td>
                                                    <td>
                                                        <a href="<?=site_url('/meeting/edit/'.$report->id)?>" id="inline-comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click">Edit</a>
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