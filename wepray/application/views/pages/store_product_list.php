<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>

<style>
	.product_pagenation a{
		color: black;
	    padding: 8px 16px;
	}
	.product_pagenation a:hover{
		background-color: #bbb;
	}
	.product_pagenation strong{
		background-color: #337ab7;
		padding: 8px 16px;
    	color: white;
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
					商品清單
				</span>
			</h2>
			<hr>

			<div>
				<table class="table table-hover table-bordered table-striped product_list">
					<thead>
						<tr>
							<th>商品編號</th>
							<th>商品名稱</th>
							<th>商品副標題</th>
							<th>狀態</th>
							<th>官方狀態</th>
							<th>上架方</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody >
					<?php foreach ($list as $key => $value): ?>
						<tr>
							<td><?=$value['pid']?></td>
							<td><?=$value['product_name']?></td>
							<td><?=$value['product_sub_name']?></td>
							<td>
								<?php switch ($value['status']) {
									case '0':
										echo "未公開";
										break;
									case '1':
										echo "上架中";
										break;
									case '2':
										echo "缺貨";
										break;
									case '8':
										echo "放到倉庫";
										break;
									case '9':
										echo "銷毀";
										break;
								} ?>
							</td>
							<td>
								<?php switch ($value['official_status']) {
									case '0':
										echo "允許上架";
										break;
									case '1':
										echo "不允許上架";
										break;
								} ?>
							</td>
							<td>
								<?php switch ($value['is_official']) {
									case '0':
										echo "非官方上架";
										break;
									case '1':
										echo "官方上架";
										break;
								} ?>
							</td>
							<td>
								<a class="btn btn-info btn-edit" pid="<?=$value['pid']?>">編輯</a>
								<a class="btn btn-success btn-on-line" pid="<?=$value['pid']?>">上架</a>
								<a class="btn btn-warning btn-off-line" pid="<?=$value['pid']?>">下架</a>
								<a class="btn btn-warning btn-to-warehouse" pid="<?=$value['pid']?>">放到倉庫</a>
								<a class="btn btn-danger btn-destory" pid="<?=$value['pid']?>">銷毀</a>
								<!-- <a class="btn btn-default btn-preview" pid="<?=$value['pid']?>">預覽</a> -->
						</tr>
					<?php endforeach ?>

					</tbody>
				</table>

				<div class="product_pagenation">
					<?php if (isset($pagenation)) {
						echo $pagenation;
					}; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php loadView('templates/footer');?>


<script>
	$(function(){
		
		//返回福物管理
		$('body').on('click','.btn-back',function(){
			console.log('kk');
			location.href = "<?=site_url()?>pages/store";
		});

		//編輯
		$('body').on('click','.btn-edit',function(){
			var pid = $(this).attr('pid');
			location.href = "<?=site_url()?>pages/store_product_edit?pid="+pid;
		});

		//上架
		$('body').on('click','.btn-on-line',function(){
			var pid = $(this).attr('pid');
			if (confirm('確定要上架嗎?')) {
				$.post('<?=site_url()?>api_product/update_product_status',{
					"pid":pid,
					"type":'status',
					"status":1
				},function(data){
					alert(data.sys_msg);
					if (data.sys_code == "200") {
						location.reload();
					}
				},'json');	
			}
			
		});

		//下架
		$('body').on('click','.btn-off-line',function(){
			var pid = $(this).attr('pid');
			if (confirm('確定要下架嗎?')) {
				$.post('<?=site_url()?>api_product/update_product_status',{
					"pid":pid,
					"type":'status',
					"status":0
				},function(data){
					alert(data.sys_msg);
					if (data.sys_code == "200") {
						location.reload();
					}
				},'json');	
			}
		});

		//銷毀
		$('body').on('click','.btn-destory',function(){
			var pid = $(this).attr('pid');
			if (confirm('確定要銷毀嗎?')) {
				$.post('<?=site_url()?>api_product/update_product_status',{
					"pid":pid,
					"type":'status',
					"status":9
				},function(data){
					alert(data.sys_msg);
					if (data.sys_code == "200") {
						location.reload();
					}
				},'json');	
			}
		});

		//放到倉庫
		$('body').on('click','.btn-to-warehouse',function(){
			var pid = $(this).attr('pid');
			if (confirm('確定要放到倉庫嗎?')) {
				$.post('<?=site_url()?>api_product/update_product_status',{
					"pid":pid,
					"type":'status',
					"status":8
				},function(data){
					alert(data.sys_msg);
					if (data.sys_code == "200") {
						location.reload();
					}
				},'json');	
			}
		});

		$('body').on('click','.btn-preview',function(){
			var pid = $(this).attr('pid');
			location.href = "<?=site_url()?>pages/product_preview?pid="+pid;
		});


	})
</script>