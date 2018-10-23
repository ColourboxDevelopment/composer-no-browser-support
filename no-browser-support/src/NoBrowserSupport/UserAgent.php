<?php 

namespace NoBrowserSupport;

class UserAgent
{
    // string Microsoft Internet Explorer Value: msie
    public static $MSIE = 'msie';
    // string Microsoft Edge Value: msie
    public static $EDGE = 'edge';
    // string Mozilla Firefox Value: ff
    public static $FF = 'ff';
    // string Apple Safari Value: safari
    public static $SAFARI = 'safari';
    // string Google Chrome Value: chrome
    public static $CHROME = 'chrome';
    // string Opera Value: opera
    public static $OPERA = 'opera';
    // string Unknow web browser Value: other_browser
    public static $OTHER_BROWSER = 'other_browser';
    // string Opera with webkit engine Value: opera_chrome
    public static $OPR = 'opera_chrome';
    // string Microsoft Internet Explorer with gecko ua string Value: msgecko
    public static $MSGECKO = 'msgecko'; //msie 11+
    // string Windows Value: windows
    public static $WINDOWS = 'windows';
    // string Macintosh Value: mac
    public static $MAC = 'mac';
    // string Linux Value: linux
    public static $LINUX = 'linux';
    // string Android Value: android
    public static $ANDROID = 'android';
    // string iOs Value: ios
    public static $IOS = 'ios';
    // string Unknow operating system Value: other_os
    public static $OTHER_OS = 'other_os';
    // string PC Value: pc
    public static $PC = 'pc';
    // string Mobile Value: mobile
    public static $MOBILE = 'mobile';

    private static $firstArray = false;
    public static $browser_list = [];
    public static $os_list = [];
    public static $device_list = [];

    public static function uaString() {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }

    private static function initArrays() {
        if (!self::$firstArray) {
            self::$firstArray = true;
            self::$browser_list = [
                self::$MSIE => 'MSIE',
                self::$EDGE => 'Edge',
                self::$MSGECKO => 'Trident',
                self::$FF => 'Firefox',
                self::$OPERA => 'Opera',
                self::$OPR => 'OPR', 
                self::$CHROME => 'Chrome',
                self::$SAFARI => 'Safari'
            ];

            self::$os_list = [
                self::$WINDOWS => 'Windows', 
                self::$MAC => 'Macintosh',
                self::$ANDROID => 'Android',
                self::$IOS => '(iOS)|(iPhone)|(iPad)|(iPod)',
                self::$LINUX => 'Linux' 
            ];

            self::$device_list = [ self::$MOBILE => 'Mobile' ];
        }
    }

    public static function getOS() {
        self::initArrays();
        foreach ( self::$os_list as $key => $value ) {
            if ( preg_match('/'.str_replace('/','\\/',$value).'/', self::uaString() ) ) {
                return $key;
            }
        }
        return self::$OTHER_OS;
    }

    public static function isAndroid() {
        return self::getOS() == self::$ANDROID; 
    }

    public static function isIos() {
        return self::getOS() == self::$IOS; 
    }

    public static function isWindows() {
        return self::getOS() == self::$WINDOWS; 
    }

    public static function isMac() {
        return self::getOS() == self::$MAC; 
    }

    public static function isLinux() {
        return self::getOS() == self::$LINUX; 
    }

    public static function getIosVersion() {
        if ( self::isIos() ) {
            $version = preg_replace("/(.*) OS ([0-9]*)_(.*)/","$2", self::uaString());
            if( intval($version) > 0 ) {
                return intval($version);
            }
        }
        return false;
    }

    public static function getBrowser() {
        self::initArrays();
        foreach ( self::$browser_list as $key => $value ) {
            if (preg_match('/'.str_replace('/','\\/',$value).'/', self::uaString())) {
                return strtolower($key);
            }
        }
        return strtolower(self::$OTHER_BROWSER);
    }

    public static function getMSIEVersion() {
        $b = self::getBrowser();
        if ( $b == self::$MSIE ) {
            preg_match('/MSIE ([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        } else if ( $b == self::$MSGECKO ) {
            return self::getTridentVersion() + 4;
        }
        return false;
    }

    // Trident is Microsoft Internet Explorer's layout engine. 
    // 7 = MSIE 11, 6 = MSIE 10, 5 = MSIE 9, 4 = MSIE 8, 3.1 = MSIE 7
    public static function getTridentVersion() {
        preg_match('/Trident\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
        if(isset($reg[1])) {
            return intval($reg[1]);
        }
        return false;
    }

    public static function getEdgeVersion() {
        if ( self::getBrowser() == self::$EDGE ) {
            preg_match('/Edge\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        }
        return false;
    }

    public static function getFireFoxVersion() {
        if ( self::getBrowser() == self::$FF ) {
            preg_match('/Firefox\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        }
        return false;
    }

    public static function getOperaVersion() {
        $b = self::getBrowser();
        if ( $b == self::$OPERA ) {
            preg_match('/Version\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        } else if ( $b == self::$OPR ) {
            preg_match('/OPR\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        } 
        return false;
    }

    public static function getChromeVersion() {		
        if ( self::getBrowser() == self::$CHROME ) {
            preg_match('/Chrome\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        }
        return false;
    }	

    public static function getSafariVersion() {
        if ( self::getBrowser() == self::$SAFARI ) {
            preg_match('/Version\/([0-9]{1,2}\.[0-9])/',self::uaString(),$reg);
            if(isset($reg[1])) {
                return intval($reg[1]);
            }
        }
        return false;
    }	

    public static function isGecko() {
        if ( preg_match('/'.str_replace('/','\\/','Gecko').'/', self::uaString()) ) {
            return true;
        }
        return false;
    }

    public static function isWebkit() {
        preg_match('/AppleWebKit\/([0-9]{1,3}\.[0-9])/',self::uaString(),$reg);
        if(isset($reg[1])) {
            return intval($reg[1]);
        }
        return false;
    }

    public static function isPresto() {
        preg_match('/Presto\/([0-9]{1,3}\.[0-9])/',self::uaString(),$reg);
        if(isset($reg[1])) {
            return intval($reg[1]);
        }
        return false;
    }

    public static function isRobot() {
        if ( preg_match('/bot|crawl|slurp|spider|mediapartners/i', self::uaString() ) ) {
            return true;
        }
        return false;
    }

    public static function getDeviceType() {
        self::initArrays();
        foreach ( self::$device_list as $key => $value ) {
            if (preg_match('/'.$value.'/', self::uaString())) {
                return $key;
            }
        }
        return self::$PC;
    }

    public static function isMobile() {
        return self::getDeviceType() == self::$MOBILE || self::isIPad() || self::isIPod() || self::isIPhone() || self::isIos() || self::isAndroid();
    }

    public static function isIPad() {
        if ( preg_match('/iPad/', self::uaString() ) ) {
            return true;
        }
        return false;
    }

    public static function isIPod() {
        if ( preg_match('/iPod/', self::uaString() ) ) {
            return true;
        }
        return false;
    }

    public static function isIPhone() {
        if ( preg_match('/iPhone/', self::uaString() ) ) {
            return true;
        }
        return false;
    }
}
