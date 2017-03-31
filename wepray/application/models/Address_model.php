<?php
class Address_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_country()
        {
                $this->db-> select('*');
                $this->db-> from('t_country');
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
        public function get_province()
        {
                $this->db-> select('*');
                $this->db-> from('t_province');
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
        public function get_provinceById($id)
        {

                $condition = "countryId =" . "'" . $id . "'";
                $this->db-> select('*');
                $this->db-> from('t_province');
                $this->db-> where($condition);
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
        public function get_prefectural()
        {
                $this->db-> select('*');
                $this->db-> from('t_prefectural');
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
        public function get_prefecturalById($id)
        {

                $condition = "provinceId =" . "'" . $id . "'";
                $this->db-> select('*');
                $this->db-> from('t_prefectural');
                $this->db-> where($condition);
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
        public function get_district()
        {
                $this->db-> select('*');
                $this->db-> from('t_district');
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
        public function get_districtById($id)
        {

                $condition = "prefecturalId =" . "'" . $id . "'";
                $this->db-> select('*');
                $this->db-> from('t_district');
                $this->db-> where($condition);
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
}

