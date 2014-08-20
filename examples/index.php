<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
        <title>class-query</title>
        <link type="text/css" rel="stylesheet" href="examples/css/core.css">
        <link type="text/css" rel="stylesheet" href="examples/css/ph_detail.css" >
        <!--[if IE]>
         <link type="text/css" rel="stylesheet" href="css/d_ie.css" >
        <![endif]-->
    </head>
    <body class="t1">
        <div id="maincol">
            <table width="100%">
                <td id="wikicontent" class="psdescription">
                    <p><h1>Class Query</h1> </p><p><ul><li><a href="#Examples">Examples</a></li><ul><li><a href="#Select">Select</a></li><ul><li><a href="#Select_From_Table">Select From Table</a></li><li><a href="#Select_With_Criteria_And_Limit">Select With Criteria And Limit</a></li><li><a href="#Select_With_Order_By_And_Limit">Select With Order By And Limit</a></li><li><a href="#select_inner_join">Select With Inner Join</a></li><li><a href="#Select_With_Page">Select With Page</a></li></ul><li><a href="#Insert">Insert</a></li><ul><li><a href="#Insert_Into">Insert Into</a></li><li><a href="#Insert_Into,_Select_Inserted">Insert Into, Select Inserted</a></li></ul><li><a href="#Update">Update</a></li><ul><li><a href="#Update_Table_With_Criteria_And_Limit">Update Table With Criteria And Limit</a></li></ul><li><a href="#Delete">Delete</a></li></ul><li><a href="#Usage">Usage</a></li><ul><li><a href="#Quick_Install">Quick Install</a></li><li><a href="#Example">Example</a></li><li><a href="#See_All_Examples">See examples running</a></li></ul>
                    </ul> <br></br> </p><h1><a name="Examples"></a>Examples<a href="#Examples" class="section_anchor"></a></h1><h2><a name="Select"></a>Select<a href="#Select" class="section_anchor"></a></h2><h3><a name="Select_From_Table"></a>Select From Table<a href="#Select_From_Table" class="section_anchor"></a></h3><pre class="prettyprint">$q=new Query;
