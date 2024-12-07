<?php
require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

switch($path)
{
    case "/":
        $response = new Response('<h1 style="color: #660000;letter-spacing: 10px;font-family: AppleGothic;cursor: pointer;">Hi</h1>', 200);
        break;
    case "/bye":
        $response = new Response('Bye', 200);
        break;
    default:
        $response = new Response('Not Found', 404);
        break;
}

$response->send();
