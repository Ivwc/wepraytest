<script src="<?php echo base_url(); ?>asset/ckeditor/ckeditor.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>asset/ckfinder/ckfinder.js?<?php echo time(); ?>"></script>
<?php setImportAsset('dropzone.js')?>
<?php setImportAsset('dropzone.css')?>

<style>
	.show_class_area a{
		text-decoration: none;
	}
	.modal-product-class-crumbs .crumbs_item_home{
		font-size: 18px;
	}

	.modal-product-class-choise-area .glyphicon {
		margin-left: 5px;
		font-size: 14px;
	}

	.modal-product-class-choise-area .modal_product_name{
		font-size: 16px;
	}

	.wizard {
	    margin: 20px auto;
	    background: #fff;
	}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

    .specification_item{
		margin-bottom: 5px;    	
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

.has-feedback span,#product_class_input{
	display: none
}

#previewer{
	width:80%;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
    top:22.5px;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

.panel-content{
	border:1px solid #ddd;
	border-radius: 10px;
	padding: 30px;
	margin-bottom: 15px;
}
.form-group .glyphicon{
	right:15px;
}



@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>

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
					新增商品
				</span>
			</h2>
			<hr>

			<div class="page-content">
				
				<!-- <div class="container">
					<div class="row"> -->
						<section>
				        <div class="wizard">
				            <div class="wizard-inner">
				                <div class="connecting-line"></div>
				                <ul class="nav nav-tabs" role="tablist">

				                    <li role="presentation" class="active">
				                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
				                            <span class="round-tab">
				                                <i class="glyphicon glyphicon-folder-open"></i>
				                            </span>
				                        </a>
				                    </li>

				                    <li role="presentation" class="disabled">
				                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
				                            <span class="round-tab">
				                                <i class="glyphicon glyphicon-pencil"></i>
				                            </span>
				                        </a>
				                    </li>
				                    <li role="presentation" class="disabled">
				                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
				                            <span class="round-tab">
				                                <i class="glyphicon glyphicon-picture"></i>
				                            </span>
				                        </a>
				                    </li>

				                    <li role="presentation" class="disabled">
				                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
				                            <span class="round-tab">
				                                <i class="glyphicon glyphicon-ok"></i>
				                            </span>
				                        </a>
				                    </li>
				                </ul>
				            </div>

				            <form role="form">
				                <div class="tab-content">
				                    <?php loadView('subitem/product_add_step1.php')?>
				                    <?php loadView('subitem/product_add_step2.php')?>
				                    <?php loadView('subitem/product_add_step3.php')?>
				                    
				                    <div class="tab-pane dom-C" role="tabpanel" id="complete">
				                        <h1>商品新增完成</h1>
				                        <p>兩秒後進行跳轉</p>
				                    </div>
				                    <div class="clearfix"></div>
				                </div>
				            </form>
				        </div>
				    </section>
				<!--    </div>
				</div> -->
				
			</div>
		</div>
	</div>
</div>


<?php loadView('templates/footer');?>






<script>
	$(document).ready(function () {
	    //Initialize tooltips
	    $('.nav-tabs > li a[title]').tooltip();
	    
	    //Wizard
	    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

	        var $target = $(e.target);
	    
	        if ($target.parent().hasClass('disabled')) {
	            return false;
	        }
	    });

	    $(".next-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs li.active');
	        $active.next().removeClass('disabled');
	        $active.addClass('disabled');
	        nextTab($active);

	    });

	    $('.product_step_1_input').focusout(function(){
	    	console.log('out');
	    	console.log($(this));
	    	if ($(this).val() != "") {
	    		console.log('!=""');
	    		$(this).closest('.has-feedback').removeClass('has-error');
	    		$(this).closest('.has-feedback').find('span').hide();
	    	}
	    });

	    

	    

	    
	    

	    
	    
	    //回上一頁
	    $('body').on('click','.btn-back',function(){
			// console.log('kk');
			location.href = "<?=site_url()?>pages/store";
		});

		

		

	   	//圖片預覽
	   	preview_img();
		
	});

	function nextTab(elem) {
	    $(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
	    $(elem).prev().find('a[data-toggle="tab"]').click();
	}

	function preview_img(){
		var filechooser = document.getElementById('product_main_photo');
		var previewer = document.getElementById('previewer');

		filechooser.onchange = function() {
		    var files = this.files;
		    var file = files[0];

		    // 接受 jpeg, jpg, png 类型的图片
		    if (!/\/(?:jpeg|jpg|png)/i.test(file.type)) return;

		    var reader = new FileReader();

		    reader.onload = function() {
		        var result = this.result;

		        previewer.src = result;

		        // 清空图片上传框的值
		        // filechooser.value = '';
		    };

		    reader.readAsDataURL(file);
		};
	}

</script>