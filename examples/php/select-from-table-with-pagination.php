<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
        <title>class-query</title>
        <link type="text/css" rel="stylesheet" href="../css/core.css">
        <link type="text/css" rel="stylesheet" href="../css/ph_detail.css" >

        <style>
            body {
                background: #dfdfdf;
                color: #666 !important;
                font: 14px/24px sans-serif;
            }

            #container {
                width: 600px;
                margin: 0 auto;
                padding: 20px;
            }

            .btn {
                display: inline-block;
                padding: 10px;
                border-radius: 5px; /*optional*/
                color: #aaa;
                font-size: .875em;
            }

            .pagination {
                background: #f2f2f2;
                padding: 20px;
                margin-bottom: 20px;
            }

            .page {
                display: inline-block;
                padding: 0px 9px;
                margin-right: 4px;
                border-radius: 3px;
                border: solid 1px #c0c0c0;
                background: #e9e9e9;
                box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
                font-size: .875em;
                font-weight: bold;
                text-decoration: none;
                color: #717171;
                text-shadow: 0px 1px 0px rgba(255,255,255, 1);
            }

            .page:hover, .page.gradient:hover {
                background: #fefefe;
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
                background: -moz-linear-gradient(0% 0% 270deg,#FEFEFE, #f0f0f0);
            }

            .page.active {
                border: none;
                background: #616161;
                box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
                color: #f0f0f0;
                text-shadow: 0px 0px 3px rgba(0,0,0, .5);
            }

            .page.gradient {
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f8f8f8), to(#e9e9e9));
                background: -moz-linear-gradient(0% 0% 270deg,#f8f8f8, #e9e9e9);
            }

            .pagination.dark {
                background: #414449;
                color: #feffff;
            }

            .page.dark {
                border: solid 1px #32373b;
                background: #3e4347;
                box-shadow: inset 0px 1px 1px rgba(255,255,255, .1), 0px 1px 3px rgba(0,0,0, .1);
                color: #feffff;
                text-shadow: 0px 1px 0px rgba(0,0,0, .5);
            }

            .page.dark:hover, .page.dark.gradient:hover {
                background: #3d4f5d;
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#547085), to(#3d4f5d));
                background: -moz-linear-gradient(0% 0% 270deg,#547085, #3d4f5d);
            }

            .page.dark.active {
                border: none;
                background: #2f3237;
                box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .1);
            }

            .page.dark.gradient {
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#565b5f), to(#3e4347));
                background: -moz-linear-gradient(0% 0% 270deg,#565b5f, #3e4347);
            }
        </style>
        <!--[if IE]>
         <link type="text/css" rel="stylesheet" href="../css/d_ie.css" >
        <![endif]-->
    </head>
    <body class="t1">
        <div id="maincol">
            <h1>Running example</h1>
            <a href="#Select_From_Table" name="Live_Example">Example Code</a>
            <hr>
            <?php
            // Loading all required classes
            require_once( __DIR__ . '/../../lib/autoload.php');

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
                                'Continent' => 'South America'
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
            print "<b>Light : </b><br>" .
                    $q->make_pages('select-from-table-with-pagination.php?id=', $id_post);

            $q->class_active = 'page dark active';
            $q->class_inative = 'page dark';
            $q->class_after = 'page dark';
            $q->class_before = 'page dark';
            $q->message = false;

            print "<hr><b>Dark</b><br>" .
                    $q->make_pages('select-from-table-with-pagination.php?id=', $id_post);
            ?>

            <hr>
            <h1><a name="Select_From_Table"></a>Example of executing code<a class="section_anchor"></a></h1>
            <a href="#Live_Example">Example of executing code</a>
            <pre class="prettyprint">
// Loading all required classes
require_once( __DIR__ . '/../../lib/autoload.php');

// get id of pagination
$id_post = filter_input(INPUT_GET, 'id');

// record limit
$limit = 4;

// defines if the parameter does not exist
$id = isset($id_post) ? $id_post : 1;

$q = new Query;
$q
        ->select()
        ->from('country')
        ->where_equal_to(
                array(
                    'Continent' => 'South America'
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
        'Code: ' . $dados['Code'] .
        'Name: ' . $dados['Name'] .
        'Population: ' . $dados['Population'];
    }
}
// configuration pagination

// Light mode
$q->li = false;
$q->class_active = 'page active';
$q->class_inative = 'page';
$q->class_after = 'page';
$q->class_before = 'page';
$q->message = true;
print $q->make_pages('select-from-table-with-pagination.php?id=', $id_post);

// Dark Mode
$q->class_active = 'page dark active';
$q->class_inative = 'page dark';
$q->class_after = 'page dark';
$q->class_before = 'page dark';
$q->message = false;

print $q->make_pages('select-from-table-with-pagination.php?id=', $id_post);
/* $q->show();

        SELECT
                *
        FROM
                country
        WHERE
                Continent = 'South America'
        ORDER BY
                Code ASC
        LIMIT
                8, 4
*/</pre>
            <script src="../../examples/js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../../examples/js/ph_core.js"></script>
        </div>
    </body>
</html>
