# composer-no-browser-support

> Composer package - Show popup on not supported browsers about supported browsers

[packagist.org](https://packagist.org/packages/colourbox-account/no-browser-support)

## Install newest version

```bash
composer require colourbox-account/no-browser-support
```

## Update to newest version

```bash
composer update colourbox-account/no-browser-support
```

## Usage

```php
NoBrowserSupport\PopUp::check('en');
```

# Documentation

```php 
PopUp::check($language:String)
```

Checks the visitors web browser and version and, if not meets the requierement, than dispalys a popup with suggestion to newer web browser.

@param $language:String

The language of the popup content. Current supported languages: 
* en: English (Default)
* da: German
* de: Danish

> The popup is displayed only on Microsoft Internet Explorer with version lower than 11

> If the visitor closes the popup that reloads the current page with **sb-no-browser-support-hide** parameter in the url. This sets a cookie for **24 hours**, in this time period the web browser requierement is ignored fot the whole domain.

# Testing

To force the popup to be displayed add **sb-no-browser-support-always-show** parameter to the url.

To test in different web browsers and versions use [browserstack.com](https://www.browserstack.com/).

# Requirement

PHP: ^5.3.0 || ^7.0

> This package requires no other composer packages

