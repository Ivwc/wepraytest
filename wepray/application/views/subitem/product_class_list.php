<style>
	.edit_dom{
		display: none;
	}
</style>
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-title">
			<a class="btn-back">商品分類</a>
			<span>
				<span class="glyphicon glyphicon-menu-right"></span>
					<?=$sort['sort_class_name']?>
			</span>
		</h2>
		
	</div>
	<div class="col-xs-12">
		<input type="text" placeholder="請輸入小分類" id="class_name">
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
					<tr sn='<?=$value['class_sn']?>'>
						<td>
							<span class="show_dom class_name"><?=$value['class_name']?></span>
							<input type="text" class="edit_dom class_name_input" value="<?=$value['class_name']?>">	
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
			var class_name = $('#class_name').val();
			
			$.post('<?=site_url()?>api_product/insert_class',{
				"class_name":class_name,
				"sort_sn":"<?=$_GET['sort_sn']?>"
			},function(data){
				console.log(data);
				var html = '<tr sn="'+data.sn+'">'+
								'<td>'+
									'<span class="show_dom class_name">'+class_name+'</span>'+
									'<input type="text" class="edit_dom class_name_input" value="'+class_name+'">'+
								'</td>'+
								'<td>'+
									'<a class="btn btn-success btn-rename show_dom" >編輯</a>'+
									'<a class="btn btn-danger btn-remove show_dom">刪除</a>'+
									'<a class="btn btn-info btn-submit edit_dom">送出</a>'+
									'<a class="btn btn-info btn-close edit_dom">關閉</a>'+
								'</td>'+
							'</tr>';
				$('.product_sort_list').append(html);
				$('#class_name').val('');
			},'json');
		});

		$('body').on('click','.btn-remove',function(){
			var sn = $(this).closest('tr').attr('sn');
			var _this = $(this);
			console.log(sn);
			if (confirm('確定要刪除嗎?')) {
				$.post('<?=site_url()?>api_product/remove_product_class',{
					"sn":sn,
					"sort_sn":"<?=$_GET['sort_sn']?>"
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
			var class_name = $(this).closest('tr').find('.class_name_input').val();
			var _this = $(this);
			// console.log(class_name);
			$.post('<?=site_url()?>api_product/rename_product_class',{
				"sn":sn,
				"class_name":class_name
			},function(data){
				alert(data.sys_msg);
				if (data.sys_code == "200") {
					_this.closest('tr').find('.class_name_input').val(class_name);
					_this.closest('tr').find('.class_name').html(class_name);
					_this.closest('tr').find('.edit_dom').hide();
					_this.closest('tr').find('.show_dom').show();
				}
			},'json');

		});

		$('body').on('click','.btn-close',function(){
			$(this).closest('tr').find('.edit_dom').hide();
			$(this).closest('tr').find('.show_dom').show();
		});

		$('body').on('click','.btn-back',function(){
			location.href = "<?=site_url()?>pages/product_class";
		});

	})
</script>