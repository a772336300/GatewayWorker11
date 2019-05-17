<?php

if(!defined('ROOTDIR'))
{
        define('ROOTDIR',realpath(__DIR__.'/../Proto'));   //定义更目录
}
class MyAutoloader {
        
        public static function myAutoload( $name )
        {
                $class_path = str_replace('\\',DIRECTORY_SEPARATOR,$name);
                $file = ROOTDIR.'/'.$class_path.'.php';
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
spl_autoload_register('MyAutoloader::myAutoload');