
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#info_apply" aria-controls="home" role="tab" data-toggle="tab">交友资料待审核清单  <span class="badge"><?php echo countAllFriendsApply();?></span></a></li>
	<li role="presentation"><a href="#pic_modify" aria-controls="profile" role="tab" data-toggle="tab">个人图片待审核清单  <span class="badge"><?php echo countAllFriendsPicModify();?></span></a></li>
	<li role="presentation"><a href="#ban" aria-controls="profile" role="tab" data-toggle="tab">检举待审核清单  <span class="badge"><?php echo countAllFriendsBan();?></span></a></li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="info_apply">
		<br />
		<?php loadView('subitem/friends_verify_account');?>
	</div>
	<div role="tabpanel" class="tab-pane" id="pic_modify">
		<br />
		<?php loadView('subitem/friends_verify_pic');?>
	</div>
	<div role="tabpanel" class="tab-pane" id="ban">
		<br />
		<?php loadView('subitem/friends_ban_account');?>
	</div>
</div>
