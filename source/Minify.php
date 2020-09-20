<?php

/**
 * CSS
 */

use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

$minCSS = new CSS();
$minCSS->add(dirname(__DIR__, 1) . "/views/assets/css/style.css");
$minCSS->add(dirname(__DIR__, 1) . "/views/assets/css/form.css");
$minCSS->add(dirname(__DIR__, 1) . "/views/assets/css/button.css");
$minCSS->add(dirname(__DIR__, 1) . "/views/assets/css/message.css");
$minCSS->add(dirname(__DIR__, 1) . "/views/assets/css/load.css");
$minCSS->minify(dirname(__DIR__, 1) . "/views/assets/style.min.css");

/**
 * JS
*/
$minJS = new JS();
$minJS->add(dirname(__DIR__, 1) . "/views/assets/js/jquery.js");
$minJS->add(dirname(__DIR__, 1) . "/views/assets/js/jquery-ui.js");
$minJS->minify(dirname(__DIR__, 1) . "/views/assets/script.min.js");