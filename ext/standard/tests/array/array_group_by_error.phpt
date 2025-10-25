--TEST--
Test array_group_by() function: error conditions
--FILE--
<?php

echo "*** Testing array_group_by() : error conditions ***\n";

$data = array(
    array('name' => 'John', 'role' => 'admin'),
    array('name' => 'Jane', 'role' => 'user'),
);

echo "-- Missing required arguments --\n";
try {
    array_group_by($data);
} catch (ArgumentCountError $e) {
    echo $e->getMessage() . "\n";
}

echo "\n-- Invalid first argument (not an array) --\n";
try {
    array_group_by('not an array', 'role');
} catch (TypeError $e) {
    echo $e->getMessage() . "\n";
}

echo "\n-- Invalid second argument type --\n";
try {
    array_group_by($data, 123);
} catch (TypeError $e) {
    echo $e->getMessage() . "\n";
}

echo "\n-- Multi-level grouping not supported --\n";
try {
    array_group_by($data, ['role', 'name']);
} catch (TypeError $e) {
    echo $e->getMessage() . "\n";
}

echo "\n-- Non-existent field returns null groups --\n";
$grouped = array_group_by($data, 'nonexistent');
var_dump($grouped);

echo "Done\n";
?>
--EXPECTF--
*** Testing array_group_by() : error conditions ***
-- Missing required arguments --
array_group_by() expects at least 2 arguments, 1 given

-- Invalid first argument (not an array) --
array_group_by(): Argument #1 ($array) must be of type array, string given

-- Invalid second argument type --
array_group_by(): Argument #2 ($group_by) must be a callable, string, or array

-- Multi-level grouping not supported --
array_group_by(): Multi-level grouping with arrays is not yet supported

-- Non-existent field returns null groups --
array(1) {
  [""]=>
  array(2) {
    [0]=>
    array(2) {
      ["name"]=>
      string(4) "John"
      ["role"]=>
      string(5) "admin"
    }
    [1]=>
    array(2) {
      ["name"]=>
      string(4) "Jane"
      ["role"]=>
      string(4) "user"
    }
  }
}
Done
