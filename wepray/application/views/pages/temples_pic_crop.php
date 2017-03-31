<?php loadView('templates/temples_pic_crop_header');?>
<?php loadView('mainframe/navbar');?>

<div id="wrapper">
	<?php loadView('mainframe/functionList');?>
	<div id="page-content-wrapper">
		<div class="container-fluid">

			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 建议宽度为600
			</div>
			<img id="target" src="<?php echo getAssetImagePath().$templePicUrl;?>?<?php echo time();?>">
			<br/>
			<span id="range"></span>
			<br/>
			<br/>
			<button class="btn btn-success btn-lg" id="cropBt" onclick="submitCrop();">切割</button>
		</div>
		<input type="hidden" class="input" size="6" id="x1" name="x1" />
		<input type="hidden" class="input" size="6" id="y1" name="y1" />
		<input type="hidden" class="input" size="6" id="x2" name="x2" />
		<input type="hidden" class="input" size="6" id="y2" name="y2" />
		<input type="hidden" class="input" size="6" id="w" name="w" />
		<input type="hidden" class="input" size="6" id="h" name="h" />
	</div>
</div>
<?php loadView('templates/footer');?>
<script type="text/javascript">
	var img = document.getElementById('target'); 
	var range = document.getElementById('range'); 
	var width = img.clientWidth;
	var height = img.clientHeight;
	if(img) {
		img.style.width = 600;
	}
	var width_new = img.clientWidth;
	var height_new = img.clientHeight;
	var radio=width/width_new;
	var radio2=height/height_new;
	jQuery(function($){
		var jcrop_api;
		initJcrop();
		function initJcrop()
		{
			$('#target').Jcrop({
				allowSelect: false,
				allowMove: true,
				allowResize:true,
				aspectRatio: 4/3,
				minSize: [100, 100],
				onChange: showCoords,
				onSelect: showCoords,
				onRelease: clearCoords
			},function(){
				jcrop_api = this;
				jcrop_api.animateTo([0, 0, 400, 300]);
			});
			$('#coords').on('change','input',function(e){
				var x1 = $('#x1').val(),
				x2 = $('#x2').val(),
				y1 = $('#y1').val(),
				y2 = $('#y2').val();

				jcrop_api.setSelect([x1, y1, x2, y2]);
			});
		};
	});
	function showCoords(c){
		$('#x1').val(Math.round(c.x*radio));
		$('#y1').val(Math.round(c.y*radio2));
		$('#x2').val(Math.round(c.x2*radio));
		$('#y2').val(Math.round(c.y2*radio2));
		$('#w').val(Math.round(c.w*radio));
		$('#h').val(Math.round(c.h*radio2));
		var x_axis=document.getElementById('x1').value; 
		var y_axis=document.getElementById('y1').value; 
		var x_axis2=document.getElementById('x2').value; 
		var y_axis2=document.getElementById('y2').value; 
		var width=document.getElementById('w').value; 
		var height=document.getElementById('h').value; 
		range.innerHTML="切割范围从("+x_axis+","+y_axis+")至("+x_axis2+","+y_axis2+")总宽高为"+width+"/"+height;
	};
	function clearCoords(){
		$('#coords input').val('');
	};

	function b64toBlob(b64Data, contentType, sliceSize) {
		contentType = contentType || '';
		sliceSize = sliceSize || 512;

		var byteCharacters = atob(b64Data);
		var byteArrays = [];
		for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
			var slice = byteCharacters.slice(offset, offset + sliceSize);

			var byteNumbers = new Array(slice.length);
			for (var i = 0; i < slice.length; i++) {
				byteNumbers[i] = slice.charCodeAt(i);
			}

			var byteArray = new Uint8Array(byteNumbers);

			byteArrays.push(byteArray);
		}
		var blob = new Blob(byteArrays, {type: contentType});
		return blob;
	}
	function submitCrop(){
		var x_axis=document.getElementById('x1').value; 
		var y_axis=document.getElementById('y1').value; 
		var width=document.getElementById('w').value; 
		var height=document.getElementById('h').value; 
		alertify.confirm('你确定要切割选取的区域吗？一但切割就不能回复', function (e) {  
			if (e) {  
				$.ajax({
					url: "<?php echo site_url('/picupload_temples/crop');?>",
					type:"post",
					data:{"id":<?php echo $templeId;?>,"url":"<?php echo getAssetImage().$templePicUrl;?>","x_axis":x_axis,"y_axis":y_axis,"width":width,"height":height},
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
	function submitRotate(){
		$.ajax({
			url: "<?php echo site_url('/picupload_temples/rotate');?>",
			type:"post",
			data:{"id":<?php echo $templeId;?>,"url":"<?php echo getAssetImage().$templePicUrl;?>","angle":'90'},
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


