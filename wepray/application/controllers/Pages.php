<?php
class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wepray_temples_model');
        $this->load->model('wepray_temples_pic_model');
        $this->load->model('address_model');
    }
    public function index(){
        check_session_authority();
        $this->load->view('pages/home');

    }
    public function info(){
        check_session_authority();
        $this->load->view('pages/info');
    }
    public function temples_pic_upload(){
        check_session_authority();
        $this->load->view('pages/temples_pic_upload');
    }
    public function money(){
        check_session_authority();
        $this->load->view('pages/money');
    }
    public function chat(){
        check_session_authority();
        $this->load->view('pages/chat');
    }
    public function chat2(){
        check_session_authority();
        $this->load->view('pages/chat2');
    }
    public function kindness(){
        check_session_authority();
        $this->load->view('pages/kindness');
    }
    public function store(){
        check_session_authority();
        $this->load->view('pages/store');
    }
    public function store_product_add(){
        check_session_authority();
        $this->load->model('mod_product');
        $data = array(
            'color'=>$this->mod_product->get_color_list(get_temples_id()),
            'specification'=>$this->mod_product->get_specification_list(),
            );
        $this->load->view('pages/store_product_add',$data);
    }
    public function store_product_edit(){
        check_session_authority();
        $pid = $this->input->get('pid');
        
        //檢查商品是否是這個廟方的
        $chk = chk_product_is_templeid(get_temples_id(),$pid);
        if ($chk) {
            $res = $this->mod_product->get_once($pid,get_temples_id());
        
            $data = array(
                'list' => $res, 
                'color'=>$this->mod_product->get_color_list(get_temples_id()),
                'specification'=>$this->mod_product->get_specification_list(),
            );

            $this->load->view('pages/store_product_edit',$data);
        }else{
            echo '<script>alert("不屬於您的商品");</script>';
            redirect(site_url().'pages/store_product_list','refresh');
        }
        // $this->load->view('pages/store_product_edit');

        
    }

    public function store_product_search(){
        check_session_authority();
        $this->load->view('pages/store_product_search');        
    }

    public function store_product_list(){
        check_session_authority();

        $type = $this->input->get_post('type');

        if ($type == 'search') {
            $this->load->model('mod_product');
            $product_name = $this->input->get_post('product_name');
            $product_sub_name = $this->input->get_post('product_sub_name');            
            $product_class = $this->input->get_post('product_class');
            $search_data = array(
                'product_name' => $product_name, 
                'product_sub_name' => $product_sub_name,
                'product_class' => $product_class,
                );
            $res = $this->mod_product->get_search_request(get_temples_id(),$search_data);
            $data = array('list'=>$res);
        }else{
            $this->load->model('mod_product');
        
            $this->load->library('pagination');
            //從第幾筆開始
            $per_page = $this->input->get_post('per_page');

            //一頁幾筆
            $qty = 10;
            if ($per_page == "") {
                $per_page = 0;
            }
            // from menu
            // $data['list'] = $this->mod_product->get_all($qty,$mini,$this->session->userdata('product_list'));
            $res = $this->mod_product->get_list(get_temples_id(),$qty,$per_page);

            $mycount = count($this->mod_product->get_list(get_temples_id()));

            $config['base_url'] = site_url().'pages/store_product_list';
            $config['total_rows'] = $mycount;
            $config['per_page'] = $qty;
            $config['num_links'] = 2;
            $config['page_query_string'] = TRUE;
                        
            $this->pagination->initialize($config);

            $pagenation = $this->pagination->create_links();
            $data = array('list' => $res,'pagenation'=>$pagenation );
        }
        
        $this->load->view('pages/store_product_list',$data);
    }
    public function upload(){
        check_session_authority();
        $this->load->view('upload_form');
    }

    public function temples_pic_show($id){
        check_session_authority();
        $result=$this->wepray_temples_pic_model->getPicToShow($id);
        if ($result != null) {
            $data2 = array();
            foreach ($result as $key => $value) {
                $data2['url']=$value['templePicUrl'];
            }
            $data['templePicUrl']=$data2['url'];
            $data['templeId']=$id;
            $this->load->view('pages/temples_pic_show',$data);
        }else{
            redirect('pages', 'location');
        }
    }
    public function temples_pic_crop($id){
        check_session_authority();
        $result=$this->wepray_temples_pic_model->getPicToShow($id);
        if ($result != null) {
            $data2 = array();
            foreach ($result as $key => $value) {
                $data2['url']=$value['templePicUrl'];
            }
            $data['templePicUrl']=$data2['url'];
            $data['templeId']=$id;
            $this->load->view('pages/temples_pic_crop',$data);
        }else{
            redirect('pages', 'location');
        }
    }

    public function insert_temples_information(){
        $fields_ary = array( 
            'templeName', 
            'countryId',
            'provinceId',  
            'prefecturalId', 
            'districtId',
            'templeAddress', 
            'templePhone',
            'templeLongitude', 
            'templeLatitude', 
            'templeIntroduction',
            );
        $temp=$this->wepray_temples_model->insert_db($fields_ary);
        redirect('pages', 'reflash');
    }
    public function update_information($id = -1 ){
        if( $id == -1 )
        {
            redirect('pages', 'location');
        }
        $rs = $this->wepray_temples_model->update_temples( $id );
        redirect('pages', 'location');
    }
    public function store_product_class(){
        check_session_authority();
        $this->load->model('mod_product');
        $father = $this->input->get('father');

        $data = array(
            'list'=>$this->mod_product->get_class_list(get_temples_id(),$father),
            'crumbs'=>$this->mod_product->get_crumbs($father),
            );
        $this->load->view('pages/store_product_class',$data);        
    }
    public function store_product_color(){
        check_session_authority();
        $this->load->model('mod_product');
        $data = array(
            'list' => $this->mod_product->get_color_list(get_temples_id()), 
            );
        $this->load->view('pages/store_product_color',$data);        
    }
}