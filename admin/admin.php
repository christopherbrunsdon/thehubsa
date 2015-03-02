<?php

//defined('ABSPATH') or die("No script kiddies please!");

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
//require_once('admin_services_types.php');

/**
 * Slugs
 *
 */

define('THEHUBSA_ADMIN_SLUG', "thehubsa-admin");
define('THEHUBSA_ADMIN_NPOS_SLUG', "thehubsa-admin-npos");
define('THEHUBSA_ADMIN_SIGNUPS_SLUG', "thehubsa-admin-signups");
define('THEHUBSA_ADMIN_NPO_SERVICE_TYPES_SLUG', "thehubsa-admin-npo-services");

/**
 * Toolbar node
 */

// look at adding link in tool bar.

// eg: edit NPO while viewing it.

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
		$menu_slug = THEHUBSA_ADMIN_SLUG, 
		$function = 'admin_thehubsa_options',
		$icon_url = "",
		$position = 25.01 ); // below comments

	// submenus
	add_submenu_page( 
		$parent_slug, 
		$page_title = 'Manage NPOs', 
		$menu_title = 'NPOs', 
		$capability, 
		$menu_slug = THEHUBSA_ADMIN_NPOS_SLUG, 
		$function = "thehubsa_admin_crud_npos");	

	// submenus
	add_submenu_page( 
		$parent_slug, 
		$page_title = 'Landing Page Signups', 
		$menu_title = 'Signups', 
		$capability, 
		$menu_slug = THEHUBSA_ADMIN_SIGNUPS_SLUG, 
		$function = "thehubsa_admin_crud_memberships");

    // submenus
    add_submenu_page(
        $parent_slug,
        $page_title = 'Npo Services',
        $menu_title = 'Npo Services',
        $capability,
        $menu_slug = THEHUBSA_ADMIN_NPO_SERVICE_TYPES_SLUG,
        $function = "thehubsa_admin_npo_service_types");

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
					<li><a href="<?php echo admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG); ?>">Manage NPOs</a></li>
					<li><a href="<?php echo admin_url("admin.php?page=".THEHUBSA_ADMIN_SIGNUPS_SLUG); ?>">Manage Signups</a></li>
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
function thehubsa_admin_crud_npos() 
{
	echo '<div class="wrap"><h1>TheHubSA NPOs</h1>';

	$action = filter_input(INPUT_GET, 'action');
	$npo_id = filter_input(INPUT_GET, 'id');
	$filter = filter_input(INPUT_GET, 'filter');

	switch(strtolower($action)) 
	{
		case 'view':
			echo "<h2><a class='add-new-h2' href='".admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG)."'><- Back to list</a></h2>";

			$npo = model_thehub_npos::get_by_id($npo_id);

			if(empty($npo)) {
				echo "<div>Error: Id {$npo_id} not found</div>";
			} else {
				require(plugin_dir_path( __FILE__ )."../views/admin/npo_view.php");
			}
			break;

		case 'preview':
			echo "<h2>Preview <a class='add-new-h2' href='".admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG."&id={$npo_id}&action=view")."'><- Back</a></h2>";

			$npo = model_thehub_npos::get_by_id($npo_id);
			if(empty($npo)) {
				echo "<div>Error: Id {$npo_id} not found</div>";
			} else {
				require(plugin_dir_path( __FILE__ )."../views/lists/listing-npo.php");
			}
			break;

		case 'edit':
			$npo = model_thehub_npos::get_by_id($npo_id);

			if(empty($npo)) {
				echo "<div>Error: Id {$npo_id} not found</div>";
			} else {
				$form = new form_npo($npo);
				$form->show_banking = false;
                $form->shortcode();
				require(plugin_dir_path( __FILE__ )."../views/admin/npo_edit.php");
			}
			break;

		case 'activate':
		case 'deactivate':
			$npo = model_thehub_npos::get_by_id($npo_id);
			
			if(empty($npo)) {
				echo "<div>Id {$npo_id} not found</div>";
			} else {
				$npo->set_active((bool)($action === 'activate'));
				echo "<div>NPO <strong>{$npo}</strong> is now <strong>".($npo->is_active()?'Active':'Deactive')."</strong>";
				echo "</div>";

				echo "<ul>";
				echo "<li><a href='".admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG)."&id={$npo->id}&action=view'>View NPO {$npo}</a></li>";
				echo "<li><a href='".admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG)."'>View NPO list</a></li>";
				echo "</ul>";
			}
			break;

		default:
			$admin_npos = new Link_List_NPO_Table();
			$admin_npos->set_base_url(admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG));
			$admin_npos->set_npo_filter($filter);
			$admin_npos->prepare_items();
			$admin_npos->display();
	}
	echo '</div>';
}

/**
 *
 */
function thehubsa_admin_crud_memberships() 
{
	echo '<div class="wrap"><p>TheHubSA Signups</p></div>';

	//Prepare Table of elements
	$admin_memberships = new Link_List_Memberships_Table();
	$admin_memberships->prepare_items();
	$admin_memberships->display();
}

/**
 *
 */
function thehubsa_admin_npo_service_types()
{
    echo "<h1>NPO Services</h1>";

    if($id = filter_input(INPUT_GET, 'active_change')) {
        $nst = model_thehub_npo_service_types::get_by_id($id);
        if($nst) {
            $nst->set_active(!$nst->is_active());
        }
    }

    global $wpdb;
    $sql="SELECT * FROM ".model_thehub_npo_service_types::get_table_name()
        ." ORDER BY id ";

//    echo $sql;

    echo "<table>";
    $header=False;
    foreach($wpdb->get_results($sql, ARRAY_A) as $row) {
        if(!$header) {
            echo "<trv><td>Actions</td><td>"
                .implode(array_keys($row), "</td><td>")
                ."</td></tr>";
            $header=True;
        }
        echo "<tr>"
            ."<td><a href='".admin_url("admin.php?page=".THEHUBSA_ADMIN_NPO_SERVICE_TYPES_SLUG."&active_change=".$row['id'])."'>Active</a></td>"
            ."<td>"
            .implode($row, "</td><td>")."</td>";

        echo "</tr>";
    }
    echo "</table>";
}
// [eof]