<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>
<script src="<?php echo base_url(); ?>asset/ckeditor/ckeditor.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>asset/ckfinder/ckfinder.js?<?php echo time(); ?>"></script>
<?php setImportAsset('dropzone.js')?>
<?php setImportAsset('dropzone.css')?>
<?php setImportAsset('datepicker.css');?>
<?php setImportAsset('bootstrap-datepicker.min.js');?>
<style>
	.error_span{
		color:red;
	}
</style>
<style>
	.previewer{
		width:80%;
	}
	.crumbs_item{
		margin: 0px 10px;
	}
	.form-group .glyphicon{
		right:15px;
	}
	.has-feedback span{
		display: none
	}
	.img_area{
		min-height: 100px;
		border:1px solid #ddd;
		padding:5px;
		margin-bottom: 15px;
	}
	.img_area img{
		width: 100%;
	}

	.img_div{
		/*border:1px solid #111;
		border-radius: 5px;*/
	}
	
	
	.img_border{
		border:1px solid #111;
		border-radius: 5px;	
		margin:5px;
		overflow: hidden;
		height: 220px;
		position: relative;
	}

	@media(max-width:1024px) {
		
		.img_border{
			height: 180px;
		}
	}

	@media(max-width:768px) {
		
		.img_border{
			height: 160px;
		}
	}

	.specification_item{
		margin-bottom: 5px;    	
    }
	
	#previewer{
		width:70%;
	}
	
	.img_border .remove_img_btn{
		position: absolute;
		right: 6px;
		top:6px;
		font-weight: 900;
		font-size: 20px;
		color:black;
	}
	
