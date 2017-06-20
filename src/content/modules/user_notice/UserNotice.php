<?php
class UserNotice extends Controller {
	private $moduleName = "user_notice";
	public function uninstall() {
		$migrator = new DBMigrator ( $this->moduleName, "lib/updates/down" );
		$migrator->rollback ();
	}
}
	
