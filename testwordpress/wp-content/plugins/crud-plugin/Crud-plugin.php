
<?php
/**
 * Plugin Name:       CRUD Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Crud
 * Version:           1.00
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            David
 * Author URI:        https://facebook.com/sahilgulati007
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       crud-plugin
 */



//adding in menu
add_action('admin_menu', 'at_try_menu');
function at_try_menu() {
    //adding plugin in menu
    add_menu_page('employee_list', //page title
        'Employee Listing', //menu title nom de colonne
        'manage_options', //capabilities
        'Employee_Listing', //menu slug
        //employee_list() //function
    );
    //adding submenu to a menu

    add_submenu_page('Employee_Listing',//parent page slug
        'email_insert',//page title
        'email insert',//menu titel   ici nom de colonne
        'manage_options',//manage optios
        'email_insert',//slug
        'email_insert'//function
    );
    add_submenu_page('Employee_Listing',//parent page slug
        'list_user',//page title
        'list_user',//menu titel   ici nom de colonne
        'manage_options',//manage optios
        'list_user',//slug
        'list_user'//function
    );
    add_submenu_page( '',//parent page slug
        'employee_update',//$page_title
        'employee_update',// $menu_title
        'manage_options',// $capability
        'employee_update',// $menu_slug,
        'employee_update'// $function
    );
    add_submenu_page( 'Employee_Listing',//parent page slug
        'create_quizz',//$page_title
        'create_quizz',// $menu_title
        'manage_options',// $capability
        'create_quizz',// $menu_slug,
        'create_quizz'// $function
    );
    add_submenu_page( 'Employee_Listing',//parent page slug
        'read_quizz',//$page_title
        'read_quizz',// $menu_title
        'manage_options',// $capability
        'read_quizz',// $menu_slug,
        'read_quizz'// $function
    );
    add_submenu_page( '',//parent page slug
        'quizz_update',//$page_title
        'quizz_update',// $menu_title
        'manage_options',// $capability
        'quizz_update',// $menu_slug,
        'quizz_update'// $function
    );
}

// returns the root directory path of particular plugin
define('ROOTDIR', plugin_dir_path(__FILE__));

require_once(ROOTDIR . 'employee_list.php');
require_once (ROOTDIR.'email_insert.php');
require_once (ROOTDIR.'list_user.php');
require_once (ROOTDIR.'employee_update.php');
require_once (ROOTDIR.'create_quizz.php');
require_once (ROOTDIR.'read_quizz.php');
require_once (ROOTDIR.'quizz_update.php');
?>
