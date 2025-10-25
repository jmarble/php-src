--TEST--
Test array_group_by() function: multiple groups (items in multiple groups)
--FILE--
<?php

echo "*** Testing array_group_by() : items in multiple groups ***\n";

$items = array(
    array('id' => 1, 'name' => 'PHP', 'tags' => ['programming', 'web']),
    array('id' => 2, 'name' => 'JavaScript', 'tags' => ['programming', 'web', 'frontend']),
    array('id' => 3, 'name' => 'MySQL', 'tags' => ['database', 'backend']),
    array('id' => 4, 'name' => 'Redis', 'tags' => ['database', 'cache']),
);

echo "-- Group by tags (each item in multiple groups) --\n";
$grouped = array_group_by($items, fn($item) => $item['tags']);
var_dump($grouped);

echo "\n-- Same with preserve_keys --\n";
$grouped = array_group_by($items, fn($item) => $item['tags'], true);
var_dump($grouped);

echo "Done\n";
?>
--EXPECT--
*** Testing array_group_by() : items in multiple groups ***
-- Group by tags (each item in multiple groups) --
array(6) {
  ["programming"]=>
  array(2) {
    [0]=>
    array(3) {
      ["id"]=>
      int(1)
      ["name"]=>
      string(3) "PHP"
      ["tags"]=>
      array(2) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
      }
    }
    [1]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(10) "JavaScript"
      ["tags"]=>
      array(3) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
        [2]=>
        string(8) "frontend"
      }
    }
  }
  ["web"]=>
  array(2) {
    [0]=>
    array(3) {
      ["id"]=>
      int(1)
      ["name"]=>
      string(3) "PHP"
      ["tags"]=>
      array(2) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
      }
    }
    [1]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(10) "JavaScript"
      ["tags"]=>
      array(3) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
        [2]=>
        string(8) "frontend"
      }
    }
  }
  ["frontend"]=>
  array(1) {
    [0]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(10) "JavaScript"
      ["tags"]=>
      array(3) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
        [2]=>
        string(8) "frontend"
      }
    }
  }
  ["database"]=>
  array(2) {
    [0]=>
    array(3) {
      ["id"]=>
      int(3)
      ["name"]=>
      string(5) "MySQL"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(7) "backend"
      }
    }
    [1]=>
    array(3) {
      ["id"]=>
      int(4)
      ["name"]=>
      string(5) "Redis"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(5) "cache"
      }
    }
  }
  ["backend"]=>
  array(1) {
    [0]=>
    array(3) {
      ["id"]=>
      int(3)
      ["name"]=>
      string(5) "MySQL"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(7) "backend"
      }
    }
  }
  ["cache"]=>
  array(1) {
    [0]=>
    array(3) {
      ["id"]=>
      int(4)
      ["name"]=>
      string(5) "Redis"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(5) "cache"
      }
    }
  }
}

-- Same with preserve_keys --
array(6) {
  ["programming"]=>
  array(2) {
    [0]=>
    array(3) {
      ["id"]=>
      int(1)
      ["name"]=>
      string(3) "PHP"
      ["tags"]=>
      array(2) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
      }
    }
    [1]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(10) "JavaScript"
      ["tags"]=>
      array(3) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
        [2]=>
        string(8) "frontend"
      }
    }
  }
  ["web"]=>
  array(2) {
    [0]=>
    array(3) {
      ["id"]=>
      int(1)
      ["name"]=>
      string(3) "PHP"
      ["tags"]=>
      array(2) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
      }
    }
    [1]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(10) "JavaScript"
      ["tags"]=>
      array(3) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
        [2]=>
        string(8) "frontend"
      }
    }
  }
  ["frontend"]=>
  array(1) {
    [1]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(10) "JavaScript"
      ["tags"]=>
      array(3) {
        [0]=>
        string(11) "programming"
        [1]=>
        string(3) "web"
        [2]=>
        string(8) "frontend"
      }
    }
  }
  ["database"]=>
  array(2) {
    [2]=>
    array(3) {
      ["id"]=>
      int(3)
      ["name"]=>
      string(5) "MySQL"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(7) "backend"
      }
    }
    [3]=>
    array(3) {
      ["id"]=>
      int(4)
      ["name"]=>
      string(5) "Redis"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(5) "cache"
      }
    }
  }
  ["backend"]=>
  array(1) {
    [2]=>
    array(3) {
      ["id"]=>
      int(3)
      ["name"]=>
      string(5) "MySQL"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(7) "backend"
      }
    }
  }
  ["cache"]=>
  array(1) {
    [3]=>
    array(3) {
      ["id"]=>
      int(4)
      ["name"]=>
      string(5) "Redis"
      ["tags"]=>
      array(2) {
        [0]=>
        string(8) "database"
        [1]=>
        string(5) "cache"
      }
    }
  }
}
Done
