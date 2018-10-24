<?php
    $width = 940;
    $height = 319;
    $bgOpacity = .6;
?>
<style>
    #NoBrowserSupport,
    #NoBrowserSupport * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
    }
    #NoBrowserSupport img {
        border: 0px;
    }
    #NoBrowserSupport {
        position: fixed;
        left: 0px; 
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 100000;
    }
    .NoBrowserSupportBg {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background: #000000;
        opacity: <?=$bgOpacity?>;
        -o-opacity: <?=$bgOpacity?>;
        -webkit-opacity: <?=$bgOpacity?>;
        -moz-opacity: <?=$bgOpacity?>;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?=$bgOpacity*100?>)";
        filter: alpha(opacity=<?=$bgOpacity*100?>);
    }
    .NoBrowserSupportContainer {
        position: fixed; 
        width: <?=$width?>px;
        height: <?=$height?>px;
        margin-left: -<?=$width/2?>px;
        margin-top: -<?=$height/2?>px;
        left: 50%;
        top: 50%;
        background: #ffffff;
        color: #000000;
    }
    .NoBrowserSupportTable {
        width: <?=$width?>px;
        height: <?=$height?>px;
    }
    .NoBrowserSupportImg {
        position: absolute;
        left: 0px;
        top: 0px;
        width: <?=$height?>px;
        height: 100%;
    }
    .NoBrowserSupportTd1 {
        width: <?=$height?>px;
    }
    .NoBrowserSupportTd1Div {
        width: <?=$height?>px;
    }
    .NoBrowserSupportTd2 {
        vertical-align: middle;
        padding: 30px 60px 30px 60px;
    }
    .NoBrowserSupportTd2 a {
        color: #2C3775;
        font-weight: bold;
    }
    .NoBrowserSupportTitle {
        color: #000000;
        font-size: 18px;
        font-weight: 600;
        line-height: 22px;
        margin-bottom: 10px;
    }
    .NoBrowserSupportText {
        color: #000000;
        font-size: 14px;
        line-height: 22px;
        padding-right: 36px;
    }
    .NoBrowserSupportTableChk {
        width: 100%;
        margin-top: 20px;
    }
    .NoBrowserSupportTableChkTd {
        color: #000000;
        font-size: 14px;
        line-height: 22px;
        padding-top: 10px;
    }
    .NoBrowserSupportTableChkImg {
        position: relative;
    }
    .NoBrowserSupportClose {
        position: absolute;
        right: 20px;
        top: 20px;
    }
    @media screen and (max-width: <?=$width?>px) {
        .NoBrowserSupportTd1 {
            display: none;
        }
        .NoBrowserSupportContainer {
            margin-left: 0px;
            left: 0px;
            width: 100%;
        }
        .NoBrowserSupportTable {
            width: 100%;
        }
    }
    @media screen and (max-width: 640px) {
        .NoBrowserSupportContainer {
            margin-top: 0px;
            top: 0px;
            height: auto;
        }
        .NoBrowserSupportClose {
            right: 15px;
            top: 15px;
        }
        .NoBrowserSupportTd2 {
            padding: 40px;
        }
        .NoBrowserSupportTableChk,
        .NoBrowserSupportTableChk tr,
        .NoBrowserSupportTableChkTd {
            display: block;
            width: 100%;
        }
        .NoBrowserSupportTableChkSpacer {
            display: none;
        }
    }
</style>
<div id="NoBrowserSupport">
    <div class="NoBrowserSupportBg"></div>
    <div class="NoBrowserSupportContainer">
        <table cellpadding="0" cellspacing="0" width="100%" class="NoBrowserSupportTable">
            <tr>
                <td class="NoBrowserSupportTd1">
                    <div class="NoBrowserSupportTd1Div"></div>
                    <img src="<?=self::imgURL('/gfx/no-browser-support/main.jpg')?>" alt="" class="NoBrowserSupportImg" />
                </td>
                <td class="NoBrowserSupportTd2">
                    <div class="NoBrowserSupportTitle"><?=self::$language->getTranslation('You are using a browser which is not supported')?></div>
                    <div class="NoBrowserSupportText"><?=sprintf(self::$language->getTranslation('In order for you to get the full experience, please use one of our supported browsers. Download a supported browser <a href="%s" target="_blank">here</a>.'), self::browsehappyLink())?></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="NoBrowserSupportTableChk">
                    <tr>
                        <td width="46%" class="NoBrowserSupportTableChkTd"><img src="<?=self::imgURL('/gfx/no-browser-support/check.jpg')?>" align="absmiddle" class="NoBrowserSupportTableChkImg" /> Safari 10+</td>
                        <td width="4%" class="NoBrowserSupportTableChkSpacer">&nbsp;</td>
                        <td width="50%" class="NoBrowserSupportTableChkTd"><img src="<?=self::imgURL('/gfx/no-browser-support/check.jpg')?>" align="absmiddle" class="NoBrowserSupportTableChkImg" /> Chrome (<?=self::$language->getTranslation('two latest versions')?>)</td>
                    </tr>
                    <tr>
                        <td class="NoBrowserSupportTableChkTd"><img src="<?=self::imgURL('/gfx/no-browser-support/check.jpg')?>" align="absmiddle" class="NoBrowserSupportTableChkImg" /> Internet Explorer 11+</td>
                        <td class="NoBrowserSupportTableChkSpacer">&nbsp;</td>
                        <td class="NoBrowserSupportTableChkTd"><img src="<?=self::imgURL('/gfx/no-browser-support/check.jpg')?>" align="absmiddle" class="NoBrowserSupportTableChkImg" /> Firefox (<?=self::$language->getTranslation('two latest versions')?>)</td>
                    </tr>
                    <tr>
                        <td class="NoBrowserSupportTableChkTd" colspan="3"><img src="<?=self::imgURL('/gfx/no-browser-support/check.jpg')?>" align="absmiddle" class="NoBrowserSupportTableChkImg" /> Microsoft Edge (<?=self::$language->getTranslation('two latest versions')?>)</td>
                    </tr>
                    </table>
                </td>
            </tr>
        </table>
        <a href="<?=self::closeLink()?>" class="NoBrowserSupportClose"><img src="<?=self::imgURL('/gfx/no-browser-support/close.jpg')?>" /></a>
    </div>
</div>