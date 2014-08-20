<?php

// Loading all required classes
require_once( __DIR__ . '/../../lib/autoload.php');


// Insert a new user into `user`

$name = 'user' . rand();
$email = $name . '@example.com';

$q = new Query;
$q
        ->insert_into(
                '`user`', array(
            '`name`' => $name,
            '`email`' => $email,
                )
);

$result = $q->run();
$insert_id = $q->get_insert_id();

if (!($result && $insert_id > 0)) {
    echo 'Sorry, could not add user.' . "\n";
} else {
    echo 'User added.' . "\n";
}

$q->show();

/*
User added.
    INSERT INTO `user` (
        `name`,
        `email`
    )
    VALUES (
        "user1039877430",
        "user1039877430@example.com"
    )
*/
