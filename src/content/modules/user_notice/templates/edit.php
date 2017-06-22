<?php
$acl = new ACL ();
if ($acl->hasPermission ( "user_notice" )) {
	
	?>
<form action="#" method="post">
	<p>
		<textarea></textarea>
	</p>
	<p>
		<input type="submit" value="<?php translate("save");?>">
	</p>
</form>
<?php
} else {
	noperms ();
}