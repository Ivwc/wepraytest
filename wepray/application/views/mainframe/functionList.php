<div id="sidebar-wrapper">
    <ul class="sidebar-nav nav-pills nav-stacked">
        <li id="li_pages">
            <a href="<?=site_url('pages')?>"><span class="glyphicon glyphicon-home"></span> 首页</a>
        </li>
        <li id="li_temples_pic_upload">
            <a href="<?=site_url('pages/temples_pic_upload')?>"><span class="glyphicon glyphicon-picture"></span> 庙方图片</a>
        </li>
        <li id="li_store">
            <a href="<?=site_url('pages/store')?>"><span class="glyphicon glyphicon-gift"></span> 福物管理</a>
        </li>
        <li id="li_money">
            <a href="<?=site_url('pages/money')?>"><span class="glyphicon glyphicon-piggy-bank"></span> 发财金</a>
        </li>
        <li id="li_kindness">
            <a href="<?=site_url('pages/kindness')?>"><span class="glyphicon glyphicon-piggy-bank"></span> 善事牆？</a>
        </li>
        <li id="li_chat">
            <a href="<?=site_url('pages/chat')?>"><span class="glyphicon glyphicon-piggy-bank"></span> 小伊對話(大頭使用)</a>
        </li>
        <li id="li_chat2">
            <a href="<?=site_url('pages/chat2')?>"><span class="glyphicon glyphicon-piggy-bank"></span> 大頭對話(小伊使用)</a>
        </li>
    </ul>
</div>
<script type="text/javascript">
    var myUrl=window.location.href;
    myUrl = myUrl.split('/');
    myUrl = myUrl[myUrl.length-1];
    myUrl = myUrl.split('?');
    myUrl = myUrl[0];
    console.log(myUrl);
    $('.nav-stacked li').each(function(){
        $(this).removeClass('active');
        $('#li_'+myUrl).addClass('active');
    });
    if ($('#'+myUrl+'_num').size() > 0) {
        $("#"+myUrl+"_num").css("background-color","#FFFFFF");    
    }
</script>
