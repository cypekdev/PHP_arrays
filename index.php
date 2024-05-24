<?php

namespace App;

include './ArraysProcessor.php';

$arraysProcessor = new ArraysProcessor();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn-data']))
{
  $data = $_POST['btn-data'];
  $arraysProcessor->processRequest($data);
}

$error = '';
$arrays = $arraysProcessor->getArrays();
include './view.php';
