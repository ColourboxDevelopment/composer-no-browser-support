<?php

namespace NoBrowserSupport;

use NoBrowserSupport;

class PopUp
{
    private static $first = false;
    private static $cookieIndex = 'sb-no-browser-support-hide';
    private static $alwaysShowIndex = 'sb-no-browser-support-always-show';
    private static $language;
    private static $cookieLifetime = 60;

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
        echo isset($_COOKIE[self::$cookieIndex]) ? $_COOKIE[self::$cookieIndex] : 'undefined';
        if (isset($_GET[self::$cookieIndex])) {
            setcookie( self::$cookieIndex, '1', time() + self::$cookieLifetime, "/", false);
        }
    }

    private static function hidden() {
        return isset($_COOKIE[self::$cookieIndex]) || isset($_GET[self::$cookieIndex]);
    }

    private static function validBrowser() {
        if (UserAgent::isMobile() || UserAgent::isRobot()) {
            return true;
        }

        // Newest versions - updated on 23 oct. 2018
        $versionTarget = [
            UserAgent::$CHROME => 69,
            UserAgent::$SAFARI => 12,
            UserAgent::$EDGE => 17,
            UserAgent::$MSIE => 11,
            UserAgent::$MSGECKO => 11,
            UserAgent::$FF => 62
        ];

        $target = [
            UserAgent::$CHROME => function($target) { return UserAgent::getChromeVersion() >= $target - 1; },
            UserAgent::$SAFARI => function($target) { return UserAgent::getSafariVersion() >= $target - 1; },
            UserAgent::$EDGE => function($target) { return UserAgent::getEdgeVersion() >= $target - 1; },
            UserAgent::$MSIE => function($target) { return UserAgent::getMSIEVersion() >= $target; },
            UserAgent::$MSGECKO => function($target) { return UserAgent::getMSIEVersion() >= $target; },
            UserAgent::$FF => function($target) { return UserAgent::getFireFoxVersion() >= $target - 1; },
        ];
        foreach ( $target as $key => $value ) {
            if ( UserAgent::getBrowser() === $key && $value($versionTarget[$key]) ) {
                return true;
            }
        }
        return false;
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
