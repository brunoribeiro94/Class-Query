# PHP Class-Query
-----------------
This is a script to make life easier for beginners, medium and advanced programmers.
This script connects to the database using mysqli method further down has some usage examples. 

### Key Features
-----------------
* Uses Mysqli (more security)
* Paging records.
* No SQL Injection.
* Functions and classes very well documented.
* Queries using the class-Query is simple and practical.
* Can use *$q>show()* to show the code SQL executed.
* Taken almost all functions have already been implemented in SQL.
* Main functions already mentioned with an example of SQL.

## Requirements
-----------------
* **PHP 5.3.7+**, PHP 5.4+ or PHP 5.5+
* **MySQL 5** database

## Installation / Usage
-----------------

1. Download the [`composer.phar`](https://getcomposer.org/composer.phar) executable or use the installer.

    ``` sh
    $ curl -sS https://getcomposer.org/installer | php
    ```
    
2. Create a composer.json defining your dependencies. Note that this example is
a short version for applications that are not meant to be published as packages
themselves. To create libraries/packages please read the
[documentation](http://getcomposer.org/doc/02-libraries.md).

    ``` json
    {
	"repositories": [
	    { "type": "git", "url": "https://github.com/offboard/Class-Query"}
	], 
        "require": {  
            "offboard/class-query": "dev-master"
        }
    }
    ```
3. Run Composer: `php composer.phar install`
4. Browse for more packages on [Packagist](https://packagist.org).

## Updating Composer
-----------------

Running `php composer.phar self-update` or equivalent will update a phar
install with the latest version.

## Installation from Source
------------------------

1. Run `git clone https://github.com/offboard/class-query.git /var/www/your-project/libs/`
3. Include the class in your project file: `include('./libs/autoload.php');`

#### CONFIGS IN THE CODE:
-----------------

In *lib/Query/src/Config.php*:
4. enter you array conection in *$Conections_Settings*
5. enter your database credentials in key *DB_USER*, *DB_PASS* etc.
6. enter your charset in key charset.

In *lib/Query/src/Pagination.php*:

7. you can set the default settings for paging numbered below.
8. in ```php $li``` you can Use true to enable li tag in your page with pagination.
9. in ```php $after``` you decide whether to show the "after" button.
10. in ```php $before``` you decide whether to show the "before" button.
11. in ```php $message``` put true if you do not want the button before and after receive text messages put false will show symbols.
12. in ```php $class_active``` is the class name of your stylesheet, if your page is active paging (put null if you want to put anything).
13. in ```php $class_inactive``` is the class name of your stylesheet, if your page is inactive paging (put null if you want to put anything).
14. in ```php $class_before``` use a class on the "before" (put null if you want to put anything).
15. in ```php $class_after``` use a class on the "after" (put null if you want to put anything).


## Quick Install
-----------------
```php
// Loading all classes in lib folder
require_once('autoload.php');
```

## Example Select From Table
-----------------
```php
<?php
// Loading all required classes
require_once('autoload.php');

$q=new Query;
$q
        ->select()
        ->from('`user`')
        ->run();
/* -> 
        SELECT
                *
        FROM
                `user`
*/
?>
```

## Example Select With Order By And Limit
-----------------
```php
<?php
// Loading all required classes
require_once('autoload.php');

// Find the user_id, name and email for all users from the `user` table
$q=new Query;
$q
        ->select(
                array(
                        '`user`.`user_id`',
                        '`user`.`name`',
                        '`user`.`email`'
                )
        )
        ->from('`user`')
        ->order_by('`user`.`name` ASC')
        ->limit(3)
        ->run();
/* -> 
        SELECT
                `user`.`user_id`,
                `user`.`name`,
                `user`.`email`
        FROM
                `user`
        ORDER BY
                `user`.`name` ASC
        LIMIT
                3
*/
if($q){
        $users=$q->get_selected();
        foreach($users as $user){
                echo
                        'Name:'.$user['name'].'<br />'.
                        'Email:'.$user['email'].'<br />'.
                        'User Id:'.$user['user_id'].'.<br />'.
                        '-----<br />'.
                        '';
        }
}
else{
        echo 'Sorry, no users found.';
}
?>
```

## Example Select With Criteria And Limit
-----------------
```php
<?php
// Loading all required classes
require_once('autoload.php');

$id = 'BRA';
$q = new Query;
$q
        ->select()
        ->from('country')
        ->where_equal_to(
                array(
                    'Code' => $id,
                )
        )
        ->limit(1)
        ->run();
$data = $q->get_selected();
$count = $q->get_selected_count();
if (!($data && $count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    // return print result
    echo
    'Code: ' . $data['Code'] . "<br>" .
    'Name: ' . $data['Name'] . "<br>" .
    'Population: ' . $data['Population'] . "<br>" .
    "<hr>";
}
?>
```

## Example Select With where between
-----------------
```php
<?php
// Loading all required classes
require_once('autoload.php');

$q = new Query;
$q
        ->select()
        ->from('country')
        ->where_between(
                array(
                    'SurfaceArea' => array(50, 50000),
                    'Population' => array(10, 75000)
                )
        )
        ->run();

$data = $q->get_selected();
$count = $q->get_selected_count();

if (!($data && $count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    foreach ($data as $dados) {
        echo
        'Code: ' . $dados['Code'] .
        'Name: ' . $dados['Name'] .
        'Population: ' . $dados['Population'];
    }
}
?>
```

## Example Select With pagination
-----------------
```php
<?php
// Loading all required classes
require_once( __DIR__ . '/lib/autoload.php');

// get id of pagination
$id_post = filter_input(INPUT_GET, 'id');
// record limit
$limit = 5;
// defines if the parameter does not exist
$id = isset($id_post) ? $id_post : 1;

$q = new Query;
$q
        ->select()
        ->from('country')
        ->where_equal_to(
                array(
                    'Continent' => 5
                )
        )
        ->page($id)
        ->limit($limit)
        ->order_by('Code ASC')
        ->run();

$data = $q->get_selected();
$count = $q->get_selected_count();

if (!($count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    foreach ($data as $dados) {
        echo
        'Code: ' . $dados['Code'] . "<br>" .
        'Name: ' . $dados['Name'] . "<br>" .
        'Population: ' . $dados['Population'] . "<br>" .
        "<hr>";
    }
}

// configuration
$q->li = false;
$q->class_active = 'page active';
$q->class_inative = 'page';
$q->class_after = 'page';
$q->class_before = 'page';
$q->message = true;
print $q->make_pages('page.php?id=', $id_post);
?>
```

## Example Insert Into
-----------------
```php
<?php
// Loading all required classes
require_once( __DIR__ . '/lib/autoload.php');

$name = 'user'.rand();
$email = $name.'@example.com';
$q = new Query;
$q
	->insert_into(
		'user',
		array(
			'name' => $name,
			'email' => $email
		)
	)
	->run();
	
if (!$q) {
    echo 'sorry, was not possible to insert a new user.';
} else {
    echo 'User successfully added.';
}
?>
```

## Example Update Table With Criteria And Limit
-----------------
```php
<?php
// Loading all required classes
require_once( __DIR__ . '/lib/autoload.php');

$q = new Query;
$q
        ->update('user')
        ->set(
                array(
                        'name' => 'new_user_name',
                        'email' => 'new_email@example.com'
                )
        )
        ->where_equal_to(
                array(
                        'user_id' => 123456
                )
        )
        ->limit(1)
        ->run();
	
if (!$q) {
      echo 'Sorry, could not update user.';
} else {
      echo 'User updated.';
}
?>
```
## Example Delete Table With Criteria
-----------------
```php
<?php
// Loading all required classes
require_once( __DIR__ . '/lib/autoload.php');
$id = rand(1,10);
$q = new Query();
$q
        ->delete('user')
        ->where_equal_to(
                array(
                        'id' => $id
                )
        )
        ->run();
if ($q) {
    echo 'User successfully deleted.';
}else{
    echo 'sorry, it was not possible to delete the user.';
}
?>
```      

## Example Custom SQL
-----------------
```php
<?php
// Loading all required classes
require_once( __DIR__ . '/lib/autoload.php');
$q = new Query();
$q
        ->customSQL("SELECT * FROM country")
        ->run();
$data = $q->get_selected();
$count = $q->get_selected_count();

if (!($count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    foreach ($data as $dados) {
        echo
        'Code: ' . $dados['Code'] . "<br>" .
        'Name: ' . $dados['Name'] . "<br>" .
        'Population: ' . $dados['Population'] . "<br>" .
        "<hr>";
    }
}
?>
```      

## Contribute
-----------------

Please commit only in *develop* branch. The *master* branch will always contain the stable version.

## Current and further development
-----------------

See active issues and requested features here:
https://github.com/offboard/class-query/issues?state=open

## License
-----------------

Licensed under [MIT](http://www.opensource.org/licenses/mit-license.php). Totally free for private or commercial projects.
