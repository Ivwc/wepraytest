<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Mod_product extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('date');
	}

	function make_product_id(){
		$count = $this->db->count_all_results('p_main');
		$time = date('m-d');
		$time = explode('-', $time);

		$md = $time[0].$time[1];
		return $md.$count;

	}

	function insert($data){
		$this->db->insert('p_main',$data);
		return true;

	}

	function insert_map($data){
		$this->db->insert('p_map_temple',$data);
		return true;
	}
	
	function update($pid,$data){
		$this->db->where('pid',$pid);
		return $this->db->update('p_main',$data);
	}

	function add_product_img($pid,$file_url){
		$data = array(
			'pid' => $pid, 
			'img_url' => $file_url, 
			'create_datetime' => date('Y-m-d H:i:s'), 
			);
		$this->db->insert('p_img',$data);

	}

	function get_list($templeid,$qty="",$per_page=""){
		$this->db->where('status !=',9);
		$this->db->where('templeid',$templeid);
		$this->db->join('p_main','p_main.pid=p_map_temple.pid');
		// $this->db->limit(1);$qty,$per_page
		$this->db->limit($qty,$per_page);
		if ($qty != "" && $per_page != ""){
			$this->db->limit($qty,$per_page);
			// echo "per_page:".$per_page;
			// echo "qty:".$qty;
			
			
		}
		$res = $this->db->get('p_map_temple')->result_array();

		return $res;
	}

	//取得單筆商品
	function get_once($pid,$templeid){
		$this->db->where('templeid',$templeid);
		$this->db->where('p_main.pid',$pid);
		$this->db->join('p_main','p_main.pid=p_map_temple.pid');
		$res = $this->db->get('p_map_temple')->row_array();

		$this->db->where('pid',$res['pid']);
		$res['sku'] = $this->db->get('p_sku')->result_array();

		return $res;
	}

	//刪除圖片
	function remove_img($sn){
		$this->db->where('sn',$sn);
		$once = $this->db->get('p_img')->row_array();
		
		if (is_file(getProductImagePath().$once['img_url'])) {
			unlink(getProductImagePath().$once['img_url']);	
		}
		

		$this->db->where('sn',$sn);
		return $this->db->delete('p_img');
	}

	//取得商品圖片
	function get_img($pid){
		$this->db->where('pid',$pid);
		return $this->db->get('p_img')->result_array();
	}

	//確認商品是否是此廟方的
	function chk_once_product($templeid,$pid){
		$this->db->where('templeid',$templeid);
		$this->db->where('pid',$pid);
		$count = $this->db->count_all_results('p_map_temple');

		if ($count > 0) {
			return true;
		}else{
			return false;
		}

	}

	//取得商品搜尋結果
	function get_search_request($templeid,$data){
		// print_r($data);
		$this->db->where('templeid',$templeid);

		
		if ($data['product_class'] != "") {
			$this->db->where('product_class',$data['product_class']);
		}
		if ($data['product_name'] != "") {
			$this->db->like('product_name',$data['product_name']);
		}
		if ($data['product_sub_name'] != "") {
			$this->db->like('product_sub_name',$data['product_sub_name']);
		}

		$this->db->join('p_map_temple','p_map_temple.pid=p_main.pid');

		$res = $this->db->get('p_main')->result_array();
print_r($res);
		return $res;
	}

	
	

	function insert_class($data){
		$this->db->insert('p_class',$data);
		return $this->db->insert_id();
	}

	function get_class_list($templeid,$father){
		$this->db->where('templeid','official');
		$this->db->where('father',$father);
		$official = $this->db->get('p_class')->result_array();

		$this->db->where('templeid',$templeid);
		$this->db->where('father',$father);
		$res = $this->db->get('p_class')->result_array();

		foreach ($res as $key => $value) {
			$official[] = $res[$key];
		}

		return $official;

	}

	function remove_product_class($sn){
		//刪除子分類
		$this->db->where('father',$sn);
		$this->db->delete('p_class');

		//刪除本身
		$this->db->where('class_sn',$sn);
		return $this->db->delete('p_class');
	}

	function rename_product_class($sn,$data){
		$this->db->where('class_sn',$sn);
		return $this->db->update('p_class',$data);
	}

	//取得分類歷史路徑
	function get_crumbs($father){
		$crumbs = array();
		$class = array();
		if ($father != "") {
			do{
				$this->db->where('class_sn',$father);
				$class = $this->db->get('p_class')->row_array();
				$crumbs[] = $class;
				$father = $class['father'];

			}while($class['father'] != "");
				// echo $class['father'];
		}

		$crumbs = array_reverse($crumbs);
		return $crumbs;
	}

	function get_color_list($templeid){
		$this->db->where('templeid',$templeid);
		$res = $this->db->get('p_color')->result_array();
		return $res;
	}

	function set_product_color($templeid,$data){
		//全部刪掉
		$this->db->where('templeid',$templeid);
		$this->db->delete('p_color');


		foreach ($data as $key => $value) {
			$color = array(
				'templeid' => $templeid, 
				'color' => $value['color'], 
				'name' => $value['name'], 
				);
			$this->db->insert('p_color',$color);
		}
		return true;
	}

	//輸入sku
	function insert_sku($templeid,$data,$pid){
		$this->db->where('pid',$pid);
		$this->db->delete('p_sku');

		foreach ($data as $key => $value) {
			$value['templeid'] = $templeid;

			//處理圖片
			$value['img'] = $this->product_base64_to_file($value['img'],$value['pid']);
			$this->db->insert('p_sku',$value);
		}

		return true;
	}

	function product_base64_to_file($decodedData,$pid){
		
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

	function get_specification_list(){
		return $this->db->get('p_specification')->result_array();
	}


}

/* End of file Mod_product.php */
/* Location: ./application/models/Mod_product.php */ ?>