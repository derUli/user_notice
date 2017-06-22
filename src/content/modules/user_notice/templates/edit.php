<?php
$acl = new ACL ();
if ($acl->hasPermission ( "user_notice" )) {
	$user = new UserNoticeData ( get_user_id () );
	$note = $user->getNotice () ? strip_tags ( $user->getNotice (), UserNoticeData::allowableTags ) : "";
	?>
<form
	action="<?php Template::escape(ModuleHelper::buildActionURL("home", "sClass=UserNotice&sMethod=save&tab=notes"));?>"
	method="post">
	<p>
		<textarea name="my_notes" id="my_notes"><?php Template::escape($note);?></textarea>
	</p>
	<p>
		<input type="submit" value="<?php translate("save");?>">
	</p>
	<?php csrf_token_html();?>
	<!-- @TODO: CKEditor oder CodeMirror für Textarea starten -->
</form>
<?php
} else {
	noperms ();
}