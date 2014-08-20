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
            $q = new Query;
            $q
                    ->select(
                            array(
                                'c.*',
                            )
                    )
                    ->from('country as c')
                    #->inner_join('city ON city.`CountryCode` = c.`Code`')
                    ->inner_join(
                            array(
                                'city ON city.`CountryCode` = c.`Code`',
                                'countrylanguage ON countrylanguage.`CountryCode` = c.`Code`'
                            )
                    )
                    ->limit(10)
                    ->order_by('c.`Name` asc')
                    ->run();

            $data = $q->get_selected();
            $count = $q->get_selected_count();
            if (!($count > 0)) {
                echo 'Countries not found.' . "\n";
            } else {
                foreach ($data as $dados) {
                    // return print result
                    echo
                    'Code: ' . $dados['Code'] . "<br>" .
                    'Name: ' . $dados['Name'] . "<br>" .
                    'Population: ' . $dados['Population'] . "<br>" .
                    "<hr>";
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
        ->select(
                array(
                    'c.*',
                )
        )
        ->from('country as c')
        #->inner_join('city ON city.`CountryCode` = c.`Code`')
        ->inner_join(
                array(
                    'city ON city.`CountryCode` = c.`Code`',
                    'countrylanguage ON countrylanguage.`CountryCode` = c.`Code`'
                )
        )
        ->order_by('c.`Name` asc')
        ->run();

$data = $q->get_selected();
$count = $q->get_selected_count();

if (!($count > 0)) {
    echo 'Countries not found.' . "\n";
} else {
    foreach ($data as $dados) {
        // return print result
        echo
        'Code: ' . $dados['Code'] .
        'Name: ' . $dados['Name'] .
        'Population: ' . $dados['Population'];
    }
}
/* $q->show();
        SELECT
                c.*
        FROM
                country as c
        INNER JOIN
                city ON city.`CountryCode` = c.`Code`
        INNER JOIN
                countrylanguage ON countrylanguage.`CountryCode` = c.`Code`
        ORDER BY
                c.`Name` asc
*/</pre>
            <script src="../js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../js/ph_core.js"></script>
        </div>
    </body>
</html>
