<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>
<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#information" aria-controls="home" role="tab" data-toggle="tab">庙宇资讯</a></li>
				<li role="presentation"><a href="#map" aria-controls="profile" role="tab" data-toggle="tab">行政區變更</a></li>
				<li role="presentation"><a href="#password" aria-controls="profile" role="tab" data-toggle="tab">变更密码</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="information">
					<br />
					<?php loadView('subitem/update_temple_information');?>
				</div>
				<div role="tabpanel" class="tab-pane" id="map">
					<br />
					<form method="post" action="<?php echo site_url('temples/update_map/');?>" >
						<?php if(getInformation(get_session_id())!=null){
							foreach (getInformation(get_session_id()) as $item):?>

							<input type="hidden" class="form-control" name="templeId" value="<?php echo $item['templeId'];?>">

						<?php endforeach;}?>
						<?php loadView('subitem/map');?>
						<br>
						<br>
						<button type="submit" class="btn btn-success btn-default" id="update" disabled="disabled">更新</button>
					</form>
				</div>
				<div role="tabpanel" class="tab-pane" id="password">
					<br />
					<?php loadView('subitem/change_password');?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php loadView('templates/footer');?>
