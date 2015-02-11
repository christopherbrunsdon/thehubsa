<?php

defined('ABSPATH') or die("No script kiddies please!");

// Sources:
// http://codex.wordpress.org/Administration_Menus
// http://www.smashingmagazine.com/2011/11/03/native-admin-tables-wordpress/


//Our class extends the WP_List_Table class, so we need to make sure that it's there
if(!class_exists('WP_List_Table'))
{
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

require_once('admin_memberships.php');
require_once('admin_npos.php');

/*
 * Add my menus
 *
 */

add_action( 'admin_menu', 'admin_thehubsa_menu' );

function admin_thehubsa_menu() 
{
	$parent_slug = 'thehubsa-admin';
	$capability = 'manage_options';

	// main menu
	add_menu_page( 
		$page_title = 'TheHubSA Admin', // menu title
		$menu_title = 'TheHubSA',  // 
		$capability,
		$menu_slug = $parent_slug, 
		$function = 'admin_thehubsa_options',
		$icon_url = "",
		$position = 25.01 ); // below comments

	// submenus
	add_submenu_page( 
		$parent_slug, 
		$page_title = 'Manage NPOs', 
		$menu_title = 'NPOs', 
		$capability, 
		$menu_slug = "{$parent_slug}-npos", 
		$function = "admin_thehubsa_npos");	

	// submenus
	add_submenu_page( 
		$parent_slug, 
		$page_title = 'Landing Page Signups', 
		$menu_title = 'Signups', 
		$capability, 
		$menu_slug = "{$parent_slug}-signups", 
		$function = "admin_thehubsa_memberships");	
}

/**
 *
 */
function admin_thehubsa_options() {
	?>
	<div class="wrap">
		<h1>TheHubSA</h1>
	</div>

	<table>
		<tr>
			<td>
				<h2>Links</h2>
				<ul>
					<li><a href="">Manage NPOs</a></li>
					<li><a href="">Manage Signups</a></li>
				</ul>
			</td>
			<td width="50%">
				<img width="100%" src="<?php echo plugins_url('assets/images/logo-banner.png', __DIR__); ?>" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 *
 */
function admin_thehubsa_npos() 
{
	// NPOS
	echo '<div class="wrap"><p>TheHubSA NPOs</p></div>';

	//Prepare Table of elements
	$admin_npos = new Link_List_NPO_Table();
	$admin_npos->prepare_items();
	$admin_npos->display();
}

/**
 *
 */
function admin_thehubsa_memberships() 
{
	echo '<div class="wrap"><p>TheHubSA Signups</p></div>';

	//Prepare Table of elements
	$admin_memberships = new Link_List_Memberships_Table();
	$admin_memberships->prepare_items();
	$admin_memberships->display();
}


// [eof]