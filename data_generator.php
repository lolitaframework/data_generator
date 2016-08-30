<?php
/*
Plugin Name: Data generator
Plugin URI: https://lolitaframework.com/
Description: Provides multiple example posts, pages, categories, tags, custom terms to assist with styling and developing new and current themes.
Version: 1.0
Author: Guriev Eugen
Author URI: https://lolitaframework.com/
License: GPLv2 or later
Text Domain: data_generator
*/
// ==============================================================
// Bootstraping
// ==============================================================
if (! class_exists('\data_generator\LolitaFramework')) {
    require_once 'LolitaFramework/LolitaFramework.php';
}
$lolita_framework = \data_generator\LolitaFramework::getInstance();
$lolita_framework->addModule('Configuration');
$lolita_framework->addModule('CssLoader');
$lolita_framework->addModule('Generator');
