<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function customphpcode_callback_section_logging() {
	echo '<p>These settings enable you to enable or disable security feature of Custom PHP Code</p>';
}

function customphpcode_callback_field_checkbox( $args ) {
	$options = get_option( 'customphpcode_options', customphpcode_options_default() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	echo '<input id="customphpcode_options_'. $id .'" name="customphpcode_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="customphpcode_options_'. $id .'">'. $label .'</label>';
}
