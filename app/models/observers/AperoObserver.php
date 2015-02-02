<?php
class AperoObserver{
    public function saved($apero){
        $apero->tagCount($apero);
    }
    
    public function deleted($apero){
        $apero->tagCount($apero);
    }
}