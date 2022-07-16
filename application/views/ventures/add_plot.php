<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Plot Add</h3>
            </div>
            
		<form action="<?=site_url('CompanyVentures/savePlot/'.$VentureID)?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	          <input type='hidden' id='VentureID' name='VentureID' value='<?=$VentureID?>'>
			  <div class="box-body">
			  		<div class='row'>
							<div class="col-md-6">
								<label for="PlotNo" class="control-label"><span class="text-danger">*</span> Plot No</label>
								<div class="form-group">
									<input type="text" name="PlotNo" onkeypress="return isNumberKey(event,this);" value="<?php echo $this->input->post('PlotNo'); ?>" class="form-control" id="PlotNo" />
									<span class="text-danger"><?php echo form_error('PlotNo');?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="Coordinates" class="control-label"><span class="text-danger">*</span>Plot Coordinates</label>
								<div class="form-group">
									<textarea name="Coordinates" class="form-control" id="Coordinates"><?php echo $this->input->post('Coordinates'); ?></textarea>
									<span class="text-danger"><?php echo form_error('Coordinates');?></span>
								</div>
							</div>
					</div>
					<div class="row clearfix">	
					
							<div class="col-md-6">
								<label for="ptype_id" class="control-label"><span class="text-danger">*</span>Plot type</label>
								<div class="form-group">
									<select name="ptype_id" class="form-control">
										<option value=''>Select</option>
										<?php 
											foreach($plot_types as $value)
											{
												echo '<option value="'.$value['ptype_id'].'">'.$value['ptype_name'].'</option>';
											} 
										?>
									</select>
									<span class="text-danger"><?php echo form_error('ptype_id');?></span>
								</div>
							</div>

							<div class="col-md-6">
								<label for="Facing" class="control-label"><span class="text-danger">*</span>Facings</label>
								<div class="form-group">
								<select name="Facing" class="form-control">
										<option value=''>Select </option>
										<?php foreach($facings as $facing){ ?>
											<option  value='<?=$facing['facingID']?>'><?=$facing['facingName']?></option>
										<?php } ?>
										<!-- <option  value='2'> West</option>
										<option  value='3'>North	</option>
										<option  value='4'>South	</option>
										<option  value='5'>NorthWest	</option>
										<option  value='6'>SouthEast	</option>
										<option value='7'>NorthEast	</option>
										<option value='8'>SouthWest	</option> -->
									</select>
									<span class="text-danger"><?php echo form_error('Facing');?></span>
								</div>
							</div>
					</div>

					<div class="row clearfix">
							<div class="col-md-6">
								<label for="Plotsize" class="control-label"><span class="text-danger">*</span>Plot Size</label>
								<div class="form-group">
									<input type="text" onkeypress="return isDecimal(event,this);" name="Plotsize" value="<?php echo $this->input->post('Plotsize'); ?>" class="form-control" id="Plotsize" />
									<span class="text-danger"><?php echo form_error('Plotsize');?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="EstPrice" class="control-label">EstPrice</label>
								<div class="form-group">
								<input type="text" name="EstPrice" value="<?php echo $this->input->post('EstPrice'); ?>" class="form-control" id="Measurements" />
									<span class="text-danger"><?php echo form_error('EstPrice');?></span>
								</div>
							</div>
					</div>
					<div class="row clearfix">
					
					<div class="col-md-6">
							<label for="IsAvailable" class="control-label">Venture Status</label>
							<div class="form-group">
									<select name="IsAvailable" class="form-control">
										<option value='A'>Available</option>
										<option value='NA'> Not Available</option>
										<option value='P'>Pending	</option>
										<option value='M'>Mortgage	</option>
										
									</select>
									<span class="text-danger"><?php echo form_error('IsAvailable');?></span>
								
							</div>
						</div>

							<div class="col-md-6">
								<label for="Measurements" class="control-label"> <span class="text-danger">*</span>Measurements</label>
								<div class="form-group">
								<input type="text" name="Measurements" value="<?php echo $this->input->post('Measurements'); ?>" class="form-control" id="Measurements" />
									<span class="text-danger"><?php echo form_error('Measurements');?></span>
								</div>
							</div>
					</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
            		<i class="fa fa-check"></i> Save
            	</button>
            	<a href="javascript:history.go(-1)" class="btn btn-danger float-right">Back</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
