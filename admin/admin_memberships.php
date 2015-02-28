<?php

//defined('ABSPATH') or die("No script kiddies please!");

/**
 * Form Join
 *
 */
class Link_List_Memberships_Table extends WP_List_Table {

	//@TODO: save these deaults

	function getPerPage()
	{
		return 50;
	}

   /**
    * Constructor, we override the parent to pass our own arguments
    * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
    */

    function __construct() {
       parent::__construct( array(
      'singular'=> 'wp_list_text_link', //Singular label
      'plural' => 'wp_list_test_links', //plural label, also this well be one of the table css class
      'ajax'   => false //We won't support Ajax for this table
      ) );
    }

	/**
	 * Add extra markup in the toolbars before or after the list
	 * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
	 */

	function extra_tablenav( $which ) 
	{
	   if ( $which == "top" ){
	      echo "List of people who have signed up";
	   }

	   if ( $which == "bottom" ){
	      echo "";
	      echo "<p><small>Number of rows per page {$this->getPerPage()}</small></p>";
	      echo "<p>To add this form to a page, use the shortcode: <b>[".SHORTCODE_THEHUBSA_FORM_JOIN."]</b></p>";
	   }
	}

	/**
	 *
	 */

	function get_columns() {
	   return $columns= array(
	      'id'             => 'ID',
	      'Name'           => 'Name',
	      'Surname'        => 'Surname',
	      'Email'          => 'Email',
	      'bActive'        => 'Active',
	      'MembershipType' => 'Membership Type',
	      'WhenCreated'    => 'Created'
	   );
	}

	/**
	 * Decide which columns to activate the sorting functionality on
	 * @return array $sortable, the array of columns that can be sorted by the user
	 */
	public function get_sortable_columns() {
		return array();

	   	return $sortable = array(
	      'id'      => 'id',
	      'Name'    => 'Name',
	      'Surname' => 'Surname',
	      'Email'   => 'Email',
	   );
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements
	 *
	 */
	function prepare_items() 
	{
		global $wpdb, $_wp_column_headers;
		$screen = get_current_screen();

		/* -- Preparing your query -- */
		$query = "SELECT 
					m.*, 
					mt.MembershipType 
				  FROM ".model_thehub_memberships::get_table_name()." m 
				  LEFT OUTER JOIN 
					".model_thehub_membership_types::get_table_name()." mt 
				  ON (m.fkMembershipType = mt.id) "; 

		// if (debug) ... error_log($query);

		/* -- Ordering parameters -- */
        //Parameters that are going to be used to order the result
		// $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
		// $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';

		$orderby = filter_input(INPUT_GET, 'orderby', FILTER_SANITIZE_MAGIC_QUOTES);
		$order = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_MAGIC_QUOTES)?:'ASC';
		if(!empty($orderby) & !empty($order)){ 
			$query.=' ORDER BY '.$orderby.' '.$order; 
		}

		/* -- Pagination parameters -- */
        //Number of elements in your table?
		$totalitems = $wpdb->query($query); //return the total number of affected rows

		$perpage = $this->getPerPage(); 

		$paged = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ 
			$paged=1; 
		}
		
		//How many pages do we have in total?
		$totalpages = ceil($totalitems/$perpage);

		//adjust the query to take pagination into account
		if(!empty($paged) && !empty($perpage))
		{
			$offset=($paged-1)*$perpage;
		 	$query.=' LIMIT '.(int)$offset.','.(int)$perpage;
		}

		/* -- Register the pagination -- */
		$this->set_pagination_args( array(
		 "total_items" => $totalitems,
		 "total_pages" => $totalpages,
		 "per_page" => $perpage,
		) );
		//The pagination links are automatically built according to those parameters

		 /* — Register the Columns — */
		 $columns = $this->get_columns();
		 $hidden = array();
		 $sortable = $this->get_sortable_columns();
		 $this->_column_headers = array($columns, $hidden, $sortable);

		/* -- Fetch the items -- */
		$this->items = $wpdb->get_results($query);
	}

	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display_rows() 
	{
	   //Get the records registered in the prepare_items method
	   $records = $this->items;

	   //Get the columns registered in the get_columns and get_sortable_columns methods
	   list( $columns, $hidden ) = $this->get_column_info();

	   //Loop for each record
	   if(!empty($records)) {

	   	foreach($records as $rec) {
	      //Open the line
			echo '<tr id="record_'.$rec->id.'">';
			foreach ( $columns as $column_name => $column_display_name ) {

				//Style attributes for each col
				$class = "class='$column_name column-$column_name'";
				$style = "";
				if ( in_array( $column_name, $hidden ) ) {
					$style = ' style="display:none;"';
				}

		         $attributes = $class . $style;

		         //edit link
		         //$editlink  = '/wp-admin/link.php?action=edit&link_id='.(int)$rec->id;

		         //Display the cell
		         switch (strtolower($column_name))
		         {
		            case "id":  
		            	echo "<td {$attributes}>{$rec->id}</td>";   
		            	break;
		            
		            case "name": 
		            	echo "<td {$attributes}>".stripslashes($rec->Name).'5</td>'; 
		            	break;
		            
		            case "surname": 
		            	echo "<td {$attributes}>".stripslashes($rec->Surname)."</td>"; 
		            	break;
		            
		            case "email": 
		            	echo "<td {$attributes}>{$rec->Email}</td>"; 
		            	break;
		            
		            case "bactive": 
		            	echo "<td {$attributes}>".($rec->bActive?'Yes':'No')."</td>"; 
		            	break;

		            case "whencreated": 
		            	echo "<td {$attributes}>{$rec->WhenCreated}</td>"; 
		            	break;

		            case "membershiptype": 
		            	echo "<td {$attributes}>{$rec->MembershipType}</td>"; 
		            	break;

		         }
		      }

		      //Close the line
		      echo'</tr>';
		   }
		}
	}
}

