<?php

/*
  Plugin Name: Wordpress Facebook Pixel
  Description: Includes Facebook Pixel on your website.
  Author: Cristian Tala Sánchez
  Version: 0.2.1
  Author URI: http://www.cristiantala.cl
  Plugin URI: https://bitbucket.org/ctala/wordpress-facebook-pixel/
  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License or any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

add_action('wp_head', 'hook_facebook_pixel');

function hook_facebook_pixel() {
    if (!is_admin()) {
        $fbk_pixel_id = get_option('fbk_pixel_id');
        $fbk_pixel_currency = strtoupper(get_option('fbk_pixel_currency'));
        //die($fbk_pixel_id);
        $script = "<script>(function() {
                    var _fbq = window._fbq || (window._fbq = []);
                    if (!_fbq.loaded) {
                        var fbds = document.createElement('script');
                        fbds.async = true;
                        fbds.src = '//connect.facebook.net/en_US/fbds.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(fbds, s);
                        _fbq.loaded = true;
                    }                    
                    })();
                    window._fbq = window._fbq || [];
                    window._fbq.push(['track', '$fbk_pixel_id', {'value':'0.00','currency':'$fbk_pixel_currency'}]);
                    </script> 
                     
                    
                </script>
                    ";
        $noscript = "<noscript>"
                . "<img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=$fbk_pixel_id&amp;cd[value]=0.00&amp;cd[currency]=$fbk_pixel_currency&amp;noscript=1' />"
                . "</noscript>";

        echo $script . $noscript;
    }
}

// create custom plugin settings menu
add_action('admin_menu', 'facebookpixel_create_menu');

function facebookpixel_create_menu() {

    //create new top-level menu
    add_menu_page('Facebook Pixel Settings', 'Facebook Pixel Settings', 'administrator', __FILE__, 'facebookpixel_settings_page', plugins_url('/img/facebook_16.png', __FILE__));

    //call register settings function
    add_action('admin_init', 'register_mysettings_facebookpixel');
}

function register_mysettings_facebookpixel() {
    //register our settings
    register_setting('fbkPixel-settings-group', 'fbk_pixel_id');
    register_setting('fbkPixel-settings-group', 'fbk_pixel_currency');
}

function facebookpixel_settings_page() {
    include_once 'admin/optionsPage.php';
}
