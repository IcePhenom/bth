<?php
/**
 * Theme related functions. 
 */

/**
 * Get title for the webpage.
 *
 * @param string $title for this page.
 * @return string/null wether the favicon is defined or not.
 */
function get_title($title) {
  global $mfact;
  return $title . (isset($mfact['title_append']) ? $mfact['title_append'] : null);
}

/**
 * Create menu.
 *
 * @param string $menu for the menu bar.
 * @return string as the html for the menu.
 * 
 */
function menu($menu) {
  $html = "<nav>\n<ul> <!-- menu -->\n";
  foreach($menu as $link) {
  	if($link['sub'] != 0){
  		$html .= "<li><a href='{$link['url']}' title='{$link['title']}'>{$link['text']}</a>\n";
    	$html .= "<ul> <!-- sub -->\n";
    	foreach($link['sub'] as $sub) {
    		$html .= "<li><a href='{$sub['url']}' title='{$sub['title']}'>{$sub['text']}</a></li>";
    	}
    	$html .= "</ul>\n</li>\n";
    }
    else
    	$html .= "<li><a href='{$link['url']}' title='{$link['title']}'>{$link['text']}</a></li>\n";
  }
  $html .= "</ul>\n</nav>\n";
  return $html;
}
