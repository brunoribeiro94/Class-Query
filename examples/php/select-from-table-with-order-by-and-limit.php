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
            // Get users from `user`
            $q = new Query();
            $q
                    ->select(
                            array(
                                '`country`.`Code`',
                                '`country`.`Name`',
                                '`country`.`Region`',
                            )
                    )
                    ->from('`country`')
                    ->order_by(
                            array(
                                '`country`.`Code` ASC',
                                '`country`.`Name` ASC',
                            )
                    )
                    ->limit(10)
                    ->run();

            $result = $q->get_selected();
            $count = $q->get_selected_count();

            if (!($result && $count > 0)) {
                echo 'No users found.' . "\n";
            } else {
                foreach ($result as $dados) {
                    echo
                    'Code: ' . $dados['Code'] . "<br>" .
                    'Name: ' . $dados['Name'] . "<br>" .
                    'Region: ' . $dados['Region'] . "<br>" .
                    "<hr>";
                }
            }
            ?>
            <hr>
            <h1><a name="Select_From_Table"></a>Example of executing code<a class="section_anchor"></a></h1>
            <a href="#Live_Example">Example of executing code</a>
            <pre class="prettyprint">
            // Loading all required classes
            require_once( __DIR__ . '/../../autoload.php');

            // Get users from `user`
            $q = new Query;
            $q
                    ->select(
                            array(
                                '`country`.`Code`',
                                '`country`.`Name`',
                                '`country`.`Region`',
                            )
                    )
                    ->from('`country`')
                    ->order_by(
                            array(
                                '`country`.`Code` ASC',
                                '`country`.`Name` ASC',
                            )
                    )
                    ->limit(10)
                    ->run();

            $result = $q->get_selected();
            $count = $q->get_selected_count();

            if (!($result && $count > 0)) {
                echo 'No users found.' . "\n";
            } else {
                foreach ($result as $dados) {
                    echo
                    'Code: ' . $dados['Code'] .
                    'Name: ' . $dados['Name'] .
                    'Region: ' . $dados['Region'];
                }
            }
/* $q->show();
        SELECT
                `country`.`Code`,
                `country`.`Name`,
                `country`.`Region`
        FROM
                `country`
        ORDER BY
                `country`.`Code` ASC,
                `country`.`Name` ASC
        LIMIT
                10
*/</pre>
            <script src="../js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="../js/ph_core.js"></script>
        </div>
    </body>
</html>
