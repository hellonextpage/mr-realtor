<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Add Company Admin </h3>
            </div>
            <?php echo form_open_multipart('CompanyAdmins/add'); ?>
						<!-- <form action="employee/add" enctype="multipart/form-data" onsubmit="return validate()" method="post" accept-charset="utf-8"> -->
          	<div class="box-body">
          		<div class="row clearfix">
					
						<div class="col-md-6">
							<label for="CompID" class="control-label"><span class="text-danger">*</span>Company</label>
							<div class="form-group">
								<select name="CompID" class="form-control">
									<option value=''>Select</option>
									<?php 
									foreach($companies as $value)
									{
										
										echo '<option value="'.$value['CompID'].'">'.$value['CompName'].'</option>';
									} 
									?>
								</select>
								<span class="text-danger"><?php echo form_error('CompID');?></span>
							</div>
						</div>


						<div class="col-md-6">
							<label for="Ventures" class="control-label"><span class="text-danger">*</span>Ventures</label>
							<div class="form-group">
								<select name="Ventures[]" class="js-example-basic-multiple select2 form-control" multiple>
									<option value=''>Select</option>
									<?php 
									foreach($all_ventures as $value)
									{
										
										echo '<option value="'.$value['VentureID'].'">'.$value['VentureName'].'</option>';
									} 
									?>
								</select>
								<span class="text-danger"><?php echo form_error('VentureID');?></span>
							</div>
						</div>

						
						<div class="col-md-6">
							<label for="Name" class="control-label"><span class="text-danger">*</span>Admin Name</label>
							<div class="form-group">
								<input type="text" onkeypress="return onlyAlphabets(event,this);" 
								    name="Name"  value="<?php echo $this->input->post('Name'); ?>" class="form-control" id="Name" />
								<span class="text-danger"><?php echo form_error('Name');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="EmailID" class="control-label"> <span class="text-danger">*</span> Email Id</label>
							<div class="form-group">
								<input type="text" name="EmailID" value="<?php echo $this->input->post('EmailID'); ?>" class="form-control" id="EmailID" />
								<span class="text-danger"><?php echo form_error('EmailID');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="MobileNo" class="control-label"><span class="text-danger">*</span>Mobile Number</label>
							<div class="form-group">
								<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" name="MobileNo" value="<?php echo $this->input->post('mobile_no'); ?>" class="form-control" id="mobile_no" />
								<span class="text-danger"><?php echo form_error('MobileNo');?></span>
							</div>
						</div>

					</div>
					<div class='row'>
						<div class="col-md-6">
							<label for="Password" class="control-label"><span class="text-danger">*</span>Password</label>
							<div class="form-group">
								<input type="text" maxlength="12"  name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" />
								<span class="text-danger"><?php echo form_error('password');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="ConfirmPassword" class="control-label"><span class="text-danger">*</span>Confirm Password</label>
							<div class="form-group">
								<input type="password" maxlength="12"  name="confirm_password" value="<?php echo $this->input->post('confirm_password'); ?>" class="form-control" id="confirm_password" />
								<span class="text-danger"><?php echo form_error('confirm_password');?></span>
							</div>
						</div>
					</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
            		<i class="fa fa-check"></i> Save
            	</button>
            	<a href="<?php echo base_url()?>CompanyAdmins/index" class="btn btn-danger float-right">Back</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
