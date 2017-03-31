<?php loadView('templates/header');?>
<?php loadView('mainframe/navbar');?>

<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<h2 class="page-title">
				<a class="btn-back">福務管理</a>
				<span>
					<span class="glyphicon glyphicon-menu-right"></span>
					商品搜尋
				</span>
			</h2>
			<hr>
			<form action="<?=site_url()?>pages/store_product_list" class="form">
				<input class="form-control" id="type" name="type" type="hidden" value="search">
				<div class="form-group col-xs-12">
				    <label class="col-sm-2 control-label">商品名稱</label>
				    <div class="col-sm-10">
				    	<input class="form-control search_input" id="product_name" name="product_name" type="text" value="">
					</div>
				</div>
				<div class="form-group col-xs-12">
				    <label class="col-sm-2 control-label">商品副標題</label>
				    <div class="col-sm-10">
				    	<input class="form-control search_input" id="product_sub_name" name="product_sub_name" type="text" value="">
					</div>
				</div>
				<div class="form-group col-xs-12">
				    <label class="col-sm-2 control-label">商品大分類</label>
				    <div class="col-sm-10">
				    	<input class="form-control search_input" id="product_sort_class" name="product_sort_class" type="text" value="">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-sm-2 control-label">商品分類</label>
					<div class="col-sm-10">
						<a class="btn btn-xs btn-info btn-set-class" data-toggle="modal" data-target="#ClassModal">設定</a>
						<div class="show_class_area">
													    		
						</div>
						<input type="hidden" name="product_class" class="product_step_1_input" id="product_class">
					</div>
				</div>
				<div class="form-group col-xs-12">
				    <label class="col-sm-2 control-label"></label>
				    <div class="col-sm-10">
				    	<a class="btn btn-black btn-search">開始搜尋</a>
					</div>
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
<?php loadView('templates/footer');?>
<script>
	$(function(){
		$('body').on('click','.btn-back',function(){
			// console.log('kk');
			location.href = "<?=site_url()?>pages/store";
		});

		$('body').on('click','.btn-search',function(){
			var search = false;
			$('.search_input').each(function(){
				console.log($(this).val());
				if ($(this).val() != "") {
					search = true;
				}
			});

			if (!search) {
				alert('請至少輸入一個欄位');
			}else{
				$('.form').submit();
			}
		});

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
	})
</script>