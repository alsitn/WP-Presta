<?php 
/*
Plugin Name: WordPress-PrestaShop Cross Sales
Plugin URI: http://www.loginetsolutions.com/wp
Description: Display PrestaShop products within your WordPress Blog. You are welcomed with any suggestions or support and help requests at support@loginetsolutions.com Do not forget to <a target="_blank" href="http://wordpress.org/extend/plugins/wordpress-prestashop-cross-sales/">rate the plugin</a> if you like it. Thank you.
Author: Adrian Plopeanu
Version: 1.0.0
Author URI: http://www.loginetsolutions.com
*/

/*  Copyright 2011  Loginet Solutions  (email : info@loginetsolutions.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


//*************** Plugin functions ***************

function wppscs_links($links, $file) {
    static $this_plugin;
 
    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }
 
    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
        // the anchor tag and href to the URL we want. For a "Settings" link, this needs to be the url of your settings page
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=wp-prestashop-cs-db-admin">Settings</a> | <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7CNFQJXY45W28">Donate $5</a>';
        // add the link to the list
        array_unshift($links, $settings_link);
    }
 
    return $links;
}

function wppscs_getproducts($product_cnt=1) {
	//Connect to the PrestaShop database
	$PrestaShopdb = new wpdb(get_option('wppscs_dbuser'),get_option('wppscs_dbpwd'), get_option('wppscs_dbname'), get_option('wppscs_dbhost'));
	$prod_selection = get_option('wppscs_prod_sel'); // Product selection type: random or category
	
	$retval = '';
	
	if ($prod_selection == "random"){ //search whole database
	
		for ($i=0; $i<$product_cnt; $i++) {
			//Get a random product
			$product_count = 0;
			while ($product_count == 0) {
				$product_id = rand(0,30);
				$product_count = $PrestaShopdb->get_var("SELECT COUNT(*) FROM ps_product WHERE id_product=$product_id AND active=1");
			}
			
			//get size of image, default language, product selection type and category 
			$image_size = get_option('wppscs_prod_img_size'); //image size 
			$language = get_option('wppscs_ps_language');; //Prestashop language
			$category = get_option('wppscs_prod_category');;//select Prestashop category
			
			
			//Get product image, name and URL
			$product_name = $PrestaShopdb->get_var("SELECT name FROM ps_product_lang WHERE id_product=$product_id AND id_lang=$language");
			$store_url = get_option('wppscs_store_url');
			$image_folder = get_option('wppscs_prod_img_folder');

			$attribute_id = $PrestaShopdb->get_var('
            SELECT i.`id_image` FROM `ps_product` p
            LEFT JOIN `ps_product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.$language.')
            LEFT JOIN `ps_image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
            LEFT JOIN `ps_image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.$language.')
            WHERE p.`active` = 1
            AND p.`id_product` = '.$product_id.''
            );
			
			//$image_path = $image_folder . "/" . $product_id . "/" . $attribute_id . "/" . $product_id . $attribute_id. "-" . $image_size;
			$image_path = $image_folder . "/" . $product_id . "-" . $attribute_id . "-" . $image_size;
			//Build the HTML code
			$retval .= '<div class="wppscs_product">';
			$retval .= '<a href="'. $store_url . '/product.php?id_product=' . $product_id . '"><img src="' . $image_path . '.jpg" /></a><br />';
			$retval .= '<a href="'. $store_url . '/product.php?id_product=' . $product_id . '">' . $product_name . '</a>';
			$retval .= '</div>';
		}
	}else if ($prod_selection == "category"){ //search only one selected category
	
		for ($i=0; $i<$product_cnt; $i++) {
			
			//get size of image, default language, product selection type and category 
			$image_size = get_option('wppscs_prod_img_size'); //image size 
			$language = get_option('wppscs_ps_language');; //Prestashop language
			$category = get_option('wppscs_prod_category');;//select Prestashop category
			
			//Get a random product
			$product_count = 0;
			while ($product_count == 0) {
				$product_id = rand(0,30);
				$product_count = $PrestaShopdb->get_var("SELECT COUNT(*) FROM ps_product WHERE id_product=$product_id AND id_category_default=$category AND active=1");
			}
					
			//Get product image, name and URL
			$product_name = $PrestaShopdb->get_var("SELECT name FROM ps_product_lang WHERE id_product=$product_id AND id_lang=$language");
			$store_url = get_option('wppscs_store_url');
			$image_folder = get_option('wppscs_prod_img_folder');

			$attribute_id = $PrestaShopdb->get_var('
            SELECT i.`id_image` FROM `ps_product` p
            LEFT JOIN `ps_product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.$language.')
            LEFT JOIN `ps_image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
            LEFT JOIN `ps_image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.$language.')
            WHERE p.`active` = 1
            AND p.`id_product` = '.$product_id.''
            );
			
			//$image_path = $image_folder . "/" . $product_id . "/" . $attribute_id . "/" . $product_id . $attribute_id. "-" . $image_size;
			$image_path = $image_folder . "/" . $product_id . "-" . $attribute_id . "-" . $image_size;
			//Build the HTML code
			$retval .= '<div class="wppscs_product">';
			$retval .= '<a href="'. $store_url . '/product.php?id_product=' . $product_id . '"><img src="' . $image_path . '.jpg" /></a><br />';
			$retval .= '<a href="'. $store_url . '/product.php?id_product=' . $product_id . '">' . $product_name . '</a>';
			$retval .= '</div>';
		}		
	}
	
	return $retval;
}

//*************** Admin functions ***************
function wppscs_load_js(){
	$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', false, '1.4.2', true);
	wp_enqueue_script('jquery');
	wp_enqueue_script('wppscs_js_script', $plugindir . '/js/wppscs_js.js', array('jquery'), '1.0', true);
	echo "<link rel='stylesheet' href='$plugindir/css/style.css' type='text/css' />\n";
}
function wppscs_menu_link() {   

}
function wppscs_db_admin() {
	include('wp-prestashop-cs-db-admin.php');
}
function wppscs_ps_admin() {
	include('wp-prestashop-cs-ps-admin.php');
}
function wppscs_remove_options(){
	/* Deletes the database field. Clean up time. */
	delete_option('wppscs_dbhost');
	delete_option('wppscs_dbname');
	delete_option('wppscs_dbuser');
	delete_option('wppscs_dbpwd');
	delete_option('wppscs_store_url');
	delete_option('wppscs_prod_img_folder');
	delete_option('wppscs_prod_img_size');
	delete_option('wppscs_ps_language');
	delete_option('wppscs_prod_sel');
	delete_option('wppscs_prod_category');
}
function wppscs_admin_actions() {
	if (function_exists('add_menu_page')) {
		//plugin menu
		add_menu_page( __( 'WordPress-PrestaShop Cross Sales' ), __( 'PrestaShop CS' ), 'manage_options', 'wp-prestashop-cs-db-admin', 'wppscs_menu_link');
		add_submenu_page( 'wp-prestashop-cs-db-admin', __( 'Prestashop Database Settings' ), __( 'PS Database Config' ), 'manage_options', 'wp-prestashop-cs-db-admin', 'wppscs_db_admin' );
		$wppscs_ps_page = add_submenu_page( 'wp-prestashop-cs-db-admin', __( 'Prestashop Options Settings' ), __( 'PrestaShop Settings' ), 'manage_options', 'wp-prestashop-cs-ps-admin', 'wppscs_ps_admin' );				
		//show settings and donate link
		add_filter('plugin_action_links', 'wppscs_links', 10, 2);
		//load javascript and css
		add_action( "admin_print_scripts-$wppscs_ps_page", 'wppscs_load_js' );
	}	
}

add_action('admin_menu', 'wppscs_admin_actions');

/*
Delete all plugin options when uninstall the plugin
Runs on plugin deactivation only
*/
register_deactivation_hook( __FILE__, 'wppscs_remove_options' );

?>