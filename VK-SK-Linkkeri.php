<?php
/**
 * Plugin Name: VK-SK-Linkkeri
 * Plugin URI: https://github.com/terokode/VK-SK-LINKKERI
 * Description: WP-sivuilta linkit helposti Suomen Ev.lut. kirkon virsikirjaan ja Suomen Luterilaisen Evankeliumiyhdistyksen Siionin kanteleeseen
 * Version: 2017-03-12
 * Author: Tero Kotti
 * Author URI: http://kotti.fi
 * License: MIT (c) 2014, 2017 Tero Kotti
 */

function makeLink(&$atts, &$urlPattern, &$linkPattern){
    $att = shortcode_atts(array('nro' => false), $atts);

    if (preg_match('/^[0-9]{1,3}[a-b]?$/', $att['nro'])){
        $url = sprintf( $urlPattern, $att['nro'],
                (   /**
                     * Virsikirja vaatii 3 numeroisen numeroinnin ja
                     * mahdollisesti myös sävelen kirjaimen
                    */
                    in_array(substr($att['nro'], -1),array('a','b')) ?
                    substr($att['nro'], -1) : ''
                )
        );
        return sprintf($linkPattern, $url, $att['nro'], $att['nro']);
    }
    else {
        return "Virhe: VK-SK-Linkkeri tarvitsee laulun numeron.";
    }
}
// Virsikirja
function vk_func($atts){
    $urlPattern = 'http://notes.evl.fi/virsikirja.nsf/pudotusvalikko/%03d%s?OpenDocument';
    $linkPattern = '<a href="%s" title="Virsikirja: %s (uuteen selainikkunaan)" target="_blank">VK %s</a>';
    return makeLink($atts, $urlPattern, $linkPattern);
}
//Siionin kannel
function sk_func($atts){
    $urlPattern = 'http://sley.fi/sk%d%s';
    $linkPattern = '<a href="%s" title="Siionin Kantele: %s (uuteen selainikkunaan)" target="_blank">SK %s</a>';
    return makeLink($atts, $urlPattern, $linkPattern);
}

add_shortcode('vk', 'vk_func');
add_shortcode('sk', 'sk_func');

?>
