<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>
<style>
	.edit_dom{
		display: none;
	}
	.btn_area a{
		float:right;
		margin-right: 10px;
	}
</style>
<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<h2 class="page-title">
				<a class="btn-back">福務管理</a>
				<span>
					<span class="glyphicon glyphicon-menu-right"></span>
					<a href="<?=site_url()?>pages/store_product_class">商品分類</a>
					<?php foreach ($crumbs as $key => $value): ?>
						<span class="glyphicon glyphicon-menu-right"></span>
						<a href="<?=site_url()?>pages/store_product_class?father=<?=$value['class_sn']?>"><span sn="<?=$value['class_sn']?>"><?=$value['class_name']?></span></a>
					<?php endforeach ?>
				</span>
			</h2>
			<hr>
			<div class="col-xs-12">
				<input type="text" placeholder="請輸入分類" id="class_name">
				<button class="btn btn-black btn-add-class">新增</button>
			</div>
			<hr>
			<div class="col-xs-12">
				<table class="table table-hover table-bordered table-striped product_sort_list">
					<thead>
						<tr>
							<th>名稱</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($list as $key => $value): ?>
							<tr sn='<?=$value['class_sn']?>'>
								<td>
									<div class="name_area col-xs-8">
										<span class="show_dom class_name"><?=$value['class_name']?>&nbsp<span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span></span>
										<input type="text" class="edit_dom class_name_input" value="<?=$value['class_name']?>">		
									</div>
									<div class="btn_area col-xs-4">
										<a class="glyphicon glyphicon-menu-right btn-to-children"></a>
										<a class="glyphicon glyphicon-edit btn-rename show_dom" ></a>
										<a class="glyphicon glyphicon-trash btn-remove show_dom"></a>
										<a class="btn btn-xs btn-info btn-submit edit_dom">送出</a>
										<a class="btn btn-xs btn-info btn-close edit_dom">關閉</a>	

									</div>									
								</td>
								
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('body').on('click','.btn-add-class',function(){
			var class_name = $('#class_name').val();
			var father = "<?php if(isset($_GET['father'])){echo $_GET['father'];}?>";

			if (class_name != "") {
				$.post('<?=site_url()?>api_product/insert_class',{
					"class_name":class_name,
					"father":father,
				},function(data){
					console.log(data);
					var html = '<tr sn="'+data.sn+'">'+
									'<td>'+
										'<div class="name_area col-xs-8">'+
											'<span class="show_dom class_name">'+class_name+'&nbsp<span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span></span>'+
											'<input type="text" class="edit_dom class_name_input" value="'+class_name+'">'+
										'</div>'+
										'<div class="btn_area col-xs-4">'+
											'<a class="glyphicon glyphicon-menu-right btn-to-children"></a>'+
											'<a class="glyphicon glyphicon-edit btn-rename show_dom" ></a>'+
											'<a class="glyphicon glyphicon-trash btn-remove show_dom"></a>'+
											'<a class="btn btn-xs btn-info btn-submit edit_dom">送出</a>'+
											'<a class="btn btn-xs btn-info btn-close edit_dom">關閉</a>'+
										'</div>'+
									'</td>'+
								'</tr>';
					$('.product_sort_list').append(html);
					$('#class_name').val('');
				},'json');
			}else{
				alert('請輸入文字');
			}
			
		});

		$('body').on('click','.btn-remove',function(){
			var sn = $(this).closest('tr').attr('sn');
			var _this = $(this);
			console.log(sn);
			if (confirm('確定要刪除嗎?')) {
				$.post('<?=site_url()?>api_product/remove_product_class',{
					"sn":sn,
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
			location.href = "<?=site_url()?>pages/store";
		});

		$('body').on('click','.btn-to-children',function(){
			var sn = $(this).closest('tr').attr('sn');
			location.href="<?=site_url()?>pages/store_product_class?father="+sn;
		});

	})
</script>
<?php loadView('templates/footer');?>


