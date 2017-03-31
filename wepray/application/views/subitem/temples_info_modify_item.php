<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<?php if(getAllInformationModify()!=null){
		foreach(getAllInformationModify() as $item):?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="tab<?php echo $item['modifyId'];?>">
				<h4 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#mydiv<?php echo $item['modifyId'];?>" aria-expanded="false" aria-controls="mydiv<?php echo $item['modifyId'];?>">
					#<?php echo $item['modifyId'];?>
				</h4>
			</div>
			<div id="mydiv<?php echo $item['modifyId'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tab<?php echo $item['modifyId'];?>">
				<div class="panel-body">
					<table class="table">
						<?php foreach(getInformationBeforeModifyById($item['templeId']) as $item2):?>
						<?php endforeach;?>
						<tr class="active">
							<td>庙宇编号</td>
							<td><?php echo $item['templeId'];?></td>
							<td></td>
							<td></td>
						</tr>
						<?php if($item['modifyType']==1){?>
						<tr class="danger">
							<td>原先名称</td>
							<td><?php echo $item2['templeName'];?></td>
							<td>修改名称</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==2){?>
						<tr class="danger">
							<td>原先地址</td>
							<td><?php echo $item2['templeAddress'];?></td>
							<td>修改地址</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==3){?>
						<tr class="danger">
							<td>原先电话</td>
							<td><?php echo $item2['templePhone'];?></td>
							<td>修改电话</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }else if($item['modifyType']==4){?>
						<tr class="danger">
							<td>原先介绍</td>
							<td><?php echo $item2['templeIntroduction'];?></td>
							<td>修改介绍</td>
							<td><?php echo $item['modifyName'];?></td>
						</tr>
						<?php }?>
						<tr class="active" id="refuseArea<?php echo $item['modifyId'];?>" hidden="true">
							<td><textarea class="form-control" rows="3" placeholder="拒絕原因" id="refuseText<?php echo $item['modifyId'];?>"></textarea></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="controlArea<?php echo $item['modifyId'];?>">
							<td><button type="button" class="btn btn-success" onclick="submitUpdate(<?php echo $item['modifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="submitRefuse(<?php echo $item['modifyId']?>);">拒絕</button></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="refuseButtonArea<?php echo $item['modifyId'];?>" hidden="true">
							<td><button type="button" class="btn btn-success" onclick="submitUpdate(<?php echo $item['modifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="refuse(<?php echo $item['modifyId']?>);">同意拒絕</button></td>
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
	function submitUpdate($id){
		alertify.confirm('你确定通过此笔修正？', function (e) {  
			if (e) {  
				$.ajax({
					url: "<?php echo site_url('/temples/modify_temples');?>",
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
	function submitRefuse($id){
		document.getElementById("refuseArea"+$id).hidden=false;
		document.getElementById("refuseButtonArea"+$id).hidden=false;
		document.getElementById("controlArea"+$id).hidden=true;
	}
	function refuse($id){
		var content=document.getElementById("refuseText"+$id).value;
		if(content==""){
			alertify.alert("你沒有輸入拒絕原因", function(){
			});
		}else{
			alertify.confirm('你确定拒絕此筆修正?並填寫原因為:'+content, function (e) {  
				if (e) {  
					$.ajax({
						url: "<?php echo site_url('/temples/refuse_temples');?>",
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