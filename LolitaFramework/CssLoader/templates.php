<?php
use \datagenerator\LolitaFramework\Core\View;

if (!function_exists('lolitaCssLoaderTemplates')) {

    /**
     * Add Loader templates
     *
     * @author Guriev Eugen <gurievcreative@gmail.com>
     */
    function lolitaCssLoaderTemplates()
    {
        echo View::make(__DIR__ . DS . 'views' . DS . 'lf_css_loader.php');
    }
    add_action('wp_footer', 'lolitaCssLoaderTemplates');
    add_action('admin_footer', 'lolitaCssLoaderTemplates');
    add_action('login_footer', 'lolitaCssLoaderTemplates');
}
