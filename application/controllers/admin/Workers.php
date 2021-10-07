<?php

 /**
 * Author: Amirul Momenin
 * Desc:Workers Controller
 *
 */
class Workers extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Workers_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of workers table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['workers'] = $this->Workers_model->get_limit_workers($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/workers/index');
		$config['total_rows'] = $this->Workers_model->get_count_workers();
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
		
        $data['_view'] = 'admin/workers/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save workers
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
					 'first_name' => html_escape($this->input->post('first_name')),
'last_name' => html_escape($this->input->post('last_name')),
'designation' => html_escape($this->input->post('designation')),
'phone' => html_escape($this->input->post('phone')),
'address' => html_escape($this->input->post('address')),
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
			$data['workers'] = $this->Workers_model->get_workers($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Workers_model->update_workers($id,$params);
				$this->session->set_flashdata('msg','Workers has been updated successfully');
                redirect('admin/workers/index');
            }else{
                $data['_view'] = 'admin/workers/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $workers_id = $this->Workers_model->add_workers($params);
				$this->session->set_flashdata('msg','Workers has been saved successfully');
                redirect('admin/workers/index');
            }else{  
			    $data['workers'] = $this->Workers_model->get_workers(0);
                $data['_view'] = 'admin/workers/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details workers
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['workers'] = $this->Workers_model->get_workers($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/workers/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting workers
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $workers = $this->Workers_model->get_workers($id);

        // check if the workers exists before trying to delete it
        if(isset($workers['id'])){
            $this->Workers_model->delete_workers($id);
			$this->session->set_flashdata('msg','Workers has been deleted successfully');
            redirect('admin/workers/index');
        }
        else
            show_error('The workers you are trying to delete does not exist.');
    }
	
	/**
     * Search workers
	 * @param $start - Starting of workers table's index to get query
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
$this->db->or_like('first_name', $key, 'both');
$this->db->or_like('last_name', $key, 'both');
$this->db->or_like('designation', $key, 'both');
$this->db->or_like('phone', $key, 'both');
$this->db->or_like('address', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['workers'] = $this->db->get('workers')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/workers/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('first_name', $key, 'both');
$this->db->or_like('last_name', $key, 'both');
$this->db->or_like('designation', $key, 'both');
$this->db->or_like('phone', $key, 'both');
$this->db->or_like('address', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("workers")->count_all_results();
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
		$data['_view'] = 'admin/workers/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export workers
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'workers_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $workersData = $this->Workers_model->get_all_workers();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","First Name","Last Name","Designation","Phone","Address","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($workersData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $workers = $this->db->get('workers')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/workers/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Workers controller