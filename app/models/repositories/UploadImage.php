<?php

namespace repositories;

class UploadImage{
    /**
     * 
     * @param type $flashTarget
     * @param array $thumbsize [x, y]
     * @return string
     */
    public function uploadImage($flashTarget, array $thumbsize=[50,50]){
        if(Input::hasfile('file')) {
            $file = Input::file('file');
            $files = [$file];
            $rules = ['image' => 'image|mime:jpg,png,gif, jpeg|max:3000'];
            $validator = Validator::make($files, $rules);
            if($validator->fails()){
                Session::flash($flashTarget, "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>Image invalide.</p>");
                return Redirect::back();
            }

            $fileTrueName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $fileThumb = $file;

            $destinationPath = 'public/uploads/';
            $filename = str_random(25) . '.' . $fileExtension;

            $thumbPath = $destinationPath . '_min/' . $filename;
            //fonction de resize des images
            HelperImage::thumb($fileThumb, $thumbsize[0], $thumbsize[1], $thumbPath);

            $upload_success = $file->move($destinationPath, $filename);
            
            if($upload_success){
                return $filename;
            }else{
                Session::flash($flashTarget, "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>Problème d'upload.</p>");
                return Redirect::back();
            }
        }
    }
}