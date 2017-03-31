<style>
	.color_area{
		margin:5px 0px;
	}
	.show_color{
		height: 16px;
		width:16px;
		margin:0px 3px;
	}
</style>
<div class="tab-pane" role="tabpanel" id="step2">
	<h3>Step 2</h3>
	<p>商品</p>

	<div class="panel-content col-xs-12 nopaddingRL" style="padding:30px">
		<input type="hidden" name="pid" id="pid">
		<div class="color_area">
			<?php foreach ($color as $key => $value): ?>
			<input type="checkbox" name="color" class="color" id="color<?=$value['color_sn']?>" color="<?=$value['color']?>" color_name="<?=$value['name']?>">
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
					<!-- <tr>
						<td>
							<div>
								<span class="glyphicon glyphicon-stop show_color" aria-hidden="true" style="color:#ddd"></span>
								<label for="color">灰色</label>	
							</div>
							
						</td>
						<td>
							<div>
								<img src="" class="previewer">
								<input type="file" name="color_img" class="color_img img_input">	
							</div>
							
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="col-xs-4">
								<input type="text" name="color_price" class=" col-xs-12 color_price" placeholder="價格">
							</div>
							<div class="col-xs-4">
								<input type="text" name="color_qty" class=" col-xs-12 color_qty" placeholder="數量">
							</div>
							<div class="col-xs-4">
								<input type="checkbox">開啟
							</div>
						</td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
	<ul class="list-inline pull-right">
		<li><button type="button" class="btn btn-primary step_2_submit">送出進行下一步</button></li>
	</ul>
</div>

<script>
	$(function(){
		
		$('body').on('change','.img_input',function(){
			console.log('asd');
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
		$('body').on('click','.step_2_submit',function(){
			var sku = [];
			var empty = false;
	    	$('.sku_area').each(function(k,v){
	    		sku[k] = {};
	    		var pid = $('#pid').val();
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
	    	console.log(sku);

	    	if(!empty){
	    		$.post('<?=site_url()?>api_product/insert_product_sku',{
		    		"sku":sku,
		    		"pid":$('#pid').val(),
		    	},function(data){
		    		if (data.sys_code == "200") {
		    			var $active = $('.wizard .nav-tabs li.active');
						$active.addClass('disabled');
						$active.next().removeClass('disabled');
						nextTab($active);	
		    		}else{
		    			alert(data.sys_msg);
		    		}
		    		
		    	},'json');
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
									'<span class="glyphicon glyphicon-stop show_color" aria-hidden="true" style="color:'+color+'" color="'+color+'" name="'+color_name+'"></span>'+
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
	})

	
</script>