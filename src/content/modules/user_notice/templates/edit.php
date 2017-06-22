<?php
$acl = new ACL ();
if ($acl->hasPermission ( "user_notice" )) {
	
	?>Not implemented yet.
		<?php
} else {
	noperms ();
}