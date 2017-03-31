<?php if(getInformation(get_session_id())!=null){
	foreach (getInformation(get_session_id()) as $item):?>
	<?php 
	$modifyStatus=-1;
	$per=0;
	if($item['templeName']!=""){
		$per++;
	}
	if($item['countryName']!=""){
		$per++;
	}
	if($item['provinceName']!=""){
		$per++;
	}
	if($item['prefecturalName']!=""){
		$per++;
	}
	if($item['districtName']!=""){
		$per++;
	}
	if($item['templeAddress']!=""){
		$per++;
	}
	if($item['templeIntroduction']!=""){
		$per++;
	}
	if($item['templePhone']!=""){
		$per++;
	}
	if($item['godsUrl']!=""){
		$per++;
	}
	if($item['templeLongitude']!=""&&$item['templeLatitude']!=""){
		$per++;
	}
	?>
	<div class="alert <?php 
	if($per==10){
		echo 'alert-success';
	}else{
		echo 'alert-warning';
	}
	?>" role="alert">请将资料填写完整，完成度为<?php echo $per*10?>%</div>

	<?php 
	if($item['templePublicStatus']==9){
		echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color:red"> 资料已注销</span></div>';
	}else if($item['templePublicStatus']==1){
		echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"> 资料公开中</span></div>';
	}else if($item['templePublicStatus']==2){
		?>
		<?php if(getInformationModify($item['templeId'])!=null){
			foreach (getInformationModify($item['templeId']) as $item2):?>
			<?php 
			$modifyStatus=$item2['modifyStatus'];
			$modifyPublic=$item2['modifyPublic'];
			if($modifyStatus==0&&$modifyPublic==0){
				echo '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> 资料审核中</span>';
				if($item2['modifyType']==1){
					setViewForUpdateInformationDiv(1,$item['templeName'],$item2['modifyName']);
				}else if($item2['modifyType']==2){
					setViewForUpdateInformationDiv(2,$item['templeAddress'],$item2['modifyName']);
				}else if($item2['modifyType']==3){
					setViewForUpdateInformationDiv(3,$item['templePhone'],$item2['modifyName']);
				}else if($item2['modifyType']==4){
					setViewForUpdateInformationDiv(4,$item['templeIntroduction'],$item2['modifyName']);
				}
				?>
				<button class="btn btn-success" id="cropBt" onclick="cancelUpdate(<?php echo $item2['modifyId'];?>);">取消更新</button>
			</div>
			<?php }else if($modifyStatus==1&&$modifyPublic==0){
				echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"> 资料审核成功</span>';
				if($item2['modifyType']==1){
					echo '<br/><br/>名称变更成功:'.$item2['modifyName'].'<br/><br/>';
				}else if($item2['modifyType']==2){
					echo '<br/><br/>地址变更成功:'.$item2['modifyName'].'<br/><br/>';
				}else if($item2['modifyType']==3){
					echo '<br/><br/>电话变更成功:'.$item2['modifyName'].'<br/><br/>';
				}else if($item2['modifyType']==4){
					echo '<br/><br/>介绍变更成功:'.$item2['modifyName'].'<br/><br/>';
				}
				?>
				<button class="btn btn-success" id="cropBt" onclick="notShow(<?php echo $item2['modifyId'];?>);">不再显示</button>
			</div>
			<?php }else if($modifyStatus==2&&$modifyPublic==0){
				echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"> 资料审核失败</span>';
				echo '<br/><br/>变更失败原因:'.$item2['modifyContent'].'<br/>';
				if($item2['modifyType']==1){
					echo '名称变更失败内容:'.$item2['modifyName'].'<br/><br/>';
				}else if($item2['modifyType']==2){
					echo '地址变更失败内容:'.$item2['modifyName'].'<br/><br/>';
				}else if($item2['modifyType']==3){
					echo '电话变更失败内容:'.$item2['modifyName'].'<br/><br/>';
				}else if($item2['modifyType']==4){
					echo '介绍变更失败内容:'.$item2['modifyName'].'<br/><br/>';
				}
				?>
				<button class="btn btn-success" id="cropBt" onclick="notShow(<?php echo $item2['modifyId'];?>);">不再显示</button>
			</div>
			<?php }
			?>
		<?php endforeach;}?>

		<?php if(getMapModify($item['templeId'])!=null){
			foreach (getMapModify($item['templeId']) as $item2):?>
			<?php 
			$modifyStatus=$item2['modifyStatus'];
			$modifyPublic=$item2['modifyPublic'];
			if($modifyStatus==0&&$modifyPublic==0){
				echo '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> 资料审核中</span>';
				setViewForUpdateInformationDiv(0,$item['countryName']." ".$item['provinceName']." ".$item['prefecturalName']." ".$item['districtName']." (".$item['templeLongitude'].",".$item['templeLatitude'].") ",$item2['countryName']." ".$item2['provinceName']." ".$item2['prefecturalName']." ".$item2['districtName']." (".$item2['templeLongitude'].",".$item2['templeLatitude'].") ");
				?>
				<button class="btn btn-success" id="cropBt" onclick="cancelUpdate(<?php echo $item2['modifyId'];?>);">取消更新</button>
			</div>
			<?php }else if($modifyStatus==1&&$modifyPublic==0){
				echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"> 资料审核成功</span>';
				echo '<br/><br/>行政区变更成功:'.$item2['countryName']." ".$item2['provinceName']." ".$item2['prefecturalName']." ".$item2['districtName']." (".$item2['templeLongitude'].",".$item2['templeLatitude'].") ".'<br/><br/>';
				?>
				<button class="btn btn-success" id="cropBt" onclick="notShow(<?php echo $item2['modifyId'];?>);">不再显示</button>
			</div>
			<?php }else if($modifyStatus==2&&$modifyPublic==0){
				echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"> 资料审核失败</span>';
				echo '<br/><br/>变更失败原因:'.$item2['modifyContent'].'<br/>';
				echo '行政区变更失败内容:'.$item2['countryName']." ".$item2['provinceName']." ".$item2['prefecturalName']." ".$item2['districtName']." (".$item2['templeLongitude'].",".$item2['templeLatitude'].") ".'<br/><br/>';
				?>
				<button class="btn btn-success" id="cropBt" onclick="notShow(<?php echo $item2['modifyId'];?>);">不再显示</button>
			</div>
			<?php }
			?>
		<?php endforeach;}?>
		<?php
	}else if($item['templePublicStatus']==0){
		echo '<div class="alert alert-info" role="alert"> 资料未公开</div>';
	}
	?>
	<form method="post" action="<?php echo site_url('temples/update_information/');?>" >
		<div class="panel panel-default">
			<input type="hidden" class="form-control" name="templeId" value="<?php echo $item['templeId'];?>">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td>名称</td>
						<td>
							<input type="text" class="form-control" name="templeName" value="<?php echo $item['templeName'];?>">
						</td>
					</tr>
					<tr>
						<td>行政区</td>
						<td>
							<?php echo $item['countryName']." ".$item['provinceName']." ".$item['prefecturalName']." ".$item['districtName']." (".$item['templeLongitude'].",".$item['templeLatitude'].") ";?>	
						</td>
					</tr>
					<tr>
						<td>地址</td>
						<td>
							<input type="text" class="form-control" name="templeAddress" value="<?php echo $item['templeAddress'];?>">
						</td>
					</tr>
					<tr>
						<td>电话</td>
						<td>
							<input type="text" class="form-control" name="templePhone" value="<?php echo $item['templePhone'];?>">
						</td>
					</tr>
					<tr>
						<td>神祇</td>
						<td>
							<img src="<?php echo $item['godsUrl'];?>" width="100" height="100" class="img-rounded"/>
						</td>
					</tr>
					<tr>
						<td>介绍</td>
						<td>
							<textarea class="form-control" rows="3" name="templeIntroduction"><?php echo $item['templeIntroduction'];?></textarea>
						</td>
					</tr>
					<tr>
						<td>官方认证</td>
						<td>
							<?php 
							if($item['officialCertification']==0){
								echo '<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span>';
							}else if($item['officialCertification']==1){
								echo '<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"></span>';
							}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<button type="submit" class="btn btn-success">更新</button>
	</form>

<?php endforeach;}
else{?>
<div class="alert alert-danger" role="alert">并没有相关的庙宇资讯，请洽询管理者</div>
<?php }?>
<script type="text/javascript">

	$( document ).ready(function() {
		setInterval("check_form()", 500);
	});
	function check_form()
	{
		var longitude = document.getElementById('longitudeHide').value;
		var latitude = document.getElementById('latitudeHide').value;
		var updateBt = document.getElementById("update");

		var countryId = document.getElementById('countryId').value;
		var provinceId = document.getElementById('provinceId').value;
		var prefecturalId = document.getElementById('prefecturalId').value;
		var districtId = document.getElementById('districtId').value;

		if(longitude==""||latitude==""||countryId==0||provinceId==0||prefecturalId==0||districtId==0){
			updateBt.disabled=true;
		}else{
			updateBt.disabled=false;
		}
	}	
	function cancelUpdate($id){
		alertify.confirm('你确定要取消此项更新吗？', function (e) {  
			if (e) {  
				$.ajax({
					url: "<?php echo site_url('/temples/cancel_update_information');?>",
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

	function notShow($id){
		$.ajax({
			url: "<?php echo site_url('/temples/notshow_modify');?>",
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
	}
</script>