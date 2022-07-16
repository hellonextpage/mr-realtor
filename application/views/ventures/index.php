<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ventures Listing</h3>
                <?php if($this->session->userdata('Role') == 1 || $this->session->userdata('Role')==2){ ?>
            	<div class="box-tools">
                    <a href="<?php echo site_url('CompanyVentures/add'); ?>" class="btn btn-success btn-sm">Add New</a> 
                </div>
            <?php } ?>
            </div>
            <div class="box-body">
                <table id='datatable' class="table table-striped">
                    <thead>
                    <tr>
						<th> Sl.No</th>
						<th>Company Name</th>
						<th>Venture Name</th>
						<th>Zone</th>
                        <th>Venture Status</th>
						<th>CreatedOn </th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($all_ventures as $v){ ?>
                    <tr>
						<td><?php echo ++$i ; ?></td>
						<td><?php echo $v['CompName']; ?></td>
						<td><?php echo $v['VentureName']; ?></td>
						<td><?php echo $v['ZoneName']; ?></td>
                        <td><?php echo $v['VentureStatus']; ?></td>
						<td><?php echo date('d-m-Y',strtotime($v['CreatedOn'])) ?></td>
						<td>
                           <a href="<?php echo site_url('CompanyVentures/edit/'.$v['VentureID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                           <a href="<?php echo site_url('CompanyVentures/venturePlots/'.$v['VentureID']); ?>" class="btn btn-warning btn-xs"> Venture Plots</a>
                           <a href="<?php echo site_url('CompanyVentures/ventureGallery/'.$v['VentureID']); ?>" class="btn btn-success btn-xs"> Venture Gallery</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<script>
// MDB Lightbox Init
$(function () {
$("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});
</script>