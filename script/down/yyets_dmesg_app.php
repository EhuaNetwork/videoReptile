<?php

namespace script\down;
require_once('vendor/autoload.php');

use \QL\QueryList;

/**
 * 通用采集脚本[API]
 * @author: Ehua(ehua999@163.com)
 * @Time: 2022/12/3 13:45
 */
class yyets_dmesg_app
{
    public static $mode = true;//是否精准匹配  true精准|false模糊
    public static $debug = true;//调试模式

    public static function init($key = null)
    {
        $url = "https://yyets.dmesg.app/api/resource?keyword=$key";
        $urlInfo = parse_url($url);
        $html = \Request::curl_get($url);
        $html = json_decode($html, true);
        $video_url = false;
        $newvideo_url = false;
        foreach ($html['data'] as $k => $dat) {
            $video_url[$k]['url'] = $urlInfo['scheme'] . '://' . $urlInfo['host'] . '/resource?id=' . $dat['id'];
            $video_url[$k]['title'] = $dat['cnname'];
            if (self::$debug) dump($video_url[$k]['title']);
            if (self::$mode) {
                if (self::check($key, $video_url[$k]['title'])) {
                    $newvideo_url[] = $video_url[$k];
                }
            } else {
                $newvideo_url[] = $video_url[$k];
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