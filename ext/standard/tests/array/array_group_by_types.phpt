--TEST--
Test array_group_by() function: type coercion (boolean, null, numeric)
--FILE--
<?php

echo "*** Testing array_group_by() : type coercion ***\n";

$data = array(
    array('value' => 'a', 'active' => true),
    array('value' => 'b', 'active' => false),
    array('value' => 'c', 'active' => true),
    array('value' => 'd', 'active' => false),
    array('value' => 'e', 'active' => null),
    array('value' => 'f', 'active' => 0),
    array('value' => 'g', 'active' => 1),
);

echo "-- Group by boolean field (should convert to int) --\n";
$grouped = array_group_by($data, 'active');
var_dump(array_keys($grouped));

echo "\n-- Group by numeric field --\n";
$numeric_data = array(
    array('value' => 'a', 'group' => 1),
    array('value' => 'b', 'group' => 2),
    array('value' => 'c', 'group' => 1),
    array('value' => 'd', 'group' => 3),
);
$grouped = array_group_by($numeric_data, 'group');
var_dump(array_keys($grouped));

echo "\n-- Group by callback returning mixed types --\n";
$mixed = array(
    array('id' => 1, 'val' => 'test'),
    array('id' => 2, 'val' => 'test'),
    array('id' => 3, 'val' => 'other'),
);
$grouped = array_group_by($mixed, fn($item) => $item['id'] <= 2 ? true : false);
var_dump(array_keys($grouped));

echo "Done\n";
?>
--EXPECT--
*** Testing array_group_by() : type coercion ***
-- Group by boolean field (should convert to int) --
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(0)
  [2]=>
  string(0) ""
}

-- Group by numeric field --
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
}

-- Group by callback returning mixed types --
array(2) {
  [0]=>
  int(1)
  [1]=>
  int(0)
}
Done
