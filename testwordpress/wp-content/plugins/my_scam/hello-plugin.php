
<?php
/**
 * Plugin Name:       my_scam plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       my_scam Plugin to send mail
 * Version:           1.00
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Tim
 * Text Domain:       crud-plugin
 */



//adding in menu
add_action('admin_menu', 'add_menu_scam');
function add_menu_scam() {
    //adding plugin in menu
    add_menu_page('my_scam', //page title
        'my_scam', //menu title nom de colonne
        'manage_options', //capabilities
        'my_scam', //menu slug
        'my_scam', //function
    );
    //adding submenu to a menu



}

// returns the root directory path of particular plugin

require_once ('Hello_World.php');
