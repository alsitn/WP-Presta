=== WordPress-PrestaShop Cross Sales ===
Contributors: wpkey10
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7CNFQJXY45W28
Tags: ecommerce, e-commerce, prestashop, cross sale plugin, shopping cart
Requires at least: 3.2.1
Tested up to: 3.2.1
Stable tag: 1.0.0

Include PrestaShop products on your WordPress website. PrestaShop (http://www.prestashop.com) is an ecommerce Open Source solution. 


== Description ==

Include **[PrestaShop](http://www.prestashop.com "an open source e-commerce solution")** products to your blog posts or side bar.

IMPORTANT: In order this plugin to work you NEED TO HOST PrestaShop ON THE SAME SERVER or ALLOW MySQL TO CONNECT REMOTELY.

Please do not rate the plugin 1 or 2 stars. Ask us for support and help at support@loginetsolutions.com 

Some functionalities :

* configure the URL and the database of your PrestaShop installation
* chose the product image sizes (PrestaShop sizes)
* chose the Prestashop default store language so, the product description will match your store language
* configure product selection: from a chosen category or random from the whole database


== Installation ==

1. Upload the folder `wordpress-prestashop-cross-sales` to the `/wp-content/plugins/` directory
1. Activate the plugin through the `Plugins` menu in WordPress
1. Click on Settings and configure your WordPress-PrestaShop Cross Sales Plugin 
1. Copy and paste `<?php echo wppscs_getproducts(3); ?>` in your theme files (e.g.: sidebar.php, loop.php, single.php)


== Frequently Asked Questions ==

= What PrestaShop version is compatible with WP-PrestaShop Cross Sales Plugin? =

We have start the development with PrestaShop 1.4.4.0

= There is a widget version of this plugin? =

Not yet. We are planning to make it.

= Can I include my PrestaShop header and footer on my blog? =

Not yet. We are still working on this.

= My WordPress website give me an error or doesn't load or is partially loaded. Why? =

Please check your settings. If everything is looking round and square than you can't access your PrestaShop database or your PrestaShop database can't be accessed remotely. 
Check with your hosting provider. Within Godaddy share accounts you have to allow remote access when you create the PrestaShop database. 
Within your own dedicated server you can allow remote MySQL access within cPanel and root account.

= Can I use the plugin if my table prefixes are not the default (`_ps`) of PrestaShop? =

If you know how, you can update the plugin by yourself: replace in all files the term "_ps" with your table prefix  (e.g.: "_presta") using a Notepad text editor.
We'll give you the option to change the table prefix in the next release of the plugin.

= All works fine but I can't see the product images. Why? =

Check the image path. We supposed you don't modify the default PrestaShop installation and the images are stored as by PrestaShop style.
E.g.: http://yourwebsite.com/img/p/1-5-home.jpg 
Try to open in your browser an url like the one in example. 
If you don't see anything, than you are using Prestashop 1.4.2 or higher. In this case (1.4.3 or higher) the image path has changed in PrestaShop
to http://yourwebsite.com/img/p/1/5/15-home.jpg 
You can modify wp-prestashop-cs.php file from
$image_path = $image_folder . "/" . $product_id . "-" . $attribute_id . "-" . $image_size;
to
$image_path = $image_folder . "/" . $product_id . "/" . $attribute_id . "/" . $product_id . $attribute_id. "-" . $image_size;


== Screenshots ==

1. Configure the plugin: Prestashop database
2. Configure the plugin: Prestashop settings
3. See the result! Just an example with default theme.

== Changelog ==

= 1.0.0 =
- First stable version.

== Upgrade Notice ==

= 1.0.0 =
- First stable version.