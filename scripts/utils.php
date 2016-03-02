<?php
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/3/1
 * Time: 17:21
 */

//todo no cursive
function listDirs($dir,$root)
{
    $dir_and_files =[];
    $dir_requote  ='/^' .preg_quote( $root) .'/';
    print($dir_requote) .PHP_EOL;
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ((is_dir($dir . "/" . $file)) && $file != "." && $file != "..") {//is dir
                    $subdir = $dir . "/" . $file ;
                    $relative_dir  = trim(preg_replace($dir_requote,"",$subdir,1),'/');
                    if ($relative_dir) {
                        print ("add dir: $relative_dir".PHP_EOL);
                        $dir_and_files[] = ['dir' => $relative_dir];
                    }
//                  print ("read dir: $dir $file".PHP_EOL);
                    $dir_and_files = @array_merge($dir_and_files,@listDirs($dir . "/" . $file ,$root) );
                } else {//is file
                    if ($file != "." && $file != "..") {
                        $relative_dir  = trim(preg_replace($dir_requote,"",$dir,1),'/');
                        $dir_and_files[] = ['dir' => $relative_dir,'file' => $file];
                    }
                }
            }
            closedir($dh);
        }
    }
    return $dir_and_files;
}