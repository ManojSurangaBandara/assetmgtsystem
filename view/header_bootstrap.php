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
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
        <link rel="stylesheet" type="text/css" media="all" href="../jsdatepick/jsDatePick_ltr.min.css" />
		<link rel="stylesheet" type="text/css" href="../jscript/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../jscript/dataTables.jqueryui.css">
		<link rel="stylesheet" type="text/css" href="../jquery/jquery-ui.css">
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
		<script type="text/javascript" src="../jquery/jquery-ui.js"></script>
		<script type="text/javascript" src="../jquery/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../jquery/jquery.cookie.js"></script>
		<script type="text/javascript" src="../jquery/jquery.table2excel.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.plugin.from_html.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.plugin.split_text_to_size.js"></script>
		<script type="text/javascript" src="../jquery/jspdf.plugin.standard_fonts_metrics.js"></script> 
		<script type="text/javascript" src="../jquery/jspdf.debug.js"></script> 
		<link href="../tablesorter/dist/css/theme.default.min.css" rel="stylesheet">
		<script src="../tablesorter/dist/js/jquery.tablesorter.min.js"></script>
		<script src="../tablesorter/dist/js/jquery.tablesorter.widgets.min.js"></script>
		<script src="../tablesorter/dist/js/jquery.tablesorter.js"></script>
		<script src="../tablesorter/dist/js/jquery.tablesorter.widgets.js"></script>
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
<script type="text/javascript">
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('abc'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
<style type="text/css">
.blink_text {

animation:1s blinker linear infinite;
-webkit-animation:1s blinker linear infinite;
-moz-animation:1s blinker linear infinite;

 color: red;
}

@-moz-keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }

@-webkit-keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }

@keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }
 </style>
    </head>
<?php include('mainmenu.php'); ?>