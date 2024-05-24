<?php

namespace App;

include './MyArray.php';

class ArraysProcessor
{
  private array $arrays = [];

  public function __construct()
  {
    session_start();

    if (isset($_SESSION['arrays'])) {
      $this->arrays = $_SESSION['arrays'];
    } else {
      $_SESSION['arrays'] = [];
    }
  }

  public function __destruct()
  {
    $_SESSION['arrays'] = $this->arrays;
  }

  public function processRequest(string $data): void
  {
    $dataElements = explode('-', $data);
    $arrayAction = $dataElements[0];

    switch ($arrayAction) {
      case 'NEW_ARRAY':
        if (isset($_POST['new_array_name'])) {
          $newArrayName = $_POST['new_array_name'];
          $this->arrays[$newArrayName] = new MyArray();
        } 
        break;

      case 'DEL_ARR':
        $arrayName = $dataElements[1];
        unset($this->arrays[$arrayName]);
        break;

      case 'SHIFT':
        $arrayName = $dataElements[1];
        if (isset($this->arrays[$arrayName])) {
          $array = $this->arrays[$arrayName];
          $array->shift();
        }
        break;

      case 'POP':
        $arrayName = $dataElements[1];
        if (isset($this->arrays[$arrayName])) {
          $array = $this->arrays[$arrayName];
          $array->pop();
        }
        break;

      case 'REMOVE':
        $arrayName = $dataElements[1];
        $key = $dataElements[2];
        if (
          isset($this->arrays[$arrayName]) && 
          isset($this->arrays[$arrayName][$key])) 
        {
          $array = $this->arrays[$arrayName];
          $array->offsetUnset($key);
        }
        break;

      case 'EMPTY':
        $arrayName = $dataElements[1];
        if (isset($this->arrays[$arrayName])) {
          $array = $this->arrays[$arrayName];
          $array->empty();
        }
        break;
      
      case 'EXECUTE':
        $arrayName = $dataElements[1];
        if (isset($this->arrays[$arrayName])) {
          $array = $this->arrays[$arrayName];

          if (!empty($_POST['unshift_value'])) 
          {
            $value = $_POST['unshift_value'];
            if (empty($_POST['unshift_key'])) 
            {
              $array->unshift($value);
            } 
            else 
            {
              $key = $_POST['unshift_key'];
              $array->offsetSet($key, $value);
            }
          }
          if (!empty($_POST['push_value'])) 
          {
            $value = $_POST['push_value'];
            if (empty($_POST['push_key'])) 
            {
              $array->push($value);
            } 
            else 
            {
              $key = $_POST['push_key'];
              $array->offsetSet($key, $value);
            }
          }
        }
        break;
    }
  }

  public function getArrays(): array
  {
    return $this->arrays;
  }
}
