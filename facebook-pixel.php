<?php

/*
  Plugin Name: Wordpress Facebook Pixel
  Description: Includes Facebook Pixel on your website.
  Author: Cristian Tala Sánchez
  Version: 1.0.0
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

//include_once "classes/CurrencyCodes.php";
include_once "classes/HelperPixel.php";

add_action('wp_head', 'hook_facebook_pixel');
add_action('wp_head', 'hook_facebook_pixel_audience');

function hook_facebook_pixel() {
    if (!is_admin()) {
        $fbk_pixel_id = get_option('fbk_pixel_id');
        if (isset($fbk_pixel_id) && $fbk_pixel_id != "") {

            $fbk_pixel_currency = strtoupper(get_option('fbk_pixel_currency'));


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
                     
                    
                
                    ";
            $noscript = "<noscript>"
                    . "<img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=$fbk_pixel_id&amp;cd[value]=0.00&amp;cd[currency]=$fbk_pixel_currency&amp;noscript=1' />"
                    . "</noscript>";

            echo $script . $noscript;
        }
    }
}

function hook_facebook_pixel_audience() {
    if (!is_admin()) {

        $fbk_pixel_id = get_option('fbk_pixel_custom_id');
        if (isset($fbk_pixel_id) && $fbk_pixel_id != "") {


            $helper = new HelperPixel();

            $audienceOptions = $helper->getAudienceOptions();


            $script = "<!-- Facebook Pixel Code -->
                <script>
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','//connect.facebook.net/en_US/fbevents.js');

                fbq('init', '$fbk_pixel_id ');
                fbq('track', 'PageView');
                ";

            foreach ($audienceOptions as $option) {
                $optionName = 'fbk_pixel_custom_option_' . $option;
                $optionValue = get_option($optionName);
                if ($optionValue == "on") {
                    $script.="fbq('track', '$option');";
                }
            }

            $script.="        
                </script>
                <noscript><img height='1' width='1' style='display:none'
                src='https://www.facebook.com/tr?id=$fbk_pixel_id &ev=PageView&noscript=1'
                /></noscript>
                <!-- End Facebook Pixel Code -->
                    ";


            echo $script;
        }
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

    register_setting('fbkPixel-custom-settings-group', 'fbk_pixel_custom_id');

    $helper = new HelperPixel();

    $audienceOptions = $helper->getAudienceOptions();

    foreach ($audienceOptions as $option) {
        register_setting('fbkPixel-custom-settings-group', 'fbk_pixel_custom_option_' . $option);
    }
}

function facebookpixel_settings_page() {
    include_once 'admin/optionsPage.php';
}
