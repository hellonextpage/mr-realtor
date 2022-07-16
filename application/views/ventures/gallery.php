<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Venture Gallery</h3>
                
            </div>
            <div class="box-body">
                <div class='row'>
                    <div class='col-md-12'>
                        <form action="<?=site_url('CompanyVentures/saveVentureImage/')?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            
                                        <input type='hidden' name='VentureID' id='VentureID' value='<?=$VentureID?>'>
                                            <div class="row clearfix">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <label for="venture_images" class="control-label"><span class="text-danger">*</span>Select Images</label>
                                                    <div class="form-group">
                                                            <input type="file" multiple
                                                                name="venture_images[]" accept="image/*" class="form-control" id="venture_images" />
                                                            <span class="text-danger" id='err_venture_images'></span>
                                                        </div>
                                                </div>
                                                <button style='margin-top: 2.5%;' type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                    
                                
                           
                        </form>
                        
                    </div>
                </div>
                <?php foreach($venture_images as $images){ ?>
                    <div class='col-md-4' style='padding:2%'>
                        <button class='btn btn-danger' onclick='deleteImage(<?=$images['vimage_id']?>)' style='float:right'><i class='fa fa-trash'></i></button>
                        <img style='width: 100%;' alt="picture" src="<?=base_url()?><?=$images['Image_path']?>" >
                    </div>
                <?php } ?>
               
            </div>
            </div>
        <div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Images</h4>
        </div>
        
    </div>
  </div>

<script>

   function validate(){

       console.log($('#venture_images').val());
       if($('#venture_images').val() == ''){

           $('#err_venture_images').html('Please selecte atleast one image.');
           return false;
           
       }else{

           $('#err_venture_images').html('');
           return true;
       }
      
    }

    function deleteImage(vimage_id){

        $res = confirm('Are you sure to delete this image');

        $.ajax({

            type:'post',
            url:'<?=base_url()?>/CompanyVentures/delete_image',
            data:{'vimage_id':vimage_id},
            async:false,
            success:function(response){
                console.log(response);
                window.location.reload()
            },
            error:function(status){

                console.log(status);
            }
        });
    }
</script>