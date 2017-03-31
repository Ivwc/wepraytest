<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>

<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
		<?php loadView('subitem/friends_verify_item');?>
		</div>
	</div>
</div>
<?php loadView('templates/footer');?>


