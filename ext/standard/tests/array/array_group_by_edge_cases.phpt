--TEST--
Test array_group_by() function: edge cases and Laravel compatibility
--FILE--
<?php

echo "*** Testing array_group_by() : edge cases ***\n";

// Test 1: Empty array
echo "-- Empty array --\n";
$result = array_group_by([], 'field');
var_dump($result);

// Test 2: Single item
echo "\n-- Single item --\n";
$result = array_group_by([['id' => 1, 'name' => 'Test']], 'id');
var_dump($result);

// Test 3: All items in same group
echo "\n-- All items in same group --\n";
$data = [
    ['status' => 'active', 'name' => 'A'],
    ['status' => 'active', 'name' => 'B'],
    ['status' => 'active', 'name' => 'C'],
];
$result = array_group_by($data, 'status');
echo "Number of groups: " . count($result) . "\n";
echo "Items in 'active' group: " . count($result['active']) . "\n";

// Test 4: Stringable object as key (Laravel compatibility)
echo "\n-- Stringable object as group key --\n";
class StringableKey {
    public function __construct(private string $value) {}
    public function __toString(): string {
        return $this->value;
    }
}

$data = [
    ['name' => new StringableKey('Laravel'), 'type' => 'framework'],
    ['name' => new StringableKey('Laravel'), 'type' => 'framework'],
    ['name' => new StringableKey('Symfony'), 'type' => 'framework'],
];
$result = array_group_by($data, 'name');
echo "Groups: " . implode(', ', array_keys($result)) . "\n";
echo "Laravel group count: " . count($result['Laravel']) . "\n";

// Test 5: Enum as group key (PHP 8.1+)
echo "\n-- Enum as group key --\n";
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
}

$data = [
    ['user' => 'Alice', 'status' => Status::Active],
    ['user' => 'Bob', 'status' => Status::Inactive],
    ['user' => 'Charlie', 'status' => Status::Active],
];
$result = array_group_by($data, 'status');
echo "Groups: " . implode(', ', array_keys($result)) . "\n";
echo "Active group count: " . count($result['active']) . "\n";

// Test 6: Numeric string keys
echo "\n-- Numeric string keys --\n";
$data = [
    ['rating' => '1', 'item' => 'A'],
    ['rating' => '1', 'item' => 'B'],
    ['rating' => '2', 'item' => 'C'],
];
$result = array_group_by($data, 'rating');
var_dump(array_keys($result));

// Test 7: Mixed numeric and string keys
// Note: PHP coerces numeric strings to integers in array keys
echo "\n-- Mixed key types (numeric string coercion) --\n";
$data = [
    ['group' => 1, 'val' => 'numeric'],
    ['group' => '1', 'val' => 'string'],
    ['group' => 2, 'val' => 'numeric2'],
];
$result = array_group_by($data, 'group');
echo "Number of groups: " . count($result) . "\n";
echo "Group 1 has both items: " . (count($result[1]) === 2 ? 'yes' : 'no') . "\n";

// Test 8: Callback returning null
echo "\n-- Callback returning null --\n";
$data = [
    ['id' => 1, 'optional' => 'has value'],
    ['id' => 2], // no 'optional' key
];
$result = array_group_by($data, fn($item) => $item['optional'] ?? null);
echo "Has empty string group: " . (isset($result['']) ? 'yes' : 'no') . "\n";

// Test 9: Very long group keys
echo "\n-- Long string keys --\n";
$longKey = str_repeat('a', 1000);
$data = [
    ['key' => $longKey, 'val' => 1],
    ['key' => $longKey, 'val' => 2],
];
$result = array_group_by($data, 'key');
echo "Long key exists: " . (isset($result[$longKey]) ? 'yes' : 'no') . "\n";
echo "Long key group count: " . count($result[$longKey]) . "\n";

echo "Done\n";
?>
--EXPECT--
*** Testing array_group_by() : edge cases ***
-- Empty array --
array(0) {
}

-- Single item --
array(1) {
  [1]=>
  array(1) {
    [0]=>
    array(2) {
      ["id"]=>
      int(1)
      ["name"]=>
      string(4) "Test"
    }
  }
}

-- All items in same group --
Number of groups: 1
Items in 'active' group: 3

-- Stringable object as group key --
Groups: Laravel, Symfony
Laravel group count: 2

-- Enum as group key --
Groups: active, inactive
Active group count: 2

-- Numeric string keys --
array(2) {
  [0]=>
  int(1)
  [1]=>
  int(2)
}

-- Mixed key types (numeric string coercion) --
Number of groups: 2
Group 1 has both items: yes

-- Callback returning null --
Has empty string group: yes

-- Long string keys --
Long key exists: yes
Long key group count: 2
Done
