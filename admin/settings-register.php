<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function customphpcode_register_settings() {
	register_setting(
		'customphpcode_options',
		'customphpcode_options',
		'customphpcode_callback_validate_options'
	);

	add_settings_section(
		'customphpcode_section_logging',
		'Enable/Disable Security Feature',
		'customphpcode_callback_section_logging',
		'customphpcode'
	);

	add_settings_field(
		'custom_spcitsphpcode',
		'Custom PHP Code',
		'customphpcode_callback_field_checkbox',
		'customphpcode',
		'customphpcode_section_logging',
		[ 'id' => 'custom_spcitsphpcode', 'label' => 'Only allow admin enabled queries on front end.' ]
	);

	add_settings_field(
		'custom_spcitsphpsave',
		'Save Custom PHP Code',
		'customphpcode_callback_field_checkbox',
		'customphpcode',
		'customphpcode_section_logging',
		[ 'id' => 'custom_spcitsphpsave', 'label' => 'Save custom PHP Codes in database.' ]
	);

}

add_action( 'admin_init', 'customphpcode_register_settings' );
