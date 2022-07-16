<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Company Edit</h3>
            </div>
			<?php echo form_open('companies/edit/'.$company['CompID']); ?>
			<!-- <form action="#" enctype="multipart/form-data" onsubmit="return checkIdempInanyGroup()" method="post" accept-charset="utf-8"> -->
			<div class="box-body">
				<div class="row clearfix">

					<div class="col-md-6">
						<label for="CompName"  class="control-label"><span class="text-danger">*</span>Company Name</label>
						<div class="form-group">
							<input type="text"  onkeypress="return onlyAlphabets(event,this);" name="CompName" value="<?php echo ($this->input->post('CompName') ? $this->input->post('CompName') : $company['CompName']); ?>" class="form-control" id="emp_name" />
							<span class="text-danger"><?php echo form_error('CompName');?></span>
						</div>
					</div>
					<div class="col-md-6">
							<label for="MobileNo" class="control-label"><span class="text-danger">*</span>Mobile Number</label>
							<div class="form-group">
								<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" name="MobileNo"  value="<?php echo ($this->input->post('MobileNo') ? $this->input->post('MobileNo') : $company['MobileNo']); ?>" class="form-control" id="MobileNo" />
								<span class="text-danger"><?php echo form_error('MobileNo');?></span>
							</div>
						</div>
					</div>

					
			  <div class='row'>
				
			  	<div class="col-md-6">
							<label for="Phone_no" class="control-label"><span class="text-danger">*</span>Phone Number</label>
							<div class="form-group">
								<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" name="Phone_no"  value="<?php echo ($this->input->post('Phone_no') ? $this->input->post('Phone_no') : $company['Phone_no']); ?>" class="form-control" id="Phone_no" />
								<span class="text-danger"><?php echo form_error('Phone_no');?></span>
							</div>
						</div>
			
					<div class="col-md-6">
							<label for="EmailID" class="control-label"> <span class="text-danger">*</span> Email Id</label>
							<div class="form-group">
								<input type="text" name="EmailID" value="<?php echo ($this->input->post('EmailID') ? $this->input->post('EmailID') : $company['EmailID']); ?>" class="form-control" id="EmailID" />
								<span class="text-danger"><?php echo form_error('EmailID');?></span>
							</div>
						</div>
				</div>
				
				<div class="row clearfix">
						<div class="col-md-6">
							<label for="Website" class="control-label"> Website</label>
							<div class="form-group">
								<input type="text" name="Website" value="<?php echo ($this->input->post('Website') ? $this->input->post('Website') : $company['Website']); ?>" class="form-control" id="Website" />
								<span class="text-danger"><?php echo form_error('Website');?></span>
							</div>
						</div>
			
					<div class="col-md-6">
						<label for="Address" class="control-label">Address</label>
						<div class="form-group">
							<textarea name="Address" class="form-control" id="Address"><?php echo ($this->input->post('Address') ? $this->input->post('Address') : $company['Address']); ?></textarea>
						</div>
					</div>

					<div class="col-md-12">
								<label for="AboutCompany" class="control-label">About Company</label>
								<div class="form-group">
										<textarea id="editor1" name="AboutCompany" rows="10" cols="80" style="visibility: hidden;"><?php echo ($this->input->post('AboutCompany') ? $this->input->post('AboutCompany') : $company['AboutCompany']); ?></textarea>
						</div>
			    </div>
					
					
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
					<i class="fa fa-check"></i> Update
				</button>
			
				<a href="<?php echo base_url()?>Companies/index" class="btn btn-danger float-right">Back</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="view">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class='row' style='pdding:3%'>
				Your need to assigned  This employee leads to any other employee before changing designation.
            </p>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		 <a type="button" id='asign_leads'  class="btn btn-success" target="_blank" href='#'>Assign</a>
      </div>

    </div>
  </div>
</div>

<script>


	
	function checkIdempInanyGroup(){
		
		
		let old_desig_id = $('#old_desig_id').val();
		let desig_id     = $('#desig_id').val();
		let error = 0;
		
		if(old_desig_id != desig_id ){
			let emp_id = <?=$company['emp_id']?>;
			if(old_desig_id == 4 || old_desig_id == 5 ){
				
				$.ajax({
					
					type:'post',
					url:"<?=site_url()?>/Employee/unAssignedLeads",
					data:{'emp_id':emp_id},
					async:false,
					success:function(response){
						
						console.log(response);
						if(response > 0){
							
							$("#asign_leads").attr("href", "<?=site_url()?>/Employee/get_emp_leads/"+emp_id+"/"+old_desig_id);
							$('#view').modal('show');
							error =1;
							
						}
					},error:function(status){
						console.log(status);
					}
				});
				
				//alert('If Designation Chnages All Employee Data Will Be Clears.Please Assign This employee leads to any other before changing designation , data once loss you wont get it back.');
			}
			
		}
		
		
		if($('#city_id').val().length == 0){

			$('#err_city_id').html('Please select atleat one city');
			error = 1;
			
		}else{

			$('#err_city_id').html('');
		}
		

		if(error == 0){ 
			return true ;
		}else{
			return false;
		}
		
		
	}
	
</script>