<?php
function runSQL($rsql) { //get options
	$dbhost = get_option('wppscs_dbhost');
	$dbname = get_option('wppscs_dbname');
	$dbuser = get_option('wppscs_dbuser');
	$dbpwd = get_option('wppscs_dbpwd');
	$dbcnx = @mysql_connect($dbhost,$dbuser,$dbpwd,true);
	if (!$dbcnx) {
		echo '</select><p>Unable to connect to the database server at this time. Please check your <a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=wp-prestashop-cs-db-admin">PrestaShop database settings</a>.</p>';
		exit();
	}

	mysql_select_db($dbname, $dbcnx);
	mysql_set_charset('utf8',$dbcnx); 
	$result = mysql_query($rsql) or die ('</select><p>Unable to query the database. Please check your <a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=wp-prestashop-cs-db-admin">PrestaShop database settings</a>.</p>');
	return $result;
	mysql_close($connect);
}

//TO DO: get all PrestaShop values to populate dropdown lists (languages, image sizes) and save them to wordpress options (array)
//Add these options when install the plugin and delete these options when uninstall the plugin

?>

