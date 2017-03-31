<div id="my-dropzone" class="dropzone panel panel-default"></div>

<br/>
<br/>
<div style="height:60%;overflow-y:scroll" id="test" class="panel panel-default">
</div>
<script type="text/javascript">
	window.Dropzone;
	Dropzone.autoDiscover=false;
	var myDropzone =new Dropzone("#my-dropzone",{
		url: "<?php echo site_url("picupload_temples/upload")?>",
		maxFilesize:3,
		imageWidth:500,
		imageHeight:400,
		imageSameSize:true,
		imageCompress:0.5
	});
	myDropzone.on("success", function(file) {	
		reloadDivPicList();
	});
	
	function reloadDivPicList(){
		$.ajax({
			url: "<?php echo site_url("picupload_temples/list_pic")?>",
			type:"post",
			dataType:'text',
			success:function(data){
				var JSONObject = $.parseJSON(data);
				// $("#test").empty();
				for (var key in JSONObject) {
					if (JSONObject.hasOwnProperty(key)) {
						if(document.getElementById(JSONObject[key]["templePicId"])==null){
							$img='<a href="<?php echo base_url()?>pages/temples_pic_show/' + JSONObject[key]["templePicId"] + '"><img src="<?php echo getAssetImagePath()?>' + JSONObject[key]["templePicUrl"] + '?<?php echo time();?>"'+'class="img-rounded" width="200" id="'+JSONObject[key]["templePicId"]+'" ></a>';
							$btUp='<button type="button" class="btn btn-success btn-sm" onclick="move_up('+JSONObject[key]["templePicId"]+','+JSONObject[key]["templePicSequence"]+')">上移</button>';
							$btDown='<button type="button" class="btn btn-success btn-sm" onclick="move_down('+JSONObject[key]["templePicId"]+','+JSONObject[key]["templePicSequence"]+')">下移</button>';
							$btDis='<button type="button" class="btn btn-danger btn-sm" onclick="disablePic('+JSONObject[key]["templePicId"]+')">禁用</button>';
							$btAble='<button type="button" class="btn btn-success btn-sm" onclick="ablePic('+JSONObject[key]["templePicId"]+')">启用</button>';
							$btCrop='<a href="<?php echo base_url()?>pages/temples_pic_crop/' + JSONObject[key]["templePicId"] + '" class="btn btn-success btn-sm" >切割</a>';
							if(JSONObject[key]["picStatus"]==0){
								$('<div class="bg-info">'+$img+$btCrop+$btUp+$btDown+'<p></p></div>').appendTo($("#test"));
							}else if(JSONObject[key]["picStatus"]==1){
								$('<div class="bg-success">'+$img+$btCrop+$btUp+$btDown+$btDis+'<p></p></div>').appendTo($("#test"));
							}else if(JSONObject[key]["picStatus"]==2){
								$('<div class="bg-warning">'+$img+$btCrop+$btUp+$btDown+$btAble+'<p></p></div>').appendTo($("#test"));
							}else if(JSONObject[key]["picStatus"]==9){
								$('<div class="bg-danger">'+$img+$btCrop+$btUp+$btDown+'<p></p></div>').appendTo($("#test"));
							}
						}

					}
				}
			}

		});
	}
	function moveDivPicList(){
		$.ajax({
			url: "<?php echo site_url("picupload_temples/list_pic")?>",
			type:"post",
			dataType:'text',
			success:function(data){
				var JSONObject = $.parseJSON(data);
				$("#test").empty();
				for (var key in JSONObject) {
					if (JSONObject.hasOwnProperty(key)) {
						$img='<a href="<?php echo base_url()?>pages/temples_pic_show/' + JSONObject[key]["templePicId"] + '"><img src="<?php echo base_url()?>' + JSONObject[key]["templePicUrl"] + '?<?php echo time();?>"'+'class="img-rounded" width="200" id="'+JSONObject[key]["templePicId"]+'" ></a>';
						$btUp='<button type="button" class="btn btn-success btn-sm" onclick="move_up('+JSONObject[key]["templePicId"]+','+JSONObject[key]["templePicSequence"]+')">上移</button>';
						$btDown='<button type="button" class="btn btn-success btn-sm" onclick="move_down('+JSONObject[key]["templePicId"]+','+JSONObject[key]["templePicSequence"]+')">下移</button>';
						$btDis='<button type="button" class="btn btn-danger btn-sm" onclick="disablePic('+JSONObject[key]["templePicId"]+')">禁用</button>';
						$btAble='<button type="button" class="btn btn-success btn-sm" onclick="ablePic('+JSONObject[key]["templePicId"]+')">启用</button>';
						if(JSONObject[key]["picStatus"]==0){
							$('<div class="bg-info">'+$img+$btUp+$btDown+'<p></p></div>').appendTo($("#test"));
						}else if(JSONObject[key]["picStatus"]==1){
							$('<div class="bg-success">'+$img+$btUp+$btDown+$btDis+'<p></p></div>').appendTo($("#test"));
						}else if(JSONObject[key]["picStatus"]==2){
							$('<div class="bg-warning">'+$img+$btUp+$btDown+$btAble+'<p></p></div>').appendTo($("#test"));
						}else if(JSONObject[key]["picStatus"]==9){
							$('<div class="bg-danger">'+$img+$btUp+$btDown+'<p></p></div>').appendTo($("#test"));
						}

					}
				}
			}

		});
	}
	function move_up($id,$sequence){
		$.ajax({
			url: "<?php echo site_url('/picupload_temples/move_up');?>",
			type:"post",
			data:{"templePicId":$id,"sequence":$sequence},
			dataType:'text',
			success:function(data){
				moveDivPicList();
			}
		});
	}
	function move_down($id,$sequence){
		$.ajax({
			url: "<?php echo site_url('/picupload_temples/move_down');?>",
			type:"post",
			data:{"templePicId":$id,"sequence":$sequence},
			dataType:'text',
			success:function(data){
				moveDivPicList();
			}
		});
	}
	function disablePic($id){
		$.ajax({
			url: "<?php echo site_url('/picupload_temples/disable');?>",
			type:"post",
			data:{"templePicId":$id},
			dataType:'text',
			success:function(data){
				moveDivPicList();
			}
		});
	}

	function ablePic($id){
		$.ajax({
			url: "<?php echo site_url('/picupload_temples/able');?>",
			type:"post",
			data:{"templePicId":$id},
			dataType:'text',
			success:function(data){
				moveDivPicList();
			}
		});
	}
	reloadDivPicList();
</script>