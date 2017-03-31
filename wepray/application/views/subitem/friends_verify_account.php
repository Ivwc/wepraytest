<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<?php if(getAllFriendsApply()!=null){
		foreach(getAllFriendsApply() as $item):?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="tabaccount<?php echo $item['userModifyId'];?>">
				<h4 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#myaccountdiv<?php echo $item['userModifyId'];?>" aria-expanded="false" aria-controls="myaccountdiv<?php echo $item['userModifyId'];?>">
					#<?php echo $item['userModifyId'];?>
				</h4>
			</div>
			<div id="myaccountdiv<?php echo $item['userModifyId'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabaccount<?php echo $item['userModifyId'];?>">
				<div class="panel-body">
					<table class="table">
						<?php foreach(getFriendsInfo($item['userInfoId']) as $item2):?>
						<?php endforeach;?>
						<tr class="active">
							<td>祈緣用戶编号</td>
							<td><?php echo $item['userInfoId'];?></td>
							<td></td>
							<td></td>
						</tr>
						<?php if($item['modifyType']==0){?>
						<tr class="danger">
							<td>原先名称</td>
							<td><?php echo $item2['userName'];?></td>
							<td>修改名称</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==1){?>
						<tr class="danger">
							<td>原先暱稱</td>
							<td><?php echo $item2['userNickname'];?></td>
							<td>修改暱稱</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==2){?>
						<tr class="danger">
							<td>原先關於我</td>
							<td><?php echo $item2['userAbout'];?></td>
							<td>修改關於我</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==3){?>
						<tr class="danger">
							<td>原先名称</td>
							<td><?php echo $item2['userName'];?></td>
							<td>修改名称</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==4){?>
						<tr class="danger">
							<td>原先名称</td>
							<td><?php echo $item2['userName'];?></td>
							<td>修改名称</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }?>
						<tr class="active" id="refuseAccountArea<?php echo $item['userModifyId'];?>" hidden="true">
							<td><textarea class="form-control" rows="3" placeholder="拒絕原因" id="refuseAccountText<?php echo $item['userModifyId'];?>"></textarea></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="controlAccountArea<?php echo $item['userModifyId'];?>">
							<td><button type="button" class="btn btn-success" onclick="submitUpdateAccount(<?php echo $item['userModifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="submitRefuseAccount(<?php echo $item['userModifyId']?>);">拒絕</button></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="refuseAccountButtonArea<?php echo $item['userModifyId'];?>" hidden="true">
							<td><button type="button" class="btn btn-success" onclick="submitUpdateAccount(<?php echo $item['userModifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="refuseAccount(<?php echo $item['userModifyId']?>);">同意拒絕</button></td>
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
	function submitUpdateAccount($id){
		alertify.confirm('你确定通过此笔修正？', function (e) {  
			if (e) { 
				$.ajax({
					url: "<?php echo site_url('/friends_info/modify_friends_info');?>",
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
	function submitRefuseAccount($id){
		document.getElementById("refuseAccountArea"+$id).hidden=false;
		document.getElementById("refuseAccountButtonArea"+$id).hidden=false;
		document.getElementById("controlAccountArea"+$id).hidden=true;
	}
	function refuseAccount($id){
		var content=document.getElementById("refuseAccountText"+$id).value;
		if(content==""){
			alertify.alert("你沒有輸入拒絕原因", function(){
			});
		}else{
			alertify.confirm('你确定拒絕此筆修正?並填寫原因為:'+content, function (e) {  
				if (e) {  
					$.ajax({
						url: "<?php echo site_url('/friends_info/refuse_modify_friends_info');?>",
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