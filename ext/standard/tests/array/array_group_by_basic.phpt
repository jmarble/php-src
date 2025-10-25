--TEST--
Test array_group_by() function: basic functionality
--FILE--
<?php

echo "*** Testing array_group_by() : basic functionality ***\n";

/* Array representing a possible record set returned from a database */
$records = array(
    array(
        'id' => 1,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'role' => 'admin'
    ),
    array(
        'id' => 2,
        'first_name' => 'Sally',
        'last_name' => 'Smith',
        'role' => 'user'
    ),
    array(
        'id' => 3,
        'first_name' => 'Jane',
        'last_name' => 'Jones',
        'role' => 'admin'
    ),
    array(
        'id' => 4,
        'first_name' => 'Bob',
        'last_name' => 'Brown',
        'role' => 'user'
    )
);

echo "-- Group by role field --\n";
$grouped = array_group_by($records, 'role');
var_dump($grouped);

echo "\n-- Group by role field with preserved keys --\n";
$grouped = array_group_by($records, 'role', true);
var_dump($grouped);

echo "\n-- Group using callback --\n";
$grouped = array_group_by($records, fn($user) => $user['role']);
var_dump($grouped);

echo "\n-- Group by callback with key parameter --\n";
$grouped = array_group_by($records, fn($user, $key) => $key % 2 === 0 ? 'even' : 'odd');
var_dump($grouped);

echo "\n-- Group by first letter of last name --\n";
$grouped = array_group_by($records, fn($user) => substr($user['last_name'], 0, 1));
var_dump($grouped);

echo "Done\n";
?>
--EXPECT--
*** Testing array_group_by() : basic functionality ***
-- Group by role field --
array(2) {
  ["admin"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(1)
      ["first_name"]=>
      string(4) "John"
      ["last_name"]=>
      string(3) "Doe"
      ["role"]=>
      string(5) "admin"
    }
    [1]=>
    array(4) {
      ["id"]=>
      int(3)
      ["first_name"]=>
      string(4) "Jane"
      ["last_name"]=>
      string(5) "Jones"
      ["role"]=>
      string(5) "admin"
    }
  }
  ["user"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(2)
      ["first_name"]=>
      string(5) "Sally"
      ["last_name"]=>
      string(5) "Smith"
      ["role"]=>
      string(4) "user"
    }
    [1]=>
    array(4) {
      ["id"]=>
      int(4)
      ["first_name"]=>
      string(3) "Bob"
      ["last_name"]=>
      string(5) "Brown"
      ["role"]=>
      string(4) "user"
    }
  }
}

-- Group by role field with preserved keys --
array(2) {
  ["admin"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(1)
      ["first_name"]=>
      string(4) "John"
      ["last_name"]=>
      string(3) "Doe"
      ["role"]=>
      string(5) "admin"
    }
    [2]=>
    array(4) {
      ["id"]=>
      int(3)
      ["first_name"]=>
      string(4) "Jane"
      ["last_name"]=>
      string(5) "Jones"
      ["role"]=>
      string(5) "admin"
    }
  }
  ["user"]=>
  array(2) {
    [1]=>
    array(4) {
      ["id"]=>
      int(2)
      ["first_name"]=>
      string(5) "Sally"
      ["last_name"]=>
      string(5) "Smith"
      ["role"]=>
      string(4) "user"
    }
    [3]=>
    array(4) {
      ["id"]=>
      int(4)
      ["first_name"]=>
      string(3) "Bob"
      ["last_name"]=>
      string(5) "Brown"
      ["role"]=>
      string(4) "user"
    }
  }
}

-- Group using callback --
array(2) {
  ["admin"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(1)
      ["first_name"]=>
      string(4) "John"
      ["last_name"]=>
      string(3) "Doe"
      ["role"]=>
      string(5) "admin"
    }
    [1]=>
    array(4) {
      ["id"]=>
      int(3)
      ["first_name"]=>
      string(4) "Jane"
      ["last_name"]=>
      string(5) "Jones"
      ["role"]=>
      string(5) "admin"
    }
  }
  ["user"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(2)
      ["first_name"]=>
      string(5) "Sally"
      ["last_name"]=>
      string(5) "Smith"
      ["role"]=>
      string(4) "user"
    }
    [1]=>
    array(4) {
      ["id"]=>
      int(4)
      ["first_name"]=>
      string(3) "Bob"
      ["last_name"]=>
      string(5) "Brown"
      ["role"]=>
      string(4) "user"
    }
  }
}

-- Group by callback with key parameter --
array(2) {
  ["even"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(1)
      ["first_name"]=>
      string(4) "John"
      ["last_name"]=>
      string(3) "Doe"
      ["role"]=>
      string(5) "admin"
    }
    [1]=>
    array(4) {
      ["id"]=>
      int(3)
      ["first_name"]=>
      string(4) "Jane"
      ["last_name"]=>
      string(5) "Jones"
      ["role"]=>
      string(5) "admin"
    }
  }
  ["odd"]=>
  array(2) {
    [0]=>
    array(4) {
      ["id"]=>
      int(2)
      ["first_name"]=>
      string(5) "Sally"
      ["last_name"]=>
      string(5) "Smith"
      ["role"]=>
      string(4) "user"
    }
    [1]=>
    array(4) {
      ["id"]=>
      int(4)
      ["first_name"]=>
      string(3) "Bob"
      ["last_name"]=>
      string(5) "Brown"
      ["role"]=>
      string(4) "user"
    }
  }
}

-- Group by first letter of last name --
array(4) {
  ["D"]=>
  array(1) {
    [0]=>
    array(4) {
      ["id"]=>
      int(1)
      ["first_name"]=>
      string(4) "John"
      ["last_name"]=>
      string(3) "Doe"
      ["role"]=>
      string(5) "admin"
    }
  }
  ["S"]=>
  array(1) {
    [0]=>
    array(4) {
      ["id"]=>
      int(2)
      ["first_name"]=>
      string(5) "Sally"
      ["last_name"]=>
      string(5) "Smith"
      ["role"]=>
      string(4) "user"
    }
  }
  ["J"]=>
  array(1) {
    [0]=>
    array(4) {
      ["id"]=>
      int(3)
      ["first_name"]=>
      string(4) "Jane"
      ["last_name"]=>
      string(5) "Jones"
      ["role"]=>
      string(5) "admin"
    }
  }
  ["B"]=>
  array(1) {
    [0]=>
    array(4) {
      ["id"]=>
      int(4)
      ["first_name"]=>
      string(3) "Bob"
      ["last_name"]=>
      string(5) "Brown"
      ["role"]=>
      string(4) "user"
    }
  }
}
Done
