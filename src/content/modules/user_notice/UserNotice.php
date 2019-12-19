<?php

class UserNotice extends Controller {

    private $moduleName = "user_notice";

    public function uninstall() {
        $migrator = new DBMigrator($this->moduleName, ModuleHelper::buildModuleRessourcePath($this->moduleName, "migrations/down"));
        $migrator->rollback();
    }

    public function accordionLayout() {
        echo Template::executeModuleTemplate($this->moduleName, "dashboard.php");
    }

    public function save() {
        $acl = new ACL ();
        if (Request::getMethod() != "post" or ! is_logged_in() or ! $acl->hasPermission("user_notice")) {
            Request::redirect(ModuleHelper::buildActionURL("edit_notice"));
        }
        $notes = StringHelper::isNotNullOrWhitespace(Request::getVar("my_notes", "")) ? Request::getVar("my_notes", "") : null;

        $user = new UserNoticeData(get_user_id());
        $user->setNotice($notes);
        $user->save();
        // @TODO: Speichern implementieren
        Request::redirect(ModuleHelper::buildActionURL("home", "tab=notes"));
    }

}
