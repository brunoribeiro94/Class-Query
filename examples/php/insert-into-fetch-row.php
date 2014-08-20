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
    $id = $insert_id;
    echo 'User ' . $id . ' added.' . "\n";

    $q = new Query;
    $q
            ->select(
                    array(
                        '`user`.`id`',
                        '`user`.`name`',
                        '`user`.`email`',
                    )
            )
            ->from('`user`')
            ->where_equal_to(
                    array(
                        '`user`.`id`' => $id,
                    )
            )
            ->limit(1)
            ->run();

    $result = $q->run();
    $count = $q->get_selected_count();

    if (!($result && $count > 0)) {
        echo 'User not found.' . "\n";
    } else {
        list($user['id'], $user['name'], $user['email']) = mysql_fetch_row($result);
        echo
        'Id: ' . $user['id'] . "\n" .
        'Name: ' . $user['name'] . "\n" .
        'Email: ' . $user['email'] . "\n" .
        '';
    }

    $q->show();

    /*
      SELECT
      `user`.`id`,
      `user`.`name`,
      `user`.`email`
      FROM
      `user`
      WHERE
      `user`.`id` = 1
      LIMIT
      1
     */
}
