# JSON DB PHP

This is a simple PHP class that allows you to store and manipulate data in a JSON file.

## Usage

1. Include the `JsonDB.php` file in your project.

```php
require_once 'JsonDB.php';
```

2. Create a new instance of the `JsonDBObject` class by providing the filename of the JSON file and the table name.

```php
$db = new JsonDBObject('data.json', 'users');
```

3. Insert data into the JSON database.

```php
$userData = array(
    'name' => 'John Doe',
    'age' => 10,
    'email' => 'johndoe@example.com'
);
$db->insert($userData);
```

4. Retrieve all data from the JSON database.

```php
$allData = $db->getAll();
print_r($allData);
```

5. Retrieve data at a specific index from the JSON database.

```php
$user = $db->getRecord(0);
print_r($user);
```

6. Update data at a specific index in the JSON database.

```php
$user['age'] = 31;
$db->update(0, $user);
```

7. Delete data at a specific index from the JSON database.

```php
$db->delete(0);
```

## Class `JsonDB`

### Constructor

The `JsonDB` class constructor accepts a single parameter: the filename of the JSON file to load or create.

```php
$db = new JsonDB('data.json');
```

### Methods

- `get($key)`: Retrieves the value associated with the given key from the JSON database. If the key does not exist, it returns `null`.

- `set($key, $value)`: Sets the value associated with the given key in the JSON database. If the key already exists, it updates the value.

- `delete($key)`: Deletes the value associated with the given key from the JSON database.

- `getAll()`: Retrieves all data from the JSON database as an associative array.

## Class `JsonDBObject`

The `JsonDBObject` class extends the `JsonDB` class and provides additional methods for working with JSON database tables.

### Constructor

The `JsonDBObject` class constructor accepts two parameters: the filename of the JSON file and the table name.

```php
$db = new JsonDBObject('data.json', 'users');
```

### Methods

- `insert($data)`: Inserts a new record into the specified table.

- `update($index, $data)`: Updates the record at the specified index in the table.

- `delete($index)`: Deletes the record at the specified index from the table.

- `getAll()`: Retrieves all records from the table.

- `getRecord($index)`: Retrieves the record at the specified index from the table. If the index is out of bounds, it returns `null`.

## Example

```php
<?php

require_once 'JsonDB.php';

// Create a new instance of JsonDBObject
$db = new JsonDBObject('data.json', 'users');

// Insert data into the JSON database
$userData = array(
    'name' => 'John Doe',
    'age' => 10,
    'email' => 'johndoe@example.com'
);
$db->insert($userData);

// Retrieve all data from the JSON database
$allData = $db->getAll();
print_r($allData);

// Retrieve data at a specific index from the JSON database
$user = $db->getRecord(0);
print_r($user);

// Update data at a specific index in the JSON database
$user['age'] = 31;
$db->update(0, $user);



// Delete data at a specific index from the JSON database
$db->delete(0);

?>
```

## License

This project is licensed under the [MIT License](LICENSE).
