<?php

Class Login_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('date');
	}

	public function registration_insert($data) {
		$condition = "accountName =" . "'" . $data['account'] . "'";
		$this->db->select('*');
		$this->db->from('account');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {

			// Query to insert data in database
			$this->db->insert('user_login', $data);
			if ($this->db->affected_rows() > 0) {
				return true;	
			}
		} else {
			return false;
		}
	}

	public function login($data) {

		$condition = "accountName =" . "'" . $data['account'] . "' AND " . "accountPassword =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('account');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function read_user_information($account) {
		$condition = "accountName =" . "'" . $account . "'";
		$this->db->select('*');
		$this->db->from('account');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function check_password($account) {
		$condition = "accountName =" . "'" . $account . "'";
		$this->db->select('*');
		$this->db->from('account');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function update_password($id,$password)
	{
		$data = array();
		$data['updateDate']=date('Y-m-d H:i:s');
		$data['accountPassword']=$password;
		$this->db->where( 'accountId', $id );
		$this->db->update( 'account' , $data );
		return true;
	}
	public function update_login_date($id)
	{
		$data = array();
		$data['updateDate']=date('Y-m-d H:i:s');
		$this->db->where( 'accountId', $id );
		$this->db->update( 'account' , $data );
		return true;
	}
	public function register( $ary )
	{
		$ary['accountLevel']=0;
		$ary['createDate']=date('Y-m-d H:i:s');
		$ary['updateDate']=date('Y-m-d H:i:s');
		$this->db->insert( "account", $ary);
		return true;
	}

}

?>