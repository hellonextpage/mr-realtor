<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Plot Add</h3>
            </div>
            
		<form action="<?=site_url('CompanyVentures/updatePlot/'.$venture_plot['PlotID'])?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	          <input type='hidden' id='VentureID' name='VentureID' value='<?=$venture_plot['VentureID']?>'>
			  <div class="box-body">
			  		<div class='row'>
							<div class="col-md-6">
								<label for="PlotNo" class="control-label"><span class="text-danger">*</span> Plot No</label>
								<div class="form-group">
									<input type="text" onkeypress="return isNumberKey(event,this);" name="PlotNo" value="<?php echo ($this->input->post('PlotNo') ? $this->input->post('PlotNo') : $venture_plot['PlotNo']); ?>" class="form-control" id="PlotNo" />
									<span class="text-danger"><?php echo form_error('PlotNo');?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="Coordinates" class="control-label"><span class="text-danger">*</span>Plot Coordinates</label>
								<div class="form-group">
									<textarea name="Coordinates" class="form-control" id="Coordinates"><?php echo ($this->input->post('Coordinates') ? $this->input->post('Coordinates') : $venture_plot['Coordinates']); ?></textarea>
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

												$selected = $venture_plot['ptype_id'] == $value['ptype_id'] ? 'selected':'';
												echo '<option value="'.$value['ptype_id'].'" '.$selected.'>'.$value['ptype_name'].'</option>';
											} 
										?>
									</select>
									<span class="text-danger"><?php echo form_error('ptype_id');?></span>
								</div>
							</div>


							<div class="col-md-6">
								<label for="Facing" class="control-label"><span class="text-danger">*</span>Facing</label>
								<div class="form-group">
								<select name="Facing" class="form-control">
										<option value=''>select </option>
										<?php foreach($facings as $facing){ ?>
											<option <?=$venture_plot['Facing'] == $facing['facingID'] ? 'selected':''?>  value='<?=$facing['facingID']?>'><?=$facing['facingName']?></option>
										<?php } ?>
										
									</select>
									<span class="text-danger"><?php echo form_error('Facing');?></span>
							</div>
					</div>

					<div class="row clearfix">
					
							<div class="col-md-6">
								<label for="Plotsize" class="control-label"><span class="text-danger">*</span>Plot Size</label>
								<div class="form-group">
									<input type="text" onkeypress="return isDecimal(event,this);" name="Plotsize" value="<?php echo ($this->input->post('Plotsize') ? $this->input->post('Plotsize') : $venture_plot['Plotsize']); ?>" class="form-control" id="Plotsize" />
									<span class="text-danger"><?php echo form_error('Plotsize');?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="EstPrice" class="control-label">EstPrice</label>
								<div class="form-group">
								<input type="text" name="EstPrice" value="<?php echo ($this->input->post('EstPrice') ? $this->input->post('EstPrice') : $venture_plot['EstPrice']); ?>" class="form-control" id="Measurements" />
									<span class="text-danger"><?php echo form_error('EstPrice');?></span>
								</div>
							</div>
											
							
					</div>
					<div class="row clearfix">
					
					<div class="col-md-6">
							<label for="IsAvailable" class="control-label">Venture Status</label>
							<div class="form-group">
									<select name="IsAvailable" class="form-control">
										<option <?=$venture_plot['IsAvailable'] == 'A'?'selected':''?> value='A'>Available</option>
										<option <?=$venture_plot['IsAvailable'] == 'NA'?'selected':''?> value='NA'> Not Available</option>
										<option <?=$venture_plot['IsAvailable'] == 'P'?'selected':''?> value='P'>Pending	</option>
										<option <?=$venture_plot['IsAvailable'] == 'M'?'selected':''?> value='M'>Mortgage	</option>
									</select>
									<span class="text-danger"><?php echo form_error('IsAvailable');?></span>
								
							</div>
						</div>

							<div class="col-md-6">
								<label for="Measurements" class="control-label"> <span class="text-danger">*</span>Measurements</label>
								<div class="form-group">
								<input type="text" name="Measurements" value="<?php echo ($this->input->post('Measurements') ? $this->input->post('Measurements') : $venture_plot['Measurements']); ?>" class="form-control" id="Measurements" />
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
