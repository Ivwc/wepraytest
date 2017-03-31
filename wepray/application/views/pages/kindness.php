<?php loadView('templates/waterfall_header');?>
<?php loadView('mainframe/navbar');?>
<style type="text/css">
	.container {
		width: 700px;
		position: relative;
	}

	.item {
		position: absolute;
	}

	.item img {
		display: block;
		width: 100%;
	}
</style>
<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container">
			<div class="container_inner">
				<?php for($i=0;$i<=51;$i+=2){?>
				<div class="item">
					<img src="<?php echo getAssetImagePath();?>t_1_pic_<?php echo $i;?>_v.png?<?php echo time();?>" alt="">
				</div>
				<?php }?>
				<?php for($i=1;$i<=51;$i+=2){?>
				<div class="item">
					<img src="<?php echo getAssetImagePath();?>t_1_pic_<?php echo $i;?>_v.png?<?php echo time();?>" alt="">
				</div>
				<?php }?>
			</div>
			<p class="load">Fetching images</p>
		</div>     
	</div>
</div>
</div>
<?php loadView('templates/footer');?>

<script> 
	var fluid;
	imagesLoaded( $('.container'), function() {
		fluid = new $('.container').fluid({col: 3, spacingX: 20, spacingY: 20});
	});
</script> 

