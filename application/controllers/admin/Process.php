<?php

 /**
 * Author: Amirul Momenin
 * Desc:Process Controller
 *
 */
class Process extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Process_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of process table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['process'] = $this->Process_model->get_limit_process($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/process/index');
		$config['total_rows'] = $this->Process_model->get_count_process();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/process/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save process
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		$created_at = "";
$updated_at = "";

		if($id<=0){
															 $created_at = date("Y-m-d H:i:s");
														 }
else if($id>0){
															 $updated_at = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'warehouse_id' => html_escape($this->input->post('warehouse_id')),
'raw_materials' => html_escape($this->input->post('raw_materials')),
'raw_materials_qty_or_weight' => html_escape($this->input->post('raw_materials_qty_or_weight')),
'raw_materials_unit' => html_escape($this->input->post('raw_materials_unit')),
'raw_materials_cost' => html_escape($this->input->post('raw_materials_cost')),
'finished_goods' => html_escape($this->input->post('finished_goods')),
'finished_goods_qty_or_weight' => html_escape($this->input->post('finished_goods_qty_or_weight')),
'finished_goods_unit' => html_escape($this->input->post('finished_goods_unit')),
'finished_goods_cost' => html_escape($this->input->post('finished_goods_cost')),
'lost_raw_material' => html_escape($this->input->post('lost_raw_material')),
'lost_raw_qty_or_weight' => html_escape($this->input->post('lost_raw_qty_or_weight')),
'lost_raw_unit' => html_escape($this->input->post('lost_raw_unit')),
'manpowers' => html_escape($this->input->post('manpowers')),
'total_work' => html_escape($this->input->post('total_work')),
'tw_unit' => html_escape($this->input->post('tw_unit')),
'manpower_cost' => html_escape($this->input->post('manpower_cost')),
'created_at' =>$created_at,
'updated_at' =>$updated_at,

				);
		 
		if($id>0){
							                        unset($params['created_at']);
						                          }if($id<=0){
							                        unset($params['updated_at']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['process'] = $this->Process_model->get_process($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Process_model->update_process($id,$params);
				$this->session->set_flashdata('msg','Process has been updated successfully');
                redirect('admin/process/index');
            }else{
                $data['_view'] = 'admin/process/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $process_id = $this->Process_model->add_process($params);
				$this->session->set_flashdata('msg','Process has been saved successfully');
                redirect('admin/process/index');
            }else{  
			    $data['process'] = $this->Process_model->get_process(0);
                $data['_view'] = 'admin/process/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details process
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['process'] = $this->Process_model->get_process($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/process/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting process
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $process = $this->Process_model->get_process($id);

        // check if the process exists before trying to delete it
        if(isset($process['id'])){
            $this->Process_model->delete_process($id);
			$this->session->set_flashdata('msg','Process has been deleted successfully');
            redirect('admin/process/index');
        }
        else
            show_error('The process you are trying to delete does not exist.');
    }
	
	/**
     * Search process
	 * @param $start - Starting of process table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('warehouse_id', $key, 'both');
$this->db->or_like('raw_materials', $key, 'both');
$this->db->or_like('raw_materials_qty_or_weight', $key, 'both');
$this->db->or_like('raw_materials_unit', $key, 'both');
$this->db->or_like('raw_materials_cost', $key, 'both');
$this->db->or_like('finished_goods', $key, 'both');
$this->db->or_like('finished_goods_qty_or_weight', $key, 'both');
$this->db->or_like('finished_goods_unit', $key, 'both');
$this->db->or_like('finished_goods_cost', $key, 'both');
$this->db->or_like('lost_raw_material', $key, 'both');
$this->db->or_like('lost_raw_qty_or_weight', $key, 'both');
$this->db->or_like('lost_raw_unit', $key, 'both');
$this->db->or_like('manpowers', $key, 'both');
$this->db->or_like('total_work', $key, 'both');
$this->db->or_like('tw_unit', $key, 'both');
$this->db->or_like('manpower_cost', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['process'] = $this->db->get('process')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/process/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('warehouse_id', $key, 'both');
$this->db->or_like('raw_materials', $key, 'both');
$this->db->or_like('raw_materials_qty_or_weight', $key, 'both');
$this->db->or_like('raw_materials_unit', $key, 'both');
$this->db->or_like('raw_materials_cost', $key, 'both');
$this->db->or_like('finished_goods', $key, 'both');
$this->db->or_like('finished_goods_qty_or_weight', $key, 'both');
$this->db->or_like('finished_goods_unit', $key, 'both');
$this->db->or_like('finished_goods_cost', $key, 'both');
$this->db->or_like('lost_raw_material', $key, 'both');
$this->db->or_like('lost_raw_qty_or_weight', $key, 'both');
$this->db->or_like('lost_raw_unit', $key, 'both');
$this->db->or_like('manpowers', $key, 'both');
$this->db->or_like('total_work', $key, 'both');
$this->db->or_like('tw_unit', $key, 'both');
$this->db->or_like('manpower_cost', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("process")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/process/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export process
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'process_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $processData = $this->Process_model->get_all_process();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Warehouse Id","Raw Materials","Raw Materials Qty Or Weight","Raw Materials Unit","Raw Materials Cost","Finished Goods","Finished Goods Qty Or Weight","Finished Goods Unit","Finished Goods Cost","Lost Raw Material","Lost Raw Qty Or Weight","Lost Raw Unit","Manpowers","Total Work","Tw Unit","Manpower Cost","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($processData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $process = $this->db->get('process')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/process/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Process controller