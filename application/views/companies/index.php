<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Companies Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('Companies/add'); ?>" class="btn btn-success btn-sm">Add New</a> 
                </div>
            </div>
            <div class="box-body">
                <table id='datatable' class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th> Name</th>
						<th>Mobile No</th>
						<th>Phone No</th>
						
						<th>Email Id</th>
                        <th>Website</th>
                        <th>Address</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach($companies as $c){ ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?php echo $c['CompName']; ?></td>
						<td><?=$c['MobileNo']?></td>
						<td><?php echo $c['Phone_no']; ?></td>
						<td><?php echo $c['EmailID']; ?></td>
						
						<td><?php echo $c['Website']; ?></td>
						<td><?php echo $c['Address']; ?></td>
						<td><?php echo date('d-m-Y',strtotime($c['CreatedOn']))?></td>
						<td>
                          <a href="<?php echo site_url('Companies/edit/'.$c['CompID']); ?>" class="btn btn-primary btn-xs"> Edit</a> 
                           <?php if($c['IsActive']){ ?>
                           
                                <a href="<?php echo site_url('Companies/deactivate/'.$c['CompID']); ?>" class="btn btn-danger btn-xs"> De-Activate</a> 
                            <?php }else{ ?>
                            
                                <a href="<?php echo site_url('Companies/activate/'.$e['CompID']); ?>" class="btn btn-success btn-xs"> Activate</a> 
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>  
    </div>
</div>


 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
       
        <div class="modal-body">
                <div class='row'>
						<div class="col-md-6">
								<label for="IsAvailable" class="control-label"> Plot No</label>
								<div class="form-group">
                                    <select name="IsAvailable" class="form-control">
                                        <option value='A'>Available</option>
                                        <option value='NA'> Not Available</option>
                                        <option value='P'> Not Pending</option>
                                   
                                    </select>
                                    <span class="text-danger"><?php echo form_error('IsAvailable');?></span>
								</div>
							</div>

				
							<div class="col-md-6">
								<label for="Coordinates" class="control-label">Plot Type</label>
								<div class="form-group">
                                    <select name="ptype_id" class="form-control">
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
					</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>