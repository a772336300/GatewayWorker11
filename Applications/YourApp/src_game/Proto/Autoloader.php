<?php
if(!defined('ROOTDIRGAME'))
{
        define('ROOTDIRGAME',realpath(__DIR__.'/../Proto'));   //定义更目录
}
class game_MyAutoloader {
        
        public static function myAutoload( $name )
        {
                $class_path = str_replace('\\',DIRECTORY_SEPARATOR,$name);
                $file = ROOTDIRGAME.'/'.$class_path.'.php';
                if( file_exists( $file ) )
                {
                        require_once( $file );
                        if( class_exists($name, false) )
                        {
                                return true;
                        }
                }
                return false;
        }
}
spl_autoload_register('game_MyAutoloader::myAutoload');