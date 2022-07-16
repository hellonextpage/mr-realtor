<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Company Admins Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('CompanyAdmins/add'); ?>" class="btn btn-success btn-sm">Add New</a> 
                </div>
            </div>
            <div class="box-body">
                <table id='datatable' class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th> Name</th>
                        <th>Company </th>
						<th>Mobile No</th>
						<th>Email Id</th>
                        
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach($company_admins as $ca){ ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?php if($ca['Name']!="" && $ca['Name']!=null){ echo $ca['Name'];}else{ echo "N/A";} ?></td>
						<td><?php if($ca['CompName']!="" && $ca['CompName']!=null){ echo $ca['CompName'];}else{ echo "N/A";}?></td>
						<td><?php echo $ca['MobileNo']; ?></td>
						<td><?php echo $ca['EmailID']; ?></td>
						
						
						<td>
                            <a href="<?php echo site_url('CompanyAdmins/edit/'.$ca['CompAdminID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                           
                           <?php if($ca['IsActive']){ ?>
                           
                                <a href="<?php echo site_url('CompanyAdmins/deactivate/'.$ca['CompAdminID']); ?>" class="btn btn-danger btn-xs"> De-Activate</a> 
                            <?php }else{ ?>
                            
                                <a href="<?php echo site_url('CompanyAdmins/activate/'.$ca['CompAdminID']); ?>" class="btn btn-success btn-xs"> Activate</a> 
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
