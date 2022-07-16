<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Venture Edit</h3>
            
			<form action="<?=site_url('CompanyVentures/edit/'.$venture['VentureID'])?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
											$selected = ($value['CompID'] == $venture['CompID']) ? ' selected="selected"' : "";
											echo '<option value="'.$value['CompID'].'" '.$selected.'>'.$value['CompName'].'</option>';
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

											$selected = ($value['ZoneID'] == $venture['ZoneID']) ? ' selected="selected"' : "";
											echo '<option value="'.$value['ZoneID'].'" '.$selected.'>'.$value['ZoneName'].'</option>';
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
								    name="VentureName" value="<?php echo ($this->input->post('VentureName') ? $this->input->post('VentureName') : $venture['VentureName']); ?>" class="form-control" id="VentureName" />
								<span class="text-danger"><?php echo form_error('VentureName');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="VentureSequence" class="control-label"><span class="text-danger">*</span>Venture Sequence</label>
							<div class="form-group">
								<input type="text" onkeypress="return isNumberKey(event,this);" 
								    name="VentureSequence"  value="<?php echo ($this->input->post('VentureSequence') ? $this->input->post('VentureSequence') : $venture['VentureSequence']); ?>" class="form-control" id="VentureSequence" />
								<span class="text-danger"><?php echo form_error('VentureSequence');?></span>
							</div>
						</div>

						<div class="col-md-6">
							<label for="Latitude" class="control-label"><span class="text-danger">*</span>Latitude</label>
							<div class="form-group">
								<input type="text"  
								    name="Latitude"  onkeypress="return isDecimal(event,this);" value="<?php echo ($this->input->post('Latitude') ? $this->input->post('Latitude') : $venture['Latitude']); ?>" class="form-control" id="Latitude" />
								<span class="text-danger"><?php echo form_error('Latitude');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="Longitude" class="control-label"><span class="text-danger">*</span>Longitude</label>
							<div class="form-group">
								<input type="text" 
								    name="Longitude"  onkeypress="return isDecimal(event,this);" value="<?php echo ($this->input->post('Longitude') ? $this->input->post('Longitude') : $venture['Longitude']); ?>" class="form-control" id="Longitude" />
								<span class="text-danger"><?php echo form_error('Longitude');?></span>
							</div>
						</div>
						
			    </div>
				<div class="row clearfix">

					

						<div class="col-md-6">
							<label for="VentureStatus" class="control-label"><span class="text-danger">*</span>Venture Status</label>
							<div class="form-group">
									<select name="VentureStatus" class="form-control">
										<option <?=$venture['VentureStatus'] == 'Upcoming' ? 'selected':''?> value='Upcoming'>Upcoming</option>
										<option <?=$venture['VentureStatus'] == 'Ongoing' ? 'selected':''?> value='Ongoing'>Ongoing</option>
										<option <?=$venture['VentureStatus'] == 'Completed' ? 'selected':''?> value='Completed'>Completed	</option>
										
									</select>
									<span class="text-danger"><?php echo form_error('VentureStatus');?></span>
								
							</div>
						</div>
						<div class="col-md-6">
						<label for="photo_path" class="control-label"><span class="text-danger">*</span>Venture Logo</label>
						<div class="form-group">
								<input type="file"  accept="image/*"
									name="photo_path" class="form-control" id="photo_path" />
								<span class="text-danger"><?php echo form_error('photo_path');?></span>
							</div>

							<?php if($venture['VentureLogo']!= ''){ ?>
								<img  src='<?=base_url()?><?=$venture['VentureLogo']?>' alt='vlogo' width='75' height='75'>
							<?php } ?>
						</div>

						<div class="col-md-6">
						<label for="brochure" class="control-label">Venture Brochure</label>
						<div class="form-group">
								<input type="file"  accept="image/*"
									name="brochure" class="form-control" id="photo_path" />
							</div>

							<?php if($venture['brochure']!= ''){ ?>
								<img  src='<?=base_url()?>uploads/ventures/<?=$venture['brochure']?>' alt='brochure' width='75' height='75'>
							<?php } ?>
						</div>

						<div class="col-md-6">
						<label for="venture_location" class="control-label">Venture Location</label>
						<div class="form-group">
								<input type="text" value="<?=$venture['location']?>"  accept="image/*"
									name="venture_location" class="form-control" id="photo_path" />
							</div>

							
						</div>
				</div>

				  <div class="row clearfix">
							<div class="col-md-6">
								<label for="AboutVenture" class="control-label"><span class="text-danger">*</span>Features</label>
								<div class="form-group">
										<textarea id="editor1" name="AboutVenture" rows="10" cols="80" style="visibility: hidden;"><?php echo ($this->input->post('AboutVenture') ? $this->input->post('AboutVenture') : $venture['AboutVenture']); ?></textarea>
                                        <span class="text-danger"><?php echo form_error('AboutVenture');?></span>
								</div>
						    </div>
						    <div class="col-md-6">
								<label for="highlights" class="control-label">Highlights</label>
								<div class="form-group">
										<textarea id="editor2" name="highlights" rows="10" cols="80" style="visibility: hidden;"><?php echo ($this->input->post('highlights') ? $this->input->post('highlights') : $venture['highlights']); ?></textarea>
								</div>
						    </div>
						    <div class="col-md-6">
								<label for="statement_area" class="control-label">Statement Area</label>
								<div class="form-group">
										<textarea id="editor3" name="statement_area" rows="10" cols="80" style="visibility: hidden;"><?php echo ($this->input->post('statement_area') ? $this->input->post('statement_area') : $venture['statement_area']); ?></textarea>
                                        
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