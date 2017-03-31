<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>

<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
		<img src="<?php echo getAssetImagePath().$templePicUrl;?>?<?php echo time();?>" class="img-rounded" width="auto">
		</div>
	</div>
</div>
<?php loadView('templates/footer');?>