</style>
<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<!-- <?php print_r($list) ?> -->
			
			<form action="">

				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品主圖</label>
					<div class="col-sm-10">
						<input type="file" id="product_main_photo" />
						<img alt="" id="previewer" src="<?=getProductImageFile($list['product_main_photo'])?>">
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品名稱</label>
					<div class="col-sm-10">
						<input type="text" class="form-control product_step_1_input" id="product_name" value="<?=$list['product_name']?>">
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback  col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品副標題</label>
					<div class="col-sm-10">
						<input type="text" class="form-control product_step_1_input" id="product_sub_name" value="<?=$list['product_sub_name']?>">
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback  col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品分類</label>
					<div class="col-sm-10">
						<a class="btn btn-xs btn-info btn-set-class" data-toggle="modal" data-target="#ClassModal">設定</a>
						<div class="show_class_area">
													    		
						</div>
						<input type="hidden" name="product_class" class="product_step_1_input" id="product_class">
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">材質</label>
					<div class="col-sm-10">
						<select name="product_specification" id="product_specification" class="form-control">
							<?php foreach ($specification as $key => $value): ?>
							<option value="<?=$value['sn']?>" <?php if($list['specification'] == $value['sn']){echo 'selected=""';} ?> ><?=$value['specification_name']?></option>
							<?php endforeach ?>
						</select>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				
					
				
				<div class="form-group col-xs-12 nopaddingRL">
					<textarea name="content" id="content" rows="10" cols="80"><?=$list['product_intro']?></textarea>
					<script>
						CKFinder.setupCKEditor();
						CKEDITOR.replace( 'content', {});
					</script>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品圖片1</label>
					<div class="col-sm-10">
						<input type="file" id="product_img1" class="img_input"/>
						<img alt="" id="img1_previewer" class="previewer" <?php if($list['product_img1'] != ""){echo 'src="'.getProductImageFile($list['product_img1']).'"';};?>>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品圖片2</label>
					<div class="col-sm-10">
						<input type="file" id="product_img2" class="img_input"/>
						<img alt="" id="img2_previewer" class="previewer" <?php if($list['product_img2'] != ""){echo 'src="'.getProductImageFile($list['product_img2']).'"';};?>>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品圖片3</label>
					<div class="col-sm-10">
						<input type="file" id="product_img3" class="img_input"/>
						<img alt="" id="img3_previewer" class="previewer" <?php if($list['product_img3'] != ""){echo 'src="'.getProductImageFile($list['product_img3']).'"';};?>>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品圖片4</label>
					<div class="col-sm-10">
						<input type="file" id="product_img4" class="img_input"/>
						<img alt="" id="img4_previewer" class="previewer" <?php if($list['product_img4'] != ""){echo 'src="'.getProductImageFile($list['product_img4']).'"';};?>>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError">商品圖片5</label>
					<div class="col-sm-10">
						<input type="file" id="product_img5" class="img_input"/>
						<img alt="" id="img5_previewer" class="previewer" <?php if($list['product_img5'] != ""){echo 'src="'.getProductImageFile($list['product_img5']).'"';};?>>
						<span class="glyphicon glyphicon-remove form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-xs-12 nopaddingRL">
					<label class="col-sm-2 control-label" for="inputError"></label>
					<div class="col-sm-10">
						<input type="checkbox" id="chk_indeed" class="chk_indeed" <?php if($list['chk_indeed'] == 1){echo 'checked=""';} ?>/>
						<label for="chk_indeed">保證商品資訊屬實</label>
					</div>
				</div>

				<div class="panel-content col-xs-12 nopaddingRL" style="padding:30px">
					<input type="hidden" name="pid" id="pid">
					<div class="color_area">
						<?php 
						$color_list = array();
						foreach ($list['sku'] as $key => $value) {
							$color_list[] = $value['color'];
						} ?>
						<?php foreach ($color as $key => $value): ?>
						<input type="checkbox" name="color" class="color" id="color<?=$value['color_sn']?>" color="<?=$value['color']?>" color_name="<?=$value['name']?>" <?php if(in_array($value['color'], $color_list)){echo 'checked=""';} ?>>
						<!-- <i class="show_color" style="border-right:14px solid <?=$value['color']?>"></i> -->
						<label for="color<?=$value['color_sn']?>"><span class="glyphicon glyphicon-stop show_color" aria-hidden="true" style="color:<?=$value['color']?>"></span><?=$value['name']?></label>&nbsp&nbsp		
						<?php endforeach ?>	
					</div>
					
					<div>
						<table class="table table-hover table-bordered table-striped sku_table">
							<thead>
								<tr>
									<th>顏色</th>
									<th>圖片</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list['sku'] as $key => $value): ?>
									<tr class="<?=$value['sn']?> sku_area">
										<td>
											<div>
												<span class="glyphicon glyphicon-stop show_color" aria-hidden="true" style="color:<?=$value['color']?>" color="<?=$value['color']?>"></span>
												<label for="color"><?=$value['name']?></label>
											</div>
										</td>
										<td>
											<div>
												<img src="<?=getProductImageFile($value['img'])?>" class="previewer">
												<input type="file" name="color_img" class="color_img img_input">
											</div>
										</td>
									</tr>
									<tr class="<?=$value['sn']?>">
										<td colspan="2">
											<div class="col-xs-4">
												<input type="text" name="color_price" class=" col-xs-12 color_price" placeholder="價格" value="<?=$value['price']?>">
											</div>
											<div class="col-xs-4">
												<input type="text" name="color_qty" class=" col-xs-12 color_qty" placeholder="數量" value="<?=$value['qty']?>">
											</div>
											<div class="col-xs-4">
												<input type="checkbox" class="sku_open" <?php if($value['status'] == 1){echo 'checked=""';} ?>>開啟
											</div>
										</td>
									</tr>		
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>


				<div class="col-xs-12 form-group">
					<div class="col-xs-12">
						<label>提貨方式</label>
					</div>
					<div class="col-xs-12">
						<input type="radio" name="how_take[]" id="self" value="0" <?php if($list['how_take'] == 0){echo 'checked=""';}?> >&nbsp<label for="self">自提</label>&nbsp&nbsp
						<input type="radio" name="how_take[]" id="mailing" value="1" <?php if($list['how_take'] == 1){echo 'checked=""';}?> >&nbsp<label for="mailing">郵寄</label>&nbsp&nbsp
						<span class="error_span" target="how_take"></span>
					</div>
				</div>
				<div class="col-xs-12 form-group">
					<div class="col-xs-12">
						<label>自提規則(郵寄無須填寫)</label>
					</div>
					<div class="col-xs-12">
						<textarea name="take_rule" id="take_rule" rows="8" class="form-control"><?=$list['take_rule']?></textarea>
						<span class="error_span" target="take_rule"></span>
					</div>
				</div>
				<div class="col-xs-12 form-group">
					<div class="col-xs-12">
						<label>上架時間</label>
					</div>
					<div class="col-xs-12">
						<input type="text" id="on_time" value="<?=$list['on_time']?>">
						<span class="error_span" target="on_time"></span>
					</div>
				</div>
				<div class="col-xs-12 nopaddingRL">
					<a class="btn btn-success btn-submit">送出</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Product_Class Modal -->
