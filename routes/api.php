<?php

use Illuminate\Support\Facades\Route;

$folder = "controller_routes";
$suffix = "Route.php";


include $folder . "/Cliente" . $suffix;
include $folder . "/Email" . $suffix;
include $folder . "/Telefone" . $suffix;
include $folder . "/Contato" . $suffix;
include $folder . "/Report" . $suffix;

