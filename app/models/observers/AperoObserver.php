<?php
class AperoObserver{
    public function saved($apero){
        $apero->tagCount();
    }
    
    public function deleted($apero){
        $apero->tagCount();
    }
}