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
            require_once( __DIR__ . '/../../lib/autoload.php');

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
            if (!($count > 0)) {
                echo 'Countries not found.' . "\n";
            } else {
                // return print result
                echo
                'Code: ' . $data['Code'] . "<br>" .
                'Name: ' . $data['Name'] . "<br>" .
                'Population: ' . $data['Population'] . "<br>" .
                "<hr>";
            }
            /*
              $q->show();


             */
            ?>
            <hr>
            <h1><a name="Select_From_Table"></a>Example of executing code<a class="section_anchor"></a></h1>
            <a href="#Live_Example">Example of executing code</a>
            <pre class="prettyprint">
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
if (!($count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    // return print result
    echo
    'Code: ' . $data['Code'] .
    'Name: ' . $data['Name'] .
    'Population: ' . $data['Population'];
/* $q->show();
        SELECT
            *
        FROM
            `country`
*/</pre>
            <script src="../../examples/js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../../examples/js/ph_core.js"></script>
        </div>
    </body>
</html>
