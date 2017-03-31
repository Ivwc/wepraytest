<?php setImportAsset('datepicker.css');?>
<?php setImportAsset('bootstrap-datepicker.min.js');?>
<style>
	.error_span{
		color:red;
	}
</style>
<div class="tab-pane" role="tabpanel" id="step3">
	<h3>Step 3</h3>
	<p>商品設定</p>
	<div class="col-xs-12 nopaddingRL panel-content">
		<div class="col-xs-12 form-group">
			<div class="col-xs-12">
				<label>提貨方式</label>
			</div>
			<div class="col-xs-12">
				<input type="radio" name="how_take[]" id="self" value="0">&nbsp<label for="self">自提</label>&nbsp&nbsp
				<input type="radio" name="how_take[]" id="mailing" value="1">&nbsp<label for="mailing">郵寄</label>&nbsp&nbsp
				<span class="error_span" target="how_take"></span>
			</div>
		</div>
		<div class="col-xs-12 form-group">
			<div class="col-xs-12">
				<label>自提規則(郵寄無須填寫)</label>
			</div>
			<div class="col-xs-12">
				<textarea name="take_rule" id="take_rule" rows="8" class="form-control"></textarea>
				<span class="error_span" target="take_rule"></span>
			</div>
		</div>
		<div class="col-xs-12 form-group">
			<div class="col-xs-12">
				<label>上架時間</label>
			</div>
			<div class="col-xs-12">
				<input type="radio" name="on_time[]" value="1">&nbsp<label for="self">立刻</label>&nbsp&nbsp
				<input type="radio" name="on_time[]" value="8">&nbsp<label for="mailing">放入倉庫</label>&nbsp&nbsp
				<input type="radio" name="on_time[]" value="0">&nbsp<label for="mailing">設定</label>&nbsp&nbsp
				<input type="text" id="on_time">
				<span class="error_span" target="on_time"></span>
			</div>
		</div>
	</div>
	<ul class="list-inline pull-right">    
		<li><button type="button" class="btn btn-primary btn-info-full step_3_submit">完成商品新增</button></li>
	</ul>
</div>
<script>
	$(function(){
		
	    $('body').on('click','.step_3_submit',function(){
	    	var how_take = '';
	    	$('input[name="how_take[]"]').each(function(){
	    		if ($(this).prop('checked')) {
	    			how_take = $(this).val();
	    		}
	    	});
	    	console.log(how_take);

	    	var on_time = '';
	    	$('input[name="on_time[]"]').each(function(){
	    		if ($(this).prop('checked')) {
	    			on_time = $(this).val();
	    		}
	    	});
	    	console.log(on_time);

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
	    	if (on_time == "") {
	    		$('.error_span').each(function(){
	    			if ($(this).attr('target') == "on_time") {
	    				$(this).html('請選擇');
	    			}
	    		});
	    	}

	    	$.post('<?=site_url()?>api_product/update_product_config',{
	    		'pid':$('#pid').val(),
	    		'how_take':how_take,
	    		'take_rule':take_rule,
	    		'on_time':date,
	    		'status':on_time,
	    	},function(data){
	    		if (data.sys_code == "200") {
	    			var $active = $('.wizard .nav-tabs li.active');
					$active.addClass('disabled');
					$active.next().removeClass('disabled');
					nextTab($active);

					setTimeout(function(){
						location.href = "<?=site_url()?>pages/store";
					},'2000');
	    		}else{
	    			alert('發生不明錯誤，請告知管理員。');
	    		}
	    	},'json');


	    });

	    $('body').on('click','input[type=radio]',function(){
	    	$(this).closest('div').find('.error_span').html('');
	    });
	    $('body').on('focusout','textarea',function(){
	    	if ($(this).val() != "") {
	    		$(this).closest('div').find('.error_span').html('');	
	    	}
	    });

	    $('#on_time').datepicker({format:'yyyy-mm-dd'});
	})
</script>