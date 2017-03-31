<?php

class Picupload_temples extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wepray_temples_pic_model');
    }
    private $upload_path='./img';
    public function upload() {
        if (!empty($_FILES)) {
            $config['upload_path']          = './asset/img';
            // $config['allowed_types']        = 'jpg|gif|png|jpeg|bmp';
            $config['allowed_types']        = '*';
            $config['overwrite']     = true;
            $resultCount = $this->wepray_temples_pic_model->count_temples_pic();
            $new_name = "t_".get_temples_id()."_pic_".($resultCount)."_v.png";
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file'))
            {
                // $fInfo=$this->upload->data();
                // $config['image_library'] = 'gd2';
                // $config['source_image'] = $fInfo['full_path'];
                // $config['maintain_ratio'] = TRUE;
                // $config['width']     = 1026;
                // $config['height']     = 770;
                // $config['quality']         = "100%";
                // $this->image_lib->clear();
                // $this->image_lib->initialize($config);
                // $this->image_lib->resize();
                $url= $config['file_name'];
                $this->wepray_temples_pic_model->insert_pic(get_temples_id(),$resultCount,$url);
            }else{
                $error = array('error' => $this->upload->display_errors());
            }
        }
    }

    public function list_pic(){
        $files=$this->wepray_temples_pic_model->getPic(get_temples_id());
        echo json_encode($files);
    }

    public function move_up(){
        $templePicId = $this->input->post('templePicId');
        $sequence = $this->input->post('sequence');
        if($sequence==0){
            echo false;
        }else{
            $result = $this->wepray_temples_pic_model->move_up($templePicId,$sequence);
            echo $result;
        }
        
    }
    public function move_down(){
        $resultcount=0;
        $resultcount = $this->wepray_temples_pic_model->count_temples_pic();
        $templePicId = $this->input->post('templePicId');
        $sequence = $this->input->post('sequence');
        if($sequence==$resultcount){
            echo false;
        }else{
            $result = $this->wepray_temples_pic_model->move_down($templePicId,$sequence);
            echo $result;
        } 
    }
    public function disable(){
        $templePicId = $this->input->post('templePicId');
        $result = $this->wepray_temples_pic_model->disable($templePicId);
        echo $result;
    }
    public function able(){
        $templePicId = $this->input->post('templePicId');
        $result = $this->wepray_temples_pic_model->able($templePicId);
        echo $result;
    }
    public function crop(){
        $templeId = $this->input->post('id');
        $url = $this->input->post('url');
        $x_axis = $this->input->post('x_axis');
        $y_axis = $this->input->post('y_axis');
        $width = $this->input->post('width');
        $height = $this->input->post('height');
        $this->image_lib->clear();
        $img_array = array();
        $img_array['image_library'] = 'gd2';
        $img_array['source_image'] = "./".$url;
        $img_array['maintain_ratio'] = FALSE;
        $img_array['x_axis'] = $x_axis;
        $img_array['y_axis'] = $y_axis;
        $img_array['width'] = $width;
        $img_array['height'] = $height;
        $this->image_lib->initialize($img_array); 
        if ( ! $this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        }else{
            echo "成功";
        }
    }
    public function rotate(){
        $templeId = $this->input->post('id');
        $url = $this->input->post('url');
        $angle = $this->input->post('angle');
        $this->image_lib->clear();
        $img_array = array();
        $img_array['image_library'] = 'gd2';
        $img_array['source_image'] = "./".$url;
        $img_array['rotation_angle'] = $angle;
        $this->image_lib->initialize($img_array); 
        if ( ! $this->image_lib->rotate())
        {
            echo $this->image_lib->display_errors();
        }else{
            echo "成功";
        }
    }
}
?>