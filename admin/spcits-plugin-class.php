<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class spcits_Plugin {
	static $instance;
	public $customphpcodes_obj;

	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
	}

	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {
		$hook = add_menu_page(
			'SPcits Custom PHP Code List',
			'Custom PHP Codes',
			'manage_options',
			'SPcits_Custom_PHP_Code',
			[ $this, 'plugin_settings_page' ]
		);
		add_submenu_page(
			'SPcits_Custom_PHP_Code',
			'Custom PHP Code Settings',
			'Custom Settings',
			'manage_options',
			'customphpcode',
			'customphpcode_display_settings_page'
		);
		add_action( "load-$hook", [ $this, 'screen_option' ] );

	}

	public function plugin_settings_page() {
		?>
		<div class="wrap">
			<h2>List of Attemted PHP Codes With Their Status</h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->customphpcodes_obj->prepare_items();
								$this->customphpcodes_obj->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	public function screen_option() {
		$option = 'per_page';
		$args   = [
			'label'   => 'Number of Custom PHP Codes on Each Page',
			'default' => 5,
			'option'  => 'customphpcodes_per_page'
		];
		add_screen_option( $option, $args );
		$this->customphpcodes_obj = new Custom_PHP_Codes();
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
