<?php loadView('templates/login_header');?>
<div class="container" > 
	<div class="form-signin">
		<form name="login" id="loginForm"  method="post" action="<?php echo site_url('login/user_login_process/');?>" >
			<h2 class="form-signin-heading">祈机后台登入</h2>
			<div class="controls controls-row">
			</div>
			<div class="control-group info">
				<div class="controls">
					<input type="text" id="account" class="form-control input-block-level" name="account" placeholder="帐号" maxlength="20" value="" >
					<input type="password" id="password" class="form-control input-block-level" name="password" placeholder="密码" maxlength="20" value="" >
				</div>
			</div>
			<br>
			<button type="submit" class="btn btn-success btn-lg btn-block" disabled="disabled" id="login">登入</button>
			<a class="btn btn-info btn-lg btn-block" href="<?php echo site_url('login/register');?>">注册</a>
			<p class="text-error"><?php 
				if(get_session_errorcount()!=0){
					echo "帐号密码错误".get_session_errorcount()."次";
				}?></p>
			</form>
		</div>
	</div>

	<script>
		$( document ).ready(function() {
			setInterval("check_form()", 100);
		});

		function check_form()
		{
			var account = $('#account').val();
			var password = $('#password').val();
			if(account==""||password==""){
				document.getElementById("login").disabled=true;
				document.getElementById("login").className="btn btn-success btn-lg btn-block";
			}else{
				document.getElementById("login").disabled=false;
				document.getElementById("login").className="btn btn-success btn-lg btn-block";
			}
		}	
	</script>
	<?php loadView('templates/footer');?>