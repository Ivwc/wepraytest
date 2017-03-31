<?php
class Wepray_temples_pic_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function count_temples_pic() {
                $condition = "templeId =" . "'" . get_temples_id()."'";
                $this->db->select('*');
                $this->db->from('t_temples_pic');
                $this->db->where($condition);
                return $this->db->count_all_results();
        }
        public function get_my_temples($accountId)
        {
                $condition = "accountId =" . "'" . $accountId."'";
                $this->db->select('templeId');
                $this->db->from('t_temples_information');
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                        return $query->result_array();
                } else {
                        return null;
                }
        }
        public function insert_pic($templeId,$resultcount,$picurl){
                $data['templeId']=$templeId;
                $data['templePicSequence']=$resultcount;
                $data['templePicUrl']=$picurl;
                $data['createDate']=date('Y-m-d H:i:s');
                $data['updateTime']=date('Y-m-d H:i:s');
                $data['picStatus']=0;
                $this->db->insert( "t_temples_pic", $data );
                return true;
        }
        public function getPic($templeId)
        {
                $condition = "templeId =" . "'" . $templeId."'";
                $this->db->select('*');
                $this->db->from('t_temples_pic');
                $this->db->where($condition);
                $this->db->order_by("templePicSequence", "asc"); 
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        return $query->result_array();
                } else {
                        return null;
                }
        }

        public function getPicToShow($templePicId)
        {
                $condition = "templePicId =" . "'" . $templePicId."' && templeId='".get_temples_id()."'";
                $this->db->select('templePicUrl');
                $this->db->from('t_temples_pic');
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                        return $query->result_array();
                } else {
                        return null;
                }
        }
        public function move_up($templePicId,$sequence){
                $condition = "templePicSequence =" . "'" . ($sequence-1)."' && templeId='".get_temples_id()."'";
                $this->db->select('*');
                $this->db->from('t_temples_pic');
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                        $result=$query->result_array();
                        foreach ($result as $key => $value) {
                                $data2['templePicId']=$value['templePicId'];
                        }
                        $data = array();
                        $data['templePicSequence']=$sequence;
                        $this->db->where( 'templePicId', $data2['templePicId'] );
                        $this->db->update( 't_temples_pic' ,  $data);
                } else {
                        return false;
                }
                $data = array();
                $data['templePicSequence']=$sequence-1;
                $this->db->where( 'templePicId', $templePicId );
                $this->db->update( 't_temples_pic' , $data );
                return true;
        }

        public function move_down($templePicId,$sequence){
                $condition = "templePicSequence =" . "'" . ($sequence+1)."' && templeId='".get_temples_id()."'";
                $this->db->select('*');
                $this->db->from('t_temples_pic');
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                        $result=$query->result_array();
                        foreach ($result as $key => $value) {
                                $data2['templePicId']=$value['templePicId'];
                        }
                        $data = array();
                        $data['templePicSequence']=$sequence;
                        $this->db->where( 'templePicId', $data2['templePicId'] );
                        $this->db->update( 't_temples_pic' ,  $data);
                } else {
                        return false;
                }
                $data = array();
                $data['templePicSequence']=$sequence+1;
                $this->db->where( 'templePicId', $templePicId );
                $this->db->update( 't_temples_pic' , $data );
                return true;
        }
        public function disable($templePicId){
                $data = array();
                $data['picStatus']=2;
                $this->db->where( 'templePicId', $templePicId );
                $this->db->update( 't_temples_pic' , $data );
                return true;
        }
        public function able($templePicId){
                $data = array();
                $data['picStatus']=1;
                $this->db->where( 'templePicId', $templePicId );
                $this->db->update( 't_temples_pic' , $data );
                return true;
        }

}

