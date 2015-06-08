<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadImgHandler
 *
 * @author zq
 */
class UploadImgHandler {

    public static function isImg($type) {
        return in_array($type, array("jpg", "jpeg", "gif", "png"));
    }

    /**
     *
     * @param type $data
     * @param type $type
     * @return string
     */
    public static function upImg($data, $type = 'jpg') {

        if (!self::isImg(strtolower($type))) {
            return FALSE;
        }

        $server = getC("upload_server");

        $sign = getC("upload_sign");

        $file_url = upload_file($server, $data, $type, $sign);

        return $file_url;
    }

}

?>
