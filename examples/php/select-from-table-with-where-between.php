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
        <div id="maincol">
            <h1>Example Live</h1>
            <hr>
            <?php
            // Loading all required classes
            require_once( __DIR__ . '/../../autoload.php');

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

            <hr>
            <h1><a name="Select_From_Table"></a>Example Code<a class="section_anchor"></a></h1>

            <pre class="prettyprint">
// Loading all required classes
require_once( __DIR__ . '/../../autoload.php');

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

if (!($count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    foreach ($data as $dados) {
        echo
        'Code: ' . $dados['Code'] .
        'Name: ' . $dados['Name'] .
        'Population: ' . $dados['Population'];
    }
}
/* $q->show();
        SELECT
                *
        FROM
                country
        WHERE
                SurfaceArea BETWEEN 50 AND 50000 AND
                Population BETWEEN 10 AND 75000 
*/</pre>
            <script src="../js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../js/ph_core.js"></script>
        </div>
    </body>
</html>
