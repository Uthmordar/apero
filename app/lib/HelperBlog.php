<?php
class HelperBlog {
    protected static $className = "active";

    public static function isHome(){
        if(Request::is('/')){
            return "class=" . self::$className;
        }
    }

    public static function isCat($id){
        if(Request::is('cat/*') && Request::segment(2)==$id){
            return "class=" . self::$className;
        }
    }

    public static function isPage($name){
        if(Request::segment(1)==$name){
            return "class=" . self::$className;
        }
    }
    
    public static function isApRessource($name){
        if(Request::is('apero/*') && Request::segment(2)==$name){
            return "class=" . self::$className;
        }else if(Request::is('apero') && Request::segment(1)==$name){
            return "class=" . self::$className;
        }
    }
}