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
		
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">


    google.load("elements", "1", {
        packages: "transliteration"
    });

    function onLoad() {
        var options = {
            sourceLanguage:
               google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.SINHALESE],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

       var control =
            new google.elements.transliteration.TransliterationControl(options);

   control.makeTransliteratable(['comment']);
        control.makeTransliteratable(['name']);
		control.makeTransliteratable(['sname']);
   }
    google.setOnLoadCallback(onLoad);
</script>
<script language="javascript" type="text/javascript">


function greetVisitor(i)
{
//	var $my_variable = i;
//$.ajax({
//     url: 'index.php?action=changelanguage&lang=$my_variable',
//     data: {x: $my_variable},
//     type: 'POST'
//});
	//localStorage.setItem('lang', i);
	document.cookie="lang="+i;
	document.location.reload();
}


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
    <td style="float: right;"><b>Language : </b><a href="javascript:greetVisitor(0)">English</a>&nbsp;&nbsp;<a href="javascript:greetVisitor(1)">සිංහල</a>&nbsp;&nbsp;<a href="javascript:greetVisitor(2)">தமிழ்</a></td>
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
                                <?php if ($_SESSION['SESS_LEVEL'] == 1) { ?>				
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
                        </ul>
                    </div>




<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Quick Info
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                                <?php
                                                break;
                                            case '1':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>
                                                <?php
                                                break;
                                            case '2':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Catalogue Number Already Entered !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>
                                                <?php
                                                break;
                                            case '6':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Deleted</strong></li>
                                        <?php } ?>
                                    </ul>

                                    <div style="width: 640px; float: left; height: auto; border: 1px #D0D0D0 solid; padding: 5px;">

                                        <div id="commentsend" style="color:#000000; float:left; margin-top:10px; margin-left:5px;"></div>


                                        <div id="normal_comment">

                                            <form name="frm_add" method="post" id="frm_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Add_QuickInfo" />
										<input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                <div class="box">
                                                    <p class="comment_field_text">Title  :</p>
                                                    <input type="text" name="name" value="<?php echo $title; ?>" id="name" class="text_field" style="width:400px" />								</div>
                                                <div class="box">
                                                    <p class="comment_field_text">Details : </p>
                                                    <textarea name="comment" cols="90" rows="12" id="comment" class="text_area" ><?php echo $details; ?></textarea>			  
                                                </div>
												<div class="box">
                                                    <p class="comment_field_text">Activate : </p>
                                                    <input name="activate" type="checkbox" value="" <?php if($activate == 1) echo "checked=checked"; ?> > Select / Deselect			  
                                                </div>
                                                <div>
												
                                                </div>
                                                <div class="buttons">
                                                    <ul>
                                                        <li><span class="button send_form_btn"><span><span>Add Details</span></span><input name="" type="submit"/></span> </li>
                                                    </ul>       
                                                </div>
												</form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>










