<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>
<style type="text/css">

	.top_menu {
		background-color: #fff;
		width: 90%;
		padding: 20px 0 15px;
		box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
	}
	.top_menu .buttons {
		margin: 3px 0 0 20px;
		position: absolute;
	}
	.top_menu .buttons .button {
		width: 16px;
		height: 16px;
		border-radius: 50%;
		display: inline-block;
		margin-right: 10px;
		position: relative;
	}
	.top_menu .buttons .button.close {
		background-color: #f5886e;
	}
	.top_menu .buttons .button.minimize {
		background-color: #fdbf68;
	}
	.top_menu .buttons .button.maximize {
		background-color: #a3d063;
	}
	.top_menu .title {
		text-align: center;
		color: #bcbdc0;
		font-size: 20px;
	}

	.messages {
		position: relative;
		list-style: none;
		padding: 20px 10px 0 10px;
		margin: 0;
		height: 347px;
		overflow: scroll;
	}
	.messages .message {
		clear: both;
		overflow: hidden;
		margin-bottom: 20px;
		transition: all 0.5s linear;
		opacity: 0;
	}
	.messages .message.left .avatar {
		background-image:url(<?php echo getAssetImagePath();?>123.png); 
		float: left;
	}
	.messages .message.left .text_wrapper {
		background-color: #ffe6cb;
		margin-left: 20px;
	}
	.messages .message.left .text_wrapper::after, .messages .message.left .text_wrapper::before {
		right: 100%;
		border-right-color: #ffe6cb;
	}
	.messages .message.left .text {
		color: #c48843;
	}
	.messages .message.right .avatar {
		background-color: #fdbf68;
		float: right;
	}
	.messages .message.right .text_wrapper {
		background-color: #c7eafc;
		margin-right: 20px;
		float: right;
	}
	.messages .message.right .text_wrapper::after, .messages .message.right .text_wrapper::before {
		left: 100%;
		border-left-color: #c7eafc;
	}
	.messages .message.right .text {
		color: #45829b;
	}
	.messages .message.appeared {
		opacity: 1;
	}
	.messages .message .avatar {
		width: 60px;
		height: 60px;
		border-radius: 50%;
		display: inline-block;
	}
	.messages .message .text_wrapper {
		display: inline-block;
		padding: 20px;
		border-radius: 6px;
		width: calc(100% - 85px);
		min-width: 100px;
		position: relative;
	}
	.messages .message .text_wrapper::after, .messages .message .text_wrapper:before {
		top: 18px;
		border: solid transparent;
		content: " ";
		height: 0;
		width: 0;
		position: absolute;
		pointer-events: none;
	}
	.messages .message .text_wrapper::after {
		border-width: 13px;
		margin-top: 0px;
	}
	.messages .message .text_wrapper::before {
		border-width: 15px;
		margin-top: -2px;
	}
	.messages .message .text_wrapper .text {
		font-size: 18px;
		font-weight: 300;
	}

	.bottom_wrapper {
		position: relative;
		width: 90%;
		background-color: #fff;
		padding: 20px 20px;
		position: absolute;
		bottom: -70;
	}
	.bottom_wrapper .message_input_wrapper {
		display: inline-block;
		height: 50px;
		border-radius: 25px;
		border: 1px solid #bcbdc0;
		width: calc(100% - 160px);
		position: relative;
		padding: 0 20px;
	}
	.bottom_wrapper .message_input_wrapper .message_input {
		border: none;
		height: 90%;
		box-sizing: border-box;
		width: calc(90% - 40px);
		position: absolute;
		outline-width: 0;
		color: gray;
	}
	.bottom_wrapper .send_message {
		width: 140px;
		height: 50px;
		display: inline-block;
		border-radius: 50px;
		background-color: #a3d063;
		border: 2px solid #a3d063;
		color: #fff;
		cursor: pointer;
		transition: all 0.2s linear;
		text-align: center;
		float: right;
	}
	.bottom_wrapper .send_message:hover {
		color: #a3d063;
		background-color: #fff;
	}
	.bottom_wrapper .send_message .text {
		font-size: 18px;
		font-weight: 300;
		display: inline-block;
		line-height: 48px;
	}

	.message_template {
		display: none;
	}

