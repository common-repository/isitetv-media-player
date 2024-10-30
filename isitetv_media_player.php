<?php
/**
 * @package iSiteTV_Media_Player
 * @version 1.0
 */
/*
Plugin Name: iSiteTV Media Player
Plugin URI: http://wordpress.org/plugins/isitetv-media-player/
Description: Allows the use of the shortcode "isitetv_player" to insert an iSiteTV media player into your page.
Author: iSiteTV Limited
Version: 1.0
Author URI: http://isitetv.com
*/



add_action('init',       'isitetv_media_player_init');
add_action('admin_head', 'isitetv_player_css');



function isitetv_player_shortcode($atts = array(), $content = null)
{
	$content = '';  // We're not doing anything with shortcode content, so make sure it is blank!
	$output  = '';  // Create blank varaible to use returned output
	
	// normalise attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
 
    // override default attributes with user attributes
    $isitetv_player_atts = shortcode_atts(array(
                                     'encoded' => '',
                                 ), $atts, $tag);
 
    $template = '<div class="isitetv_content_container"><div class="isitetv_media_player_container"><iframe src="https://isitetv.com/isitetv_cms/player.php?or_playerid=216&or_use_overlay=Y&encoded=VAR_ENCODED" allowfullscreen="" frameborder="0" width="640" height="450" scrolling="no" class="isitetv_media_player_iframe"></iframe></div></div>';
	
	if (!empty($isitetv_player_atts['encoded'])) {
		$output = str_replace("VAR_ENCODED",$isitetv_player_atts['encoded'],$template);
	}
 
    // return output
    return $output;
}

function isitetv_player_css() 
{
	echo '
	<style type="text/css">
		.isitetv_media_player_container {
			position:relative;
			padding-top:20px;
			padding-bottom:65%;
			height:0;
			overflow:hidden;
		}
		iframe.isitetv_media_player_iframe {
			position:absolute;
			top:0;
			left:0;
			width:100%;
			height:100%;
			overflow:hidden;
		}
	</style>
	';
}

function isitetv_media_player_init() 
{
    add_shortcode('isitetv_player', 'isitetv_player_shortcode');
}

?>