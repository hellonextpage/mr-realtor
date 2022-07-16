<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Send Quotation</h3>
            </div>
            <form action="<?=base_url()?>Leads_list/mail_quataion/<?=$lead_details['lead_id']?>/<?=$lead_type?>" onsubmit='return validate()' enctype="multipart/form-data" method='post'>
          	<div class="box-body">
          		
                <div class='row'>
                  <?php foreach($lead_details['products'] as $key => $product){ ?>
                        
                        <div class='col-md-6'>
                            <hr><h4><b>Product <?=++$key?></b></h4><hr>
                            
                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">Model</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['model_no']?></label>
                            </div>

                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">KVA Rating</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['kva_value']?></label>
                            </div>

                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">Phase</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['phase_value']?></label>
                            </div>

                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">Panel</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['panel_value']?></label>
                            </div>

                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">List Price</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['list_price']?></label>
                            </div>

                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">Quoted Price</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['quoted_price']?></label>
                            </div>
                            
                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">Extrnl Transport Charges</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['extrnl_trasport_charges']?></label>
                            </div>
                            
                            <div class="row clearfix">                            
                                <label for="product_name" class="col-md-5 control-label">Unloading Charges</label>
                                <label for="product_name" class="col-md-1 control-label">:</label>
                                <label for="product_name" class=" col-md-6 control-label"><?=$product['unloading_charges']?></label>
                            </div>
                            
                            <div class="row clearfix">   
                                 <div class='col-md-2'>  
                                        <a href="<?=base_url()?>/Leads_list/viweQuote/<?=$lead_details['lead_id']?>/<?=$product['product_id']?>" class='btn btn-info' target="_blank">View Quotation</a>
                                    </div>
                            </div>
                            
                        </div>  
                    <?php } ?>
				
				</div>
                <p>&nbsp</p>
                <div class='row clearfix'> 
                       
                        <div class='col-md-4'>   
                            
                            <input style='width:20px;height:20px' onchange="ariction(this)" class='form-coontrol' type='checkbox' value='acheck' name='is_eriction_quote_adding' id='is_eriction_quote_adding'>
                            <label class='label-control'>Do You want to send arictin quote</label>
                        </div>
                        <!-- <button >View Qutation</button> -->
                </div>
                <div class='row clearfix' style='display:none' id='ariction_details'>
                    <div class='col-md-12'>
                        <hr><h4><b>Ariction Details</b></h4><hr>
                    </div>
                    <div class='col-md-12' id='ariction_products'>
                    <table class="table table-striped">
                    <tr>
						<th></th>
						
						<th>Model No</th>
						<th>KVA</th>
                        <th>Phase</th>
						<th>Panel</th>
                        
                        <th>Ariction Price</th>
                        <th> Upload Ariction Quote</th>
						
                    </tr>
                    <?php foreach($lead_details['products'] as $p){ ?>
                    <tr>
						<td>
                            <input type='hidden' value='<?=$p['product_id']?>' name='product_id[]' id='product_ids'>
                            <input checked type='checkbox' value='ar<?=$p['product_id']?>' id='' name='product_check<?=$p['product_id']?>'>
                        </td>
						<td><?php echo $p['model_no']; ?></td>
                        <td><?php echo $p['kva_value']; ?></td>
						<td><?php echo $p['phase_value']; ?></td>
                        <td><?php echo $p['panel_value']; ?></td>
                        
						<td>
                            <input type='text' onkeypress="return isNumberKey(event)" id='ariction_price<?=$p['product_id']?>' name='ariction_price<?=$p['product_id']?>'  class='form-control ' style='width:70%'>
                            <span></span>
                        </td>
                        <td>
        					
        						<div class="form-group">
        							<input type='file' name="ariction_quote<?=$p['product_id']?>" id='ariction_quote<?=$p['product_id']?>' style='width:70%' class="form-control" >
                                    <span></span>
        						</div>
                            
                        </td>
                    </tr>
                    <?php } ?>
                </table>

                    <!-- <div class="col-md-4">
						<label for="site_addr" class="control-label">Upload Ariction Quote</label>
						<div class="form-group">
							<input type='file' name="ariction_quote" class="form-control" id="ariction_quote">
                            <span id='err_eq'></span>
						</div>
					</div> !-->
					
               <p>&nbsp</p>
                    </div>
                </div>
                
             </div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success float-right">
            		<i class="fa fa-check"></i> Send
            	</button>
            	<a href="javascript:history.go(-1)" class="btn btn-danger float-right">Back</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>

<script>

    function ariction(event){

        console.log($(event).is(':checked'));
        
        if($(event).is(':checked')){
            
            $('#ariction_details').css('display','block');

        }else{

            $('#ariction_details').css('display','none');
            
        }
    }

    function validate(){

        let error = 0;
        let count = 0;
        if($('#is_eriction_quote_adding').is(':checked')){

            $("input[name='product_id[]']").each(function(key, value){

                console.log(key);
                //console.log($(ariction_prices[key]).val());
                console.log($(this).val());
                let check_name = 'product_check'+$(this).val();
                let ariction_price_id = 'ariction_price'+$(this).val();
                let ariction_quote_id = 'ariction_quote'+$(this).val();
              
                if($("input[name='"+check_name+"']").is(':checked')){
                    
                    if($('#'+ariction_price_id).val() == ''){

                        $('#'+ariction_price_id).next('span').html('Please enter ariction price.').css('color','red');
                        error = 1;
                    }else{

                        $('#'+ariction_price_id).next('span').html('');

                    }
                    
                    if($('#'+ariction_quote_id).val() == ''){

                        $('#'+ariction_quote_id).next('span').html('Please upload ariction file.').css('color','red');
                        error = 1;
                    }else{
                        
                        let filename = $('#'+ariction_quote_id).val();
                        if(filename.split('.').pop() != 'pdf'){
                                
                            $('#'+ariction_quote_id).next('span').html('Please Upload only pdf file.').css('color','red');
                            
                            error = 1;
                        }else{
            
                            $('#'+ariction_quote_id).next('span').html('');
            
                        }
            
                    }
                    console.log($(this).attr('name'));
                }else{

                    $('#'+ariction_price_id).next('span').html('');
                    $('#'+ariction_quote_id).next('span').html('');
                    
                }
            });
        }

        console.log(error);

        if(error == 0){

            return true;

        }else{

            return false;
        }
    }
</script>