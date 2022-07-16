<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?=$venture['VentureName']?> Ventures  Plots Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('CompanyVentures/add_plots/'.$venture['VentureID']); ?>" class="btn btn-success btn-sm">Add New</a> 
                </div>
            </div>
            <div class="box-body">
                <table id='datatable' class="table table-striped">
                    <thead>
                    <tr>
						<th> Sl.No</th>
						<th>Plot No</th>
						<th>Venture Name</th>
						<th>Plot Type</th>
                        <th>Facing</th>
						<th>Plot Size </th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($venture_plots as $v){ ?>
                    <tr>
						<td><?php echo ++$i ; ?></td>
						<td><?php echo $v['PlotNo']; ?></td>
						<td><?php echo $v['VentureName']; ?></td>
						<td><?php echo $v['ptype_name']; ?></td>
                        <td><?php echo $v['Facing']; ?></td>
                        <td><?php echo $v['Plotsize']; ?></td>
						<td>
                           <a href="<?php echo site_url('CompanyVentures/updatePlot/'.$v['PlotID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
