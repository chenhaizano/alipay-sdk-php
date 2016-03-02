<?php
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/3/1
 * Time: 17:23
 */

require "utils.php";

$input_dir = realpath(__DIR__ . "/../src/Alipay/OpenApi/aop/request");
$output_file = realpath(__DIR__."/../src/Alipay/OpenApi") . '/Requests.php';
print $output_file;

$dirs = listDirs($input_dir,$input_dir);

/*  template
<?php
//// generated automatically
namespace Alipay\OpenApi;
class Requests
{
    const AlipayAcquireCancelRequest = 'AlipayAcquireCancelRequest';
}
*/
$out=fopen($output_file,'w') or die('???');
$head =
"<?php
//// automatic generated
namespace Alipay\\OpenApi;
class Requests
{
";

$tail = "
};";

fwrite($out,$head);
foreach($dirs as $rel_dir){
//    print ( $rel_dir['file'] .PHP_EOL);
    $filename = $rel_dir['file'] ;
    $className = pathinfo($filename,PATHINFO_FILENAME);
    fwrite($out,"   const $className = '$className';".PHP_EOL);
}
//print pathinfo('asdasd.xx.asd',PATHINFO_FILENAME);
fwrite($out,$tail);
fclose($out);