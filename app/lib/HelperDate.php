<?php
class HelperDate{
    /**
     * convert timestamp to given format, if no timestamp give current date
     * 
     * @param type $format
     * @param type $time
     * @return type
     */
    public static function timeToStr($format, $time=0){
        if(!$time){
            return date($format);
        }
        return date($format, $time);
    }
}