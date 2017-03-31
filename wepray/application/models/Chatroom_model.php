<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatroom_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('date');
	}
	public function searchOldChatMsg($idA,$idB) {
		$condition = "(userInfoIdA =".$idA." AND userInfoIdB =".$idB.") OR (userInfoIdA =".$idB." AND userInfoIdB =".$idA."  AND chatStatus = 1) ";
		$this->db->select('*');
		$this->db->from('f_user_chat');
		$this->db->where($condition);
		$query = $this->db-> get();
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function searchNewChatMsg($idA,$idB) {
		$condition = "userInfoIdA =".$idA." AND userInfoIdB =".$idB." AND chatStatus = 0 ";
		$this->db->select('*');
		$this->db->from('f_user_chat');
		$this->db->where($condition);
		$query = $this->db-> get();
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function setChatBeRead($chatId) {
		$data = array();
		$data['chatStatus']=1;
		$this->db->where( 'chatId', $chatId );
		$this->db->update( 'f_user_chat' , $data );
		return true;
	}
	public function setChatMsg($data) {
		$data['createDate']=date('Y-m-d H:i:s');
		$data['chatStatus']=0;
		$this->db->insert( "f_user_chat", $data);
		return true;
	}
}