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

            // Basic select
            $q = new Query;
            $q
                    ->select()
                    ->distinct('Code')
                    ->from('country')
                    ->run();

            $q->show();
            ?>
            <hr>
            <h1><a name="Select_From_Table"></a>Example of executing code<a class="section_anchor"></a></h1>
            <a href="#Live_Example">Example of executing code</a>
            <pre class="prettyprint">
// Loading all required classes
require_once( __DIR__ . '/../../autoload.php');
// Basic select
$q = new Query;
$q
        ->distinct('Code')
        ->from('country')
        ->run();

$q->show();
/* $q->show();
        SELECT DISTINCT
                (`Code`) 
        FROM
                `country`
*/</pre>
            <script src="../js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../js/ph_core.js"></script>
        </div>
    </body>
</html>
