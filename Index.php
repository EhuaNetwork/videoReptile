<?php
require_once('vendor/autoload.php');
require_once('Tool/Common.php');
require_once('Tool/Pinyin.php');
require_once('Tool/Db.php');
require_once('Tool/Request.php');
require_once('init.php');

//自动加载采集类
function myself_autoload($classname)
{
    $abc_file = getcwd() . '\\' . $classname . '.php';       //如abc/Salary.php
    if (file_exists($abc_file)) {
        include_once $abc_file;
    }
}
spl_autoload_register('myself_autoload');


//这里是加载采集其他站点的脚本
//每一项都是一个站点的采集配置
//这个写法我讲一下哈
//video是影视站的
//down是下载的
//pan是网盘的
//写法就是脚本路径
//每个脚本都差不多 我标记的通用的 就是你可以拷贝 去采集别的站 规则基本通用  稍微改改配置就行
//我先暂停了采集  把这些先关掉   我新加个站点 演示一编
$script = [
    'script\video\www_6080dy1_com',
    'script\video\www_libvio_me',
//    'script\video\www_freeok_vip',//有IP限制 的需要弄代理IP 需要花钱买IP来采
    'script\video\www_fantuanhd_com',
    'script\video\dami10_me',

    'script\down\www_yinfans_me',
    'script\down\www_gaoqing_fm',
    'script\down\www_xl720_com',
    'script\down\yyets_dmesg_app',

    'script\pan\www_xinjuc_com',




];
foreach ($script as $dat) {
    myself_autoload($dat);
}


(new Init($script))->go();