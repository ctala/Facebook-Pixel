<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelperPixel
 *
 * @author ctala
 */
include_once 'CurrencyCodes.php';

class HelperPixel {

    var $audienceOptions = array(
        'ViewContent',
        'Search',
        'AddToCart',
        'AddToWishlist',
        'InitiateCheckout',
        'AddPaymentInfo',
        'Lead',
        'Purchase',
        'CompleteRegistration'
    );

    function getAudienceOptions() {
        return $this->audienceOptions;
    }

    function getOptionsForm($name) {

        $result = "";

        $array = $this->audienceOptions;

        foreach ($array as $option) {
            $optionName = $name . $option;
            if (get_option($optionName) == "on") {
                $result.="\n<input type='checkbox' name='$optionName' checked> $option<br>";
            } else {
                $result.="\n<input type='checkbox' name='$optionName'> $option<br>";
            }

        }


        return $result;
    }

    function getSelect($name, $id, $selected) {

        $result = "";
        $result.="<select name='$name' id='$id'>";
        $currencyCodes = new CurrencyCodes();
        $array = $currencyCodes->getCurrencyList();


        foreach ($array as $key => $currency) {

            if ($selected == $key) {
                $result.="\n<option value='$key' selected>$key - $currency[0]</option>";
            } else {
                $result.="\n<option value='$key'>$key - $currency[0]</option>";
            }
        }


        $result.="</select>";
        return $result;
    }

}
