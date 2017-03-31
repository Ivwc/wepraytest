<?php
class Address extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('address_model');
        }
        public function getProvince(){
                $id = $this->input->post('id');
                $data [ 'province' ] = $this->address_model->get_provinceById($id);
                echo json_encode($data [ 'province' ]);
        }
        public function getPrefectural(){
                $id = $this->input->post('id');
                $data [ 'prefectural' ] = $this->address_model->get_prefecturalById($id);
                echo json_encode($data [ 'prefectural' ]);
        }
        public function getDistrict(){
                $id = $this->input->post('id');
                $data [ 'district' ] = $this->address_model->get_districtById($id);
                echo json_encode($data [ 'district' ]);
        }

}