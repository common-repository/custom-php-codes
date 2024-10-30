<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists('spcits_php_code') )
{
	function spcits_php_code($content)
	{
		$spcits_all_content = $content;
		preg_match_all('!\[php_code[^\]]*\](.*?)\[/php_code[^\]]*\]!is',$spcits_all_content,$spcits_matches);
		$spcits_matches_count = count($spcits_matches[0]);
		for( $spcits_x=0; $spcits_x<$spcits_matches_count; $spcits_x++ )
		{
			ob_start();
      $spcits_match_content = $spcits_matches[1][$spcits_x];
      $spcits_match_content = str_replace("<script>","",$spcits_match_content);
      $spcits_match_content = str_replace("</script>","",$spcits_match_content);
			$spcits_out = spcits_custom_php_code($spcits_match_content);
			if($spcits_out == true)
			{
			eval($spcits_match_content);
		  }
			$spcits_replacement = ob_get_contents();
			ob_clean();
			ob_end_flush();
			$spcits_content = preg_replace('/'.preg_quote($spcits_matches[0][$spcits_x],'/').'/',$spcits_replacement,$spcits_all_content,1);

		}
		if(isset($spcits_content))
		{
		return $spcits_content;
	  }
	}
	add_filter( 'the_content', 'spcits_php_code',9);
  add_filter('widget_text', 'spcits_php_code',10);
}

function spcits_custom_php_code($code)
	{
		global $wpdb;
		$custom_php_options = get_option("customphpcode_options");
		if (!empty($custom_php_options)) {
		    foreach ($custom_php_options as $key => $option)
		        $options[$key] = $option;
		}
		$code = esc_sql($code);
    $query = "SELECT * FROM `wp_customphpcode` WHERE `query` like \"".$code."\";";
    $results = $wpdb->query($query);
		if(isset($options['custom_spcitsphpsave']))
		{
			$custom_spcitsphpsave = $options['custom_spcitsphpsave'];
		}
		else {
			$custom_spcitsphpsave = 0;
		}
		if(isset($options['custom_spcitsphpcode']))
		{
			$custom_spcitsphpcode = $options['custom_spcitsphpcode'];
		}
		else {
			$custom_spcitsphpcode = 0;
		}
		if($results == 0 && $custom_spcitsphpsave == 1)
		{
		$date = $blogtime = current_time( 'mysql' );
		$query = "INSERT INTO `wp_customphpcode` (`sno`, `query`, `query_insert_time`, `allowed`) VALUES (NULL, '$code', '$date', 'No');";
		$results = $wpdb->query($query);
	  }
		$query = "SELECT * FROM `wp_customphpcode` WHERE allowed != \"No\" AND `query` like \"".$code."\";";
		$results = $wpdb->query($query);
		if($results != 0 || $custom_spcitsphpcode == 0)
		{
			return true;
		}
		else {
			return false;
		}
	}
