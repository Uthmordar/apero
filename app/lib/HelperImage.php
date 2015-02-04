<?php

class HelperImage{
    protected static $MIME = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');

    /**
     * Generate thumb from image if jpg, jpeg, png or gif
     * @param type $file original file
     * @param type $thumbX choosen width
     * @param type $thumbY choosen height
     * @param type $path path to save
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public static function thumb($file, $thumbX, $thumbY, $path) {
        $fileTrueName=$file->getClientOriginalName();
        $fileExtension=$file->getClientOriginalExtension();

        $size=getimagesize($file);
        $mime=$size['mime'];

        if(!in_array($mime, HelperImage::$MIME)){
            throw new \InvalidArgumentException('Not allowed MIME type');
        }

        $thumb=imagecreatetruecolor($thumbX, $thumbY);
        $data=['file'=>$file, 'x'=>$size[0], 'y'=>$size[1], 'mime'=>$mime, 'thumbX'=>$thumbX, 'thumbY'=>$thumbY, 'thumb'=>$thumb];
        
        if($mime==self::$MIME[0]){
            self::imgJPG($path, $data);
        }else if($mime==self::$MIME[1]){
            self::imgJPEG($path, $data);
        }else if($mime==self::$MIME[2]){
            self::imgPNG($path, $data);
        }else if($mime==self::$MIME[3]){
            self::imgGIF($path, $data);
        }
        return true;
    }
    
    /**
     * destroy temporary img generate from thumbify process
     * @param type $img
     * @param type $thumb
     */
    protected static function imgDestroy($img, $thumb){
        imagedestroy($img);
        imagedestroy($thumb);
    }
    
    /**
     * thumb for JPG MIME TYPE
     * @param type $path
     * @param type $data
     */
    protected static function imgJPG($path, $data){
        $img=imagecreatefromjpg($data['file']);
        imagecopyresampled($data['thumb'], $img, 0, 0, 0, 0, $data['thumbX'], $data['thumbY'], $data['x'], $data['y']);

        header('Content-Type : ' . self::$MIME[0]);

        imagejpg($data['thumb']);
        imagejpg($data['thumb'], $path);

        self::imgDestroy($img, $data['thumb']);
    }
    
    /**
     * thumb for JPEG
     * @param type $path
     * @param type $data
     */
    protected static function imgJPEG($path, $data){
        $img=imagecreatefromjpeg($data['file']);
        imagecopyresampled($data['thumb'], $img, 0, 0, 0, 0, $data['thumbX'], $data['thumbY'], $data['x'], $data['y']);

        header('Content-Type : ' . self::$MIME[1]);

        imagejpeg($data['thumb']);
        imagejpeg($data['thumb'], $path);

        self::imgDestroy($img, $data['thumb']);
    }
    
    /**
     * THUMB FOR PNG
     * @param type $path
     * @param type $data
     */
    protected static function imgPNG($path, $data){
        $img=imagecreatefrompng($data['file']);
        imagealphablending($data['thumb'], false);
        imagesavealpha($data['thumb'],true);
        $transparent=imagecolorallocatealpha($data['thumb'], 255, 255, 255, 127);
        imagefilledrectangle($data['thumb'], 0, 0, $data['x'], $data['y'], $transparent);
        imagecopyresampled($data['thumb'], $img, 0, 0, 0, 0, $data['thumbX'], $data['thumbY'], $data['x'], $data['y']);

        header('Content-Type : ' . self::$MIME[2]);

        imagepng($data['thumb']);
        imagepng($data['thumb'], $path);

        self::imgDestroy($img, $data['thumb']);
    }
    
    /**
     * thumb for GIF
     * @param type $path
     * @param type $data
     */
    protected static function imgGIF($path, $data){
        $img=imagecreatefromgif($data['file']);
        imagecopyresampled($data['thumb'], $img, 0, 0, 0, 0, $data['thumbX'], $data['thumbY'], $data['x'], $data['y']);

        header('Content-Type : ' . self::$MIME[3]);

        imagegif($data['thumb']);
        imagegif($data['thumb'], $path);

        self::imgDestroy($img, $data['thumb']);
    }
}