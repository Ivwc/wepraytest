<style>
	.edit_dom{
		display: none;
	}
</style>
<div class="row">
	<div class="col-xs-12">
		<input type="text" placeholder="請輸入大分類" id="sort_class_name">
		<button class="btn btn-black btn-add-sort-class">新增</button>
	</div>
	<hr>
	<div class="col-xs-12">
		<table class="table table-hover table-bordered table-striped product_sort_list">
			<thead>
				<tr>
					<th>名稱</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list as $key => $value): ?>
					<tr sn='<?=$value['sort_sn']?>'>
						<td>
							<a href="<?=site_url()?>pages/product_class?sort_sn=<?=$value['sort_sn']?>"><span class="show_dom sort_class_name"><?=$value['sort_class_name']?></span></a>
							<input type="text" class="edit_dom sort_class_name_input" value="<?=$value['sort_class_name']?>">	
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
		$('body').on('click','.btn-add-sort-class',function(){
			var sort_class_name = $('#sort_class_name').val();
			$.post('<?=site_url()?>api_product/insert_sort_class',{
				"sort_class_name":sort_class_name
			},function(data){
				console.log(data);
				var html = '<tr sn="'+data.sn+'">'+
								'<td>'+
									'<a href="<?=site_url()?>pages/product_class?sort_sn='+data.sn+'"><span class="show_dom sort_class_name">'+sort_class_name+'</span></a>'+
									'<input type="text" class="edit_dom sort_class_name_input" value="'+sort_class_name+'">'+
								'</td>'+
								'<td>'+
									'<a class="btn btn-success btn-rename show_dom" >編輯</a>'+
									'<a class="btn btn-danger btn-remove show_dom">刪除</a>'+
									'<a class="btn btn-info btn-submit edit_dom">送出</a>'+
									'<a class="btn btn-info btn-close edit_dom">關閉</a>'+
								'</td>'+
							'</tr>';
				$('.product_sort_list').append(html);
				$('#sort_class_name').val('');
			},'json');
		});

		$('body').on('click','.btn-remove',function(){
			var sn = $(this).closest('tr').attr('sn');
			var _this = $(this);
			console.log(sn);
			if (confirm('確定要刪除嗎?')) {
				$.post('<?=site_url()?>api_product/remove_product_sort',{
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
			var sort_class_name = $(this).closest('tr').find('.sort_class_name_input').val();
			var _this = $(this);
			// console.log(sort_class_name);
			$.post('<?=site_url()?>api_product/rename_product_sort',{
				"sn":sn,
				"sort_class_name":sort_class_name
			},function(data){
				alert(data.sys_msg);
				if (data.sys_code == "200") {
					_this.closest('tr').find('.sort_class_name_input').val(sort_class_name);
					_this.closest('tr').find('.sort_class_name').html(sort_class_name);
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