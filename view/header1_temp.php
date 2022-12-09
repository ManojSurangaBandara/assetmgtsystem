<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!-- the head section -->
    <head>
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
        <meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Directorate of Asset Management</title>
        <link rel="shortcut icon" href="../pic/favicon.ico" type="favicon.icon" />
        <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
        <link rel="stylesheet" type="text/css" media="all" href="../jsdatepick/jsDatePick_ltr.min.css" />
		<link rel="stylesheet" type="text/css" href="../jscript/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../jscript/dataTables.jqueryui.css">
		<link rel="stylesheet" type="text/css" href="../jquery/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../tablesorter/themes/blue/style.css">
        <script type="text/javascript" src="../jsdatepick/jsDatePick.min.1.3.js"></script>
        <script type="text/javascript">
            function calendarSetup() {
                pick("inputField1");
                pick("inputField2");
            } //initialize calendar on each date input field 
            function pick(inputField) {
                new JsDatePick({useMode: 2, target: inputField, dateFormat: "%Y-%m-%d"});
            } //display calendar for a given date input field
        </script>		
        <script type="text/javascript" src="../jscript/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../jscript/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../jscript/dataTables.jqueryui.js"></script>
		<script type="text/javascript" src="../jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../jquery/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../jquery/jquery.cookie.js"></script>
		<script type="text/javascript" src="../jquery/jquery.table2excel.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.plugin.from_html.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.plugin.split_text_to_size.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.plugin.standard_fonts_metrics.js"></script> 
		<script type="text/javascript" src="../jquery/jspdf.debug.js"></script> 
		<script type="text/javascript" src="../jquery/FileSaver.js"></script>
		<script type="text/javascript" src="../tablesorter/jquery-latest.js"></script> 
		<script type="text/javascript" src="../tablesorter/jquery.tablesorter.js"></script> 
		<script src="../scripts/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            function getCookie(cname)
            {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++)
                {
                    var c = ca[i].trim();
                    if (c.indexOf(name) == 0)
                        return c.substring(name.length, c.length);
                }
                return "";
            }
            function setCookie(cname) {
                var val1 = document.getElementById(cname).value;
                document.cookie = "quantity=" + val1;
            }
        </script>
        <script>
            function getXMLHTTP() {
                var xmlhttp = false;
                try {
                    xmlhttp = new XMLHttpRequest();
                }
                catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {
                        try {
                            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                        }
                        catch (e1) {
                            xmlhttp = false;
                        }
                    }
                }

                return xmlhttp;
            }

            function getDistrictByProvince(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('Disdiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getDSByDistrict(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('DSdiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getGSByDS(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('GSdiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getAssetsUnitByCenter(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('Unitdiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getMakeByDescription(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('Makediv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }



            function getPresentUnitByUnit(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('PreLocdiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getrequestitem(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('Itmdiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getUnitConvertUnit(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('Areadiv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

           function getGeneratedCodeList(strURL) {

                var req = getXMLHTTP();

                if (req) {

                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            if (req.status == 200) {
                                document.getElementById('Genediv').innerHTML = req.responseText;
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }

            }

            function getGeneratedCode(strURL)
            {
                var req = getXMLHTTP();
                if (req)
                {
                    req.onreadystatechange = function()
                    {
                        if (req.readyState == 4)
                        {
                            if (req.status == 200)
                            {
                                document.getElementById('identificationno').value = req.responseText;
                            }
                            else
                            {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }
            }
        </script> 

<script language="javascript" type="text/javascript">


function greetVisitor(i)
{
	document.cookie="lang="+i;
	document.location.reload();
	$.ajax({
      url: 'index.php',
      type: 'post',
      data: 'action=languagechange&i='+i,
      success: function(data) 
      {
        //  alert('success, server says '+data);
      }, error: function()
      {
          alert('something went wrong, rating failed');
      }
   });
}

</script>
<script type="text/javascript"> 
//Enter Disable
	function stopRKey(evt) { 
		  var evt = (evt) ? evt : ((event) ? event : null); 
		  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
		  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 
			document.onkeypress = stopRKey; 
</script>
    </head>
    <body  onload=calendarSetup()>
        <div id="wrapper">
            <?php
            //Start session
            if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '') || !isset($_SESSION['SESS_PROGRAM']) || !(($_SESSION['SESS_PROGRAM']) == "AMS")) {
                header("location: ../php-login/access-denied.php");
                exit();
            }
            ?>
			 <table style="width:100%">
  <tr>
    <td>            <b><?php echo "User :  " . $_SESSION['SESS_FIRST_NAME'] . " |    "; ?><?php echo "Place : " . $_SESSION['SESS_PLACE'] . " |    "; ?><a href="../php-login/logout.php">Logout</a></b>
            <?php $place = $_SESSION['SESS_PLACE']; ?></td>
    <td id="language" style="float: right;"><b>Language : </b><a href="javascript:greetVisitor(0)">English</a>&nbsp;&nbsp;<a href="javascript:greetVisitor(1)">සිංහල</a>&nbsp;&nbsp;<a href="javascript:greetVisitor(2)">தமிழ்</a></td>
  </tr>
</table> 

            <div id="head">

                <div id="menus_wrapper">
                    <div id="main_menu">
                        <ul>
                            <li><a href="../land_details" <?php
                                if ($page == 1) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[0][$lang] ?></span></span></a></li>
                            <li><a href="../building_details" <?php
                                if ($page == 2) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[1][$lang] ?></span></span></a></li>				
                            <li><a href="../plantmac_details" <?php
                                if ($page == 3) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[2][$lang] ?></span></span></a></li>
                            <li><a href="../offequip_details" <?php
                                if ($page == 4) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[3][$lang] ?></span></span></a></li>
                            <li><a href="../vehicle_details" <?php
                                if ($page == 5) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[4][$lang] ?></span></span></a></li>
                            <!-- <li><a href="../Reports_view" <?php
                                if ($page == 6) {
                                    echo "class=selected";
                                }
                                ?>> <span><span>Reports</span></span></a></li> -->
								<?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 9) { ?>				
                                <li><a href="../tender_details" <?php
                                    if ($page == 9) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span><?php echo $mainMenu[5][$lang] ?></span></span></a></li>
                                <?php } ?>
                                <?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 5) { ?>				
                                <li><a href="../php-login" <?php
                                    if ($page == 7) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>User Controls</span></span></a></li>
                                <?php } ?>
                            <?php //if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 5) { ?>				
                                <li><a href="../controls" <?php
                                    if ($page == 8) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Controls</span></span></a></li>
                                <?php //} ?>
								<?php //if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 5) { ?>				
                                <li><a href="../videos" <?php
                                    if ($page == 10) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Videos</span></span></a></li>
                                <?php //} ?>
                        </ul>
                    </div>
					



