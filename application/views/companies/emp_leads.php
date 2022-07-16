<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?=$screen_heading?> </h3>
                
                <!-- <?php if(isset($isInsight) && $isInsight == true) { ?>
                    <div class="box-tools">
                        <a href="<?php echo site_url('Leads_list/add'); ?>" class="btn btn-success btn-sm">Add New</a> 
                    </div>
                <?php } ?> -->
            	
            </div>
            <div class='row'>
				<div class='col-md-2'></div>
				<div class="col-md-4">
					<input type='hidden' id='emp_id' value='<?=$emp_id?>'>
					<input type='hidden' id='desig_id' value='<?=$desig_id?>'>
					<label for="area_id" class="control-label"><span class="text-danger">*</span>Employee Areas </label>
						<div class="form-group">
							
							<select name="area_id_id[]" class="form-control js-example-basic-multiple"  multiple = "multiple" onchange="get_leads_by_area()"  id='area_id'>
										
										<?php  foreach($locations as $location){?>
											<option value='<?=$location['area_id']?>'><?=$location['area_name']?></option>
										<?php } ?>
									
								</select>
								<span class="text-danger"><?php echo form_error('area_id');?></span>
						</div>
					</div>
				<div class="col-md-4">
					<input type='hidden' id='emp_id' value='<?=$emp_id?>'>
					<label for="asg_emp_id" class="control-label"><span class="text-danger">*</span>Select Assigning To Employees </label>
						<div class="form-group">
							
							<select  name="asg_emp_id" id='asg_emp_id' class="form-control">
										<option value=''>Select</option>
										<?php  foreach($all_employees as $employee){?>
											<option value='<?=$employee['emp_id']?>'><?=$employee['emp_name']?> (<?=$employee['desig_name']?>)</option>
										<?php } ?>
									
								</select>
								<span class="text-danger" id='err_asg_emp_id'></span>
						</div>
					</div>
			</div>
            <div class="box-body">
			
                <table id='datatable1' class="table table-striped">
                    <thead>
                        <tr>
    						<th><input type='checkbox' onchange="chackAll(this)" id='check_all'></th>
    						<th>Created By</th>
    						<th>Company</th>
    						<th>Cust Name</th>
    						<th>Cust Mobile</th>
    						
    						<th>Location</th>
    						<th>Lead Status</th>
    						<th>Create On</th>
    					
    						<th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id='body'>
                        <?php $i=0; foreach($leads_list as $l){ ?>
                        <tr>
    						<td><input type='checkbox' name='check_lead' class='check_lead' value="<?=$l['lead_id']?>"></td>
    						<td><?php echo $l['created_by_name']; ?></td>
    						<!-- <td><?php echo $l['tl_name']; ?></td>
    						<td><?php echo $l['manager_name']; ?></td> -->
    
    						<td><?php echo $l['cust_cmp_name']; ?></td>
    						<td><?php echo $l['cust_name']; ?></td>
    						<td><?php echo $l['cust_mobile']; ?></td>
    						
    						<td><?php echo $l['area_name']; ?></td>
    						
    						<td><?php echo $l['lead_status_name']; ?></td>
    						<td><?=date('d-m-Y', strtotime($l['create_on'])); ?></td>
    						
    						<?php if($screen_heading == 'Assigned Leads List'){
    							$asg_status = '';
    							foreach($lead_assign as $status){ 
    								if($l['assigned_status'] == $status['drpd_code']){
    
    									$asg_status = $status['drpd_value'];
    								} 
    							 } ?> 
    						    <td><?=$l['asg_name'];?></th>
    							<!-- 	<th><?=$asg_status?></th> -->
    						<?php } ?>
    						<td>
    									
								<a target='_blank' href="<?php echo site_url('Leads_list/view_lead/'.$l['lead_id'].'/cct'); ?>" class="btn btn-info btn-xs"><span class="fa fa-eye"></span> View</a> 
										
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                                
            </div>
			
			<div class="box-footer">
            	<button type="button" onclick="saveChnages()" class="btn btn-success float-right">
					<i class="fa fa-check"></i> Save
				</button>
				<a href="javascript:history.go(-1)" class="btn btn-danger float-right">Back</a>
	        </div>	
        </div>
    </div>
</div>

<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Write Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class='row'>
	  				<div class="col-md-12">	
						<input type='hidden' id='lead_id' >
						<!-- <label for="comment" class="control-label">Write Comment</label> -->
						<div class="form-group">
							<textarea type="text" name="comment"  class="form-control" id="comment" ></textarea>
						</div>
					</div>
			</div>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick='submit_comment()'>Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    
   $(document).ready(function(){
       
         $(".js-example-placeholder-single").select2({
        placeholder: "Select Area",
        allowClear: true
    });

   });

	function get_leads_by_area(){
	    
	    let area_id      = $('#area_id').val();
		
		console.log(area_id);
		 $('#check_all').prop("checked", false);
	    let emp_id    = $('#emp_id').val();
	        $.ajax({
	            type:'POST',
	            url:"<?=site_url()?>/Employee/get_emp_leads_by_area",
	            data:{'area_id':area_id,'emp_id':emp_id},
	            async:false,
	            success:function(response){
	             
                    let data = jQuery.parseJSON(response);
                    if(data.length >  0){
                            
                          list =   data;
                          let content = "";
                          $.each(list,function(key , value){
							  $lead_type = '';
								if(value['lead_status'] == 'opi' || value['lead_status'] == 'opq' || value['lead_status'] == 'drpd' ||value['lead_status'] == 'loss' ){
								
									 $lead_type = 'cct';
									 
								 }
								 if(value['lead_status'] == 'ope' || value['lead_status'] == 'ng' || value['lead_status'] == 'edrpd' ||value['lead_status'] == 'eloss' ){
								
									 $lead_type = 'ems';
									 
								 }
								 let view_url = "<?php echo site_url(); ?>/Leads_list/view_lead/"+value['lead_id']+"/"+$lead_type;
								 let button  = "<a  target='_blank' href="+view_url+" class='btn btn-info btn-xs'><span class='fa fa-eye'></span> View</a> "
                                 content += " <tr><td><input type='checkbox' class='check_lead' name='check_lead' value="+value['lead_id']+"></td>"
                        					 +"<td>"+value['created_by_name']+"</td>"
                        					 +"<td>"+value['cust_cmp_name']+"</td>"
                        					 +"<td>"+value['cust_name']+"</td>"
                        					 +"<td>"+value['cust_mobile']+"</td>"
                        					 +"<td>"+value['area_name']+"</td>"
                        					 +"<td>"+value['lead_status_name']+"</td>"
                        					 +"<td>"+value['create_on']+"</td>"
											 +"<td>"+button+"</td></tr>";
                          });
                          
                          
                        if(content != ''){
                            $('#body').html(content);
                        }else{
                            
                            $('#body').html("<tr><td colspan='7'>No Leads Found</td></tr>");
                        }
                        
                    }else{
                            
                            $('#body').html("<tr><td colspan='7'>No Leads Found</td></tr>");
                        }
	               
	            },
	            error:function(status){
	                
	                console.log(status);
	            }
	        });
	    
	}
	
	function chackAll(element){
	
		if($(element).prop("checked")){
			
				$('.check_lead').prop("checked", true);
		}else{
			
			 $('.check_lead').prop("checked", false);
		}
	}
	
	function saveChnages(){
		
		let error = 0;
		let checked_leads = $("input[name='check_lead']:checked");

		let leads = [];
		if(checked_leads.length > 0 ){
			
			$.each(checked_leads, function(){            
                
				leads.push($(this).val());
            });
		}else{
			
			alert('Please select atleast one leads to assign');
			error = 1;
		}
		
		if($('#asg_emp_id').val() == '' ){
			
			$('#err_asg_emp_id').html('Please select employee to whome you need to assign.');
			$('html, body').animate({
                    scrollTop: $(".box-header").offset().top
                }, 1000);
			error = 1;
		}else{
			
			$('#err_asg_emp_id').html('');
		}
		
		if(error == 0){
			
			let emp_id 		 = $('#emp_id').val();
			let desig_id 	 = $('#desig_id').val();
			$.ajax({
				
				type:'post',
				url:"<?=site_url()?>/Employee/assign_leads_to_emp",
				data:{'leads':leads,'assig_emp_id':$('#asg_emp_id').val(),'emp_id':emp_id,'desig_id':desig_id},
				async:false,
				success:function(response){
					
					window.location.reload();
				},
				error:function(status){
					console.log(status);
				}
			});
			
		}
		
	}

</script>