<div class="modal fade" id="ClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">設定商品分類</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="modal-product-class-crumbs">
      		
      	</div>
      	<hr>
    	<div class="modal-product-class">
    		<div class="modal-product-class-choise-area">
    			<input type="checkbox" name="product_class_choise" class="product_class_choise">
    			<span class="modal_product_name"></span>
    		</div>
    	</div>
    	<div>
    		<input type="hidden" name="modal_product_class_choise_input" id="modal_product_class_choise_input">
    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
        <button type="button" class="btn btn-primary modal_product_class_ok">確定</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(function(){
		$.post('<?=site_url()?>api_product/set_session',{
			"index":"pid",
			"value":"<?=$list['pid']?>",
		},function(data){
			console.log(data);
		},'json');

		$('#on_time').datepicker({format:'yyyy-mm-dd'});

		product_class_initial(<?=$list['product_class']?>);

		preview_product_img();

		//設定商品分類
		$('body').on('click','.btn-set-class,.crumbs_item_home',function(){
			$.post('<?=site_url()?>api_product/get_product_class',{
			},function(data){
				console.log('data.data');
				var html = "";

				$(data.data).each(function(k,v){
					html += '<div class="modal-product-class-choise-area" sn="'+v.class_sn+'">'+
				    			'<input type="radio" name="product_class_choise" class="product_class_choise" id="'+v.class_sn+'">'+
				    			'&nbsp<label for="'+v.class_sn+'" class="modal_product_name">'+v.class_name+'</label><span class="glyphicon glyphicon-menu-right expand_class" aria-hidden="true"></span>'+
				    		'</div>';
				});
				$('.modal-product-class').html(html);

				//麵包削
				var crumbs = '<i class="crumbs_item_home">主分類</i>';
				$(data.path).each(function(k,v){
					crumbs += '';
				});
				$('.modal-product-class-crumbs').html(crumbs);


			},'json');
		});

		//把sn填入input
		$('body').on('click','.product_class_choise',function(){
			var sn = $(this).attr('id');
			$('#modal_product_class_choise_input').val(sn);
		});

		//進入下一層
		$('body').on('click','.expand_class,.crumbs_item',function(){

			if ($(this).hasClass('expand_class')) {
				var father = $(this).closest('div').attr('sn');	
				console.log('expand_class');
			}else{
				var father = $(this).attr('sn');
				console.log('crumbs');
			}
			console.log('father:'+father);
			
			$.post('<?=site_url()?>api_product/get_product_class',{
				father:father
			},function(data){
				console.log('data.data');
				var html = "";

				$(data.data).each(function(k,v){
					html += '<div class="modal-product-class-choise-area" sn="'+v.class_sn+'">'+
				    			'<input type="radio" name="product_class_choise" class="product_class_choise" id="'+v.class_sn+'">'+
				    			'&nbsp<label for="'+v.class_sn+'" class="modal_product_name">'+v.class_name+'</label><span class="glyphicon glyphicon-menu-right expand_class" aria-hidden="true"></span>'+
				    		'</div>';
				});
				$('.modal-product-class').html(html);

				//麵包削
				var crumbs = '<i class="crumbs_item_home">主分類</i>';
				$(data.path).each(function(k,v){
					crumbs += '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><i class="crumbs_item" sn="'+v.class_sn+'">'+v.class_name+'</i>';
				});
				$('.modal-product-class-crumbs').html(crumbs);

			},'json');
		});
		

		//選擇好商品分類
		$('body').on('click','.modal_product_class_ok',function(){
			var class_sn = $(this).closest('#ClassModal').find('#modal_product_class_choise_input').val();
			$.post('<?=site_url()?>api_product/get_product_class',{
				father:class_sn
			},function(data){
				console.log(data);
				var crumbs = '<i class="crumbs_item_home">分類</i>';
				$(data.path).each(function(k,v){
					crumbs += '<i style="right:0px" class="glyphicon glyphicon-menu-right expand_class" aria-hidden="true"></i><i sn="'+v.class_sn+'">'+v.class_name+'</i>';
				});
				
				$('.show_class_area').html(crumbs);
				$('#product_class').val(class_sn);
				$('#ClassModal').modal('hide');

			},'json');

		});

		//資料更新
		$('body').on('click','.btn-submit',function(){
			input_empty = false;
	    	// console.log($('#product_main_photo')[0].files[0]);
	    	$('.product_step_1_input').each(function(){
	    		if ($(this).val() == "") {
	    			$(this).closest('.has-feedback').addClass('has-error');
	    			$(this).closest('.has-feedback').find('span').show();
	    			input_empty = true;
	    		}
	    	});
	    	
	    	if ($('#previewer').attr('src') == "" || $('#previewer').attr('src') == undefined) {
	    		input_empty = true;
	    	}

	    	// var buy_way = "";
	    	// $('.buy_way').each(function(k,v){
	    	// 	if ($(this).prop('checked')) {
	    	// 		buy_way += $(this).val()+",";
	    	// 	}
	    	// });
	    	// buy_way = buy_way.slice(0,-1);
	    	// // console.log(buy_way);
	    	// if (buy_way == "") {
	    	// 	input_empty = true;
	    	// }

	    	// var specification = "";
	    	// $('.specification').each(function(){
	    	// 	if ($(this).val() != "") {
	    	// 		specification += $(this).val()+',';
	    	// 	}
	    	// });
	    	// specification = specification.slice(0,-1);
	    	// console.log(specification);
	    	// if (specification == "") {
	    	// 	input_empty = true;
	    	// }


	    	if (!input_empty) {
	    		if ($('#chk_indeed').prop('checked')) {

		    		var api = "<?=site_url()?>api_product/edit_product";
		    		var product_name = $('#product_name').val();
		    		var product_sub_name = $('#product_sub_name').val();
		    		var product_class = $('#product_class').val();
		    		var product_specification = $('#product_specification').val();
		    		var product_main_photo = $('#previewer').attr('src');
		    		var product_img1 = $('#img1_previewer').attr('src');
		    		var product_img2 = $('#img2_previewer').attr('src');
		    		var product_img3 = $('#img3_previewer').attr('src');
		    		var product_img4 = $('#img4_previewer').attr('src');
		    		var product_img5 = $('#img5_previewer').attr('src');
		    		var data = CKEDITOR.instances.content.getData();
		    		console.log(data);
		    		$.post(api,{
		    			'pid':"<?=$_GET['pid']?>",
		    			'product_main_photo':product_main_photo,
		    			'product_name':product_name,
		    			'product_sub_name':product_sub_name,
		    			'product_class':product_class,
		    			'specification':product_specification,
		    			'chk_indeed':1,
		    			"intro":data,
		    			'product_img1':product_img1,
		    			'product_img2':product_img2,
		    			'product_img3':product_img3,
		    			'product_img4':product_img4,
		    			'product_img5':product_img5,
		    			'templeId':"<?=$_SESSION['temples_inf']['templeId']?>"
		    		},function(data){
		    			console.log(data);
		    			if (data.sys_code == "200") {

		    				//更新SKU
		    				var sku = [];
							var empty = false;
					    	$('.sku_area').each(function(k,v){
					    		sku[k] = {};
					    		var pid = "<?=$_GET['pid']?>";
					    		var color = $(this).find('.show_color').attr('color');
					    		var name = $(this).find('.show_color').attr('name');
					    		var img = $(this).find('.previewer').attr('src');
					    		var price = $(this).next('tr').find('.color_price').val();
					    		var qty = $(this).next('tr').find('.color_qty').val();
					    		if (pid != "" || color != "" || img != "" || price != "" || qty != "") {
					    			sku[k]['pid'] = pid
						    		sku[k]['color'] = color;
						    		sku[k]['name'] = name;
						    		sku[k]['img'] = img;
						    		sku[k]['price'] = price;
						    		sku[k]['qty'] = qty;	
					    		}else{
					    			empty = true;
					    		}
					    		

					    		if ($(this).next('tr').find('.sku_open').prop('checked')) {
					    			sku[k]['status'] = '1';
					    		}else{
					    			sku[k]['status'] = '0';
					    		}
					    		// console.log(show_color);
					    	});
					    	// console.log(sku);

					    	if(!empty){
					    		$.post('<?=site_url()?>api_product/insert_product_sku',{
						    		"sku":sku,
						    		"pid":"<?=$_GET['pid']?>",
						    	},function(data){
						    		if (data.sys_code == "200") {
						    			//更新商品設定
						    			var how_take = '';
								    	$('input[name="how_take[]"]').each(function(){
								    		if ($(this).prop('checked')) {
								    			how_take = $(this).val();
								    		}
								    	});
								    	console.log(how_take);

								    	var take_rule = $('#take_rule').val();
								    	var date = $('#on_time').val();

								    	if (how_take == "") {
								    		$('.error_span').each(function(){
								    			if ($(this).attr('target') == "how_take") {
								    				$(this).html('請選擇');
								    			}
								    		});
								    	}

								    	if (how_take == 0 && take_rule == "") {
								    		$('.error_span').each(function(){
								    			if ($(this).attr('target') == "take_rule") {
								    				$(this).html('請填寫');
								    			}
								    		});
								    	}
								    	
								    	$.post('<?=site_url()?>api_product/update_product_config',{
								    		'pid':"<?=$_GET['pid']?>",
								    		'how_take':how_take,
								    		'take_rule':take_rule,
								    		'on_time':date,
								    	},function(data){
								    		if (data.sys_code == "200") {
								    			alert('更新成功');
								    			location.href="<?php echo $_SERVER['HTTP_REFERER'] ?>";
								    		}else{
								    			alert('發生不明錯誤，請告知管理員。');
								    		}
								    	},'json');

						    		}else{
						    			alert(data.sys_msg);
						    		}
						    		
						    	},'json');
					    	}
		    			}
		    		},'json');
		    	}else{
	    			alert('請勾選"確認商品資料屬實"。');
	    		}

	    		
	    	}else{
	    		alert('請填寫完所有資料!');
	    	}
		});

		//如果欄位裡面有值就把錯誤訊息拿掉
		$('.product_step_1_input').focusout(function(){
	    	if ($(this).val() != "") {
	    		console.log('!=""');
	    		$(this).closest('.has-feedback').removeClass('has-error');
	    		$(this).closest('.has-feedback').find('span').hide();
	    	}
	    });

	    $('body').on('click','.color',function(){
	    	if ($(this).prop('checked')) {
	    		//勾選，增加table
	    		var html = '';
	    		var color_id = $(this).attr('id');
	    		var color = $(this).attr('color');
	    		// console.log(color);
	    		var color_name = $(this).attr('color_name');

	    		html = '<tr class="'+color_id+' sku_area">'+
							'<td>'+
								'<div>'+
									'<span class="glyphicon glyphicon-stop show_color" aria-hidden="true" style="color:'+color+'" color="'+color+'" name="'+color+name+'"></span>'+
									'<label for="color">'+color_name+'</label>'+
								'</div>'+
							'</td>'+
							'<td>'+
								'<div>'+
									'<img src="" class="previewer">'+
									'<input type="file" name="color_img" class="color_img img_input">'+	
								'</div>'+
							'</td>'+
						'</tr>'+
						'<tr class="'+color_id+'">'+
							'<td colspan="2">'+
								'<div class="col-xs-4">'+
									'<input type="text" name="color_price" class=" col-xs-12 color_price" placeholder="價格">'+
								'</div>'+
								'<div class="col-xs-4">'+
									'<input type="text" name="color_qty" class=" col-xs-12 color_qty" placeholder="數量">'+
								'</div>'+
								'<div class="col-xs-4">'+
									'<input type="checkbox" class="sku_open">開啟'+
								'</div>'+
							'</td>'+
						'</tr>';
				$('.sku_table').find('tbody').append(html);
	    	}else{
	    		//取消勾選，移除table
	    		var color_id = $(this).attr('id');
	    		$('.'+color_id).remove();
	    	}
	    });
	   

	    $('body').on('click','input[type=radio]',function(){
	    	$(this).closest('div').find('.error_span').html('');
	    });
	    $('body').on('focusout','textarea',function(){
	    	if ($(this).val() != "") {
	    		$(this).closest('div').find('.error_span').html('');	
	    	}
	    });

	})

	//重新載入圖片
	function reload_img(){
		var pid = "<?=$_GET['pid']?>";
		var file_path = "<?=getProductImageFile("")?>";
		$.post('<?=site_url()?>api_product/get_product_img',{
			'pid':pid
		},function(data){
			var html = "";
			$(data.list).each(function(k,v){
				html += '<div class="img col-xs-6 col-sm-4 nopaddingRL img_div">'+
							'<div class="img_border">'+
								'<a class="remove_img_btn" sn="'+v.sn+'">X</a>'+
								'<img src="'+file_path+v.img_url+'" alt="">'+
							'</div>'+
						'</div>';
			});

			$('.img_area').html(html);
		},'json');
	}

	

	//預覽圖片
	function preview_product_img(){
		
		$('body').on('change','.img_input',function(){
			console.log('sd');
			var _this = $(this);
		    var file = $(this)[0].files[0];
		    var previewer = $(this).closest('div').find('.previewer');
		    console.log(previewer);
		    // 接受 jpeg, jpg, png 类型的图片
		    if (!/\/(?:jpeg|jpg|png)/i.test(file.type)) return;

		    var reader = new FileReader();

		    reader.onload = function() {
		        var result = this.result;
		        // console.log(result);
		        previewer.attr('src',result);

		        // 清空图片上传框的值
		        // filechooser.value = '';
		    };

		    reader.readAsDataURL(file);

		});
		
	}

	function product_class_initial(father){
		console.log(father);
		// var class_sn = $(this).closest('#ClassModal').find('#modal_product_class_choise_input').val();
			$.post('<?=site_url()?>api_product/get_product_class',{
				father:father
			},function(data){
				console.log(data);
				var crumbs = '<i class="crumbs_item_home">分類</i>';
				$(data.path).each(function(k,v){
					crumbs += '<i style="right:0px" class="glyphicon glyphicon-menu-right expand_class" aria-hidden="true"></i><i sn="'+v.class_sn+'">'+v.class_name+'</i>';
				});
				$('.show_class_area').html(crumbs);
				$('#product_class').val(father);
				$('#ClassModal').modal('hide');

			},'json');
	}
</script>
<?php loadView('templates/footer');?>
