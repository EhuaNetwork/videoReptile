<?php

namespace script\video;
require_once('vendor/autoload.php');

use \QL\QueryList;

/**
 * 通用采集脚本[DOMXPath]
 * @author: Ehua(ehua999@163.com)
 * @Time: 2022/12/3 13:45
 */
class dami10_me
{
    public static $mode = true;//是否精准匹配  true精准|false模糊
    public static $debug = true;//调试模式

    public static function init($key = null)
    {
        $url = "https://dami10.me/vodsearch/-------------.html?wd=$key";//
        $urlInfo = parse_url($url);
        $html = \Request::curl_get($url);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $dom->normalize();
        $xpath = new \DOMXPath($dom);
        $lists = $xpath->query("/html/body/div[1]/div/div[3]/div/div/div[3]/div/div");//列表xpath
        $video_url = false;
        if(self::$debug) dump($url) ;
        for ($i = 1; $i <= $lists->length; $i++) {
            $titles = $xpath->query("/html/body/div[1]/div/div[3]/div/div/div[3]/div/div[$i]/div[2]/div[1]/a/strong");//标题xpath
            $hrefs = $xpath->query("/html/body/div[1]/div/div[3]/div/div/div[3]/div/div[$i]/div[2]/div[1]/a");//链接xpath
            if(self::$debug) dump($titles->item(0)->textContent) ;
            if (self::check($key, $titles->item(0)->textContent)) {
                $video_url[$i]['url'] = $hrefs->item(0)->getAttribute('href');
                $video_url[$i]['title'] = $titles->item(0)->textContent;
                if (!preg_match('/(http:\/\/)|(https:\/\/)/i', $video_url[$i]['url'])) {
                    $video_url[$i]['url'] = $urlInfo['scheme'] . '://' . $urlInfo['host'] . $video_url[$i]['url'];
                }
            }
        }
        return $video_url;
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