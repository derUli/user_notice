<?php
class UserNoticeModule extends Controller {
	private $moduleName = "user_notice";
	public function uninstall() {
		$migrator = new DBMigrator ( $this->moduleName, ModuleHelper::buildModuleRessourcePath ( $this->moduleName, "migrations/down" ) );
		$migrator->rollback ();
	}
}
	
