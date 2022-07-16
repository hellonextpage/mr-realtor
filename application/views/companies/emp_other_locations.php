<div class="box box-info">
<div class="box-body">
            <div class="box-header" >
                <h2  class="box-title" id='title' style="font-weight:bold">Add Locations</h2>
            	
            </div>

        <form method='post' id='form' action="<?=base_url()?>/Employee/add_other_locations" onsubmit='return validate()'> 
                <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="area_name" class="control-label"><span class="text-danger">*</span>Select Locations</label>
                                    <div class="form-group">
                                            <input type='hidden' id='emp_id' value="<?=$emp_id?>" name='emp_id'>
                                                <select name="area_id[]" class="form-control js-example-basic-multiple"  id="area_id" multiple="multiple">
                                                    <option value=''>Select </option>
                                                <?php 
                                                foreach($remaining_areas as $location)
                                                {
                                                
                                                        echo '<option value="'.$location['area_id'].'" >'.$location['area_name'].'( '.$location['short_name'].' )</option>';
                                                } 
                                                ?>
                                            </select>
                                            <span class="text-danger " id='err_area'></span>
                                    </div>
                                </div>
                              		
                            
                    </div>
                    
                     <div class="box-footer">
                            <button type="submit" id='submit' class="btn btn-success float-right">
                                <i class="fa fa-check"></i> Add
                            </button>
                        </div>

            </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Other Locations List</h3>
            	
            </div>
            <div class="box-body">
                <table id='datatable' class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
    						<th>Location</th>
    						<th>Action</th>
    						
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =0; foreach($other_areas as $key => $oa){ ?>
                        <tr>
    						<td><?=++$i?></td>
                            <td><?php echo $oa['area_name']; ?></td>

    						<td>
    						    <?php if($oa['lead_count'] == 0) {?>
                                    <a onclick="return confirm('Are you sure to delete area ?') "href="<?php echo site_url('Employee/deleteOtherArea/'.$oa['emp_id'].'/'.$oa['area_id'].'/'.$desig_id); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<script>

    function validate(){

        let areas       = $('#area_id').val();
      
        if(areas.length == 0){

            $('#err_area').html('Please select atleat one location.');
            error = 1;
        }else{

            $('#err_area').html('');
        }


        if(error == 0){

            return true;

        }else{

            return false;
        }
    }

    function editGroup(key){

        let mappings = <?=json_encode($mappings)?>;
        
        let area_list = <?=json_encode($all_locations)?>;
        
        let unmapped_location = <?=json_encode($locations)?>
        
        let executive_list = <?=json_encode($all_executives)?>;
        let teamlead_list = <?=json_encode($teamleads)?>;
        let manager_list = <?=json_encode($managers)?>;
        
        let group = mappings[key];
        console.log(group);
        let areas = group['area_ids'].split(",");
        
        
        let area_options = '';
        let exctv_options = '';
        let teamlead_options = '';
        let manager_options = '';
    
        console.log(area_list.length);
        console.log(areas.length);
        
        $.each(area_list ,function(key,value){

            
            if(areas.indexOf(value['area_id']) != -1){
                
                area_options +="<option selected value="+value['area_id']+">"+value['area_name']+" ( "+value['short_name']+" }</option>"
            }
            
        });
        
        $.each(unmapped_location, function (key, value){
           
            area_options +="<option value="+value['area_id']+">"+value['area_name']+" ( "+value['short_name']+" }</option>"
            
        });

        $.each(executive_list,function(key,value){

            if(group['exctv_id'] == value['emp_id']){

                exctv_options +="<option selected value="+value['emp_id']+">"+value['emp_name']+"</option>";

            }else{

                exctv_options +="<option disabled='disabled' value="+value['emp_id']+">"+value['emp_name']+"</option>";
            }

        });

        $.each(teamlead_list,function(key,value){

            if(group['tl_id'] == value['emp_id']){

                teamlead_options +="<option selected value="+value['emp_id']+">"+value['emp_name']+"</option>";

            }else{

                teamlead_options +="<option  disabled='disabled' value="+value['emp_id']+">"+value['emp_name']+"</option>";
            }

        });

        
        $.each(manager_list,function(key,value){

            if(group['manager_id'] == value['emp_id']){

                manager_options +="<option selected value="+value['emp_id']+">"+value['emp_name']+"</option>";

            }else{

                manager_options +="<option disabled='disabled' value="+value['emp_id']+">"+value['emp_name']+"</option>";
            }

        });

        $('#area_id').html(area_options);
        $('#exctv_id').html(exctv_options);
        /* $('#exctv_id').attr('disabled',true); */
        $('#tl_id').html(teamlead_options);
        $('#manager_id').html(manager_options);
        $('#form').attr('action','<?=base_url()?>/Employee/edit_location_mapping');
        $('#submit').html('Update');
        $('#title').html('Edit Group');
    }
</script>
