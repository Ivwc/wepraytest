<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<?php if(getAllMapModify()!=null){
		foreach(getAllMapModify() as $item):?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="tabmap<?php echo $item['modifyId'];?>">
				<h4 class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#mymapdiv<?php echo $item['modifyId'];?>" aria-expanded="false" aria-controls="mymapdiv<?php echo $item['modifyId'];?>">
					#<?php echo $item['modifyId'];?>
				</h4>
			</div>
			<div id="mymapdiv<?php echo $item['modifyId'];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabmap<?php echo $item['modifyId'];?>">
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
						<tr class="danger">
							<td>原先行政区</td>
							<td><?php echo $item2['countryName'];?> <?php echo $item2['provinceName'];?> <?php echo $item2['prefecturalName'];?> <?php echo $item2['districtName'];?> (<?php echo $item2['templeLongitude'];?>,<?php echo $item2['templeLatitude'];?>)</td>
							<td>修改行政区</td>
							<td><?php echo $item['countryName'];?> <?php echo $item['provinceName'];?> <?php echo $item['prefecturalName'];?> <?php echo $item['districtName'];?> (<?php echo $item['templeLongitude'];?>,<?php echo $item['templeLatitude'];?>)</td>
						</tr>
						<tr class="active" id="refuseMapArea<?php echo $item['modifyId'];?>" hidden="true">
							<td><textarea class="form-control" rows="3" placeholder="拒絕原因" id="refuseMapText<?php echo $item['modifyId'];?>"></textarea></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="controlMapArea<?php echo $item['modifyId'];?>">
							<td><button type="button" class="btn btn-success" onclick="submitUpdateMap(<?php echo $item['modifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="submitRefuseMap(<?php echo $item['modifyId']?>);">拒絕</button></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr class="active" id="refuseMapButtonArea<?php echo $item['modifyId'];?>" hidden="true">
							<td><button type="button" class="btn btn-success" onclick="submitUpdateMap(<?php echo $item['modifyId']?>);">同意修正不拒絕</button><button type="button" class="btn btn-danger" onclick="refuseMap(<?php echo $item['modifyId']?>);">同意拒絕</button></td>
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
	function submitUpdateMap($id){
		alertify.confirm('你确定通过此笔修正？', function (e) {  
			if (e) { 
				$.ajax({
					url: "<?php echo site_url('/temples/modify_temples_map');?>",
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
	function submitRefuseMap($id){
		document.getElementById("refuseMapArea"+$id).hidden=false;
		document.getElementById("refuseMapButtonArea"+$id).hidden=false;
		document.getElementById("controlMapArea"+$id).hidden=true;
	}
	function refuseMap($id){
		var content=document.getElementById("refuseMapText"+$id).value;
		if(content==""){
			alertify.alert("你沒有輸入拒絕原因", function(){
			});
		}else{
			alertify.confirm('你确定拒絕此筆修正?並填寫原因為:'+content, function (e) {  
				if (e) {  
					$.ajax({
						url: "<?php echo site_url('/temples/refuse_temples_map');?>",
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