</style>
<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="chat_window">
				<div class="top_menu">
					<div class="buttons">
						<div class="button close">

						</div>
					</div>
					<div class="title">小伊</div>
				</div>
				<ul class="messages"></ul>
				<div class="bottom_wrapper clearfix">
					<div class="message_input_wrapper">
						<input class="message_input" placeholder="在这边输入讯息...." />
					</div>
					<div class="send_message">
						<div class="icon">

						</div>
						<div class="text">送出</div>
					</div>
				</div>
			</div>
			<div class="message_template">
				<li class="message">
					<div class="avatar"></div>
					<div class="text_wrapper">
						<div class="text">

						</div>
					</div>
				</li>
			</div>
		</div>
	</div>
</div>
<?php loadView('templates/footer');?>
<script type="text/javascript">
	$( document ).ready(function() {
		setInterval("getNewChat()", 500);
	});
	var Message;
	Message = function (arg) {
		this.text = arg.text, this.message_side = arg.message_side;
		this.draw = function (_this) {
			return function () {
				var $message;
				$message = $($('.message_template').clone().html());
				$message.addClass(_this.message_side).find('.text').html(_this.text);
				$('.messages').append($message);
				return setTimeout(function () {
					return $message.addClass('appeared');
				}, 0);
			};
		}(this);
		return this;
	};
	var getMessageText, message_side, sendMessage;
	message_side = 'right';
	getMessageText = function () {
		var $message_input;
		$message_input = $('.message_input');
		return $message_input.val();
	};
	sendMessage = function (text,side) {
		var $messages, message;
		if (text.trim() === '') {
			return;
		}
		$('.message_input').val('');
		$messages = $('.messages');
		if(side==1){
			message_side = 'right' ;
		}else if(side==2){
			message_side = 'left' ;
		}
		message = new Message({
			text: text,
			message_side: message_side
		});
		message.draw();
		return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
	};
	sendOldMessage = function (text,side) {
		var $messages, message;
		if (text.trim() === '') {
			return;
		}
		$('.message_input').val('');
		$messages = $('.messages');
		if(side==1){
			message_side = 'right' ;
		}else if(side==2){
			message_side = 'left' ;
		}
		message = new Message({
			text: text,
			message_side: message_side
		});
		message.draw();
		return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 0);
	};
	$('.send_message').click(function (e) {
		return sendChatMsg(getMessageText());
	});
	// $('.message_input').keyup(function (e) {
	// 	if (e.which === 13) {
	// 		return sendChatMsg(getMessageText());
	// 	}
	// });
	function sendChatMsg($text){
		$.ajax({
			url: "<?php echo site_url('/chatroom/sendChatMsg');?>",
			type:"post",
			data:{"idA":1,"idB":2,"text":$text},
			dataType:'text',
			success:function(data){
				if(data==true){
					sendMessage($text,1);
				}else if(data==false){
					sendMessage("讯息未被审过",1);
				}
			}
		});
	}

	function getNewChat(){
		$.ajax({
			url: "<?php echo site_url('/chatroom/getNewChatMessage');?>",
			type:"post",
			data:{"idA":2,"idB":1},
			dataType:'text',
			success:function(data){
				if(data==false){

				}else{
					var JSONObject = $.parseJSON(data);
					for (var key in JSONObject) {
						if (JSONObject.hasOwnProperty(key)) {
							sendMessage(JSONObject[key]["chatMessage"],2);
							$.ajax({
								url: "<?php echo site_url('/chatroom/setChatBeRead');?>",
								type:"post",
								data:{"chatId":JSONObject[key]["chatId"]},
								dataType:'text',
								success:function(data){

								}
							});
						}
					}
				}
			}
		});
	}
	function getChat(){
		$.ajax({
			url: "<?php echo site_url('/chatroom/getOldChatMessage');?>",
			type:"post",
			data:{"idA":1,"idB":2},
			dataType:'text',
			success:function(data){
				if(data==false){

				}else{
					var JSONObject = $.parseJSON(data);
					for (var key in JSONObject) {
						if (JSONObject.hasOwnProperty(key)) {
							if(JSONObject[key]["userInfoIdA"]==1){
								sendOldMessage(JSONObject[key]["chatMessage"],1);
							}else if(JSONObject[key]["userInfoIdA"]==2){
								sendOldMessage(JSONObject[key]["chatMessage"],2);
							}
						}
					}
				}
			}
		});
	}
	getChat();
</script>


