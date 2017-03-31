<?php
class Wepray_temples_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->helper('date');
        }
        public function get_all_temples()
        {
                $this->db-> select('*');
                $this->db-> from('t_temples_information');
                $this->db->join('t_country', 't_country.countryId = t_temples_information.countryId');
                $this->db->join('t_province', 't_province.provinceId = t_temples_information.provinceId');
                $this->db->join('t_prefectural', 't_prefectural.prefecturalId = t_temples_information.prefecturalId');
                $this->db->join('t_district', 't_district.districtId = t_temples_information.districtId');
                $this->db->join('t_gods_pic', 't_gods_pic.godsPicId = t_temples_information.godsPicId');

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

        public function get_my_temples_id($accountId)
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
                        return 0;
                }
        }

        public function get_my_temples($accountId)
        {
                $condition = "accountId =" . "'" . $accountId."'";
                $this->db->select('*');
                $this->db->from('t_temples_information');
                $this->db->join('t_country', 't_country.countryId = t_temples_information.countryId');
                $this->db->join('t_province', 't_province.provinceId = t_temples_information.provinceId');
                $this->db->join('t_prefectural', 't_prefectural.prefecturalId = t_temples_information.prefecturalId');
                $this->db->join('t_district', 't_district.districtId = t_temples_information.districtId');
                $this->db->join('t_gods_pic', 't_gods_pic.godsPicId = t_temples_information.godsPicId');
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                        return $query->result_array();
                } else {
                        return null;
                }
        }
        public function insert_db( $data )
        {
                $data['godsPicId']=1;
                $data['templeLastCTRTime']=date('Y-m-d H:i:s');
                $data['createDate']=date('Y-m-d H:i:s');
                $data['updateDate']=date('Y-m-d H:i:s');
                $this->db->insert( "t_temples_information", $data );
                return true;
        }

        public function get_my_temples_byId($id)
        {
                $condition = "templeId =" . "'" . $id."'";
                $this->db->select('*');
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

        public function get_my_temples_info_modify_byId($id)
        {
                $condition = "templeId =" . "'" . $id."'";
                $this->db->select('*');
                $this->db->from('t_temples_information_modify');
                $this->db->where($condition);
                $this->db->order_by("updateDate", "desc");
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        return $query->result_array();
                } else {
                        return null;
                }
        }

        public function get_my_temples_map_modify_byId($id)
        {
                $condition = "templeId =" . "'" . $id."'";
                $this->db->select('*');
                $this->db->from('t_temples_map_modify');
                $this->db->join('t_country', 't_country.countryId = t_temples_map_modify.countryId');
                $this->db->join('t_province', 't_province.provinceId = t_temples_map_modify.provinceId');
                $this->db->join('t_prefectural', 't_prefectural.prefecturalId = t_temples_map_modify.prefecturalId');
                $this->db->join('t_district', 't_district.districtId = t_temples_map_modify.districtId');
                $this->db->where($condition);
                $this->db->order_by("updateDate", "desc");
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        return $query->result_array();
                } else {
                        return null;
                }
        }
        public function update_temples_info($id,$modifyName,$num)
        {
                $data['templeId']=$id;
                $data['createDate']=date('Y-m-d H:i:s');
                $data['updateDate']=date('Y-m-d H:i:s');
                $data['modifyName']=$modifyName;
                $data['modifyType']=$num;
                $data['modifyStatus']=0;
                $data['modifyPublic']=0;
                $this->db->insert( "t_temples_information_modify", $data );
                $data2['updateDate']=date('Y-m-d H:i:s');
                $data2['templePublicStatus']=2;
                $this->db->where( 'templeId', $id );
                $this->db->update( 't_temples_information' , $data2 );
                return true;
        }
        public function update_temples_map($id,$data)
        {
                $data['templeId']=$id;
                $data['createDate']=date('Y-m-d H:i:s');
                $data['updateDate']=date('Y-m-d H:i:s');
                $data['modifyStatus']=0;
                $data['modifyPublic']=0;
                $this->db->insert( "t_temples_map_modify", $data );
                $data2['updateDate']=date('Y-m-d H:i:s');
                $data2['templePublicStatus']=2;
                $this->db->where( 'templeId', $id );
                $this->db->update( 't_temples_information' , $data2 );
                return true;
        }
        public function cancel_update_information($modifyId){
                $data2['updateDate']=date('Y-m-d H:i:s');
                $data2['modifyStatus']=3;
                $data2['modifyPublic']=1;
                $this->db->where( 'modifyId', $modifyId );
                $this->db->update( 't_temples_information_modify' , $data2 );
                return true;
        }
        public function notshow_modify($modifyId){
                $data2['updateDate']=date('Y-m-d H:i:s');
                $data2['modifyPublic']=1;
                $this->db->where( 'modifyId', $modifyId );
                $this->db->update( 't_temples_information_modify' , $data2 );
                return true;
        }
}

