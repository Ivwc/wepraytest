<?php
class Chatroom extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('chatroom_model');
		$this->load->helper('text');
	}
	public function getOldChatMessage(){
		$idA = $this->input->post('idA');
		$idB = $this->input->post('idB');
		$result = $this->chatroom_model->searchOldChatMsg($idA,$idB);
		if($result==false){
			echo false;
		}else{
			$data [ 'chat' ]=$result;
			echo json_encode($data [ 'chat' ]);
		}
	}
	public function getNewChatMessage(){
		$idA = $this->input->post('idA');
		$idB = $this->input->post('idB');
		$result = $this->chatroom_model->searchNewChatMsg($idA,$idB);
		if($result==false){
			echo false;
		}else{
			$data [ 'chat' ]=$result;
			echo json_encode($data [ 'chat' ]);
		}
	}
	public function setChatBeRead(){
		$chatId = $this->input->post('chatId');
		$this->chatroom_model->setChatBeRead($chatId);
	}
	public function sendChatMsg(){
		$idA = $this->input->post('idA');
		$idB = $this->input->post('idB');
		$text = $this->input->post('text');
		$data['userInfoIdA']=$idA;
		$data['userInfoIdB']=$idB;

		$disallowed = array('fuck');

		$string = word_censor($text,$disallowed,'####');
		if(preg_match("/####/i", $string)){
			echo false;
		}else{
			$data['chatMessage']=$string;

			$result=$this->chatroom_model->setChatMsg($data);
			echo $result;
		}
	}
}