<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>
<style>
	
	.color-submit{
		width: 100%;
		margin-top:20px;
	}

</style>
<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<?php setImportAsset('bootstrap-colorpicker.min.js')?>
	<?php setImportAsset('bootstrap-colorpicker.min.css')?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<h2 class="page-title">
				<a class="btn-back">福務管理</a>
				<span>
					<span class="glyphicon glyphicon-menu-right"></span>
					商品颜色
				</span>
			</h2>
			<hr>
			<div>
				<?php foreach ($list as $key => $value): ?>
				<div id="cp<?=$key?>" class="color_area">
					<p>颜色<?=$key+1?></p>
					<div class="input-group colorpicker-component colorpicker" style="padding: 0px;z-index:1">
						
					    <input type="text" value="<?=$value['color']?>" class="form-control color" />
					    <span class="input-group-addon"><i></i></span>
					</div>
					<input type="text" value="<?=$value['name']?>" class="form-control name" placeholder="颜色名字"/>	
				</div>
				
				<?php endforeach ?>

				
				<?php for ($i=count($list); $i <10; $i++) {  ?>
				<div id="cp<?=$i?>" class="color_area">
					<p>顏色<?=$i+1?></p>
					<div  class="input-group colorpicker-component colorpicker" style="padding: 0px;z-index:1">
						
					    <input type="text" value="<?=$value['color']?>" class="form-control color" />
					    <span class="input-group-addon"><i></i></span>
					</div>
					<input type="text" value="<?=$value['name']?>" class="form-control name" placeholder="颜色名字"/>		
				</div>
				
				<?php } ?>
				<!-- <div id="cp2" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp3" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp4" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp5" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp6" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp7" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp8" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp9" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div>
				<div id="cp10" class="input-group colorpicker-component colorpicker">
				    <input type="text" value="<?=$list['color']?>" class="form-control" />
				    <span class="input-group-addon"><i></i></span>
				</div> -->
			</div>
			<a class="color-submit btn btn-info">送出</a>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('body').on('click','.btn-back',function(){
			location.href = "<?=site_url()?>pages/store";
		});

		
		$('.colorpicker').colorpicker();

		$('body').on('click','.color-submit',function(){
			var color = [];
			for(var i = 1 ;i <= 10; i++){
				color[i-1] = {};
				color[i-1]['color'] = $('#cp'+i).find('.color').val();
				color[i-1]['name'] = $('#cp'+i).find('.name').val();
			}
			console.log(color);
			$.post('<?=site_url()?>api_product/update_product_color',{
				'color':color,
			},function(data){
				console.log(data);
				alert(data.sys_msg);
				if (data.sys_code == "200") {

				}
			},'json');
		});
	})
</script>
<?php loadView('templates/footer');?>