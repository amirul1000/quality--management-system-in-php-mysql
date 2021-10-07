<?php

/**
 * Author: Amirul Momenin
 * Desc:Warehouse Model
 */
class Warehouse_model extends CI_Model
{
	protected $warehouse = 'warehouse';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get warehouse by id
	 *@param $id - primary key to get record
	 *
     */
    function get_warehouse($id){
        $result = $this->db->get_where('warehouse',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('warehouse');
			foreach ($fields as $field)
			{
			   $result[$field] = ''; 	  
			}
		}
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all warehouse
	 *
     */
    function get_all_warehouse(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('warehouse')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit warehouse
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_warehouse($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('warehouse')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count warehouse rows
	 *
     */
	function get_count_warehouse(){
       $result = $this->db->from("warehouse")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-warehouse
	 *
     */
    function get_all_users_warehouse(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('warehouse')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-warehouse
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_warehouse($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('warehouse')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-warehouse rows
	 *
     */
	function get_count_users_warehouse(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("warehouse")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new warehouse
	 *@param $params - data set to add record
	 *
     */
    function add_warehouse($params){
        $this->db->insert('warehouse',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update warehouse
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_warehouse($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('warehouse',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete warehouse
	 *@param $id - primary key to delete record
	 *
     */
    function delete_warehouse($id){
        $status = $this->db->delete('warehouse',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
