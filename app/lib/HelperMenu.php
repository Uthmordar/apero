<?php

class HelperMenu{
    protected static $className="active";

    /**
     * test if current page is homepage
     * @return type
     */
    public static function isHome(){
        if(Request::is('/')){
            return "class=" . self::$className;
        }
    }

    /**
     * test if current page is page
     * @param type $name
     * @return type
     */
    public static function isPage($name){
        if(Request::segment(1)==$name){
            return "class=" . self::$className;
        }
    }
    
    /**
     * test if current page is apero ressource page && which ressources
     * @param type $name
     * @return type
     */
    public static function isApRessource($name){
        if(Request::is('apero/*') && Request::segment(2)==$name){
            return "class=" . self::$className;
        }else if(Request::is('apero') && Request::segment(1)==$name){
            return "class=" . self::$className;
        }
    }
}