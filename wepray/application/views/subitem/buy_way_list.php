<style>
	.edit_dom{
		display: none;
	}
</style>
<div class="row">
	<div class="col-xs-12">
		<input type="text" placeholder="請輸入購買方式名稱" id="buy_way_name">
		<button class="btn btn-black btn-add-buy-way">新增</button>
	</div>
	<hr>
	<div class="col-xs-12">
		<table class="table table-hover table-bordered table-striped buy_way_list">
			<thead>
				<tr>
					<th>名稱</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list as $key => $value): ?>
					<tr sn='<?=$value['sn']?>'>
						<td>
							<span class="show_dom buy_way_name"><?=$value['buy_way_name']?></span>
							<input type="text" class="edit_dom buy_way_name_input" value="<?=$value['buy_way_name']?>">	
						</td>
						<td>
							<a class="btn btn-success btn-rename show_dom" >編輯</a>
							<a class="btn btn-danger btn-remove show_dom">刪除</a>
							<a class="btn btn-info btn-submit edit_dom">送出</a>
							<a class="btn btn-info btn-close edit_dom">關閉</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(function(){
		$('body').on('click','.btn-add-buy-way',function(){
			var buy_way_name = $('#buy_way_name').val();
			$.post('<?=site_url()?>api_product/insert_buy_way',{
				"buy_way_name":buy_way_name
			},function(data){
				console.log(data);
				var html = '<tr sn="'+data.sn+'">'+
								'<td>'+
									'<span class="show_dom buy_way_name">'+buy_way_name+'</span>'+
									'<input type="text" class="edit_dom buy_way_name_input" value="'+buy_way_name+'">'+
								'</td>'+
								'<td>'+
									'<a class="btn btn-success btn-rename show_dom" >編輯</a>'+
									'<a class="btn btn-danger btn-remove show_dom">刪除</a>'+
									'<a class="btn btn-info btn-submit edit_dom">送出</a>'+
									'<a class="btn btn-info btn-close edit_dom">關閉</a>'+
								'</td>'+
							'</tr>';
				$('.buy_way_list').append(html);
				$('#buy_way_name').val('');
			},'json');
		});

		$('body').on('click','.btn-remove',function(){
			var sn = $(this).closest('tr').attr('sn');
			var _this = $(this);
			console.log(sn);
			if (confirm('確定要刪除嗎?')) {
				$.post('<?=site_url()?>api_product/remove_buy_way',{
					"sn":sn
				},function(data){
					if (data.sys_code == "200") {
						_this.closest('tr').fadeOut();

					}else{
						alert(data.sys_msg);
					}
				},'json');
			}
		});

		$('body').on('click','.btn-rename',function(){
			$(this).closest('tr').find('.edit_dom').show();
			$(this).closest('tr').find('.show_dom').hide();
		});

		$('body').on('click','.btn-submit',function(){
			var sn = $(this).closest('tr').attr('sn');
			var buy_way_name = $(this).closest('tr').find('.buy_way_name_input').val();
			var _this = $(this);
			// console.log(buy_way_name);
			$.post('<?=site_url()?>api_product/rename_buy_way',{
				"sn":sn,
				"buy_way_name":buy_way_name
			},function(data){
				alert(data.sys_msg);
				if (data.sys_code == "200") {
					_this.closest('tr').find('.buy_way_name_input').val(buy_way_name);
					_this.closest('tr').find('.buy_way_name').html(buy_way_name);
					_this.closest('tr').find('.edit_dom').hide();
					_this.closest('tr').find('.show_dom').show();
				}
			},'json');

		});

		$('body').on('click','.btn-close',function(){
			$(this).closest('tr').find('.edit_dom').hide();
			$(this).closest('tr').find('.show_dom').show();
		});

	})
</script>