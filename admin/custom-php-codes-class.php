<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Custom_PHP_Codes extends WP_List_Table {
		public function __construct() {

		parent::__construct( [
			'singular' => __( 'customphpcode', 'spcits' ),
			'plural'   => __( 'customphpcodes', 'spcits' ),
			'ajax'     => false
		] );

	}

	public static function get_customphpcodes( $per_page = 5, $page_number = 1 ) {
		global $wpdb;
		$sql = "SELECT * FROM {$wpdb->prefix}customphpcode";
		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}
		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}

	public static function allow_customphpcode( $sno ) {
		global $wpdb;
		$wpdb->update(
		"{$wpdb->prefix}customphpcode",
		array(
			'allowed' => 'Yes',
		),
		array( 'sno' => $sno ),
		NULL,
		NULL
		);
	}

	public static function disallow_customphpcode( $sno ) {
		global $wpdb;
		$wpdb->update(
		"{$wpdb->prefix}customphpcode",
		array(
			'allowed' => 'No',
		),
		array( 'sno' => $sno ),
		NULL,
		NULL
		);
	}

	public static function record_count() {
		global $wpdb;
		$sql = "SELECT COUNT(*) FROM {$wpdb->prefix}customphpcode";
		return $wpdb->get_var( $sql );
	}


	public function no_items() {
		_e( 'No Custom PHP Codes are avaliable.', 'spcits' );
	}

	public function column_default( $item, $column_code ) {
		switch ( $column_code ) {
			case 'query_insert_time':
			case 'allowed':
			case 'sno':
				return $item[ $column_code ];
			default:
				return print_r( $item, true );
		}
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-action[]" value="%s" />', $item['sno']
		);
	}

	function column_code( $item ) {
		$allow_nonce = wp_create_nonce( 'spcits_allow_customphpcode' );
		$disallow_nonce = wp_create_nonce( 'spcits_disallow_customphpcode' );
		$title = '<strong>' . $item['query'] . '</strong>';
		$actions = [
			'allow' => sprintf( '<a href="?page=%s&action=%s&sno=%s&_wpnonce=%s">Allow</a>', esc_attr( $_REQUEST['page'] ), 'allow', absint( $item['sno'] ), $allow_nonce ),
			'disallow' => sprintf( '<a href="?page=%s&action=%s&sno=%s&_wpnonce=%s">Disallow</a>', esc_attr( $_REQUEST['page'] ), 'disallow', absint( $item['sno'] ), $disallow_nonce )
		];
		return $title . $this->row_actions( $actions );
	}

	function get_columns() {
		$columns = [
			'cb'      => '<input type="checkbox" />',
			'sno'			=> __( 'Sno', 'spcits' ),
			'code'    => __( 'Custom PHP Code', 'spcits' ),
			'query_insert_time' => __( 'First Query Time', 'spcits' ),
			'allowed'    => __( 'Allowed/Disallowed', 'spcits' )
		];
		return $columns;
	}

	public function get_sortable_columns() {
		$sortable_columns = array(
			'code' => array( 'query', true ),
			'query_insert_time' => array( 'query_insert_time', false )
		);
		return $sortable_columns;
	}

	public function get_bulk_actions() {
		$actions = [
			'bulk-allow' => 'Allow',
			'bulk-disallow' => 'Disallow'
		];
		return $actions;
	}

	public function prepare_items() {
		$this->_column_headers = $this->get_column_info();
		$this->process_bulk_action();
		$per_page     = $this->get_items_per_page( 'customphpcodes_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();
		$this->set_pagination_args( [
			'total_items' => $total_items,
			'per_page'    => $per_page
		] );
		$this->items = self::get_customphpcodes( $per_page, $current_page );
	}

	public function process_bulk_action() {
		if ( 'allow' === $this->current_action() ) {
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );
			if ( ! wp_verify_nonce( $nonce, 'spcits_allow_customphpcode' ) ) {
				die( 'Go get a life script kiddies' );
			}
			else {
				self::allow_customphpcode( absint( $_GET['sno'] ) );
										$url = esc_url_raw(add_query_arg([]));
										$url = str_replace("action=disallow&","",$url);
										$url = str_replace("action=allow&","",$url);
										echo "<meta http-equiv='refresh' content='0;url=$url' />";
				exit;
			}

		}

		if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-allow' )
		     || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-allow' )
		) {
			$delete_ids = esc_sql( $_POST['bulk-action'] );
			foreach ( $delete_ids as $id ) {
				self::allow_customphpcode( $id );
			}
						$url = esc_url_raw(add_query_arg([]));
						$url = str_replace("action=disallow&","",$url);
						$url = str_replace("action=allow&","",$url);
						echo "<meta http-equiv='refresh' content='0;url=$url' />";

			exit;
		}

		if ( 'disallow' === $this->current_action() ) {
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );
			if ( ! wp_verify_nonce( $nonce, 'spcits_disallow_customphpcode' ) ) {
				die( 'Go get a life script kiddies' );
			}
			else {
				self::disallow_customphpcode( absint( $_GET['sno'] ) );
										$url = esc_url_raw(add_query_arg([]));
										$url = str_replace("action=disallow&","",$url);
										$url = str_replace("action=allow&","",$url);
										echo "<meta http-equiv='refresh' content='0;url=$url' />";
				exit;
			}
		}
		if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-disallow' )
				 || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-disallow' )
		) {
			$delete_ids = esc_sql( $_POST['bulk-action'] );
			foreach ( $delete_ids as $id ) {
				self::disallow_customphpcode( $id );
			}
						$url = esc_url_raw(add_query_arg([]));
						$url = str_replace("action=disallow&","",$url);
						$url = str_replace("action=allow&","",$url);
						echo "<meta http-equiv='refresh' content='0;url=$url' />";
			exit;
		}
	}
}
