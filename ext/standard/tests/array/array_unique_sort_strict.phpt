--TEST--
Test array_unique() function with SORT_STRICT flag
--FILE--
<?php
echo "*** Testing array_unique() with SORT_STRICT flag ***\n";

// Test 1: Integer 1 vs String "1" - should keep both with SORT_STRICT
echo "\nTest 1: Integer vs String comparison\n";
$input = array(1, "1", 2, "2");
echo "Without SORT_STRICT:\n";
var_dump(array_unique($input));
echo "With SORT_STRICT:\n";
var_dump(array_unique($input, SORT_STRICT));

// Test 2: Boolean vs Integer - should keep both with SORT_STRICT
echo "\nTest 2: Boolean vs Integer comparison\n";
$input = array(0, false, 1, true);
echo "Without SORT_STRICT:\n";
var_dump(array_unique($input, SORT_REGULAR));
echo "With SORT_STRICT:\n";
var_dump(array_unique($input, SORT_STRICT));

// Test 3: Float vs Integer - should keep both with SORT_STRICT
echo "\nTest 3: Float vs Integer comparison\n";
$input = array(1, 1.0, 2, 2.0);
echo "Without SORT_STRICT:\n";
var_dump(array_unique($input, SORT_REGULAR));
echo "With SORT_STRICT:\n";
var_dump(array_unique($input, SORT_STRICT));

// Test 4: Null vs empty string - should keep both with SORT_STRICT
echo "\nTest 4: Null vs empty string comparison\n";
$input = array(null, "", 0, false);
echo "Without SORT_STRICT:\n";
var_dump(array_unique($input, SORT_REGULAR));
echo "With SORT_STRICT:\n";
var_dump(array_unique($input, SORT_STRICT));

// Test 5: Preserve keys
echo "\nTest 5: Preserve keys with SORT_STRICT\n";
$input = array("a" => 1, "b" => "1", "c" => 2, "d" => "2");
var_dump(array_unique($input, SORT_STRICT));

// Test 6: Objects - identical objects should be removed
echo "\nTest 6: Object comparison\n";
$obj1 = new stdClass();
$obj1->value = 1;
$obj2 = new stdClass();
$obj2->value = 1;
$input = array($obj1, $obj1, $obj2);
echo "With SORT_STRICT (should keep obj1 once and obj2):\n";
var_dump(array_unique($input, SORT_STRICT));

// Test 7: Arrays as values
echo "\nTest 7: Array comparison\n";
$input = array(array(1, 2), array(1, 2), array(1, "2"));
echo "With SORT_STRICT:\n";
var_dump(array_unique($input, SORT_STRICT));

echo "\nDone\n";
?>
--EXPECT--
*** Testing array_unique() with SORT_STRICT flag ***

Test 1: Integer vs String comparison
Without SORT_STRICT:
array(2) {
  [0]=>
  int(1)
  [2]=>
  int(2)
}
With SORT_STRICT:
array(4) {
  [0]=>
  int(1)
  [1]=>
  string(1) "1"
  [2]=>
  int(2)
  [3]=>
  string(1) "2"
}

Test 2: Boolean vs Integer comparison
Without SORT_STRICT:
array(2) {
  [0]=>
  int(0)
  [2]=>
  int(1)
}
With SORT_STRICT:
array(4) {
  [0]=>
  int(0)
  [1]=>
  bool(false)
  [2]=>
  int(1)
  [3]=>
  bool(true)
}

Test 3: Float vs Integer comparison
Without SORT_STRICT:
array(2) {
  [0]=>
  int(1)
  [2]=>
  int(2)
}
With SORT_STRICT:
array(4) {
  [0]=>
  int(1)
  [1]=>
  float(1)
  [2]=>
  int(2)
  [3]=>
  float(2)
}

Test 4: Null vs empty string comparison
Without SORT_STRICT:
array(1) {
  [0]=>
  NULL
}
With SORT_STRICT:
array(4) {
  [0]=>
  NULL
  [1]=>
  string(0) ""
  [2]=>
  int(0)
  [3]=>
  bool(false)
}

Test 5: Preserve keys with SORT_STRICT
array(4) {
  ["a"]=>
  int(1)
  ["b"]=>
  string(1) "1"
  ["c"]=>
  int(2)
  ["d"]=>
  string(1) "2"
}

Test 6: Object comparison
With SORT_STRICT (should keep obj1 once and obj2):
array(2) {
  [0]=>
  object(stdClass)#1 (1) {
    ["value"]=>
    int(1)
  }
  [2]=>
  object(stdClass)#2 (1) {
    ["value"]=>
    int(1)
  }
}

Test 7: Array comparison
With SORT_STRICT:
array(2) {
  [0]=>
  array(2) {
    [0]=>
    int(1)
    [1]=>
    int(2)
  }
  [2]=>
  array(2) {
    [0]=>
    int(1)
    [1]=>
    string(1) "2"
  }
}

Done
