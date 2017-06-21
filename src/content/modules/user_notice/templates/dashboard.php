<?php
$acl = new ACL ();
if ($acl->hasPermission ( "user_notice" )) {
	$user = new UserNoticeData ( get_user_id () );
	$note = trim ( strip_tags ( $user->getNotice (), UserNoticeData::allowableTags ) );
	?>

<h2 class="accordion-header"><?php translate("my_notes");?></h2>
<div class="accordion-content">
<?php
	if (strlen ( $note ) > 0) {
		echo $note;
	}
	?><br />
	<br />
	<p>
		[<a href="#"><?php translate("edit");?></a>]
	</p>
</div>
<?php }?>