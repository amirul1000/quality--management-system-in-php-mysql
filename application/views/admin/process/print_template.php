<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Process'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of process-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Warehouse</th>
<th>Raw Materials</th>
<th>Raw Materials Qty Or Weight</th>
<th>Raw Materials Unit</th>
<th>Raw Materials Cost</th>
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
<th>Manpower Cost</th>

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
<td><?php echo $c['raw_materials_cost']; ?></td>
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
<td><?php echo $c['manpower_cost']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of process//--> 