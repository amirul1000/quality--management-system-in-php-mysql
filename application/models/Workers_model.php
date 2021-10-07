<?php

/**
 * Author: Amirul Momenin
 * Desc:Workers Model
 */
class Workers_model extends CI_Model
{
	protected $workers = 'workers';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get workers by id
	 *@param $id - primary key to get record
	 *
     */
    function get_workers($id){
        $result = $this->db->get_where('workers',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('workers');
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
	
    /** Get all workers
	 *
     */
    function get_all_workers(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('workers')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit workers
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_workers($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('workers')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count workers rows
	 *
     */
	function get_count_workers(){
       $result = $this->db->from("workers")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-workers
	 *
     */
    function get_all_users_workers(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('workers')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-workers
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_workers($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('workers')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-workers rows
	 *
     */
	function get_count_users_workers(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("workers")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new workers
	 *@param $params - data set to add record
	 *
     */
    function add_workers($params){
        $this->db->insert('workers',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update workers
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_workers($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('workers',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete workers
	 *@param $id - primary key to delete record
	 *
     */
    function delete_workers($id){
        $status = $this->db->delete('workers',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
