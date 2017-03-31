<form name="login" id="loginForm"  method="post" action="<?php echo site_url('login/updatePassword/');?>" >
	
	<div class="panel panel-default">
		<table class="table ">
			<tbody>
				<tr>
					<td width="200px">旧密码</td>
					<td><input type="password" class="form-control input-block-level" id="oldPassword">
						<span id="checkOld"></span>
					</td>
				</tr>
				<tr>
					<td>新密码</td>
					<td><input type="password" class="form-control input-block-level" id="newpassword" name="password">
						<span id="checkPassword"></span>
					</td>
				</tr>
				<tr>
					<td>再输入一次新密码</td>
					<td><input type="password" class="form-control input-block-level" id="confirmPassword">
						<span id="checkConfirmPassword"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 请注意，更新成功后会自动登出
	</div>
	<button type="submit" class="btn btn-success" id="updatePassword" name="updatePassword">更新</button>
</form>
<script>
	$( document ).ready(function() {
		setInterval("check_password()", 500);
	});
	function check_password(){
		var oldPassword = document.getElementById('oldPassword').value;
		var password = document.getElementById('newpassword').value;
		var confirmPassword = document.getElementById('confirmPassword').value;
		var spanOld = document.getElementById("checkOld");
		var spanPassword = document.getElementById("checkPassword");
		var spanConfirmPassword = document.getElementById("checkConfirmPassword");
		var updateBt = document.getElementById("updatePassword");
		if(oldPassword.length<4&&oldPassword.length!=0){
			spanOld.innerHTML="此密码长度不对，至少要有4码";
			$("#checkOld").css("color","#FF0000");
		}else if(oldPassword.length==0){
			spanOld.innerHTML="";
			$("#checkOld").css("color","#000000");
		}else{
			$.ajax({
				url: "<?php echo site_url('/login/checkOldPassword');?>",
				type:"post",
				data:{"password":oldPassword},
				dataType:'text',
				success:function(data){
					if(data==false){
						spanOld.innerHTML="输入密码错误";
						$("#checkOld").css("color","#FF0000");
					}else{
						spanOld.innerHTML="";
						$("#checkOld").css("color","#000000");
					}
				}
			});
		}
		if(password.length<4&&password.length!=0){
			spanPassword.innerHTML="此密码长度不对，至少要有4码";
			$("#checkPassword").css("color","#FF0000");
		}else{
			spanPassword.innerHTML="";
			$("#checkPassword").css("color","#000000");
		}
		if(confirmPassword.length<4&&confirmPassword.length!=0){
			spanConfirmPassword.innerHTML="此密码长度不对，至少要有4码";
			$("#checkConfirmPassword").css("color","#FF0000");
		}else if(confirmPassword.length==0){
			spanConfirmPassword.innerHTML="";
			$("#checkConfirmPassword").css("color","#000000");
		}else{
			if(password==confirmPassword){
				spanConfirmPassword.innerHTML="";
				$("#checkConfirmPassword").css("color","#000000");
			}else{
				spanConfirmPassword.innerHTML="此密码与上面输入不同";
				$("#checkConfirmPassword").css("color","#FF0000");
			}
		}
		if(oldPassword==""||password==""||confirmPassword==""||spanOld.innerHTML!=""||spanPassword.innerHTML!=""||spanConfirmPassword.innerHTML!=""){
			updateBt.disabled=true;
			updateBt.className="btn btn-success";
		}else{
			updateBt.disabled=false;
			updateBt.className="btn btn-success";
		}
	}
</script>