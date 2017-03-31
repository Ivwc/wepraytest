<?php
class Temples extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wepray_temples_model');
        $this->load->model('address_model');
    }

    public function update_information(){
        $this->form_validation->set_rules('templeId', 'TempleId', 'required');
        $this->form_validation->set_rules('templeName', 'TempleName', 'required');
        $this->form_validation->set_rules('templeAddress', 'TempleAddress', 'required');
        $this->form_validation->set_rules('templePhone', 'TemplePhone', 'required');
        $this->form_validation->set_rules('templeIntroduction', 'TempleIntroduction', 'required');
        $id=$this->input->post('templeId');
        $result=$this->wepray_temples_model->get_my_temples_byId($id);
        $data = array(
            'templeName' => $this->input->post('templeName'),
            'templeAddress' => $this->input->post('templeAddress'),
            'templePhone' => $this->input->post('templePhone'),
            'templeIntroduction' => $this->input->post('templeIntroduction')
            );
        if ($result != null) {
            $data2=array();
            foreach ($result as $key => $value) {
                $data2['templeName']=$value['templeName'];
                $data2['templeAddress']=$value['templeAddress'];
                $data2['templePhone']=$value['templePhone'];
                $data2['templeIntroduction']=$value['templeIntroduction'];
            }
            if(checkString($data2['templeName'],$data['templeName'])!=0){
                $this->wepray_temples_model->update_temples_info($id,$data['templeName'],1);
            }
            if(checkString($data2['templeAddress'],$data['templeAddress'])!=0){
                $this->wepray_temples_model->update_temples_info($id,$data['templeAddress'],2);
            }
            if(checkString($data2['templePhone'],$data['templePhone'])!=0){
                $this->wepray_temples_model->update_temples_info($id,$data['templePhone'],3);
            }
            if(checkString($data2['templeIntroduction'],$data['templeIntroduction'])!=0){
                $this->wepray_temples_model->update_temples_info($id,$data['templeIntroduction'],4);
            }
        }
        redirect('pages/info', 'reflash');
    }
    public function update_map(){
        $this->form_validation->set_rules('templeId', 'TempleId', 'required');
        $this->form_validation->set_rules('countryId', 'CountryId', 'required');
        $this->form_validation->set_rules('provinceId', 'ProvinceId', 'required');
        $this->form_validation->set_rules('prefecturalId', 'PrefecturalId', 'required');
        $this->form_validation->set_rules('districtId', 'DistrictId', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');

        $id=$this->input->post('templeId');
        $result=$this->wepray_temples_model->get_my_temples_byId($id);
        $data = array(
            'countryId' => $this->input->post('countryId'),
            'provinceId' => $this->input->post('provinceId'),
            'prefecturalId' => $this->input->post('prefecturalId'),
            'districtId' => $this->input->post('districtId'),
            'templeLongitude' => $this->input->post('longitude'),
            'templeLatitude' => $this->input->post('latitude')
            );
        if ($result != null) {
            $data2=array();
            foreach ($result as $key => $value) {
                $data2['countryId']=$value['countryId'];
                $data2['provinceId']=$value['provinceId'];
                $data2['prefecturalId']=$value['prefecturalId'];
                $data2['districtId']=$value['districtId'];
                $data2['templeLongitude']=$value['templeLongitude'];
                $data2['templeLatitude']=$value['templeLatitude'];
            }

            if(checkString($data2['countryId'].$data2['provinceId'].$data2['prefecturalId'].$data2['districtId'].$data2['templeLongitude'].$data2['templeLatitude'],$data['countryId'].$data['provinceId'].$data['prefecturalId'].$data['districtId'].$data['templeLongitude'].$data['templeLatitude'])!=0){
                $this->wepray_temples_model->update_temples_map($id,$data);
            }
        }
        redirect('pages/info', 'reflash');
    }

    public function cancel_update_information(){
        $modifyId = $this->input->post('id');
        $result=$this->wepray_temples_model->cancel_update_information($modifyId);
        echo $result;
    }
    public function notshow_modify(){
        $modifyId = $this->input->post('id');
        $result=$this->wepray_temples_model->notshow_modify($modifyId);
        echo $result;
    }
}