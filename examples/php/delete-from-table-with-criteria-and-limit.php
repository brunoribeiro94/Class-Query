<?php

// Loading all required classes
require_once( __DIR__ . '/../../lib/autoload.php');

$id = 1;
$q = new Query;
$q
        ->delete_from('user')
        ->where_equal_to(
                array(
                    'id' => $id,
                )
        )
        ->limit(1)
        ->run();
if ($q)
    echo 'user deleted with success !';
else
    echo 'was not possible to delete the user';
