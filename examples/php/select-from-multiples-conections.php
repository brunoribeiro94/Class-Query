<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
        <title>class-query</title>
        <link type="text/css" rel="stylesheet" href="../css/core.css">
        <link type="text/css" rel="stylesheet" href="../css/ph_detail.css" >
        <!--[if IE]>
         <link type="text/css" rel="stylesheet" href="../css/d_ie.css" >
        <![endif]-->
    </head>
    <body class="t1">
        <div id="maincol" >
            <h1>Running example</h1>
            <a href="#Select_From_Table" name="Live_Example">Example Code</a>
            <hr>
            <?php
            // Loading all required classes
            require_once( __DIR__ . '/../../autoload.php');
            $q = new Query();
            $q
                    ->select()
                    ->from('menu')
                    ->order_by('position ASC')
                    ->limit(6)
                    ->run();
            $result = $q->get_selected();
            $count = $q->get_selected_count();
            if (!($result && $count > 0)) {
                echo 'User ' . $id . ' not found.' . "\n";
            } else {
                foreach ($result as $user) {
                    echo '<hr />' .
                    "Id: " . $user['id'] . "<br>" .
                    "Name: " . $user['name'] . "<br>" .
                    "Title: " . $user['title'] . "<br>" .
                    "added " . strftime('%B %d, %Y at %H:%M:%S', strtotime($user['data'])) . "<br>" .
                    '<hr />';
                }
            }
            ?>
            <hr>
            <h1><a name="Select_From_Table"></a>Example of executing code<a class="section_anchor"></a></h1>
            <a href="#Live_Example">Example of executing code</a>
            <pre class="prettyprint">
// Loading all required classes
require_once( __DIR__ . '/../../autoload.php');
$q = new Query();
$q
        ->select()
        ->from('menu')
        ->order_by('position ASC')
        ->limit(6)
        ->run();
$result = $q->get_selected();
$count = $q->get_selected_count();
if (!($result && $count > 0)) {
    echo 'User ' . $id . ' not found.' . "\n";
} else {
    foreach ($result as $user) {
        echo
        "Id: " . $user['id'] .
        "Name: " . $user['name'] .
        "Title: " . $user['title'] .
        "added " . strftime('%B %d, %Y at %H:%M:%S', strtotime($user['data']));
    }
}
 
/* $q->show();
        SELECT
                *
        FROM
                menu
        ORDER BY
                position ASC
        LIMIT
                6
*/</pre>
            <script src="../js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../js/ph_core.js"></script>
        </div>
    </body>
</html>
