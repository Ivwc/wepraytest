<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list"></span> 祈机后台</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?=site_url().'pages'?>"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?=site_url().'pages/info'?>"><span class="glyphicon glyphicon-user"></span> <?=get_session_name();?>的个人资料</a></li>
				<li><a href="<?=site_url().'login/logout'?>" class="navbar-link"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
			</ul>
		</div>
	</div>
</nav>

    <?php setImportAsset('slide-toggle.js');?>