<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Product Add</h3>
            </div>
            <?php echo form_open('product/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6" style="display:none">
						<label for="product_name" class="control-label"><span class="text-danger">*</span>Product Name</label>
						<div class="form-group">
							<input type="text" name="product_name" value="<?php echo $this->input->post('product_name'); ?>" class="form-control" id="product_name" />
							<span class="text-danger"><?php echo form_error('product_name');?></span>
							
						</div>
					</div>
						<div class="col-md-6">
						<label for="model_no" class="control-label"><span class="text-danger">*</span>Model No</label>
						<div class="form-group">
							<!-- <input type="text" name="model_no" value="<?php echo $this->input->post('model_no'); ?>" class="form-control" id="model_no" /> -->
							<select name="model_no" class="form-control" id="model_no">
										<option value=''>Select </option>
									<?php 
									foreach($model_nos as $modal)
									{
										$selected = ($modal['drpd_code'] == $this->input->post('model_no')) ? ' selected="selected"' : "";

											echo '<option value="'.$modal['drpd_code'].'" '.$selected.'>'.$modal['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('model_no');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="kva_rating_code" class="control-label"><span class="text-danger">*</span>KVA</label>
						<div class="form-group">
							
							<select name="kva_rating_code" class="form-control" id="kva_rating_code">
										<option value=''>Select </option>
									<?php 
									foreach($kva_ratings as $ratings)
									{
										$selected = ($ratings['drpd_code'] == $this->input->post('kva_rating_code')) ? ' selected="selected"' : "";

											echo '<option value="'.$ratings['drpd_code'].'" '.$selected.'>'.$ratings['drpd_value'].'</option>';
									} 
									?>
								</select>
								
							<span class="text-danger"><?php echo form_error('kva_rating_code');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
				
					<div class="col-md-6">
						<label for="engine_make_cod" class="control-label"><span class="text-danger">*</span>Engine</label>
						<div class="form-group">
							
							<select name="engine_make_cod" class="form-control" id="engine_make_cod">
										<option value=''>Select </option>
									<?php 
									foreach($engines as $engine)
									{
										$selected = ($engine['drpd_code'] == $this->input->post('engine_make_cod')) ? ' selected="selected"' : "";

											echo '<option value="'.$engine['drpd_code'].'" '.$selected.'>'.$engine['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('engine_make_cod');?></span>
						</div>
					</div>
					
							<div class="col-md-6">
						<label for="phase_code" class="control-label"><span class="text-danger">*</span>Phase</label>
						<div class="form-group">
							
							<select name="phase_code" class="form-control" id="phase_code">
										<option value=''>Select </option>
									<?php 
									foreach($phases as $phase)
									{
										$selected = ($phase['drpd_code'] == $this->input->post('tralley_code')) ? ' selected="selected"' : "";

											echo '<option value="'.$phase['drpd_code'].'" '.$selected.'>'.$phase['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('phase_code');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
			
					<div class="col-md-6">
						<label for="panel_type_code" class="control-label"><span class="text-danger">*</span>Panel</label>
						<div class="form-group">
							
							<select name="panel_type_code" class="form-control" id="panel_type_code">
										<option value=''>Select </option>
									<?php 
									foreach($panels as $list)
									{
										$selected = ($list['drpd_code'] == $this->input->post('panel_type_code')) ? ' selected="selected"' : "";

											echo '<option value="'.$list['drpd_code'].'" '.$selected.'>'.$list['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('panel_type_code');?></span>
						</div>
					</div>
					<div class="col-md-6">
								<label for="list_price" class="control-label"><span class="text-danger">*</span>List Price</label>
								<div class="form-group">
									
									<input type='text' onkeypress="return isNumberKey(event)"  class='form-control' name='list_price' id='list_price'>
									<span class="text-danger"><?php echo form_error('list_price');?></span>
								</div>
							</div>
					
					</div>
						
					
				</div>
				
				<div class="row clearfix">
							<div class="col-md-12">
								<label for="description" class="control-label"><span class="text-danger">*</span>Product Description </label>
								<div class="form-group">
										<textarea  name="description" rows="5" cols="160" ></textarea>
                                        <span class="text-danger"><?php echo form_error('description');?></span>
								</div>
						    </div>
							
			        </div>
			
				
				    <div class="row clearfix">
							<div class="col-md-12">
								<label for="scope_content" class="control-label"><span class="text-danger">*</span>Product Scope </label>
								<div class="form-group">
										<textarea id="editor1" name="scope_content" rows="10" cols="80" style="visibility: hidden;"></textarea>
                                        <span class="text-danger"><?php echo form_error('scope_content');?></span>
								</div>
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