<?php

/**
 * Author: Amirul Momenin
 * Desc:Process Model
 */
class Process_model extends CI_Model
{
	protected $process = 'process';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get process by id
	 *@param $id - primary key to get record
	 *
     */
    function get_process($id){
        $result = $this->db->get_where('process',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('process');
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
	
    /** Get all process
	 *
     */
    function get_all_process(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('process')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit process
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_process($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('process')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count process rows
	 *
     */
	function get_count_process(){
       $result = $this->db->from("process")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-process
	 *
     */
    function get_all_users_process(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('process')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-process
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_process($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('process')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-process rows
	 *
     */
	function get_count_users_process(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("process")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new process
	 *@param $params - data set to add record
	 *
     */
    function add_process($params){
        $this->db->insert('process',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update process
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_process($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('process',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete process
	 *@param $id - primary key to delete record
	 *
     */
    function delete_process($id){
        $status = $this->db->delete('process',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
