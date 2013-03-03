<?php 
	if(isset($_POST['wppscs_hidden']) && ($_POST['wppscs_hidden'] == 'Y')) {
		//Form data sent
		$dbhost = $_POST['wppscs_dbhost'];
		update_option('wppscs_dbhost', $dbhost);
		
		$dbname = $_POST['wppscs_dbname'];
		update_option('wppscs_dbname', $dbname);
		
		$dbuser = $_POST['wppscs_dbuser'];
		update_option('wppscs_dbuser', $dbuser);
		
		$dbpwd = $_POST['wppscs_dbpwd'];
		update_option('wppscs_dbpwd', $dbpwd);
	
		?>
		<div class="updated"><p><strong><?php _e('Database options saved.' ); ?></strong></p></div>
		<?php
	} else {
		//Normal page display
		$dbhost = get_option('wppscs_dbhost');
		$dbname = get_option('wppscs_dbname');
		$dbuser = get_option('wppscs_dbuser');
		$dbpwd = get_option('wppscs_dbpwd');
	}
	
?>

<div class="wrap">
<?php    echo "<h2>" . __( 'WordPress-PrestaShop Cross Sales Plugin Options', 'wppscs_trdom' ) . "</h2>"; ?>

<form name="wppscs_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="wppscs_hidden" value="Y">
	<?php    echo "<h3>" . __( 'PrestaShop Database Settings', 'wppscs_trdom' ) . "</h3> Please update these database settings first."; ?>
	<p><?php _e("Database host: " ); ?><input type="text" name="wppscs_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" e.g.: localhost" ); ?></p>
	<p><?php _e("Database name: " ); ?><input type="text" name="wppscs_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" e.g.: PrestaShop_shop" ); ?></p>
	<p><?php _e("Database user: " ); ?><input type="text" name="wppscs_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" e.g.: root" ); ?></p>
	<p><?php _e("Database password: " ); ?><input type="text" name="wppscs_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" e.g.: secretpassword" ); ?></p>
	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Update Database Options', 'wppscs_trdom' ) ?>" />
	</p>
</form>
</div>