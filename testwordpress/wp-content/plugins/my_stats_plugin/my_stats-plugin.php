
<?php
/**
 * Plugin Name:       my_stats Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       my_stats Plugin 
 * Version:           1.00
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            david
 * Author URI:        https://facebook.com/sahilgulati007
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my_stats-plugin
 */



//adding in menu
add_action('admin_menu', 'my_stats_function');
function my_stats_function() {
    //adding plugin in menu
    add_menu_page('my_stats', //page title
        'my_stats', //menu title nom de colonne
        'manage_options', //capabilities
        'my_stats', //menu slug
        'my_stats', //function
    );
    //adding submenu to a menu

    
   
}

// returns the root directory path of particular plugin

require_once ('my_stats.php');