<a  href="<?php echo site_url('admin/process/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Process'); ?></h5>
<!--Data display of process with id--> 
<?php
	$c = $process;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Warehouse</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Warehouse_model');
									   $dataArr = $this->CI->Warehouse_model->get_warehouse($c['warehouse_id']);
									   echo $dataArr['name'];?>
									</td></tr>

<tr><td>Raw Materials</td><td><?php echo $c['raw_materials']; ?></td></tr>

<tr><td>Raw Materials Qty Or Weight</td><td><?php echo $c['raw_materials_qty_or_weight']; ?></td></tr>

<tr><td>Raw Materials Unit</td><td><?php echo $c['raw_materials_unit']; ?></td></tr>

<tr><td>Raw Materials Cost</td><td><?php echo $c['raw_materials_cost']; ?></td></tr>

<tr><td>Finished Goods</td><td><?php echo $c['finished_goods']; ?></td></tr>

<tr><td>Finished Goods Qty Or Weight</td><td><?php echo $c['finished_goods_qty_or_weight']; ?></td></tr>

<tr><td>Finished Goods Unit</td><td><?php echo $c['finished_goods_unit']; ?></td></tr>

<tr><td>Finished Goods Cost</td><td><?php echo $c['finished_goods_cost']; ?></td></tr>

<tr><td>Lost Raw Material</td><td><?php echo $c['lost_raw_material']; ?></td></tr>

<tr><td>Lost Raw Qty Or Weight</td><td><?php echo $c['lost_raw_qty_or_weight']; ?></td></tr>

<tr><td>Lost Raw Unit</td><td><?php echo $c['lost_raw_unit']; ?></td></tr>

<tr><td>Manpowers</td><td><?php echo $c['manpowers']; ?></td></tr>

<tr><td>Total Work</td><td><?php echo $c['total_work']; ?></td></tr>

<tr><td>Tw Unit</td><td><?php echo $c['tw_unit']; ?></td></tr>

<tr><td>Manpower Cost</td><td><?php echo $c['manpower_cost']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of process with id//--> 