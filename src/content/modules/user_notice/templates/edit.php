<?php
$acl = new ACL();
if ($acl->hasPermission("user_notice")) {
    $user = new UserNoticeData(get_user_id());
    $note = $user->getNotice() ? strip_tags($user->getNotice(), UserNoticeData::allowableTags) : "";
    ?>
	<p>
	<a href="<?php echo ModuleHelper::buildActionUrl("home");?>" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> <?php translate("back");?></a>
	</p>
<h2><?php translate("my_notes");?></h2>
<form
	action="<?php Template::escape(ModuleHelper::buildActionURL("edit_notice", "sClass=UserNotice&sMethod=save&tab=notes"));?>"
	method="post">
	<p>
		<textarea name="my_notes" id="my_notes" rows="20"><?php Template::escape($note);?></textarea>
	</p>
	<p>
		<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> <?php translate("save");?></button>
	</p>
	<?php csrf_token_html();?>
	<!-- CKEditor oder CodeMirror für Textarea starten -->
	<script type="text/javascript">
	<?php
    switch ($user->getHTMLEditor()) {
        case "codemirror":
            ?>
			CodeMirror.fromTextArea(document.getElementById("my_notes"),

					{lineNumbers: true,
					        matchBrackets: true,
					        mode : "text/html",

					        indentUnit: 0,
					        indentWithTabs: false,
					        enterMode: "keep",
					        tabMode: "shift"});
			<?php
            break;
        case "ckeditor":
        default:
            ?>
		
CKEDITOR.replace( 'my_notes',
					{
						skin : '<?php
            
            echo Settings::get("ckeditor_skin");
            ?>'
					});<?php
            break;
            break;
    }
    ?>
</script>
</form>
<?php
} else {
    noperms();
}