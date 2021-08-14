
<?php
/**
 * Plugin Name:       hello Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       hello Plugin to exceute hello world in Wordpress.
 * Version:           1.00
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            David bui
 * Author URI:        https://facebook.com/sahilgulati007
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       crud-plugin
 */



//adding in menu
add_action('admin_menu', 'add_menu');
function add_menu() {
    //adding plugin in menu
    add_menu_page('Hello_World', //page title
        'Hello_World', //menu title nom de colonne
        'manage_options', //capabilities
        'Hello_World', //menu slug
        'Hello_World', //function
    );
    //adding submenu to a menu



}

// returns the root directory path of particular plugin

require_once ('Hello_World.php');