$q
	-&gt;select()
	-&gt;from(&#x27;`user`&#x27;)
	-&gt;run();
/* -&gt; 
	SELECT
		*
	FROM
		`user`
*/</pre><h3><a name="Select_With_Criteria_And_Limit"></a>Select With Criteria And Limit<a href="#Select_With_Criteria_And_Limit" class="section_anchor"></a></h3><pre class="prettyprint">// Find the user_id, name and email for the specified user from the `user` table
$user_id=123456;
$q=new Query;
$q
	-&gt;select(
		array(
			&#x27;`user`.`user_id`&#x27;,
			&#x27;`user`.`name`&#x27;,
			&#x27;`user`.`email`&#x27;
		)
	)
	-&gt;from(&#x27;`user`&#x27;)
	-&gt;where_equal_to(
		array(
			&#x27;`user_id`&#x27;=&gt;$user_id
		)
	)
	-&gt;limit(1)
	-&gt;run();
/* -&gt; 
	SELECT
		`user`.`user_id`,
		`user`.`name`,
		`user`.`email`
	FROM
		`user`
	WHERE
		`user_id`=&#x27;123456&#x27; 
	LIMIT
		1
*/
if($q){
	$user=$q-&gt;get_selected();
	echo
		&#x27;Hello &#x27;.$user[&#x27;name&#x27;].&#x27;,&lt;br /&gt;&#x27;.
		&#x27;Your email is currently set to &#x27;.$user[&#x27;email&#x27;].&#x27; &#x27;.
		&#x27;and your user id is &#x27;.$user[&#x27;user_id&#x27;].&#x27;.&lt;br /&gt;&#x27;.
		&#x27;&#x27;;
}
else{
	echo &#x27;Sorry, user &#x27;.$user_id.&#x27; not found.&#x27;;
}</pre><h3><a name="Select_With_Order_By_And_Limit"></a>Select With Order By And Limit<a href="#Select_With_Order_By_And_Limit" class="section_anchor"></a></h3><pre class="prettyprint">// Find the user_id, name and email for all users from the `user` table
$q=new Query;
$q
	-&gt;select(
		array(
			&#x27;`user`.`user_id`&#x27;,
			&#x27;`user`.`name`&#x27;,
			&#x27;`user`.`email`&#x27;
		)
	)
	-&gt;from(&#x27;`user`&#x27;)
	-&gt;order_by(&#x27;`user`.`name` ASC&#x27;)
	-&gt;limit(3)
	-&gt;run();
/* -&gt; 
	SELECT
		`user`.`user_id`,
		`user`.`name`,
		`user`.`email`
	FROM
		`user`
	ORDER BY
		`user`.`name` ASC
	LIMIT
		3
*/
if($q){
	$users=$q-&gt;get_selected();
	foreach($users as $user){
		echo
			&#x27;Name:&#x27;.$user[&#x27;name&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;Email:&#x27;.$user[&#x27;email&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;User Id:&#x27;.$user[&#x27;user_id&#x27;].&#x27;.&lt;br /&gt;&#x27;.
			&#x27;-----&lt;br /&gt;&#x27;.
			&#x27;&#x27;;
	}
}
else{
	echo &#x27;Sorry, no users found.&#x27;;
}</pre>

                    <h3><a name="select_inner_join"></a>Select With Inner Join<a href="#select_inner_join" class="section_anchor"></a></h3><pre class="prettyprint">// Page 2 of the user_id, name and email for all users from the `user` table
$q=new Query;
$q
	-&gt;select(
		array(
			&#x27;`user`.`user_id`&#x27;,
			&#x27;`user`.`name`&#x27;,
			&#x27;`user`.`email`&#x27;
		)
	)
	-&gt;from(&#x27;`user`&#x27;)
	-&gt;order_by(&#x27;`user`.`name` ASC&#x27;)
	-&gt;limit(3)
	-&gt;page(2)
	-&gt;run();
/* -&gt; 
	SELECT
		`user`.`user_id`,
		`user`.`name`,
		`user`.`email`
	FROM
		`user`
	ORDER BY
		`user`.`name` ASC
	LIMIT
		3,3
*/
if($q){
	$users=$q-&gt;get_selected();
	foreach($users as $user){
		echo
			&#x27;Name:&#x27;.$user[&#x27;name&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;Email:&#x27;.$user[&#x27;email&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;User Id:&#x27;.$user[&#x27;user_id&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;-----&lt;br /&gt;&#x27;.
			&#x27;&#x27;;
	}
}
else{
	echo &#x27;Sorry, no users found.&#x27;;
}</pre>


                    <h3><a name="Select_With_Page"></a>Select With Page<a href="#Select_With_Page" class="section_anchor"></a></h3><pre class="prettyprint">// Page 2 of the user_id, name and email for all users from the `user` table
$q=new Query;
$q
	-&gt;select(
		array(
			&#x27;`user`.`user_id`&#x27;,
			&#x27;`user`.`name`&#x27;,
			&#x27;`user`.`email`&#x27;
		)
	)
	-&gt;from(&#x27;`user`&#x27;)
	-&gt;order_by(&#x27;`user`.`name` ASC&#x27;)
	-&gt;limit(3)
	-&gt;page(2)
	-&gt;run();
/* -&gt; 
	SELECT
		`user`.`user_id`,
		`user`.`name`,
		`user`.`email`
	FROM
		`user`
	ORDER BY
		`user`.`name` ASC
	LIMIT
		3,3
*/
if($q){
	$users=$q-&gt;get_selected();
	foreach($users as $user){
		echo
			&#x27;Name:&#x27;.$user[&#x27;name&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;Email:&#x27;.$user[&#x27;email&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;User Id:&#x27;.$user[&#x27;user_id&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;-----&lt;br /&gt;&#x27;.
			&#x27;&#x27;;
	}
}
else{
	echo &#x27;Sorry, no users found.&#x27;;
}</pre>

                    <h2><a name="Insert"></a>Insert<a href="#Insert" class="section_anchor"></a></h2><h3><a name="Insert_Into"></a>Insert Into<a href="#Insert_Into" class="section_anchor"></a></h3><pre class="prettyprint">$q=new Query;
$q
	-&gt;insert_into(
		&#x27;`user`&#x27;,
		array(
			&#x27;`name`&#x27;=&gt;$name,
			&#x27;`email`&#x27;=&gt;$email
		)
	)
	-&gt;run();
/* -&gt; 
	INSERT INTO `user`(
		`name`,
		`email`
	)
	VALUES(
		&#x27;user1402145267&#x27;,
		&#x27;user1402145267@example.com&#x27;
	)
*/</pre><h3><a name="Insert_Into,_Select_Inserted"></a>Insert Into, Select Inserted<a href="#Insert_Into,_Select_Inserted" class="section_anchor"></a></h3><pre class="prettyprint">// Insert a new user into the `user` table
$name=&#x27;user&#x27;.rand();
$email=$name.&#x27;@example.com&#x27;;
$q=new Query;
$q
	-&gt;insert_into(
		&#x27;`user`&#x27;,
		array(
			&#x27;`name`&#x27;=&gt;$name,
			&#x27;`email`&#x27;=&gt;$email
		)
	)
	-&gt;run();
/* -&gt; 
	INSERT INTO `user`(
		`name`,
		`email`
	)
	VALUES(
		&#x27;user1151175574&#x27;,
		&#x27;user1151175574@example.com&#x27;
	)
*/
if($q){
	$user_id=$q-&gt;get_inserted();
	$q=new Query;
	$q
		-&gt;select_from(
			&#x27;`user`&#x27;,
			array(
				&#x27;`user`.`user_id`&#x27;,
				&#x27;`user`.`name`&#x27;,
				&#x27;`user`.`email`&#x27;
			)
		)
		-&gt;where_equal_to(
			array(
				&#x27;`user`.`user_id`&#x27;=&gt;$user_id
			)
		)
		-&gt;limit(1)
		-&gt;run();
	/* -&gt; 
		SELECT
			`user`.`user_id`,
			`user`.`name`,
			`user`.`email`
		FROM
			`user`
		WHERE
			`user`.`user_id`=&#x27;1151175574&#x27;
		LIMIT
			1
	*/
	if($q){
		$user=$q-&gt;get_selected();
		echo
			&#x27;Name:&#x27;.$user[&#x27;name&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;Email:&#x27;.$user[&#x27;email&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;User Id:&#x27;.$user[&#x27;user_id&#x27;].&#x27;&lt;br /&gt;&#x27;.
			&#x27;-----&lt;br /&gt;&#x27;.
			&#x27;&#x27;;
	}
	else{
		echo &#x27;Sorry, user not found.&#x27;;
	}
}
else{
	echo &#x27;Sorry, could not add user.&#x27;;
}</pre><h2><a name="Update"></a>Update<a href="#Update" class="section_anchor"></a></h2><h3><a name="Update_Table_With_Criteria_And_Limit"></a>Update Table With Criteria And Limit<a href="#Update_Table_With_Criteria_And_Limit" class="section_anchor"></a></h3><pre class="prettyprint">// Update row values in the `user` table
$q=new Query;
$q
	-&gt;update(&#x27;`user`&#x27;)
	-&gt;set(
		array(
			&#x27;`user`.`name`&#x27;=&gt;&#x27;new_user_name&#x27;,
			&#x27;`user`.`email`&#x27;=&gt;&#x27;new_email@example.com&#x27;
		)
	)
	-&gt;where_equal_to(
		array(
			&#x27;`user`.`user_id`&#x27;=&gt;123456
		)
	)
	-&gt;limit(1)
	-&gt;run();
/* -&gt;
	UPDATE
		`user`
	SET
		`user`.`name`=&#x27;new_user_name&#x27;, 
		`user`.`email`=&#x27;new_email@example.com&#x27;
	WHERE
		`user`.`user_id`=&#x27;123456&#x27; 
	LIMIT
		1
*/
if($q){
	echo &#x27;User updated.&#x27;;
}
else{
	echo &#x27;Sorry, could not update user.&#x27;;
}</pre><h2><a name="Delete"></a>Delete<a href="#Delete" class="section_anchor"></a></h2><pre class="prettyprint">$id = 1;
$q = new Query;
$q
        ->delete_from('`user`')
        ->where_equal_to(
                array(
                    '`user`.`id`' => $id,
                )
        )
        ->limit(1)
        ->run();
if ($q)
    echo 'user deleted with success !';
else
    echo 'was not possible to delete the user';</pre><p><br></br> </p><h1><a name="Usage"></a>Usage<a href="#Usage" class="section_anchor"></a></h1><h2><a name="Quick_Install"></a>Quick Install<a href="#Quick_Install" class="section_anchor"></a></h2><ol><li>include &#x27;lib/config.inc.php&#x27;; </li><li>include &#x27;lib/class.query.php&#x27;; </li><li>See <a href="examples/php" rel="nofollow">examples</a> for usage. </li></ol><h2><a name="Example"></a>Example<a href="#Example" class="section_anchor"></a></h2><ol><li>include &#x27;lib/config.inc.php&#x27;; </li><li>include &#x27;lib/class-query.php&#x27;; </li><li>Initialized the Query class and chain parameters. </li><li>Call run(), show() or get() as the last chained function. That is, run the query, show/&quot;echo&quot; the query or return the query; </li><pre class="prettyprint">
// require database config  
// remember to configure mysql or mysqli
require &#x27;lib/config.inc.php&#x27;; 
// require class query
require &#x27;lib/class.query.php&#x27;;

$user_id=123456;
$q=new Query;
$q
	-&gt;select(
		array(
			&#x27;`user`.`user_id`&#x27;,
			&#x27;`user`.`name`&#x27;,
			&#x27;`user`.`email`&#x27;
		)
	)
	-&gt;from(&#x27;`user`&#x27;)
	-&gt;where_equal_to(
		array(
			&#x27;`user_id`&#x27;=&gt;$user_id
		)
	)
	-&gt;limit(1)
	-&gt;run();
if($q){
	$user=$q-&gt;get_selected();
	echo
		&#x27;Hello &#x27;.$user[&#x27;name&#x27;].&#x27;,&lt;br /&gt;&#x27;.
		&#x27;Your email is currently set to &#x27;.$user[&#x27;email&#x27;].&#x27; &#x27;.
		&#x27;and your user id is &#x27;.$user[&#x27;user_id&#x27;].&#x27;.&lt;br /&gt;&#x27;.
		&#x27;&#x27;;
}
else{
	echo &#x27;Sorry, user &#x27;.$user_id.&#x27; not found.&#x27;;
}</pre></ol><h2><a name="See_All_Examples"></a>See examples running<a href="#See_All_Examples" class="section_anchor"></a></h2><p><a href="examples/php" rel="nofollow">See all class-query examples.</a> </p><p><br></br> </p>
                </td>
                </tr>
            </table>
            <script src="examples/js/prettify/prettify_core_compiled.js"></script>
            <script type="text/javascript">prettyPrint();</script>
            <script type="text/javascript" src="examples/js/ph_core.js"></script>
        </div>
    </body>
</html>
