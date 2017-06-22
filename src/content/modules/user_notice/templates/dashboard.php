<?php
$acl = new ACL ();
if ($acl->hasPermission ( "user_notice" )) {
	$user = new UserNoticeData ( get_user_id () );
	$note = $user->getNotice () ? strip_tags ( $user->getNotice (), UserNoticeData::allowableTags ) : "";
	?><h2 class="accordion-header" id="tab-notes"><?php translate("my_notes");?></h2>
<div class="accordion-content">
<?php
	if (StringHelper::isNotNullOrWhitespace ( $note )) {
		echo $note;
		?><br /> <br />
	<?php }?>
	<p>
		[<a
			href="<?php Template::escape(ModuleHelper::buildActionURL("edit_notice"))?>"><?php translate("edit");?></a>]
	</p>
</div>
<?php if(Request::getVar("tab") == "notes"){?>
<script type="text/javascript">$(function(){$("#tab-notes").click();});</script>
<?php }?>
<?php }?>