<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Class Query - Live Demo </title>
    <link rel='stylesheet' id='main-css'  href='../css/style.css' type='text/css' media='all' />
    <link rel="stylesheet"  href="../css/style_bar.css" type="text/css" media="all" />	
    <script type='text/javascript' src='../js/jquery.js?ver=1.7.1'></script>
    <link rel='stylesheet' id='googleFont-css'  href='http://fonts.googleapis.com/css?family=Oswald' type='text/css' media='all' />
    <script type="text/javascript" src="../js/styleswitcher.jquery.js"></script> 	
    <style>
        .mylogo{
            color: #fefefe !important;
        }
    </style>

    <script type="text/javascript">
        var isIframe = (top.location != self.location);
        if (isIframe) {
            top.location.href = self.location;
        }
    </script>	


    <script>
        jQuery(document).ready(function () {

            jQuery('#style-switcher ,#theme-switcher ,#plugin-switcher').hide();
            jQuery('#style-switcher-button').click(function () {
                jQuery('#style-switcher').show();
                jQuery('#style-switcher-button').hide();
            });

            jQuery('#theme-switcher-button').click(function () {
                jQuery('#theme-switcher').show();
                jQuery('#theme-switcher-button').hide();
            });

            jQuery('#style-switcher').click(function () {
                jQuery('#style-switcher').hide();
                jQuery('#style-switcher-button').show();
            });
            jQuery('#theme-switcher').click(function () {
                jQuery('#theme-switcher').hide();
                jQuery('#theme-switcher-button').show();
            });

            jQuery('#plugin-switcher-button').click(function () {
                jQuery('#plugin-switcher').show();
                jQuery('#plugin-switcher-button').hide();
            });
            jQuery('#plugin-switcher').click(function () {
                jQuery('#plugin-switcher').hide();
                jQuery('#plugin-switcher-button').show();
            });

            /*jQuery('#style-switcher a').click(function() {
             jQuery.cookie("style",jQuery(this).attr('rel'), {expires: 365, path: '/'});
             jQuery("#frame").contents().find("#stylesheet").attr('href', '/bar/css/'+jQuery(this).attr('rel') );
             
             });
             */

            jQuery("#frame").attr("height", (jQuery(window).height() - 60) + 'px');
            jQuery("#frame").load(function () {
                jQuery("#frame").contents().find("#stylesheet").attr('href', '/bar/css/' + getCookie('style'));


            });

            var width = screen.availWidth;

            if (navigator.userAgent.match(/Android/i) ||
                    navigator.userAgent.match(/webOS/i) ||
                    navigator.userAgent.match(/iPhone/i) ||
                    navigator.userAgent.match(/iPad/i) ||
                    navigator.userAgent.match(/iPod/i) ||
                    navigator.userAgent.match(/BlackBerry/) ||
                    navigator.userAgent.match(/Windows Phone/i) ||
                    navigator.userAgent.match(/ZuneWP7/i) ||
                    (width < 1024)
                    ) {
                // some code
                top.location.href = 'http://drive.envato.tabvn.com';
                jQuery(".switchercontainer").hide();


            }

        });
    </script>
</head>
<body>	
    <div class="bar">
        <div class="mylogo"><a href="index.php">Class Query</a></div>				
        <div class="switchercontainer">
            <div class="barselecttheme">
                <div id="theme-switcher-button" >Check our examples code</div>  
                <div id="theme-switcher" >  
                    <div id="closetheme"></div><h4>Examples</h4> 
                    <ul>  
                        <li>
                            <a href="index.php?page=select-from-table">From Table                     
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-distinct-from-table">Distinct From Table                  
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-all-from-table-with-criteria-and-limit">With Criteria And Limit                     
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-from-table-with-order-by-and-limit">With Order By And Limit                      
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-table-inner-join-with-order-by">With Inner Join                    
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-from-table-with-pagination">With Pagination                   
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-from-table-with-where-between">With Where Between                   
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-from-table-with-group-by">With Group By                   
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-from-table-with-limit">With Limit                  
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=select-from-multiples-conections">Select Other Database                  
                                <span class="creativeBar">Select</span>
                            </a>
                        </li>


                    </ul>  
                </div> 		
            </div>


        </div>
    </div>
    <?php
    $get_page = filter_input(INPUT_GET, 'page');
    if (!isset($get_page)) {
        $page = 'select-from-table.php';
    } else {
        $page = $get_page . '.php';
    }
    ?>
    <iframe name="frame" id="frame" src="<?php echo $page; ?>" width="100%" height="100%"></iframe>

</body>
