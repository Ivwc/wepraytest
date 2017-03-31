<!DOCTYPE html>
<html>
<head>
	<title>商品測試業面</title>
    <link rel="stylesheet" href="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
	<?=setImportAsset('main.css')?>
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
	
</head>
<style type="text/css">
	body{
		padding-top: 0px;
	}
	.single-item img{
		width: 100%
	}
	.single-item .img-item{
		background-color: black;
		text-align: center;
		height: 400px;
		overflow: hidden;
	}
	.detal_area{
		margin-top: 20px;
		background-color:#eee; 
		border-bottom:1px solid #bbb;
		padding: 10px;
	}
	.share-icon,.product_price{
		float:right;
	}
	li{
		list-style-type: none;
		display: inline;
		word-break: keep-all;
	}
	.switch_area .switch_item{
		border:2px solid orange;
		padding:7px;
		border-radius: 17px;
	}
	.switch_area .active{
		border:2px solid orange;
		background-color: orange;
		color: white;
		padding:7px;
		border-radius: 17px;
	}
</style>
<body>
	<div class="page-container">
		<div class="slider single-item">
			<?php foreach ($list['img'] as $key => $value): ?>
			<div class="img-item"><img src="<?=getProductImageFile($value['img_url'])?>"></div>
			<?php endforeach ?>
		</div>
		<script>
			$(function(){
				$('.single-item').slick({
					accessibility:false,
					// autoplay:true,
					// dots:true,
					arrows:false
				});
			})
		</script>
		<!-- 倫波圖結束 -->

		<!-- 商品基本資訊 -->
		<div class="col-xs-12 detal_area nopaddingRL">
			<h1>
				<span><?=$list['product_name']?></span>
				<span class="share-icon">
					<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
				</span>
			</span>
			</h1>
			<h3>
				<span><?=$list['product_sub_name']?></span>
				<span class='product_price'>$<?=$list['product_price']?></span>
			</h3>
		</div>
		<!-- 商品基本資訊 end -->
		<!-- 商品購買資訊 -->
		<div class="col-xs-12 detal_area nopaddingRL">
			<?php $specification = explode(',', $list['specification']) ?>
			<?php $buy_way = explode(',', $list['buy_way']) ?>
			<h3>分類</h3>
			<div class="p_class_area ">
				<p>大分類 : <span><?php foreach ($class_list as $key => $value): ?>
					<?php if ($value['sort_sn'] == $list['product_sort_class']): ?>
					<?php echo $value['sort_class_name']; ?>
					<?php endif ?>
				<?php endforeach ?></span></p>
				<p>小分類 : <span><?php foreach ($class_list as $key => $value): ?>
					<?php if ($value['sort_sn'] == $list['product_sort_class']): ?>
					<?php foreach ($value['class_list'] as $c_k => $c_v): ?>
						<?php if ($c_v['class_sn'] == $list['product_class']): ?>
						<?php echo $c_v['class_name']; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php endif ?>
				<?php endforeach ?></span></p>
			</div>
			<h3>規格</h3>
			<div class="specification_area switch_area">
				<ul>
					<?php foreach ($specification as $key => $value): ?>
					<li class="specification_item switch_item"><?=$value?></li>
					<?php endforeach ?>
				</ul>				
			</div>
			<h3>購買方式</h3>
			<div class="buy_way_area switch_area">
				<ul>
					<?php foreach ($buy_way as $key => $value): ?>
					<li class="buy_way_item switch_item">
						<?php foreach ($buy_way_list as $buy_k => $buy_v): ?>
						<?php if ($buy_v['sn'] == $value): ?>
						<?php echo $buy_v['buy_way_name'] ?>
						<?php endif ?>
						<?php endforeach ?>
					</li>
					<?php endforeach ?>
				</ul>				
			</div>
		</div>
		<!-- 商品購買資訊 end -->

		<!-- 商品介紹 -->
		<div class="col-xs-12 detal_area nopaddingRL">
			<?=$list['product_intro']?>
		</div>
		<!-- 商品介紹 end -->


	</div>
</body>
<script>
	$(function(){
		$('body').on('click','.specification_item',function(){
			$('.specification_item').removeClass('active');
			$(this).addClass('active');
		});
		$('body').on('click','.buy_way_item',function(){
			$('.buy_way_item').removeClass('active');
			$(this).addClass('active');
		});
	})
</script>
</html>