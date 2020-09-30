<?php

namespace App\Util;

class UtilFile{
    /**
     * Get path file
     *
     * @param int String $type,int $versi, String $extension
     *
     *
     * @return String path file
     */
    public function getFileName(String $type,int $versi, String $extension): String
    {
    
        $filename = $type . '_' . 'v'.$versi . '.' . $extension;
        return $filename;
    }

    /**
     * Get path file
     *
     * @param int int $realid,String $type
     *
     *
     * @return String path file
     */
    public function getPathUploadDirectory(int $realid,String $type): String
    {
        require __DIR__ . '/../../config/settings.php';
        $directory = $settings['upload_directory'];
        $directory = $directory . DIRECTORY_SEPARATOR . $realid . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR;

        return $directory;
    }
}