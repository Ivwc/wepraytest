
<script src="<?php echo base_url(); ?>asset/ckeditor/ckeditor.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>asset/ckfinder/ckfinder.js?<?php echo time(); ?>"></script>

<style>
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

.has-feedback span{
	display: none
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
	                    <div class="tab-pane active" role="tabpanel" id="step1">
	                        <h3>Step 1</h3>
	                        <p>建立商品資訊</p>
	                        <div class="panel-content col-xs-12 nopadding">
	                        	<form action="">
	                        		<div class="form-group has-feedback col-xs-12 nopaddingRL">
									    <label class="col-sm-2 control-label" for="inputError">
									    商品名稱</label>
									    <div class="col-sm-10">
									    	<input type="text" class="form-control product_step_1_input" id="product_name">
									    	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
									    </div>
									</div>
									<div class="form-group has-feedback  col-xs-12 nopaddingRL">
									    <label class="col-sm-2 control-label" for="inputError">
									    商品副標題</label>
									    <div class="col-sm-10">
									    	<input type="text" class="form-control product_step_1_input" id="product_sub_name">
									    	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
									    </div>
									</div>
									<div class="form-group has-feedback  col-xs-12 nopaddingRL">
									    <label class="col-sm-2 control-label" for="inputError">
									    商品價格</label>
									    <div class="col-sm-10">
									    	<input type="text" class="form-control product_step_1_input" id="product_price">
									    	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
									    </div>
									</div>
									<div class="form-group has-feedback  col-xs-12 nopaddingRL">
									    <label class="col-sm-2 control-label" for="inputError">
									    商品數量</label>
									    <div class="col-sm-10">
									    	<input type="text" class="form-control product_step_1_input" id="product_qty">
									    	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
									    </div>
									</div>
									<div class="form-group has-feedback  col-xs-12 nopaddingRL">
									    <label class="col-sm-2 control-label" for="inputError">
									    商品大分類</label>
									    <div class="col-sm-10">
									    	<input type="text" class="form-control product_step_1_input" id="product_sort_class">
									    	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
									    </div>
									</div>
									<div class="form-group has-feedback  col-xs-12 nopaddingRL">
									    <label class="col-sm-2 control-label" for="inputError">
									    商品小分類</label>
									    <div class="col-sm-10">
									    	<input type="text" class="form-control product_step_1_input" id="product_class">
									    	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
									    </div>
									</div>
	                        	</form>
	                        </div>
	                        <ul class="list-inline pull-right">
	                            <li><button type="button" class="btn btn-primary step_1_submit">送出進行下一步</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step2">
	                        <h3>Step 2</h3>
	                        <p>編輯商品介紹</p>
	                        <div>
	                        	<form name = 'form' action = '#' method='post'>
							    	<textarea name="content" id="content" rows="10" cols="80"></textarea>
							    	<script>
										CKFinder.setupCKEditor();
							        	CKEDITOR.replace( 'content', {});
									</script>
							        <input type = 'button' value = '送出' onclick = 'processData()'>
								</form>
								<script>
								   function processData(){
								   // getting data
								   var data = CKEDITOR.instances.content.getData()
								   alert(data);
								  }
								 </script>
	                        </div>
	                        <ul class="list-inline pull-right">
	                            <!-- <li><button type="button" class="btn btn-default prev-step">Previous</button></li> -->
	                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="step3">
	                        <h3>Step 3</h3>
	                        <p>上傳商品圖片</p>
	                        
	                        <ul class="list-inline pull-right">
	                            <!-- <li><button type="button" class="btn btn-default prev-step">Previous</button></li> -->
	                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
	                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
	                        </ul>
	                    </div>
	                    <div class="tab-pane" role="tabpanel" id="complete">
	                        <h3>Complete</h3>
	                        <p>You have successfully completed all steps.</p>
	                    </div>
	                    <div class="clearfix"></div>
	                </div>
	            </form>
	        </div>
	    </section>
	<!--    </div>
	</div> -->
	
</div>

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

	    //建立商品資訊送出
	    $(".step_1_submit").click(function (e) {
	    	input_empty = false;
	    	$('.product_step_1_input').each(function(){
	    		if ($(this).val() == "") {
	    			$(this).closest('.has-feedback').addClass('has-error');
	    			$(this).closest('.has-feedback').find('span').show();
	    			input_empty = true;
	    		}
	    	});

	    	if (!input_empty) {

	    		var api = "";
	    		var $active = $('.wizard .nav-tabs li.active');
		        $active.addClass('disabled');
		        $active.next().removeClass('disabled');
		        nextTab($active);
	    	}else{
	    		alert('請填寫完所有資料!');
	    	}

	        

	    });

	    // $(".prev-step").click(function (e) {

	    //     var $active = $('.wizard .nav-tabs li.active');
	    //     $active.addClass('disabled');
	    //     prevTab($active);

	    // });

	    $('body').on('click','.step_1_submit',function(){
	    	$(this)
	    });
	});

	function nextTab(elem) {
	    $(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
	    $(elem).prev().find('a[data-toggle="tab"]').click();
	}

</script>