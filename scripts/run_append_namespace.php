<?php
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/2/29
 * Time: 20:30
 */

include_once "append_namespace.php";


function composerConfigAsArray(){
    $composer_file_content= file_get_contents(__DIR__.'/../composer.json');
    return json_decode($composer_file_content,JSON_OBJECT_AS_ARRAY);
}

function namespaceMappingFromComposer(){
    $namespace_mappings =[];
    try {
        $psr4 = composerConfigAsArray()['autoload']['psr-4'];
        foreach (array_flip($psr4) as $path => $namespace) {
            $namespace_mappings[trim($path, '/')] = trim($namespace, '\\');
        }
    } catch (\Exception $ignore) {
    }
    return $namespace_mappings;
}

$input_dir = realpath(__DIR__ . "/../original");
$output_dir = realpath(__DIR__ . "/../src");

$namespace_mappings =[
    "aop/request"  => "Alipay\\OpenApi\\Request",
    "aop/test"  => "Alipay\\OpenApi\\Test",
    "aop"  => "Alipay\\OpenApi",
];
generate($input_dir,$namespace_mappings,$output_dir);
