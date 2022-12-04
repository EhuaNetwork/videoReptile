<?php

use QL\QueryList;
use QL\Ext\PhantomJs;


class Request
{
    /**
     * file_get请求
     * @param $url
     * @return false|string
     * @author: Ehua(ehua999@163.com)
     * @Time: 2022/12/3 21:13
     */
    public static function file_get($url)
    {
        ini_set("user_agent", "Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)");
        $opts = [
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ]
        ];
        $html = file_get_contents($url, false, stream_context_create($opts));
        return $html;
    }

    /**
     * phantomjs请求
     * @param $url
     * @return mixed
     * @author: Ehua(ehua999@163.com)
     * @Time: 2022/12/3 21:13
     */
    public static function ajax_get($url)
    {
        $ql = QueryList::getInstance();
        $ql->use(PhantomJs::class, getcwd() . '/package/phantomjs-2.1.1-windows/bin/phantomjs.exe');

        $html = $ql->browser($url)->getHtml();

        return $html;
    }

    /**
     * CURL请求
     * @param $url
     * @return bool|string
     * @author: Ehua(ehua999@163.com)
     * @Time: 2022/12/3 21:13
     */
    public static function curl_get($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
        $html = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $html;
    }
}