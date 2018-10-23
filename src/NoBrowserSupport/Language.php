<?php 

namespace NoBrowserSupport;

class Language
{
    private $languages = ['en','de','da'];
    private $language = '';
    private $translations = [
        'You are using a browser which is not supported' => [
            'da' => 'Du bruger en browser, som ikke understøttes',
            'de' => 'Du benutzt einen Browser, der nicht unterstützt wird',
            'en' => ''
        ],
        'In order for you to get the full experience, please use one of our supported browsers. Download a supported browser <a href="%s" target="_blank">here</a>.' => [
            'da' => 'For at få den fulde oplevelse, skal du bruge en af disse browsere.  Download en understøttet browser <a href="%s" target="_blank">her</a>.',
            'de' => 'Damit alle Features perfekt funktionieren, benutze bitte einen unterstützten Browser. Lade <a href="%s" target="_blank">hier</a> einen unterstützten Browser herunter.',
            'en' => ''
        ],
        'two latest versions' => [
            'da' => 'to seneste versioner',
            'de' => 'die zwei letzten Versionen',
            'en' => ''
        ]
    ];

    public function __construct($language = '') {
        $this->language = in_array($language, $this->languages) ? $language : $this->languages[0];
    }

    public function getCurrent() {
        return $this->language;
    }

    public function getTranslation($index) {
        $translation = '';
        if (isset($this->translations[$index]) && isset($this->translations[$index][$this->getCurrent()])) {
            $translation = $this->translations[$index][$this->getCurrent()] === '' ? $index : $this->translations[$index][$this->getCurrent()];
        }
        return $translation;
    }
}
