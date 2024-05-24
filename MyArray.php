<?php

namespace App;

use ArrayAccess;
use Iterator;
use Countable;

class MyArray implements ArrayAccess, Iterator, Countable
{
  private array $_keys = [];       // using $_keys to access element by $_position
  private array $_assocArray = [];
  private int $_position;

  // nesesery for ArrayAccess
  public function offsetExists(mixed $offset): bool
  {
    return isset($this->_assocArray[$offset]);
  }

  public function offsetGet(mixed $offset): mixed
  {
    return isset($this->_assocArray[$offset]) ? $this->_assocArray[$offset] : null;
  }
  
  public function offsetSet(mixed $offset, mixed $value): void
  {
    if (is_null($offset)) {
      $this->_assocArray[] = $value;
      $this->_keys[] = array_key_last($this->_assocArray);
    } else {
      $this->_assocArray[$offset] = $value;
      if (!in_array($offset, $this->_keys)) $this->_keys[] = $offset;
    }
  }

  public function offsetUnset(mixed $offset): void
  {
    unset($this->_assocArray[$offset]);
    unset($this->_keys[array_search($offset, $this->_keys)]);
    $this->_keys = array_values($this->_keys);                 // re-indexing $_keys array
  }

  // nesesery for Iterator interface
  public function current(): mixed
  {
    return $this->_assocArray[ $this->_keys[ $this->_position ] ];
  }

  public function key(): mixed
  {
    return $this->_keys[ $this->_position ];
  }

  public function next(): void
  {
    $this->_position += 1;
  }

  public function rewind(): void
  {
    $this->_position = 0;
  }

  public function valid(): bool
  {
    return isset($this->_keys[ $this->_position ]);
  }

  // nesesery for Countable interface
  public function count(): int
  {
    return count($this->_keys);
  }


  public function __construct(mixed ...$values) {
    $this->_assocArray = $values;
  }


  public function push(mixed ...$values): int
  {
    $newLength = array_push($this->_assocArray, ...$values);
    $this->_keys = array_keys($this->_assocArray);
    return $newLength;
  }

  public function pop(): mixed
  {
    $poppedKey = array_pop($this->_keys);
    $poppedValue = $this->_assocArray[$poppedKey];
    unset($this->_assocArray[$poppedKey]);
    return $poppedValue;
  }

  public function shift(): mixed
  {
    $shiftedKey = array_shift($this->_keys);
    $shiftedValue = $this->_assocArray[$shiftedKey];
    unset($this->_assocArray[$shiftedKey]);
    return $shiftedValue;
  }

  public function unshift(mixed ...$values): int
  {
    $newLength = array_unshift($this->_assocArray, ...$values);
    $this->_keys = array_keys($this->_assocArray);
    return $newLength;
  }

  public function empty(): void
  {
    $this->_keys = [];
    $this->_assocArray = [];
  }
}
