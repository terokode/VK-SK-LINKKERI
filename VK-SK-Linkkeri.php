<?php
/**
 * Plugin Name: VK-SK-Linkkeri
 * Plugin URI: https://github.com/terokode/VK-SK-LINKKERI
 * Description: WP-sivuilta linkit helposti Suomen Ev.lut. kirkon virsikirjaan ja Suomen Luterilaisen Evankeliumiyhdistyksen Siionin kanteleeseen
 * Version: 2017-03-11
 * Author: Tero Kotti
 * Author URI: http://kotti.fi
 * License: MIT
 *
 * Copyright (c) 2014, 2017 Tero Kotti
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

function makeLink(&$atts, &$urlPattern, &$linkPattern){
    $att = shortcode_atts(array('nro' => false), $atts);

    if (preg_match('/^[0-9]{1,3}[a-b]?$/', $att['nro'])){
        $url = sprintf( $urlPattern, $att['nro'],
                        (
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
