<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Product Edit</h3>
            </div>
			<?php echo form_open('product/edit/'.$product['product_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="kva_rating_code" class="control-label"><span class="text-danger">*</span>KVA Rating Code</label>
						<div class="form-group">
							<!-- <input type="text" name="kva_rating_code" value="<?php echo ($this->input->post('kva_rating_code') ? $this->input->post('kva_rating_code') : $product['kva_rating_code']); ?>" class="form-control" id="kva_rating_code" />
 -->
							<select name="kva_rating_code" class="form-control" id="kva_rating_code">
										<option value=''>Select </option>
									<?php 
									foreach($kva_ratings as $ratings)
									{
										$selected_value = $this->input->post('kva_rating_code') ? $this->input->post('kva_rating_code') : $product['kva_rating_code'];
										$selected = ($ratings['drpd_code'] == $selected_value) ? ' selected="selected"' : "";

											echo '<option value="'.$ratings['drpd_code'].'" '.$selected.'>'.$ratings['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('kva_rating_code');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="model_no" class="control-label"><span class="text-danger">*</span>Model No</label>
						<div class="form-group">
							<!-- <input type="text" name="model_no" value="<?php echo ($this->input->post('model_no') ? $this->input->post('model_no') : $product['model_no']); ?>" class="form-control" id="model_no" /> -->
							<select name="model_no" class="form-control" id="model_no">
										<option value=''>Select </option>
									<?php 
									foreach($model_nos as $modal)
									{
										$selected_value = $this->input->post('model_no') ? $this->input->post('model_no') : $product['model_no'];
										$selected = ($modal['drpd_code'] == $selected_value) ? ' selected="selected"' : "";

											echo '<option value="'.$modal['drpd_code'].'" '.$selected.'>'.$modal['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('model_no');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="engine_make_cod" class="control-label"><span class="text-danger">*</span>Engine Make Cod</label>
						<div class="form-group">
							<!-- <input type="text" name="engine_make_cod" value="<?php echo ($this->input->post('engine_make_cod') ? $this->input->post('engine_make_cod') : $product['engine_make_cod']); ?>" class="form-control" id="engine_make_cod" /> -->

							<select name="engine_make_cod" class="form-control" id="engine_make_cod">
										<option value=''>Select </option>
									<?php 
									foreach($engines as $engine)
									{
										$selected_value = $this->input->post('engine_make_cod') ? $this->input->post('engine_make_cod') : $product['engine_make_cod'];
										$selected = ($engine['drpd_code'] == $selected_value) ? ' selected="selected"' : "";

											echo '<option value="'.$engine['drpd_code'].'" '.$selected.'>'.$engine['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('engine_make_cod');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="phase_code" class="control-label"><span class="text-danger">*</span>Phase Code</label>
						<div class="form-group">
							<!-- <input type="text" name="phase_code" value="<?php echo ($this->input->post('phase_code') ? $this->input->post('phase_code') : $product['phase_code']); ?>" class="form-control" id="phase_code" /> -->

							<select name="phase_code" class="form-control" id="phase_code">
										<option value=''>Select </option>
									<?php 
									foreach($phases as $phase)
									{
										$selected_value = $this->input->post('phase_code') ? $this->input->post('phase_code') : $product['phase_code'];
										$selected = ($phase['drpd_code'] == $selected_value) ? ' selected="selected"' : "";

											echo '<option value="'.$phase['drpd_code'].'" '.$selected.'>'.$phase['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('phase_code');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="panel_type_code" class="control-label"><span class="text-danger">*</span>Panel Type Code</label>
						<div class="form-group">
							<!-- <input type="text" name="panel_type_code" value="<?php echo ($this->input->post('panel_type_code') ? $this->input->post('panel_type_code') : $product['panel_type_code']); ?>" class="form-control" id="panel_type_code" /> -->
							<select name="panel_type_code" class="form-control" id="panel_type_code">
										<option value=''>Select </option>
									<?php 
									foreach($panels as $panel)
									{
										$selected_value = $this->input->post('panel_type_code') ? $this->input->post('panel_type_code') : $product['panel_type_code'];
										$selected = ($panel['drpd_code'] == $selected_value) ? ' selected="selected"' : "";

											echo '<option value="'.$panel['drpd_code'].'" '.$selected.'>'.$panel['drpd_value'].'</option>';
									} 
									?>
								</select>
							<span class="text-danger"><?php echo form_error('panel_type_code');?></span>
						</div>
					</div>
					
					<div class="col-md-6">
								<label for="list_price" class="control-label"><span class="text-danger">*</span>List Price</label>
								<div class="form-group">
									
									<input type='text' onkeypress="return isNumberKey(event)" value="<?php echo ($this->input->post('list_price') ? $this->input->post('list_price') : $product['list_price']); ?>"  class='form-control' name='list_price' id='list_price'>
									<span class="text-danger"><?php echo form_error('list_price');?></span>
								</div>
							</div>
			
					
				</div>
				<div class="row clearfix">
							
							<div class="col-md-6" style='display:none'>
								<label for="team_price" class="control-label"><span class="text-danger">*</span>Team Price</label>
								<div class="form-group">
									
									<input type='text' value="<?php echo ($this->input->post('team_price') ? $this->input->post('team_price') : $product['team_price']); ?>"  class='form-control' name='team_price' id='team_price'>
									<span class="text-danger"><?php echo form_error('team_price');?></span>
								</div>
							</div>

							
				</div>
				<div class="row clearfix">
							<div class="col-md-12">
								<label for="description" class="control-label"><span class="text-danger">*</span>Product Description </label>
								<div class="form-group">
										<textarea  name="description" rows="5" cols="160" ><?php echo ($this->input->post('description') ? $this->input->post('description') : $product['description']); ?></textarea>
                                        <span class="text-danger"><?php echo form_error('description');?></span>
								</div>
						    </div>
							
			        </div>
				  <div class="row clearfix">
							<div class="col-md-12">
								<label for="distributor_price" class="control-label"><span class="text-danger">*</span>Product Scope </label>
								<div class="form-group">
										<textarea id="editor1" name="scope_content" rows="10" cols="80" style="visibility: hidden;"><?php echo ($this->input->post('scope_content') ? $this->input->post('scope_content') : $product['scope_content']); ?></textarea>
                                        <span class="text-danger"><?php echo form_error('scope_content');?></span>
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