<?php
class UserNotice extends Controller {
	private $moduleName = "user_notice";
	public function uninstall() {
		$migrator = new DBMigrator ( $this->moduleName, ModuleHelper::buildModuleRessourcePath ( $this->moduleName, "migrations/down" ) );
		$migrator->rollback ();
	}
	public function accordionLayout() {
		echo Template::executeModuleTemplate ( $this->moduleName, "dashboard.php" );
	}
	public function save() {
		// @TODO: Speichern implementieren
		Request::redirect ( ModuleHelper::buildActionURL ( "home", "tab=notes" ) );
	}
}
	
