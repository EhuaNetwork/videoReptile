<?php

namespace script\pan;
require_once('vendor/autoload.php');

use \QL\QueryList;

/**
 * 定制脚本 采集规则不通用
 * @author: Ehua(ehua999@163.com)
 * @Time: 2022/12/3 13:44
 */
class www_xinjuc_com
{
    public static $mode = true;//是否精准匹配  true精准|false模糊
    public static $debug = true;//调试模式

    public static function init($key = null)
    {
        $url = "https://www.xinjuc.com/?s=$key";
        $urlInfo = parse_url($url);
        $html = \Request::curl_get($url);
        preg_match_all('/<a.*title=".*' . $key . '.*>/', $html, $preg);
        $video_url = false;
        if ($preg) {
            foreach ($preg[0] as $k=> $dat) {
                if(self::$debug) dump($dat) ;
                if (preg_match('/href=".*html"/', $dat, $da)) {
                    $video_url[$k]['url'] = rtrim(str_replace('href="', '', $da[0]), '"');
                    preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $dat, $content);
                    $string = implode('', $content[0]);
                    $video_url[$k]['title'] = $string;
                }
            }

            if (self::$mode && $video_url) {
                foreach ($video_url as $dat) {
                    if (self::check($key, $dat['title'])) {
                        $newvideo_url[]=$dat;
                    }
                }
            } else {
                $newvideo_url = $video_url;
            }
        }
        return $newvideo_url;
    }
    public static function check($key, $title)
    {
        if (self::$mode) {
            return $key == $title;
        } else {
            return preg_match("/$key/", $title);
        }
    }
}