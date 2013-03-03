<?php 
	require("wp-prestashop-cs-db-connect.php"); //require Prestashop database connection
	
	if(isset($_POST['wppscs_hidden']) && ($_POST['wppscs_hidden'] == 'Y')) {
		//Form data sent
		$store_url = $_POST['wppscs_store_url'];
		update_option('wppscs_store_url', $store_url);

		$prod_img_folder = $_POST['wppscs_prod_img_folder'];
		update_option('wppscs_prod_img_folder', $prod_img_folder);
	
		$wppscs_prod_img_size = $_POST['wppscs_prod_img_size'];
		update_option('wppscs_prod_img_size', $wppscs_prod_img_size);

		$wppscs_ps_language = $_POST['wppscs_ps_language'];
		update_option('wppscs_ps_language', $wppscs_ps_language);

		$wppscs_prod_sel = $_POST['wppscs_prod_sel'];
		update_option('wppscs_prod_sel', $wppscs_prod_sel);

		$wppscs_prod_category = $_POST['wppscs_prod_category'];
		update_option('wppscs_prod_category', $wppscs_prod_category);		
		?>
		<div class="updated"><p><strong><?php _e('PrestaShop Options saved.' ); ?></strong></p></div>
		<?php		
	} else {
			//Normal page display
			$store_url = get_option('wppscs_store_url');
			$prod_img_folder = get_option('wppscs_prod_img_folder');
			$wppscs_prod_img_size = get_option('wppscs_prod_img_size');
			$wppscs_ps_language = get_option('wppscs_ps_language');
			$wppscs_prod_sel = get_option('wppscs_prod_sel');
			$wppscs_prod_category = get_option('wppscs_prod_category');
			
	}
	
?>

<div class="wrap">
<?php    echo "<h2>" . __( 'WordPress-PrestaShop Cross Sales Plugin Options', 'wppscs_trdom' ) . "</h2>"; ?>

<form id="wppscs_form" name="wppscs_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="wppscs_hidden" value="Y">
	<?php    echo "<h3>" . __( 'PrestaShop Store Settings', 'wppscs_trdom' ) . "</h3>"; ?>
	<p><?php _e("Store URL: " ); ?><input type="text" name="wppscs_store_url" value="<?php echo $store_url; ?>" size="40"><?php _e(" e.g.: http://www.yourstore.com/ [Add / after .com]" ); ?></p>
	<p><?php _e("Product image folder: " ); ?><input type="text" name="wppscs_prod_img_folder" value="<?php echo $prod_img_folder; ?>" size="40"><?php _e(" e.g.: http://www.yourstore.com/img/p [No / after p]" ); ?></p>

	<p><?php _e("Product image size: " ); ?>
	<select name="wppscs_prod_img_size">
		<option <?php echo ($wppscs_prod_img_size == "small") ? " selected='selected' " : "" ?> value="small">Small 45 x 45 px</option>
		<option <?php echo ($wppscs_prod_img_size == "medium") ? " selected='selected' " : "" ?> value="medium">Medium 80 x 80 px</option>
		<option <?php echo ($wppscs_prod_img_size == "home") ? " selected='selected' " : "" ?> value="home">Home 129 x 129 px</option>
		<option <?php echo ($wppscs_prod_img_size == "large") ? " selected='selected' " : "" ?> value="large">Large 300 x 300 px</option>
		<option <?php echo ($wppscs_prod_img_size == "thickbox") ? " selected='selected' " : "" ?> value="thickbox">Thickbox 600 x 600 px</option>		
	</select><?php _e(" Set Image Size " ); ?></p>
	
	<p><?php _e("Prestashop default language: " ); ?> 

	<select name="wppscs_ps_language">
<?php //Get the languages from PrestaShop database
	$sql = "SELECT id_lang, name FROM ps_lang";
	$result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) {
?>
		<option <?php echo ($wppscs_ps_language == $row['id_lang']) ? " selected='selected' " : "" ?> value="<?php echo $row['id_lang'];?>"><?php echo $row['name']?></option>
<?php	
}	
?>
	</select>
	<?php _e(" Set your Prestashop Default Language" ); ?></p>
	
	<p><?php _e("Select product from: " ); ?>

	<select id="wppscs_prod_sel" name="wppscs_prod_sel" onchange="javascript:slideone('Category_name');">
		<option <?php echo ($wppscs_prod_sel == "random") ? " selected='selected' " : "" ?> value="random">whole database</option>	
		<option <?php echo ($wppscs_prod_sel == "category") ? " selected='selected' " : "" ?> value="category">one category</option>
	</select>	
	<?php _e(" From One Category or Random from Whole Database" ); ?></p>	
	<div id="Category_name" name="Category_name" style="<?php echo ($wppscs_prod_sel == "category") ? " display: inline; " : " display: none; " ?>"><?php _e("Category name: " ); ?><input type="text" id="wppscs_prod_category" name="wppscs_prod_category" value="<?php echo $wppscs_prod_category; ?>" size="20"><?php _e(" Set to Category ID e.g.: 2" ); ?></div>	
	

	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Update Options', 'wppscs_trdom' ) ?>" />
	</p>
</form>
</div>