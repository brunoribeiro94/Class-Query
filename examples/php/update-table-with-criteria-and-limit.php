<?php

// Loading all required classes
require_once( __DIR__ . '/../../lib/autoload.php');


// Update user's email
$q = new Query;
$q
        ->update('`user`')
        ->set(
                array(
                    '`user`.`name`' => 'new_user_name',
                    '`user`.`email`' => 'new_email@example.com',
                )
        )
        ->where_equal_to(
                array(
                    '`user`.`id`' => 1
                )
        )
        ->limit(1);

$result = $q->run();

if (!($result && $q->get_affected() > 0)) {
    echo 'Sorry, could not update user.' . "\n";
} else {
    echo 'User updated.' . "\n";
}

$q->show();

/*
    UPDATE
        `user`
    SET
        `user`.`name` = "new_user_name",
        `user`.`email` = "new_email@example.com"
    WHERE
        `user`.`id` = 1
    LIMIT
        1
*/
