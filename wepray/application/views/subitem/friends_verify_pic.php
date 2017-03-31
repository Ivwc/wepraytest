<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<?php if(getAllFriendsPicModify()!=null){
		foreach(getAllFriendsPicModify() as $item):?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="tabPic<?php echo $item['userPicModifyId'];?>">
				<h4 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#myPicdiv<?php echo $item['userPicModifyId'];?>" aria-expanded="false" aria-controls="myPicdiv<?php echo $item['userPicModifyId'];?>">
					#<?php echo $item['userPicModifyId'];?>
				</h4>
			</div>
			<div id="myPicdiv<?php echo $item['userPicModifyId'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabPic<?php echo $item['userPicModifyId'];?>">
				<div class="panel-body">
					<table class="table">
						<?php foreach(getFriendsInfo($item['userInfoId']) as $item2):?>
						<?php endforeach;?>
						<tr class="active">
							<td width="200">祈緣用戶大頭像</td>
							<td>
								<?php if($item2['userHeadimgUrl']==""){}else{ ?>
								<img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item2['userHeadimgUrl'].'?'.time();?>" width="100" height="100" class="img-rounded"/>
								<?php }?>
							</td>
						</tr>
						<tr class="active">
							<td>祈緣用戶照片組1</td>
							<td>
								<?php for($i=1;$i<=4;$i++){ if($item2['userHumanPic_'.$i]==""){}else{ ?>
								<img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item2['userHumanPic_'.$i].'?'.time();?>" width="100" height="100" class="img-rounded"/>
								<?php }}?>
							</td>
						</tr>
						<tr class="active">
							<td>祈緣用戶照片組2</td>
							<td>
								<?php for($i=1;$i<=4;$i++){ if($item2['userPic_'.$i]==""){}else{ ?>
								<img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item2['userPic_'.$i].'?'.time();?>" width="100" height="100" class="img-rounded"/>
								<?php }}?>
							</td>
						</tr>
					</table>
					<table class="table">
						<tr class="active">
							<td width="200">祈緣用戶编号</td>
							<td ><?php echo $item['userInfoId'];?></td>
							<td width="200">修改項目是 <?php if($item['modifyPicNum']==0){echo "頭像";}else if($item['modifyPicNum']>=1&&$item['modifyPicNum']<=4){echo "正面照".$item['modifyPicNum'];}else if($item['modifyPicNum']>=5&&$item['modifyPicNum']<=8){echo "一般照".($item['modifyPicNum']-4);}?></td>
							<td ></td>
						</tr>
						<?php if($item['modifyPicNum']==0){?>
						<tr class="danger">
							<td>原先頭像</td>
							<td>
								<?php if($item2['userHeadimgUrl']==""){}else{ ?>
								<img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item2['userHeadimgUrl'].'?'.time();?>" width="100" height="100" class="img-rounded"/>
								<?php }?>
							</td>
							<td>修改頭像</td>
							<td><img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item['modifyPic'].'?'.time();?>" width="100" height="100" class="img-rounded"/></td>
						</tr>
						<?php }else if($item['modifyPicNum']>=1&&$item['modifyPicNum']<=4){?>
						<tr class="danger">
							<td>原先照片</td>
							<td>
								<?php if($item2['userHumanPic_'.$item['modifyPicNum']]==""){}else{ ?>
								<img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item2['userHumanPic_'.$item['modifyPicNum']].'?'.time();?>" width="100" height="100" class="img-rounded"/>
								<?php }?>
							</td>
							<td>修改照片</td>
							<td><img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item['modifyPic'].'?'.time();?>" width="100" height="100" class="img-rounded"/></td>
						</tr>
						<?php }else if($item['modifyPicNum']>=5&&$item['modifyPicNum']<=8){?>
						<tr class="danger">
							<td>原先照片</td>
							<td>
								<?php if($item2['userPic_'.($item['modifyPicNum']-4)]==""){}else{ ?><img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item2['userPic_'.($item['modifyPicNum']-4)].'?'.time();?>" width="100" height="100" class="img-rounded"/>
								<?php }?>
							</td>
							<td>修改照片</td>
							<td><img src="<?php echo getUserFriednsImagePath($item['userInfoId']).$item['modifyPic'].'?'.time();?>" width="100" height="100" class="img-rounded"/></td>
						</tr>
						<?php }?>
						<tr class="active" id="refusePicArea<?php echo $item['userPicModifyId'];?>" hidden="true">
							<td><textarea class="form-control" rows="3" placeholder="拒絕原因" id="refusePicText<?php echo $item['userPicModifyId'];?>"></textarea></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="controlPicArea<?php echo $item['userPicModifyId'];?>">
							<td><button type="button" class="btn btn-success" onclick="submitUpdatePic(<?php echo $item['userPicModifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="submitRefusePic(<?php echo $item['userPicModifyId']?>);">拒絕</button></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="refusePicButtonArea<?php echo $item['userPicModifyId'];?>" hidden="true">
							<td><button type="button" class="btn btn-success" onclick="submitUpdatePic(<?php echo $item['userPicModifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="refusePic(<?php echo $item['userPicModifyId']?>);">同意拒絕</button></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	<?php endforeach;}?>

</div>

<script type="text/javascript">
	function submitUpdatePic($id){
		alertify.confirm('你确定通过此笔修正？', function (e) {  
			if (e) { 
				$.ajax({
					url: "<?php echo site_url('/friends_info/modify_friends_pic');?>",
					type:"post",
					data:{"id":$id},
					dataType:'text',
					success:function(data){
						location.reload();
					},
					error:function(error){
						alertify.log(error+"");  
					}
				}); 
			} else {  
			}  
		});  
	}
	function submitRefusePic($id){
		document.getElementById("refusePicArea"+$id).hidden=false;
		document.getElementById("refusePicButtonArea"+$id).hidden=false;
		document.getElementById("controlPicArea"+$id).hidden=true;
	}
	function refusePic($id){
		var content=document.getElementById("refusePicText"+$id).value;
		if(content==""){
			alertify.alert("你沒有輸入拒絕原因", function(){
			});
		}else{
			alertify.confirm('你确定拒絕此筆修正?並填寫原因為:'+content, function (e) {  
				if (e) {  
					$.ajax({
						url: "<?php echo site_url('/friends_info/refuse_modify_friends_pic');?>",
						type:"post",
						data:{"id":$id,"content":content},
						dataType:'text',
						success:function(data){
							location.reload();
						},
						error:function(error){
							alertify.log(error+"");  
						}
					}); 
				} else {  
				}  
			}); 
		} 
	}
</script>