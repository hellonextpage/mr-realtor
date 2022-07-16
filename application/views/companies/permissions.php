<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Assign Permissions</h3>
            
            </div>
            <div class="box-body">
                <input type='hidden' id='emp_id' value='<?=$emp_id?>'>
                <table id='datatabl' class="table table-striped">
                    <thead>
                    <tr>
                        <th><input type='checkbox' id='check_all' onchange='checkAll(this)'>Select All</th>
                        <th>Module Name</th>
						
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($modules as $m){ ?>
                    <tr>
                        
                        <?php $isChecked =  in_array($m['module_id'],$permissions) == true ? 'checked' :''?>
                        <td><input <?=$isChecked?>  type='checkbox' id='module<?=$m['module_id']?>' name='modules[]' value='<?=$m['module_id']?>'></td>
                        <td><?php echo $m['module_name']; ?></td>
					
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
            <div class="box-footer">
            	<button type="button" onclick="savePermissions()" class="btn btn-success float-right">
            		<i class="fa fa-check"></i> Save
            	</button>
            	<a href="javascript:history.go(-1)" class="btn btn-danger float-right">Back</a>
          	</div>
        </div>
    </div>
</div>
<script>
    
    
   
    function savePermissions(){
        
        let selected_modules = [];
        let emp_id = $('#emp_id').val();
        $checkBoxes = $("input[name='modules[]']");
        $.each($checkBoxes,function(key,value){
            
            if($(this).prop('checked') == true){
                
                selected_modules.push($(this).val());
            }
        });
        console.log(selected_modules);
        $.ajax({
            
            type:'POST',
            url:"<?=base_url()?>/Employee/saveEmpPermissions",
            data:{'selected_modules':selected_modules,'emp_id':emp_id},
            async:false,
            success:function(response){
                
                console.log(response);
                window.location.reload();
            },
            error:function(status){
                
                window.location.reload();
                console.log(status);
            }
        });
    }
    
    function checkAll(element){
        
       
        if($(element).prop('checked')){
            
            $("input[name='modules[]']").not(this).prop('checked', true);
            
        }else{
            
            $("input[name='modules[]']").not(this).prop('checked', false);
        }
         
        
    }
</script>
