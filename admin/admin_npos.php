<?php

//defined('ABSPATH') or die("No script kiddies please!");

/**
 * Form Join
 *
 */
class Link_List_NPO_Table extends WP_List_Table {

	private
		$_base_url,
		$_npo_filter,
		$_get_npo_count;

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
			echo "List of "
				.ucwords($this->_npo_filter?:'All')
				." NPOs who have signed up";

		}

		// display filters
		if(in_array($which, array("top","bottom"))) {
			if(isset($this->_base_url)) {
				echo '<div class="wrap">';
				echo '<ul class="subsubsub">';
				echo "<li class='all'><a href='{$this->_base_url}&filter=all' class='".(!in_array($this->_npo_filter, array('active','deactive'))?'current':'')."'>All <span class='count'>(".$this->get_npo_count('count_all').")</span></a> | </li>";
				echo "<li class='active'><a href='{$this->_base_url}&filter=active' class='".($this->_npo_filter=='active'?'current':'')."'>Active <span class='count'>(".$this->get_npo_count('count_active').")</span></a> | </li>";
				echo "<li class='deactive'><a href='{$this->_base_url}&filter=deactive' class='".($this->_npo_filter=='deactive'?'current':'')."'>Deactive <span class='count'>(".$this->get_npo_count('count_deactive').")</span></a></li>";
				echo '</ul>';
				echo '</div>';
			}
	   }

	   if ( $which == "bottom" ){
	      echo "";
	      echo "<p><small>Number of rows per page {$this->getPerPage()}</small></p>";
	      echo "<p>To add this form to a page, use the shortcode: <b>[".SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO."]</b></p>";
	   }
	}

	/**
	 * Table Cols
	 *
	 */

	function get_columns() {
	   return $columns= array(
	   	  'action'			=> 'Action',
	      'id'              => 'ID',
	      'Name'            => 'Name',
	      'Contact'         => 'Contact',
	      'Email'           => 'Email',
	      'Tel'             => 'Telephone',
	      'Mobile'          => 'Cell',
	      'LogoPath'		=> 'Logo',

	      'paymentEft'      => 'Eft',
	      'paymentDeposit'  => 'Deposit',

	      'bActive'         => 'Active',
	      'WhenCreated'     => 'Date'
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
	      'Contact' => 'Contact',
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

		// select from
		$query = "SELECT * FROM ".model_thehub_npos::get_table_name();
				 
		// where
		switch ($this->_npo_filter) 
		{
			case 'active':
				$query .= " WHERE bActive ";
				break;

			case 'deactive':
				$query .= " WHERE NOT bActive ";
				break;

			default:
				break;
		}

		// order by
		$query .= " ORDER BY "
				 ." ".(filter_input(INPUT_GET, 'orderby', FILTER_SANITIZE_MAGIC_QUOTES)?:'id')
				 ." ".(filter_input(INPUT_GET, 'order', FILTER_SANITIZE_MAGIC_QUOTES)?:'ASC');

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
		 $columns  = $this->get_columns();
		 $hidden   = array();
		 $sortable = $this->get_sortable_columns();
		 $this->_column_headers = array($columns, $hidden, $sortable);

		/* -- Fetch the items -- */
		$this->items = $wpdb->get_results($query);
	}

	/**
	 *
	 */
	function get_npo_count($field = Null) 
	{
		if(!is_object($this->_get_npo_count)) {
            $this->_get_npo_count=model_thehub_npos::get_table_stats();
		}
		if($field) {
            return isset($this->_get_npo_count->$field)?$this->_get_npo_count->$field:False;
		}
		return $this->_get_npo_count;
	}

	/**
	 *
	 */
	function set_base_url($base_url)
	{
		$this->_base_url=$base_url;
	}

    /**
     * @param $filter
     */
	function set_npo_filter($filter)
	{
		$this->_npo_filter=$filter;
	}

	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display_rows() 
	{
		$records = $this->items;
		if(empty($records)) {
			return;
		}

		list( $columns, $hidden ) = $this->get_column_info();

	   	foreach($records as $row) {
			$npo = new model_thehub_npos($row);

			echo '<tr id="record_'.$npo->id.'">';

			foreach ( $columns as $column_name => $column_display_name ) {

				//Style attributes for each col
				$class = "class='$column_name column-$column_name'";
				$style = "";
				if ( in_array( $column_name, $hidden ) ) {
					$style = ' style="display:none;"';
				}

		         $attributes = $class . $style;

		         //edit link
		         $edit_link  = admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG."&id=".$npo->id."&action=view");

		         //Display the cell

		         switch (strtolower($column_name))
		         {
		         	case "action":
		         		echo "<td {$attributes}>";
		            	echo "<a href='{$edit_link}'>View</a>";
		         		echo "</td>";
		         		break;

		            case "id":  
		            case "name":
		            	echo "<td {$attributes}><a href='{$edit_link}'>{$npo->$column_name}</a></td>";
		            	break;

		            
		            case "bactive": 
		            	echo "<td {$attributes}>".($npo->is_active()?'Yes':'No');
		            	echo "</td>";   
		            	break;

		            case 'logopath':
		            	if($npo->get_logo_url()) {
			            	echo "<td><img style='max-width: 100px; max-height: 100px;' src='{$npo->get_logo_url()}'/></td>";
			            } else {
			            	echo '<td>* No Logo *</td>';
			            }
		            	break;

		            default:
		            	echo "<td {$attributes}>{$npo->$column_name}</td>";
		            	break;
					}
		      }

		      //Close the line
		      echo'</tr>';
		  
		}
	}
}
