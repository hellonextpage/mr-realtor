
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Edit Company Admin</h3>
            </div>
			<!-- <?php echo form_open('employee/edit/'.$company_admin['emp_id']); ?> <?=base_url()?>employee/edit/<?=$company_admin['emp_id']?> -->
			<form action="#" enctype="multipart/form-data" onsubmit="return checkIdempInanyGroup()" method="post" accept-charset="utf-8">
			<div class="box-body">
				<div class="row clearfix">


					<div class="col-md-6">
						<label for="CompID" class="control-label"><span class="text-danger">*</span>Company</label>
						<div class="form-group">
						<select  name="CompID" class="form-control">
									<option>Select</option>
									<?php 
									foreach($companies as $value)
									{
										$selected = ($value['CompID'] == $company_admin['CompID']) ? ' selected="selected"' : "";

										echo '<option value="'.$value['CompID'].'" '.$selected.'>'.$value['CompName'].'</option>';
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
										$selected = "";

										if(array_search($value['VentureID'], array_column($selected_ventures, 'venture_id')) !== FALSE){
											$selected = 'selected';
										}
										echo '<option value="'.$value['VentureID'].'" '.$selected.'>'.$value['VentureName'].'</option>';
									} 
									?>
								</select>
								<span class="text-danger"><?php echo form_error('VentureID');?></span>
							</div>
						</div>
					
					<div class="col-md-6">
						<label for="Name"  class="control-label"><span class="text-danger">*</span>Admin Name</label>
						<div class="form-group">
							<input type="text"  onkeypress="return onlyAlphabets(event,this);" name="Name" value="<?php echo ($this->input->post('Name') ? $this->input->post('Name') : $company_admin['Name']); ?>" class="form-control" id="Name" />
							<span class="text-danger"><?php echo form_error('Name');?></span>
						</div>
					</div>
					
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="MobileNo" class="control-label"><span class="text-danger">*</span>Mobile No</label>
						<div class="form-group">
							<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" name="MobileNo" value="<?php echo ($this->input->post('MobileNo') ? $this->input->post('MobileNo') : $company_admin['MobileNo']); ?>" class="form-control" id="MobileNo" />
							<span class="text-danger"><?php echo form_error('MobileNo');?></span>
						</div>
					</div>
				
					<div class="col-md-6">
						<label for="EmailID" class="control-label">Email Id</label>
						<div class="form-group">
							<input type="text" name="EmailID" value="<?php echo ($this->input->post('EmailID') ? $this->input->post('EmailID') : $company_admin['EmailID']); ?>" class="form-control" id="EmailID" />
							<span class="text-danger"><?php echo form_error('EmailID');?></span>
						</div>
					</div>

					<div class="col-md-6">
						<label for="Password" class="control-label">Password</label>
						<div class="form-group">
							<input type="password" name="Password" value="<?php echo ($this->input->post('Password') ? $this->input->post('Password') : $company_admin['Password']); ?>" class="form-control" id="Password" />
						</div>
					</div>

					
				</div>
		
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
					<i class="fa fa-check"></i> Update
				</button>
			
				<a href="<?php echo base_url()?>CompanyAdmins/index" class="btn btn-danger float-right">Back</a>
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

	function validate(){

		error = 0;
		if($('#city_id').val().length == 0){

			$('#err_city_id').html('Please select atleat one city');
			error = 1;
		}else{

			$('#err_city_id').html('');
		}
		

		if(error == 0){ return true ;}else{return false;}
	}
	
	function checkIdempInanyGroup(){
		
		
		let old_desig_id = $('#old_desig_id').val();
		let desig_id     = $('#desig_id').val();
		let error = 0;
		
		if(old_desig_id != desig_id ){
			let emp_id = <?=$company_admin['emp_id']?>;
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