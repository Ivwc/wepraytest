<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_product extends CI_Controller {

	function add_product(){
		$this->form_validation->set_rules('product_name', '商品名稱', 'required');
        $this->form_validation->set_rules('product_sub_name', '商品副標題', 'required');
        $this->form_validation->set_rules('product_class', '商品分類', 'required');
        $this->form_validation->set_rules('specification', '規格', 'required');
        
        
        $data = array(
            'product_name' => $this->input->post('product_name'),
            'product_sub_name' => $this->input->post('product_sub_name'),
            'product_class' => $this->input->post('product_class'),
            'specification' => $this->input->post('specification'),
            'chk_indeed' => $this->input->post('chk_indeed'),
            'product_intro' => $this->input->post('intro'),
            'create_datetime'=> date('Y-m-d H:i:s'),
            'edit_datetime'=> date('Y-m-d H:i:s'),
            );
        // print_r($data);
        if ($this->form_validation->run() == FALSE)
        {
            $json_arr['sys_code'] = '500';
            $json_arr['sys_msg'] = '資料未齊全';
        }
        else
        {	
        	//寫入p_main
         	$this->load->model('mod_product');
         	$pid = $this->mod_product->make_product_id();
         	$data['pid'] = $pid;

         	//把圖片從data_uri轉成base64輸出成圖片
         	$product_main = $this->input->post('product_main_photo');
         	$product_img1 = $this->input->post('product_img1');
         	$product_img2 = $this->input->post('product_img2');
         	$product_img3 = $this->input->post('product_img3');
         	$product_img4 = $this->input->post('product_img4');
         	$product_img5 = $this->input->post('product_img5');
         	$data['product_main_photo'] = $this->product_base64_to_file($product_main,$pid);
         	$data['product_img1'] = $this->product_base64_to_file($product_img1,$pid);
         	$data['product_img2'] = $this->product_base64_to_file($product_img2,$pid);
         	$data['product_img3'] = $this->product_base64_to_file($product_img3,$pid);
         	$data['product_img4'] = $this->product_base64_to_file($product_img4,$pid);
         	$data['product_img5'] = $this->product_base64_to_file($product_img5,$pid);

         	
			
         	$this->mod_product->insert($data);

         	//寫入map
         	$map_data = array(
         		'pid' => $pid, 
         		'templeid' => $this->input->post('templeId'),
         		);
         	$this->mod_product->insert_map($map_data);



         	$json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '新增成功';
            $json_arr['pid'] = $pid;
         	
        }
        echo json_encode($json_arr);

	}

	//更新商品
	function edit_product(){
		$this->form_validation->set_rules('product_name', '商品名稱', 'required');
        $this->form_validation->set_rules('product_sub_name', '商品副標題', 'required');
        $this->form_validation->set_rules('product_class', '商品分類', 'required');
        $this->form_validation->set_rules('specification', '規格', 'required');

        $data = array(
            'product_name' => $this->input->post('product_name'),
            'product_sub_name' => $this->input->post('product_sub_name'),
            'product_intro'=>$this->input->post('intro'),
            'specification' => $this->input->post('specification'),
            'product_class' => $this->input->post('product_class'),
            'edit_datetime'=> date('Y-m-d H:i:s'),
            );
        if ($this->form_validation->run() == FALSE)
        {
            $json_arr['sys_code'] = '500';
            $json_arr['sys_msg'] = '資料未齊全';
        }
        else
        {	
        	$pid = $this->input->get_post('pid');
        	$this->load->model('mod_product');

        	//把圖片從data_uri轉成base64輸出成圖片
         	$decodedData = $this->input->get_post('product_main_photo');
         	$data['product_main_photo'] = $this->product_base64_to_file_edit($decodedData,$pid);

         	$decodedData = $this->input->get_post('product_img1');
         	$data['product_img1'] = $this->product_base64_to_file_edit($decodedData,$pid);

         	$decodedData = $this->input->get_post('product_img2');
         	$data['product_img2'] = $this->product_base64_to_file_edit($decodedData,$pid);

         	$decodedData = $this->input->get_post('product_img3');
         	$data['product_img3'] = $this->product_base64_to_file_edit($decodedData,$pid);

         	$decodedData = $this->input->get_post('product_img4');
         	$data['product_img4'] = $this->product_base64_to_file_edit($decodedData,$pid);

         	$decodedData = $this->input->get_post('product_img5');
         	$data['product_img5'] = $this->product_base64_to_file_edit($decodedData,$pid);

			$res = $this->mod_product->update($pid,$data);

         	$json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '更新成功';
            $json_arr['pid'] = $pid;
         	
        }
        echo json_encode($json_arr);
	}

	//更新商品的介紹
	function update_intro(){
		$this->form_validation->set_rules('intro', 'intro', 'required');
		$pid = $this->input->post('pid');

		if ($this->form_validation->run() == TRUE ) {
			$this->load->model('mod_product');
			$data = array('product_intro' => $this->input->get_post('intro'), );
			$res = $this->mod_product->update($pid,$data);

			if ($res) {
				$json_arr['sys_code'] = '200';
            	$json_arr['sys_msg'] = '修改成功';
			}else{
				$json_arr['sys_code'] = '500';
            	$json_arr['sys_msg'] = '修改失敗';
			}
		} else {
			$json_arr['sys_code'] = '500';
            $json_arr['sys_msg'] = '資料錯誤';
		}

		echo json_encode($json_arr);
	}

	function product_img_upload(){
		// print_r($_FILES);
		$this->load->library('session');
		$pid = $this->session->userdata('pid');
		
		if (is_dir(getProductImagePath())) {
			// echo "has img dir";

		}else{
			// echo "not has img dir";
			mkdir(getProductImagePath(),0777);
		}
		$file_name = 'p_'.$pid.'-'.uniqid().'.png';
		$file_url = getProductImagePath().$file_name;
		if ($_FILES['file']['tmp_name'] != "") {
			copy($_FILES['file']['tmp_name'],$file_url );

			//寫入資料庫
			$this->load->model('mod_product');
			$this->mod_product->add_product_img($pid,$file_name);

		}


		
	}

	function set_session(){
		$this->load->library('session');
		$index = $this->input->post('index');
		$value = $this->input->post('value');

		$array = array(
			$index => $value,
		);
		
		$this->session->set_userdata( $array );

		echo json_encode(array('sys_code'=>"200"));
	}

	function get_product_list(){
		$this->load->model('mod_product');
		
		$this->load->library('pagination');
		//從第幾筆開始
		$per_page = $this->input->get_post('per_page');

		//一頁幾筆
		$qty = 2;
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
		
		// $res = $this->mod_product->get_list(get_temples_id());

		echo json_encode(array('list'=>$res,'pagenation'=>$pagenation));
	}

	//刪除商品的圖片
	function remove_product_img(){
		$sn = $this->input->post('sn');

		$this->load->model('mod_product');

		$res = $this->mod_product->remove_img($sn);

		if ($res) {
			$json_arr['sys_code'] = "200";
			$json_arr['sys_msg'] = "刪除成功";
		}else{
			$json_arr['sys_code'] = "500";
			$json_arr['sys_msg'] = "刪除失敗";
		}
		echo json_encode($json_arr);
	}

	//取得商品的圖片
	function get_product_img(){
		$pid = $this->input->post('pid');

		$this->load->model('mod_product');

		$res = $this->mod_product->get_img($pid);

		echo json_encode(array('list'=>$res));
	}

	//更改商品狀態
	function update_product_status(){
		//商品ID
		$pid = $this->input->get_post('pid');
		//商品狀態類型
		$type = $this->input->get_post('type');
		//狀態
		$status = $this->input->get_post('status');

		$this->load->model('mod_product');

		//確認商品是否是他的
		if ($this->mod_product->chk_once_product(get_temples_id(),$pid)) {
			$data = array($type => $status, );

			$res = $this->mod_product->update($pid,$data);

			if ($res) {
				$json_arr['sys_code'] = "200";
				$json_arr['sys_msg'] = "狀態更新成功";
			}else{
				$json_arr['sys_code'] = "500";
				$json_arr['sys_msg'] = "狀態更新失敗";
			}
		}else{
			$json_arr['sys_code'] = "500";
			$json_arr['sys_msg'] = "此商品非您所屬";
		}
		echo json_encode($json_arr);


	}

	function get_once_sort_class(){
		$sort_sn = $this->input->post('sort_sn');

		$this->load->model('mod_product');

		$res = $this->mod_product->get_sort_class_list($sort_sn);

		echo json_encode(array('list'=>$res));
	}

	function insert_class(){
		$class_name = $this->input->post('class_name');
		$father = $this->input->post('father');

		$this->load->model('mod_product');
		$data = array(
			'templeid'=>get_temples_id(),
			'class_name' => $class_name, 
			'create_datetime'=>date('Y-m-d H:i:s'),
			'edit_datetime'=>date('Y-m-d H:i:s'),
			);
		if ($father != "") {
			$data['father'] = $father;
		}
		$res = $this->mod_product->insert_class($data);

		if ($res != "") {
			$json_arr['sys_code']  = "200";
			$json_arr['sys_msg'] = "新增成功";
			$json_arr['sn'] = $res;
		}else{
			$json_arr['sys_code']  = "500";
			$json_arr['sys_msg'] = "新增失敗";
		}

		echo json_encode($json_arr);

	}

	function remove_product_class(){
		$sn = $this->input->get_post('sn');

		$this->load->model('mod_product');
		$res = $this->mod_product->remove_product_class($sn);

		if ($res) {
			$json_arr['sys_code']  = "200";
			$json_arr['sys_msg'] = "刪除成功";
		}else{
			$json_arr['sys_code']  = "500";
			$json_arr['sys_msg'] = "刪除失敗";
		}

		echo json_encode($json_arr);
	}
	function rename_product_class(){
		$sn = $this->input->post('sn');
		$class_name = $this->input->post('class_name');
		$this->load->model('mod_product');
		
		$data = array(
			'class_name' => $class_name, 
			'edit_datetime'=>date('Y-m-d H:i:s'),
			);
		$res = $this->mod_product->rename_product_class($sn,$data);

		if ($res) {
			$json_arr['sys_code']  = "200";
			$json_arr['sys_msg'] = "修改成功";
			
		}else{
			$json_arr['sys_code']  = "500";
			$json_arr['sys_msg'] = "修改失敗";
		}

		echo json_encode($json_arr);

	}

	//取得商品分類
	function get_product_class(){
		$father = $this->input->post('father');

		$this->load->model('mod_product');

		$class = $this->mod_product->get_class_list(get_temples_id(),$father);
		$path = $this->mod_product->get_crumbs($father);		

		echo json_encode(array('data'=>$class,'path'=>$path));

	}

	function get_product_crumbs(){
		$father = $this->input->post('father');

		$this->load->model('mod_product');

		$res = $this->mod_product->get_crumbs($father);		

		echo json_encode(array('path'=>$res));
	}

	//
	function product_base64_to_file($decodedData,$pid){
		
        if ($decodedData != "") {
         	list($type, $decodedData) = explode(';', $decodedData);
			list(, $decodedData)      = explode(',', $decodedData);
			$decodedData = base64_decode($decodedData);
			// echo getProductImagePath();
			$file_name = 'p_'.$pid.'-'.uniqid().'.png';
			$path = getProductImagePath().$file_name;
			if (is_dir(getProductImagePath())) {
				// echo "has img dir";
			}else{
				// echo "not has img dir";
				mkdir(getProductImagePath(),0777);
			}
	  		file_put_contents($path, $decodedData);
	  		return $file_name;
       	}
	}

	function product_base64_to_file_edit($decodedData,$pid){
		if ($decodedData != "") {
				$original_img = $decodedData;
         		$img = explode('/', $decodedData);
         		
         		if ($img[0] != 'http:') {
         			list($type, $decodedData) = explode(';', $decodedData);
					list(, $decodedData)      = explode(',', $decodedData);
					$decodedData = base64_decode($decodedData);
					$file_name = 'p_'.$pid.'-'.uniqid().'.png';
					$path = getProductImagePath().$file_name;
			  		file_put_contents($path, $decodedData);

			  		if (is_file($original_img)) {
			  			unlink($original_img);	
			  		}

			  		return $file_name;
         		}else{
         			return $img[5];
         		}
         		
		  		
         	}
	}

	//更新商品顏色
	function update_product_color(){
		$color = $this->input->post('color');
		
		$this->load->model('mod_product');
		$res = $this->mod_product->set_product_color(get_temples_id(),$color);

		if ($res) {
			$json_arr['sys_code']  = "200";
			$json_arr['sys_msg'] = "修改成功";
			
		}else{
			$json_arr['sys_code']  = "500";
			$json_arr['sys_msg'] = "修改失敗";
		}

		echo json_encode($json_arr);

	}

	//輸入商品的sku
	function insert_product_sku(){
		$sku = $this->input->post('sku');
		$pid = $this->input->post('pid');
		$this->load->model('mod_product');

		$res = $this->mod_product->insert_sku(get_temples_id(),$sku,$pid);

		if ($res) {
			$json_arr['sys_code'] = "200";
			$json_arr['sys_msg'] = "建立成功";
		}else{
			$json_arr['sys_code'] = "500";
			$json_arr['sys_msg'] = "建立失敗";
		}
		echo json_encode($json_arr);


	}

	function update_product_config(){
		$pid = $this->input->post('pid');
		$how_take = $this->input->post('how_take');
		$take_rule = $this->input->post('take_rule');
		$on_time = $this->input->post('on_time');
		$status = $this->input->post('status');

		$data = array(
			'how_take' => $how_take,
			'take_rule' => $take_rule,
			'on_time' => $on_time,
			'status' => $status,
			 );

		$this->load->model('mod_product');
		$res = $this->mod_product->update($pid,$data);

		if ($res) {
			$json_arr['sys_code'] = "200";
			$json_arr['sys_msg'] = "更新成功";
		}else{
			$json_arr['sys_code'] = "500";
			$json_arr['sys_msg'] = "更新失敗";
		}
		echo json_encode($json_arr);


	}

	
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */ ?>