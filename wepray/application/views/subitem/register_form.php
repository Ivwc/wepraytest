
<form name="register" id="registerForm"  method="post" action="<?php echo site_url('login/user_register/');?>" >
	<h2 class="form-signin-heading">祈机后台注册</h2>
	<div class="panel panel-default">
		<table class="table">
			<tbody>
				<tr class="info">
					<td>帐号</td>
					<td><input type="text" class="form-control input-block-level" id="account" name="account" placeholder="帐号" maxlength="20" value="" >
						<span id="checkAccount"></span>
					</td>
				</tr>
				<tr class="active">
					<td>密码</td>
					<td><input type="password" class="form-control input-block-level" id="password" name="password" placeholder="密码" maxlength="20" value="" >
						<span id="checkPassword"></span>
					</td>
				</tr>
				<tr class="info">
					<td>确认密码</td>
					<td><input type="password" class="form-control input-block-level" id="confirmPassword" name="confirmPassword" placeholder="确认密码" maxlength="20" value="" >
						<span id="checkConfirmPassword"></span>
					</td>
				</tr>
				<tr class="active">
					<td>填选庙宇地址</td>
					<td>
						<?php loadView('subitem/map');?>
					</td>
				</tr>
				<tr class="info">
					<td>输入庙宇位置</td>
					<td><input type="text" class="form-control input-block-level" name="address" placeholder="地址"  value="" ></td>
				</tr>
				<tr class="active">
					<td><a class="btn btn-primary btn-lg btn-block" href="<?php echo site_url('login');?>">返回</a></td>
					<td><button type="submit" class="btn btn-success btn-lg btn-block" id="register" disabled="disabled" >注册</button></td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
<script>
	$( document ).ready(function() {
		setInterval("check_form()", 500);
	});
	function check_form()
	{
		var account = document.getElementById('account').value;
		var password = document.getElementById('password').value;
		var confirmPassword = document.getElementById('confirmPassword').value;
		var spanAccount = document.getElementById("checkAccount");
		var spanPassword = document.getElementById("checkPassword");
		var spanConfirmPassword = document.getElementById("checkConfirmPassword");

		var longitude = document.getElementById('longitudeHide').value;
		var latitude = document.getElementById('latitudeHide').value;
		var registerBt = document.getElementById("register");

		var countryId = document.getElementById('countryId').value;
		var provinceId = document.getElementById('provinceId').value;
		var prefecturalId = document.getElementById('prefecturalId').value;
		var districtId = document.getElementById('districtId').value;

		if(account.length<4&&account.length!=0){
			spanAccount.innerHTML="此帐号长度不对，至少要有4码";
			$("#checkAccount").css("color","#FF0000");
		}else{
			$.ajax({
				url: "<?php echo site_url('/login/getAccount');?>",
				type:"post",
				data:{"account":account},
				dataType:'text',
				success:function(data){
					if(data==false){
						spanAccount.innerHTML="";
						$("#checkAccount").css("color","#000000");
					}else{
						spanAccount.innerHTML="已经有相同的帐号，请取别的帐号名称";
						$("#checkAccount").css("color","#FF0000");
					}
				}
			});
			if(password.length<4&&password.length!=0){
				spanPassword.innerHTML="此密码长度不对，至少要有4码";
				$("#checkPassword").css("color","#FF0000");
			}else{
				spanPassword.innerHTML="";
				$("#checkPassword").css("color","#000000");
				if(confirmPassword.length<4&&confirmPassword.length!=0){
					spanConfirmPassword.innerHTML="此密码长度不对，至少要有4码";
					$("#checkConfirmPassword").css("color","#FF0000");
				}else{
					if(password!=confirmPassword&&confirmPassword.length!=0){
						spanConfirmPassword.innerHTML="此密码与上方输入不对";
						$("#checkConfirmPassword").css("color","#FF0000");
					}else{
						spanConfirmPassword.innerHTML="";
						$("#checkConfirmPassword").css("color","#000000");
					}
				}
			}
		}
		if(account==""||password==""||confirmPassword==""||longitude==""||latitude==""||countryId==0||provinceId==0||prefecturalId==0||districtId==0||spanAccount.innerHTML!=""){
			registerBt.disabled=true;
			registerBt.className="btn btn-success btn-lg btn-block";
		}else{
			registerBt.disabled=false;
			registerBt.className="btn btn-success btn-lg btn-block";
		}
	}	


</script>