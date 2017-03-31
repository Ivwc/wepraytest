<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<?php if(getAllFriendsBan()!=null){
		foreach(getAllFriendsBan() as $item):?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="tabban<?php echo $item['banId'];?>">
				<h4 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#myBanDiv<?php echo $item['banId'];?>" aria-expanded="false" aria-controls="myBanDiv<?php echo $item['banId'];?>">
					#<?php echo $item['banId'];?>
				</h4>
			</div>
			<div id="myBanDiv<?php echo $item['banId'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabban<?php echo $item['banId'];?>">
				<div class="panel-body">
					<table class="table">
						<?php foreach(getFriendsInfo($item['userInfoId']) as $item2):?>
						<?php endforeach;?>
						<tr class="active">
							<td width="200"></td>
							<td>祈缘用户编号<?php echo $item['userInfoId'];?>检举祈缘用户编号<?php echo $item['userInfoIdBan'];?></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active">
							<td>检举项目</td>
							<td><?php echo $item['banType'];?></td>
							<td>检举内容</td>
							<td><?php echo $item['banContent'];?></td>
						</tr>
						<tr class="active" id="refuseBanArea<?php echo $item['banId'];?>" hidden="true">
							<td><textarea class="form-control" rows="3" placeholder="拒绝原因" id="refuseBanText<?php echo $item['banId'];?>"></textarea></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="controlBanArea<?php echo $item['banId'];?>">
							<td><button type="button" class="btn btn-success" onclick="submitUpdateBan(<?php echo $item['banId']?>);">同意检举</button><button type="button" class="btn btn-danger" onclick="submitRefuseBan(<?php echo $item['banId']?>);">不同意检举</button></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="refuseBanButtonArea<?php echo $item['banId'];?>" hidden="true">
							<td><button type="button" class="btn btn-success" onclick="submitUpdateBan(<?php echo $item['banId']?>);">同意检举</button><button type="button" class="btn btn-danger" onclick="refuseBan(<?php echo $item['banId']?>);">不同意检举</button></td>
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
	function submitUpdateBan($id){
		alertify.confirm('你确定通过此笔检举？', function (e) {  
			if (e) { 
				$.ajax({
					url: "<?php echo site_url('/friends_info/ban_friends');?>",
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
	function submitRefuseBan($id){
		document.getElementById("refuseBanArea"+$id).hidden=false;
		document.getElementById("refuseBanButtonArea"+$id).hidden=false;
		document.getElementById("controlBanArea"+$id).hidden=true;
	}
	function refuseBan($id){
		var content=document.getElementById("refuseBanText"+$id).value;
		if(content==""){
			alertify.alert("你没有输入拒绝原因", function(){
			});
		}else{
			alertify.confirm('你确定拒绝此笔检举?并填写原因为:'+content, function (e) {  
				if (e) {  
					$.ajax({
						url: "<?php echo site_url('/friends_info/refuse_ban_friends');?>",
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