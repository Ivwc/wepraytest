<style>
	.begin-buttom-div a,.begin-buttom-div i{
		font-size: 40px;
		margin-bottom: 30px;
		line-height: 80px;
	}

	@media(max-width: 768px) {
		
	}
	.begin-buttom-div .glyphicon{
		top:6px;
	}
	.begin-btn-area{
		margin-top: 40px;
	}
	.content_area .content{
		display: none;
	}
</style>
<div class="begin-btn-area">
	<div class="col-xs-12 col-md-6 begin-buttom-div dom-R">
		<a class="btn btn-black col-xs-12 col-md-offset-2 col-md-10 product_list"  target="product-list-content"><span class="glyphicon glyphicon-list"></span>&nbsp商品清單</a>	
	</div>
	<div class="col-xs-12 col-md-6 begin-buttom-div">
		<a class="btn btn-black col-xs-12 col-md-10 product_add" target="product-add-content"><span class="glyphicon glyphicon-plus"></span>&nbsp新增商品</a>	
	</div>	
</div>
<div class="begin-btn-area">
	<div class="col-xs-12 col-md-6 begin-buttom-div dom-R">
		<a class="btn btn-black col-xs-12 col-md-offset-2 col-md-10 product_search"  target="product-search-content"><span class="glyphicon glyphicon-search"></span>&nbsp商品搜尋</a>	
	</div>
	<div class="col-xs-12 col-md-6 begin-buttom-div">
		<a class="btn btn-black col-xs-12 col-md-10 product_class" target="product-class-content"><span class="glyphicon glyphicon-folder-open"></span>&nbsp編輯分類</a>	
	</div>	
</div>
<div class="begin-btn-area">
	<div class="col-xs-12 col-md-6 begin-buttom-div dom-R">
		<a class="btn btn-black col-xs-12 col-md-offset-2 col-md-10 product_color"  target="product-search-content"><span class="glyphicon glyphicon-tint"></span>&nbsp商品顏色</a>	
	</div>
	<!-- <div class="col-xs-12 col-md-6 begin-buttom-div">
		<a class="btn btn-black col-xs-12 col-md-10 product_class" target="product-class-content"><span class="glyphicon glyphicon-folder-open"></span>&nbsp編輯分類</a>	
	</div>	 -->
</div>
	







<script>
$(function(){
	$('body').on('click','.product_list',function(){
		location.href = "<?=site_url()?>pages/store_product_list";

	});

	$('body').on('click','.product_add',function(){
		location.href = "<?=site_url()?>pages/store_product_add";
	});

	$('body').on('click','.product_search',function(){
		location.href = "<?=site_url()?>pages/store_product_search";
	});

	$('body').on('click','.product_class',function(){
		location.href = "<?=site_url()?>pages/store_product_class";
	});

	$('body').on('click','.product_color',function(){
		location.href = "<?=site_url()?>pages/store_product_color";
	});
})
	
</script>