<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Process'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/process/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/process/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/process/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//--> 
   
<!--Data display of process-->       
<table class="table table-striped table-bordered">
    <tr>
		<th>Warehouse</th>
<th>Raw Materials</th>
<th>Raw Materials Qty Or Weight</th>
<th>Raw Materials Unit</th>
<!--<th>Raw Materials Cost</th>
<th>Finished Goods</th>
<th>Finished Goods Qty Or Weight</th>
<th>Finished Goods Unit</th>
<th>Finished Goods Cost</th>
<th>Lost Raw Material</th>
<th>Lost Raw Qty Or Weight</th>
<th>Lost Raw Unit</th>
<th>Manpowers</th>
<th>Total Work</th>
<th>Tw Unit</th>
<th>Manpower Cost</th>-->

		<th>Actions</th>
    </tr>
	<?php foreach($process as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Warehouse_model');
									   $dataArr = $this->CI->Warehouse_model->get_warehouse($c['warehouse_id']);
									   echo $dataArr['name'];?>
									</td>
<td><?php echo $c['raw_materials']; ?></td>
<td><?php echo $c['raw_materials_qty_or_weight']; ?></td>
<td><?php echo $c['raw_materials_unit']; ?></td>
<!--<td><?php echo $c['raw_materials_cost']; ?></td>
<td><?php echo $c['finished_goods']; ?></td>
<td><?php echo $c['finished_goods_qty_or_weight']; ?></td>
<td><?php echo $c['finished_goods_unit']; ?></td>
<td><?php echo $c['finished_goods_cost']; ?></td>
<td><?php echo $c['lost_raw_material']; ?></td>
<td><?php echo $c['lost_raw_qty_or_weight']; ?></td>
<td><?php echo $c['lost_raw_unit']; ?></td>
<td><?php echo $c['manpowers']; ?></td>
<td><?php echo $c['total_work']; ?></td>
<td><?php echo $c['tw_unit']; ?></td>
<td><?php echo $c['manpower_cost']; ?></td>-->

		<td>
            <a href="<?php echo site_url('admin/process/details/'.$c['id']); ?>"  class="action-icon"> <i class="zmdi zmdi-eye"></i></a>
            <a href="<?php echo site_url('admin/process/save/'.$c['id']); ?>" class="action-icon"> <i class="zmdi zmdi-edit"></i></a>
            <a href="<?php echo site_url('admin/process/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="zmdi zmdi-delete"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<!--End of Data display of process//--> 

<!--No data-->
<?php
	if(count($process)==0){
?>
 <div align="center"><h3>Data is not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
	echo $link;
?>
<!--End of Pagination//-->
