<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Company Add</h3>
            </div>
            <?php echo form_open_multipart('Companies/add'); ?>
						<form action="Companies/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
          	<div class="box-body">
          		<div class="row clearfix">
					
						<div class="col-md-6">
							<label for="CompName" class="control-label"><span class="text-danger">*</span>Name</label>
							<div class="form-group">
								<input type="text" onkeypress="return onlyAlphabets(event,this);" 
								    name="CompName"  value="<?php echo $this->input->post('CompName'); ?>" class="form-control" id="CompName" />
								<span class="text-danger"><?php echo form_error('CompName');?></span>
							</div>
						</div>
						
					
						<div class="col-md-6">
							<label for="MobileNo" class="control-label"><span class="text-danger">*</span>Mobile Number</label>
							<div class="form-group">
								<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" name="MobileNo" value="<?php echo $this->input->post('MobileNo'); ?>" class="form-control" id="MobileNo" />
								<span class="text-danger"><?php echo form_error('MobileNo');?></span>
							</div>
						</div>
					</div>

					<div class='row'>
					
					<div class="col-md-6">
							<label for="Phone_no" class="control-label">Phone Number</label>
							<div class="form-group">
								<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" name="Phone_no" value="<?php echo $this->input->post('Phone_no'); ?>" class="form-control" id="Phone_no" />
								
							</div>
						</div>
						<div class="col-md-6">
							<label for="EmailID" class="control-label"> <span class="text-danger">*</span> Email Id</label>
							<div class="form-group">
								<input type="text" name="EmailID" value="<?php echo $this->input->post('EmailID'); ?>" class="form-control" id="EmailID" />
								<span class="text-danger"><?php echo form_error('EmailID');?></span>
							</div>
						</div>

					</div> 
					<div class='row'>
						<div class="col-md-6">
								<label for="Website" class="control-label"> Website</label>
								<div class="form-group">
									<input type="text" name="Website" value="<?php echo $this->input->post('Website'); ?>" class="form-control" id="Website" />
									<span class="text-danger"><?php echo form_error('Website');?></span>
								</div>
							</div>
				
							<div class="col-md-6">
								<label for="Address" class="control-label">Address</label>
								<div class="form-group">
									<textarea name="Address" class="form-control" id="Address"><?php echo $this->input->post('Address'); ?></textarea>
								</div>
							</div>

							<div class="col-md-12">
								<label for="AboutCompany" class="control-label">About Company</label>
								<div class="form-group">
										<textarea id="editor1" name="AboutCompany" rows="10" cols="80" style="visibility: hidden;"></textarea>
								</div>
						    </div>
							
					</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
            		<i class="fa fa-check"></i> Save
            	</button>
            	<a href="<?php echo base_url()?>Companies/index" class="btn btn-danger float-right">Back</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
