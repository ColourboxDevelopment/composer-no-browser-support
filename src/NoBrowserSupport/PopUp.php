<?php

namespace NoBrowserSupport;

use NoBrowserSupport;

class PopUp
{
    private static $first = false;
    private static $cookieIndex = 'sb-no-browser-support-hide';
    private static $alwaysShowIndex = 'sb-no-browser-support-always-show';
    private static $language;
    private static $cookieLifetime = 3600 * 24;

    public static function check($language = '') {
        self::cookie();

        if (isset($_GET[self::$alwaysShowIndex])) {
            unset($_COOKIE[self::$cookieIndex]);
            setcookie(self::$cookieIndex, null, -1, "/", false);
        }

        if ((strlen(trim(UserAgent::uaString())) > 0 && !self::hidden() && !self::validBrowser()) || isset($_GET[self::$alwaysShowIndex])) {
            self::$language = new Language($language);
            return self::show();
        }
    }

    public static function cookie() {
        if (isset($_GET[self::$cookieIndex])) {
            setcookie( self::$cookieIndex, '1', time() + self::$cookieLifetime, "/", false);
        }
    }

    private static function hidden() {
        return isset($_COOKIE[self::$cookieIndex]) || isset($_GET[self::$cookieIndex]);
    }

    private static function validBrowser() {
        $b = UserAgent::getBrowser();
        if (($b === UserAgent::$MSIE || $b === UserAgent::$MSGECKO) && UserAgent::getMSIEVersion() < 11) {
            return false;
        }
        return true;
    }

    private static function show() {
        if (!self::$first) {
            self::$first = true;
            return self::html();
        }
        return '<!--no browser support allready included-->';
    }

    private static function bucketUrl() {
        return "https://s3-eu-west-1.amazonaws.com/colourbox.static";
    }

    private static function imgURL($url){
        return self::bucketUrl().( strpos($url, '/') === 0 ? '' : '/' ).$url;
    }

    private static function browsehappyLink() {
        return 'https://browsehappy.com/?locale=' . self::$language->getCurrent();
    }

    private static function closeLink() {
        $requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        return $requestUri . (strpos($requestUri, '?') === false ? '?' : '&' ) . self::$cookieIndex . '=1' ;
    }

    private static function html() {
        include __DIR__ . '/template/popup.php';
    }
}
