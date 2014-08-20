<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
        <title>class-query</title>
        <link type="text/css" rel="stylesheet" href="../../examples/css/core.css">
        <link type="text/css" rel="stylesheet" href="../../examples/css/ph_detail.css" >
        <!--[if IE]>
         <link type="text/css" rel="stylesheet" href="../../css/d_ie.css" >
        <![endif]-->
    </head>
    <body class="t1">
        <div id="maincol" >
            <h1>Running example</h1>
            <a href="#Select_From_Table" name="Live_Example">Example Code</a>
            <hr>
            <?php
            // Loading all required classes
            require_once( __DIR__ . '/../../lib/autoload.php');
            
            $q = new Query;
            $q
                    ->select()
                    ->from('`country`')
                    ->group_by(
                            array(
                                '`Continent`',
                                '`Region`',
                            )
                    )
                    ->order_by('`name` ASC')
                    ->run();
            $result = $q->get_selected();
            $count = $q->get_selected_count();
            
            if (!($result && $count > 0)) {
                echo 'User ' . $id . ' not found.' . "\n";
            } else {
                foreach ($result as $user) {
                    echo '<hr />' .
                    "Code: " . $user['Code'] . "<br>" .
                    "Name: " . $user['Name'] . "<br>" .
                    "Region: " . $user['Region'] . "<br>" .
                    "Population: " . $user['Population'] . "<br>" .
                    "Country have been registered on " . strftime('%B %d, %Y at %H:%M:%S', strtotime($user['date'])) . "<br>" .
                    '<hr />';
                }
            }
            ?>
            <hr>
            <h1><a name="Select_From_Table"></a>Example of executing code<a class="section_anchor"></a></h1>
            <a href="#Live_Example">Example of executing code</a>
            <pre class="prettyprint">
// Loading all required classes
require_once( __DIR__ . '/../../lib/autoload.php');


$q = new Query;
$q
        ->select()
        ->from('`country`')
        ->group_by(
                array(
                    '`Continent`',
                    '`Region`',
                )
        )
        ->order_by('`name` ASC')
        ->run();
$result = $q->get_selected();
$count = $q->get_selected_count();

if (!($result && $count > 0)) {
    echo 'User ' . $id . ' not found.' . "\n";
} else {
    foreach ($result as $user) {
        echo
        "Code: " . $user['Code'] .
        "Name: " . $user['Name'] . 
        "Region: " . $user['Region'] . 
        "Population: " . $user['Population'] . 
        "Country have been registered on " . strftime('%B %d, %Y at %H:%M:%S', strtotime($user['date']));
    }
}
/* $q->show();
        SELECT
                *
        FROM
                `country`
        GROUP BY
                `Continent`,
                `Region`
        ORDER BY
                `name` ASC
*/</pre>
            <script src="../../examples/js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../../examples/js/ph_core.js"></script>
        </div>
    </body>
</html>
