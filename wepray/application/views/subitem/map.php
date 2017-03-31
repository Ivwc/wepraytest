
<style type="text/css">   

	#allmap {width: 500px;height: 500px;overflow: hidden;margin:0;}

	#r-result{width:200px;margin-top:5px;}
	p{margin:5px; font-size:14px;}
</style> 
<input type="text" name="countryId" value="1" style="display:none;">
<select class="form-control" id="countryId" disabled="disabled" >
	<?php foreach (getCountry() as $item):?>
		<option value="<?php echo $item['countryId'];?>"><?php echo $item['countryName'];?></option>
	<?php endforeach;?>
</select>
<select class="form-control" id="provinceId" name="provinceId">
	<option value="0">请选择</option>
	<?php foreach (getProvince() as $item):?>
		<option value="<?php echo $item['provinceId'];?>"><?php echo $item['provinceName'];?></option>
	<?php endforeach;?> 
</select>
<select class="form-control" id="prefecturalId" style="display:none;" name="prefecturalId">
	<option value="0">请选择</option>
</select>
<select class="form-control" id="districtId" style="display:none;" name="districtId">
	<option value="0">请选择</option>
</select>
<div id="allmap"></div>
<input type="text" id="longitude" class="input-block-level" placeholder="经度" value="" disabled="true">
<input type="text" id="latitude" class="input-block-level" placeholder="纬度" value="" disabled="true">
<input type="text" id="longitudeHide" name="longitude" value="" style="display:none;">
<input type="text" id="latitudeHide" name="latitude" value="" style="display:none;">
<script>
	$( document ).ready(function() {
		var map;
	});

	function loadJScript() {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://api.map.baidu.com/api?v=2.0&ak=MBDI7Q8U5L6EH6TmMK1czPySZRXGliiE&callback=init";
		document.body.appendChild(script);
	}
	function init() {
		map = new BMap.Map("allmap");
		var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}    
		map.addControl(new BMap.NavigationControl(opts));
		map.centerAndZoom("北京市",4); 
		var marker=null;
		var point=null;
		function showInfo(e){
			if(marker!=null){
				map.removeOverlay(marker);
			}
			point = new BMap.Point(e.point.lng, e.point.lat);
			document.getElementById("longitude").value=e.point.lng;
			document.getElementById("latitude").value=e.point.lat;
			document.getElementById("longitudeHide").value=e.point.lng;
			document.getElementById("latitudeHide").value=e.point.lat;
			marker = new BMap.Marker(point); 
			map.addOverlay(marker);               
		}
		map.addEventListener("click", showInfo);  
		function deletePoint(){
			var allOverlay = map.getOverlays();
			map.removeOverlay(0);
		}
	}
	window.onload = loadJScript;

	$("#countryId").change(function(){
		var str = $("#countryId").val();
		if (str==0) {
			document.getElementById("provinceId").style.display='none';
			document.getElementById("prefecturalId").style.display='none';
			document.getElementById("districtId").style.display='none';
			return;
		}else{
			document.getElementById("provinceId").style.display='block';
		}
		loadProvince(str);
	})

	$("#provinceId").change(function(){
		var str = $("#provinceId").val();
		if (str==0) {
			document.getElementById("prefecturalId").style.display='none';
			document.getElementById("districtId").style.display='none';
			return;
		}else{
			document.getElementById("prefecturalId").style.display='block';
			var str2= getSelectedText('provinceId');
			map.centerAndZoom(str2,10); 
		}
		loadPrefectural(str);
	})

	$("#prefecturalId").change(function(){
		var str = $("#prefecturalId").val();
		if (str==0) {
			document.getElementById("districtId").style.display='none';
			return;
		}else{
			document.getElementById("districtId").style.display='block';
			var str2= getSelectedText('provinceId')+getSelectedText('prefecturalId');
			map.centerAndZoom(str2,12); 
		}
		loadDistrict(str);
	})

	$("#districtId").change(function(){
		var str = $("#districtId").val();
		if (str==0) {
			return;
		}else{
			var str2= getSelectedText('provinceId')+getSelectedText('prefecturalId')+getSelectedText('districtId');
			map.centerAndZoom(str2,14); 
		}
	})
	function loadProvince(msg){
		$.ajax({
			url: "<?php echo site_url('/address/getProvince');?>",
			type:"post",
			data:{"id":msg},
			dataType:'text',
			success:function(data){
				var JSONObject = $.parseJSON(data);
				$("#provinceId").empty();
				$("<option value='0'>请选择</option>").appendTo($("#provinceId"))
				for (var key in JSONObject) {
					if (JSONObject.hasOwnProperty(key)) {
						$("<option value='" + JSONObject[key]["provinceId"] + "'>" + JSONObject[key]["provinceName"]
							+ "</option>").appendTo($("#provinceId"));
					}
				}
			}

		});
	}
	function getSelectedText(elementId) {
		var elt = document.getElementById(elementId);

		if (elt.selectedIndex == -1)
			return null;

		return elt.options[elt.selectedIndex].text;
	}
	function loadPrefectural(msg){
		$.ajax({
			url: "<?php echo site_url('/address/getPrefectural');?>",
			type:"post",
			data:{"id":msg},
			dataType:'text',
			success:function(data){
				var JSONObject = $.parseJSON(data);
				$("#prefecturalId").empty();
				$("<option value='0'>请选择</option>").appendTo($("#prefecturalId"))
				for (var key in JSONObject) {
					if (JSONObject.hasOwnProperty(key)) {
						$("<option value='" + JSONObject[key]["prefecturalId"] + "'>" + JSONObject[key]["prefecturalName"]
							+ "</option>").appendTo($("#prefecturalId"));
					}
				}
			}

		});
	}

	function loadDistrict(msg){
		$.ajax({
			url: "<?php echo site_url('/address/getDistrict');?>",
			type:"post",
			data:{"id":msg
		},
		dataType:'text',
		success:function(data)
		{
			var JSONObject = $.parseJSON(data);
			$("#districtId").empty();
			$("<option value='0'>请选择</option>").appendTo($("#districtId"))
			for (var key in JSONObject)
			{
				if (JSONObject.hasOwnProperty(key))
				{
					$("<option value='" + JSONObject[key]["districtId"] + "'>" + JSONObject[key]["districtName"]
						+ "</option>").appendTo($("#districtId"));}
				}
			}

		});
	}

</script>