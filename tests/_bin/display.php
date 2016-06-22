<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php');

use \Zwig\Tool\DisplayTool;
use \Zwig\Exception\InvalidParameterException;
use \Zwig\Exception\TemplateNotFoundException;

try {
    $tool = new DisplayTool();
    $tool->run($_GET);
} catch (InvalidParameterException $ex) {
    header("HTTP/1.0 400 Bad Request");
    die($ex->getMessage());
} catch (TemplateNotFoundException $ex) {
    header('HTTP/1.0 404 Not Found');
    die($ex->getMessage());
} catch (Exception $ex) {
    header('HTTP/1.0 500 Internal Server Error');
    die($ex->getMessage());
}