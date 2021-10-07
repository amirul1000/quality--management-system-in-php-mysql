<a  href="<?php echo site_url('admin/process/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Process'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/process/save/'.$process['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Warehouse" class="col-md-4 control-label">Warehouse</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Warehouse_model'); 
             $dataArr = $this->CI->Warehouse_model->get_all_warehouse(); 
          ?> 
          <select name="warehouse_id"  id="warehouse_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($process['warehouse_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                        <label for="Raw Materials" class="col-md-4 control-label">Raw Materials</label> 
          <div class="col-md-8"> 
           <textarea  name="raw_materials"  id="raw_materials"  class="form-control" rows="4"/><?php echo ($this->input->post('raw_materials') ? $this->input->post('raw_materials') : $process['raw_materials']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Raw Materials Qty Or Weight" class="col-md-4 control-label">Raw Materials Qty Or Weight</label> 
          <div class="col-md-8"> 
           <input type="text" name="raw_materials_qty_or_weight" value="<?php echo ($this->input->post('raw_materials_qty_or_weight') ? $this->input->post('raw_materials_qty_or_weight') : $process['raw_materials_qty_or_weight']); ?>" class="form-control" id="raw_materials_qty_or_weight" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Raw Materials Unit" class="col-md-4 control-label">Raw Materials Unit</label> 
          <div class="col-md-8"> 
           <input type="text" name="raw_materials_unit" value="<?php echo ($this->input->post('raw_materials_unit') ? $this->input->post('raw_materials_unit') : $process['raw_materials_unit']); ?>" class="form-control" id="raw_materials_unit" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Raw Materials Cost" class="col-md-4 control-label">Raw Materials Cost</label> 
          <div class="col-md-8"> 
           <input type="text" name="raw_materials_cost" value="<?php echo ($this->input->post('raw_materials_cost') ? $this->input->post('raw_materials_cost') : $process['raw_materials_cost']); ?>" class="form-control" id="raw_materials_cost" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Finished Goods" class="col-md-4 control-label">Finished Goods</label> 
          <div class="col-md-8"> 
           <textarea  name="finished_goods"  id="finished_goods"  class="form-control" rows="4"/><?php echo ($this->input->post('finished_goods') ? $this->input->post('finished_goods') : $process['finished_goods']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Finished Goods Qty Or Weight" class="col-md-4 control-label">Finished Goods Qty Or Weight</label> 
          <div class="col-md-8"> 
           <input type="text" name="finished_goods_qty_or_weight" value="<?php echo ($this->input->post('finished_goods_qty_or_weight') ? $this->input->post('finished_goods_qty_or_weight') : $process['finished_goods_qty_or_weight']); ?>" class="form-control" id="finished_goods_qty_or_weight" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Finished Goods Unit" class="col-md-4 control-label">Finished Goods Unit</label> 
          <div class="col-md-8"> 
           <input type="text" name="finished_goods_unit" value="<?php echo ($this->input->post('finished_goods_unit') ? $this->input->post('finished_goods_unit') : $process['finished_goods_unit']); ?>" class="form-control" id="finished_goods_unit" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Finished Goods Cost" class="col-md-4 control-label">Finished Goods Cost</label> 
          <div class="col-md-8"> 
           <input type="text" name="finished_goods_cost" value="<?php echo ($this->input->post('finished_goods_cost') ? $this->input->post('finished_goods_cost') : $process['finished_goods_cost']); ?>" class="form-control" id="finished_goods_cost" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Lost Raw Material" class="col-md-4 control-label">Lost Raw Material</label> 
          <div class="col-md-8"> 
           <textarea  name="lost_raw_material"  id="lost_raw_material"  class="form-control" rows="4"/><?php echo ($this->input->post('lost_raw_material') ? $this->input->post('lost_raw_material') : $process['lost_raw_material']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Lost Raw Qty Or Weight" class="col-md-4 control-label">Lost Raw Qty Or Weight</label> 
          <div class="col-md-8"> 
           <input type="text" name="lost_raw_qty_or_weight" value="<?php echo ($this->input->post('lost_raw_qty_or_weight') ? $this->input->post('lost_raw_qty_or_weight') : $process['lost_raw_qty_or_weight']); ?>" class="form-control" id="lost_raw_qty_or_weight" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Lost Raw Unit" class="col-md-4 control-label">Lost Raw Unit</label> 
          <div class="col-md-8"> 
           <input type="text" name="lost_raw_unit" value="<?php echo ($this->input->post('lost_raw_unit') ? $this->input->post('lost_raw_unit') : $process['lost_raw_unit']); ?>" class="form-control" id="lost_raw_unit" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Manpowers" class="col-md-4 control-label">Manpowers</label> 
          <div class="col-md-8"> 
           <input type="text" name="manpowers" value="<?php echo ($this->input->post('manpowers') ? $this->input->post('manpowers') : $process['manpowers']); ?>" class="form-control" id="manpowers" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Total Work" class="col-md-4 control-label">Total Work</label> 
          <div class="col-md-8"> 
           <input type="text" name="total_work" value="<?php echo ($this->input->post('total_work') ? $this->input->post('total_work') : $process['total_work']); ?>" class="form-control" id="total_work" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Tw Unit" class="col-md-4 control-label">Tw Unit</label> 
          <div class="col-md-8"> 
           <input type="text" name="tw_unit" value="<?php echo ($this->input->post('tw_unit') ? $this->input->post('tw_unit') : $process['tw_unit']); ?>" class="form-control" id="tw_unit" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Manpower Cost" class="col-md-4 control-label">Manpower Cost</label> 
          <div class="col-md-8"> 
           <input type="text" name="manpower_cost" value="<?php echo ($this->input->post('manpower_cost') ? $this->input->post('manpower_cost') : $process['manpower_cost']); ?>" class="form-control" id="manpower_cost" /> 
          </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($process['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			