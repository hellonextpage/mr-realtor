<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Checked In User List</h3>
            	
            </div>
            <div class="box-body">
                <table id='datatable' class="table table-striped">
                    <thead>
                    <tr>
						<th>Sl.No</th>
					
						<th> Company Name</th>
						<th>Mobile No</th>
						<th>Name </th>
						<th>Is Agent Or Cust ?</th>						
						<th>Last CheckedIn On </th>
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($users_list  as $p){ ?>
                    <tr>
						<td><?php echo ++$i; ?></td>
						<td><?php echo $p['CompName']; ?></td>
						<td><?php echo $p['MobileNo']; ?></td>
						<td><?php echo $p['Name']; ?></td>
						<td><?php echo $p['IsAgentOrCust']; ?></td>
						<td><?php echo $p['LastCheckedInOn']; ?></td>
					
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
