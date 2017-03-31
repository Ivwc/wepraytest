<style>
	.previewer{
		width:80%;
	}
	.crumbs_item{
		margin: 0px 10px;
	}
</style>
<div class="tab-pane active" role="tabpanel" id="step1">
	<h3>Step 1</h3>
	<p>建立商品資訊</p>
	<div class="panel-content col-xs-12 nopadding">
		<form action="">
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品主圖</label>
				<div class="col-sm-10">
					<input type="file" id="product_main_photo" />
					<img alt="" id="previewer">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品名稱</label>
				<div class="col-sm-10">
					<input type="text" class="form-control product_step_1_input" id="product_name">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback  col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品副標題</label>
				<div class="col-sm-10">
					<input type="text" class="form-control product_step_1_input" id="product_sub_name">
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
						<option value="<?=$value['sn']?>"><?=$value['specification_name']?></option>
						<?php endforeach ?>
					</select>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			
				
			
			<div class="form-group col-xs-12 nopaddingRL">
				<textarea name="content" id="content" rows="10" cols="80"></textarea>
				<script>
					CKFinder.setupCKEditor();
					CKEDITOR.replace( 'content', {});
				</script>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品圖片1</label>
				<div class="col-sm-10">
					<input type="file" id="product_img1" class="img_input"/>
					<img alt="" id="img1_previewer" class="previewer">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品圖片2</label>
				<div class="col-sm-10">
					<input type="file" id="product_img2" class="img_input"/>
					<img alt="" id="img2_previewer" class="previewer">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品圖片3</label>
				<div class="col-sm-10">
					<input type="file" id="product_img3" class="img_input"/>
					<img alt="" id="img3_previewer" class="previewer">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品圖片4</label>
				<div class="col-sm-10">
					<input type="file" id="product_img4" class="img_input"/>
					<img alt="" id="img4_previewer" class="previewer">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError">商品圖片5</label>
				<div class="col-sm-10">
					<input type="file" id="product_img5" class="img_input"/>
					<img alt="" id="img5_previewer" class="previewer">
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group has-feedback col-xs-12 nopaddingRL">
				<label class="col-sm-2 control-label" for="inputError"></label>
				<div class="col-sm-10">
					<input type="checkbox" id="chk_indeed" class="chk_indeed"/>
					<label for="chk_indeed">保證商品資訊屬實</label>
				</div>
			</div>
		</form>
	</div>
	<ul class="list-inline pull-right">
		<li><button type="button" class="btn btn-primary step_1_submit">送出進行下一步</button></li>
	</ul>
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

		//建立商品資訊送出
	    $(".step_1_submit").click(function (e) {
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

		    		var api = "<?=site_url()?>api_product/add_product";
		    		var product_name = $('#product_name').val();
		    		var product_sub_name = $('#product_sub_name').val();
		    		var product_price = $('#product_price').val();
		    		var product_qty = $('#product_qty').val();
		    		var product_sort_class = $('#product_sort_class').val();
		    		var product_class = $('#product_class').val();
		    		var product_specification = $('#product_specification').val();
		    		var product_main_photo = $('#previewer').attr('src');
		    		var product_img1 = $('#img1_previewer').attr('src');
		    		var product_img2 = $('#img2_previewer').attr('src');
		    		var product_img3 = $('#img3_previewer').attr('src');
		    		var product_img4 = $('#img4_previewer').attr('src');
		    		var product_img5 = $('#img5_previewer').attr('src');
		    		var data = CKEDITOR.instances.content.getData();
		    		// console.log(product_main_photo);
		    		$.post(api,{
		    			'product_main_photo':product_main_photo,
		    			'product_name':product_name,
		    			'product_sub_name':product_sub_name,
		    			'product_price':product_price,
		    			'product_qty':product_qty,
		    			'product_sort_class':product_sort_class,
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
		    				$('#pid').val(data.pid);
		    				var $active = $('.wizard .nav-tabs li.active');
					        $active.addClass('disabled');
					        $active.next().removeClass('disabled');
					        nextTab($active);
		    			}
		    		},'json');
		    	}else{
	    			alert('請勾選"確認商品資料屬實"。');
	    		}

	    		
	    	}else{
	    		alert('請填寫完所有資料!');
	    	}

	        

	    });

	})

	function preview_product_img(){
		
		$('.img_input').on('change',function(){
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
</script>
