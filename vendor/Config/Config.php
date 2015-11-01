<?php
class Config
{
    public static function getConfig()
    {
        $path_to_file = realpath(BASE_DIR . 'vendor/Config/config.ini');
        if (file_exists($path_to_file)) {
            return parse_ini_file($path_to_file);
        } else {
            return null;
        }
    }
}

