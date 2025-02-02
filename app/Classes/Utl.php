<?php

namespace App\Classes;

class Utl {
    public static function formatPrice($price) {
        if(!empty($price))
        {
            return str_replace(",00", "", number_format($price, 2, ",", "."));
        }
        
        return null;
    }
    
    public static function formatDate($date) {
        if(!empty($date))
        {
            return date_format(date_create($date),"d/m/Y");
        }
        
        return null;
    }
    
    public static function formatName($name) {
        
        if(strlen($name) > 30) {
            $name = substr($name, 0, 30) . "...";
        }
        
        return $name;
    }
    
    public static function formatDescription($description) {
        
        if(strlen($description) > 50) {
            $description = substr($description, 0, 50) . "...";
        }
        
        return $description;
    }
}

?>