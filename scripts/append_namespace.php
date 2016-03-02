<?php

/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/2/29
 * Time: 15:43
 */


require "utils.php";

//function pathEqual($path1,$path2){
//    return trim($path1,'/') == trim($path2,'/');
//}

function mkdirIfNotExists ($dirname){
    is_dir($dirname) || mkdir($dirname);
}


function appendNamespace($inputFilename, $namespace, $outputFilename)
{
    $inputHandle = fopen($inputFilename, "r") or die("Unable to open file to read!");
    $outputHandle = fopen($outputFilename, "w") or die("Unable to open file to write!");
    while (!feof($inputHandle)) {
        $buffer = fgets($inputHandle);//readline
        $startpos  = strpos($buffer, '<?php');
//        print '--'.$startpos.'--';
        if (is_int($startpos)) {
            $starttaglen = 5;
            $headlen = strlen(trim($buffer) ) ;
            if ($headlen == $starttaglen) {
                fwrite($outputHandle, $buffer);
                fwrite($outputHandle, "namespace $namespace;" .PHP_EOL);
            } else {
                $header = substr($buffer,0,$startpos+$starttaglen);
                $tail  = substr($buffer,$startpos+$starttaglen);
                fwrite($outputHandle, $header . PHP_EOL);
                print ('header:'.$buffer.PHP_EOL);
                fwrite($outputHandle, "namespace $namespace;".PHP_EOL);
                fwrite($outputHandle, $tail . PHP_EOL);
            }
            break;
        }
    }
    while (!feof($inputHandle)) {
        $buffer = fgets($inputHandle);//readline
        fwrite($outputHandle, $buffer);
    }

    fflush($outputHandle);
    fclose($inputHandle);
    fclose($outputHandle);
}

function generate($input_dir,$namespace_mappings,$output_dir){
    $rel_dir_and_files = listDirs($input_dir, $input_dir);
//    print_r($namespace_mappings);
//    print_r($rel_dir_and_files);
    foreach ($rel_dir_and_files as $rel_dir_and_file) {
        $rel_dir = $rel_dir_and_file['dir'];
        if (array_key_exists($rel_dir, $namespace_mappings)) {
            $namespace = $namespace_mappings[$rel_dir];
        } else {
//              $namespace = ucfirst($rel_dir);
            $namespace = join('\\', array_map(function ($path) {
                return ucfirst($path);
            }, explode('/', $rel_dir)));
        }
        $dir = str_replace('\\','/',$namespace);
        print ("$namespace ;;".PHP_EOL);
        print ($rel_dir .' => '.$dir .PHP_EOL);
        if (array_key_exists('file', $rel_dir_and_file)) {
            $file = $rel_dir_and_file['file'];
//            print ('make dir if not exists:' . $output_dir . '/' . $dir . PHP_EOL);
//            mkdirIfNotExists($output_dir . '/' . $dir);
            print ("processing $input_dir|$rel_dir|$file  => $namespace") . PHP_EOL;
            appendNamespace($input_dir . '/' . $rel_dir . '/' . $file, $namespace, $output_dir . '/' . $dir . '/' . $file);
        } else {
            print ('make dir:' . $output_dir . '/' . $dir . PHP_EOL);
            mkdirIfNotExists($output_dir . '/' . $dir);
        }

    }

}