<?php
$migrator = new DBMigrator ( "user_notice", ModuleHelper::buildModuleRessourcePath ( "user_notice", "migrations/up" ) );
$migrator->migrate ();
