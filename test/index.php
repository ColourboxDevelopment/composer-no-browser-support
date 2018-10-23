<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/../src/'.str_replace('\\', '/', $class_name).'.php';
});

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Colourbox\NoBrowserSupport</title>
</head>
<body>

    <?=NoBrowserSupport\PopUp::check('da')?>

</body>
</html>
