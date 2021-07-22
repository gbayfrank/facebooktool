<?php
namespace App\GbayLibs;

class ArrayData {
    public function gbay_array_merge($pairs, $atts) {
        echo '<pre>';
        print_r($pairs);
        echo '</pre>';
        echo '<pre>';
        print_r($atts);
        echo '</pre>';
        $atts = (array) $atts;
        $out  = array();
        foreach ( $pairs as $name => $default ) {
            if ( array_key_exists( $name, $atts ) ) {
                $out[ $name ] = $atts[ $name ];
            } else {
                $out[ $name ] = $default;
            }
        }

        return $out;
    }
}