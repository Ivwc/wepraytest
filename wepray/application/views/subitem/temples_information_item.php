
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#information" aria-controls="home" role="tab" data-toggle="tab">庙宇资讯待審核清單  <span class="badge"><?php echo countAllInfoModify();?></span></a></li>
	<li role="presentation"><a href="#map" aria-controls="profile" role="tab" data-toggle="tab">行政區變更待審核清單  <span class="badge"><?php echo countAllMapModify();?></span></a></li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="information">
		<br />
		<?php loadView('subitem/temples_info_modify_item');?>
	</div>
	<div role="tabpanel" class="tab-pane" id="map">
		<br />
		<?php loadView('subitem/temples_map_modify_item');?>
	</div>
</div>