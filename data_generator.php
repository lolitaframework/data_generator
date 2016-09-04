<?php
/*
Plugin Name: Data generator
Plugin URI: https://lolitaframework.com/
Description: Data Generator is a WordPress plugin that allows a WordPress developer to create demo data. Provides multiple example posts, pages, custom terms to assist with styling and developing new and current themes. Based on Lolita Framework.
Version: 1.0
Author: Guriev Eugen
Author URI: https://lolitaframework.com/
License: GPLv2 or later
Text Domain: data_generator
*/
// ==============================================================
// Bootstraping Lolita Framework 1.0
// ==============================================================
if (! class_exists('\data_generator\LolitaFramework')) {
    require_once 'LolitaFramework/LolitaFramework.php';
}
$lolita_framework = \data_generator\LolitaFramework::getInstance();
$lolita_framework->addModule('Configuration');
$lolita_framework->addModule('CssLoader');
$lolita_framework->addModule('Generator');
