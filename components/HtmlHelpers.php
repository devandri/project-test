<?php

namespace app\components;

use mdm\admin\components\Helper as RouteHelper;

class HtmlHelpers extends \yii\helpers\Html
{
    public static function a($text, $url = null, $options = [])
    {
        $url2check = is_array($url) ? $url[0] : $url;
        if (preg_match('/..\//',$url2check)) {
            $url2check = str_replace('../', '', $url2check);
            $url2check = parse_url($url2check, PHP_URL_PATH);
        } else {
            $url2check = basename(parse_url($url2check, PHP_URL_PATH));
        }
        if (RouteHelper::checkRoute($url2check)) {
            return parent::a($text, $url, $options);
        }
        return '';
    }
    public static function a2($text, $url = null, $options = [])
    {
        $url2check = is_array($url) ? $url[0] : $url;
        if (preg_match('/..\//',$url2check)) {
        	$url2check = str_replace('../', '', $url2check);
        	$url2check = parse_url($url2check, PHP_URL_PATH);
        } else {
        	$url2check = basename(parse_url($url2check, PHP_URL_PATH));
        }
        if (RouteHelper::checkRoute($url2check)) {
            return parent::a($text, $url, $options);
        }
        return '';
    }
}
