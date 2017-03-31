<?php
class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('wepray_temples_model');

    }
    public function index(){
        $this->load->view('pages/login');
    }
    public function register(){
        $this->load->view('pages/register');
    }
    public function login_fail(){
        clear_session_errorcount();
        $this->load->view('pages/login_fail');
    }
    public function user_login_process() {
        $this->form_validation->set_rules('account', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $data = array(
            'account' => $this->input->post('account'),
            'password' => $this->input->post('password')
            );
        if ($this->form_validation->run() == FALSE)
        {
            redirect('login', 'reflash');
        }
        else
        {
            $this->login_process($data);
        }
    }
    public function user_register() {
        $this->form_validation->set_rules('account', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('countryId', 'CountryId', 'required');
        $this->form_validation->set_rules('provinceId', 'ProvinceId', 'required');
        $this->form_validation->set_rules('prefecturalId', 'PrefecturalId', 'required');
        $this->form_validation->set_rules('districtId', 'DistrictId', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');

        $data = array(
            'accountName' => $this->input->post('account'),
            'accountPassword' => $this->input->post('password')
            );
        $data2 = array(
            'countryId' => $this->input->post('countryId'),
            'provinceId' => $this->input->post('provinceId'),
            'prefecturalId' => $this->input->post('prefecturalId'),
            'districtId' => $this->input->post('districtId'),
            'templeLongitude' => $this->input->post('longitude'),
            'templeLatitude' => $this->input->post('latitude'),
            'templeAddress' => $this->input->post('address')
            );
        if ($this->form_validation->run() == FALSE)
        {
            redirect('login/register', 'reflash');
        }
        else
        {        
            $this->login_model->register($data);
            $account = $data['accountName'];
            $result = $this->login_model->read_user_information($account);
            if ($result != false) {
                $registerdata = array(
                    'accountId' => $result[0]->accountId
                    );
                $data2['accountId']=$registerdata['accountId'];
                $this->wepray_temples_model->insert_db($data2);
            }
            $data = array(
                'account' => $this->input->post('account'),
                'password' => $this->input->post('password')
                );
            $this->login_process($data);
        }
    }
    private function login_process($data){
        $result = $this->login_model->login($data);
        if ($result == TRUE) {
            $account = $this->input->post('account');
            $result = $this->login_model->read_user_information($account);
            if ($result != false) {

                $registerdata = array(
                    'accountId' => $result[0]->accountId
                    );
                $this->login_model->update_login_date($registerdata['accountId']);
                set_session($result);
                check_session_authority();
                $result2=$this->wepray_temples_model->get_my_temples_id($registerdata['accountId']);
                
                $data2 = array();
                foreach ($result2 as $key => $value) {
                    $data2['templeId']=$value['templeId'];
                }

                set_temples($data2['templeId']);
                redirect('pages', 'reflash');
            }
        } else {
            set_session_errorcount();
            if(get_session_errorcount()<3){
                redirect('login', 'reflash');
            }else{
                redirect('login/login_fail', 'reflash');
            }
        }
    }
    public function getAccount(){
        $account = $this->input->post('account');
        $result = $this->login_model->read_user_information($account);
        if ($result != false) {
            echo true;
        }else{

            echo false;
        }
    }

    public function checkOldPassword(){
        $password = $this->input->post('password');
        $result = $this->login_model->check_password(get_session_name());
        if ($result != false) {
            $data = array(
                'password' => $result[0]->accountPassword
                );
            if($data['password']==$password){
                echo true;
            }else{

                echo false;
            }
        }else{
            echo false;
        }
    }
    public function updatePassword(){
        $this->form_validation->set_rules('password', 'Password', 'required');
        $change=$this->login_model->update_password(get_session_id(),$this->input->post('password'));
        if($change==true){
            $this->logout();
        }
    }
        // Logout from admin page
    public function logout() {
        unset_userdata();
    }
}