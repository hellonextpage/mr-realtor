<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Add Venture</h3>
            </div>
            
			<form action="<?=site_url('CompanyVentures/add/')?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
							<label for="ZoneID" class="control-label"><span class="text-danger">*</span>Zone</label>
							<div class="form-group">
									<select name="ZoneID" class="form-control">
										<option value=''>Select</option>
										<?php 
										foreach($zones as $value)
										{
											echo '<option value="'.$value['ZoneID'].'">'.$value['ZoneName'].'</option>';
										} 
										?>
									</select>
									<span class="text-danger"><?php echo form_error('ZoneID');?></span>
								
							</div>
						</div>
				</div>
			
				<div class="row clearfix">
						<div class="col-md-6">
							<label for="VentureName" class="control-label"><span class="text-danger">*</span>Venture Name</label>
							<div class="form-group">
								<input type="text" onkeypress="return onlyAlphabets(event,this);" 
								    name="VentureName"  value="<?php echo $this->input->post('VentureName'); ?>" class="form-control" id="VentureName" />
								<span class="text-danger"><?php echo form_error('VentureName');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="VentureSequence" class="control-label"><span class="text-danger">*</span>Venture Sequence</label>
							<div class="form-group">
								<input type="text" onkeypress="return isNumberKey(event,this);" 
								    name="VentureSequence"  value="<?php echo $this->input->post('VentureSequence'); ?>" class="form-control" id="VentureSequence" />
								<span class="text-danger"><?php echo form_error('VentureSequence');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="Latitude" class="control-label"><span class="text-danger">*</span>Latitude</label>
							<div class="form-group">
								<input type="text"  
								    name="Latitude"  onkeypress="return isDecimal(event,this);" value="<?php echo $this->input->post('Latitude'); ?>" class="form-control" id="Latitude" />
								<span class="text-danger"><?php echo form_error('Latitude');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="Longitude" class="control-label"><span class="text-danger">*</span>Longitude</label>
							<div class="form-group">
								<input type="text" 
								    name="Longitude"   onkeypress="return isDecimal(event,this);" value="<?php echo $this->input->post('Longitude'); ?>" class="form-control" id="Longitude" />
								<span class="text-danger"><?php echo form_error('Longitude');?></span>
							</div>
						</div>
						
			    </div>
			
				<div class="row clearfix">

				
					

						<div class="col-md-6">
							<label for="VentureStatus" class="control-label"><span class="text-danger">*</span>Venture Status</label>
							<div class="form-group">
									<select name="VentureStatus" class="form-control">
										<option value='Upcoming'>Upcoming</option>
										<option value='Ongoing'>Ongoing</option>
										<option value='Completed'>Completed	</option>
										
									</select>
									<span class="text-danger"><?php echo form_error('VentureStatus');?></span>
								
							</div>
						</div>
						<div class="col-md-6">
							<label for="photo_path" class="control-label"><span class="text-danger">*</span>Venture Logo</label>
							<div class="form-group">
									<input type="file" 
										name="photo_path" accept="image/*" class="form-control" id="photo_path" />
									<span class="text-danger"><?php echo form_error('photo_path');?></span>
								</div>
						</div>

						<div class="col-md-6">
							<label for="brochure" class="control-label">Venture Brochure</label>
							<div class="form-group">
									<input type="file" 
										name="brochure" class="form-control" id="brochure" />
								</div>
						</div>

						<div class="col-md-6">
							<label for="venture_location" class="control-label">Venture Location</label>
							<div class="form-group">
									<input type="text" 
										name="venture_location" class="form-control" id="venture_location" />
								</div>
						</div>
				</div>
				
				    <div class="row clearfix">
							<div class="col-md-6">
								<label for="AboutVenture" class="control-label"><span class="text-danger">*</span>Features</label>
								<div class="form-group">
										<textarea id="editor1" name="AboutVenture" rows="10" cols="80" style="visibility: hidden;"></textarea>
                                        <span class="text-danger"><?php echo form_error('AboutVenture');?></span>
								</div>
						    </div>
						    <div class="col-md-6">
								<label for="highlights" class="control-label">Highlights</label>
								<div class="form-group">
										<textarea id="editor2" name="highlights" rows="10" cols="80" style="visibility: hidden;"></textarea>
								</div>
						    </div>

						    <div class="col-md-6">
								<label for="statement_area" class="control-label">Statement Of Area</label>
								<div class="form-group">
										<textarea id="editor3" name="statement_area" rows="10" cols="80" style="visibility: hidden;"></textarea>
								</div>
						    </div>
							
			        </div>

			        
			        
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
            		<i class="fa fa-check"></i> Save
            	</button>
            	<a href="<?php echo base_url()?>CompanyVentures/index" class="btn btn-danger float-right">Back</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>