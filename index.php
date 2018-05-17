<?php  
    /***************   some Universal Constants here               **********************/
   /*************/     $script_name = "Cambridge Dictionary";     /********************/
  /*************/      $site_name = "Yor Site Name";              /*******************/
 /*************/       $site_link = "http://YOUR SITE LINK";     /******************/
/**************        END OF UNIVERSAL CONSTANTS               ******************/
$whomtosent     = $_POST["whomtosent"];
if (!isset($_POST['submit'])) { // if page is not submitted to itself echo the form
?>


<html>
<head>
      <title><?php echo $script_name ?> Online Script</title>
      <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
                <center><font color="red" size="5"><strong><b> <?php echo $script_name ?> online Script</b></strong></font><br>
                <form method="post" action="<?php  echo $PHP_SELF; ?>">
                         <input type="text" class="text" maxlength="99" name="whomtosent" placeholder="Word"><br><br>
                         <input type="submit" name="submit" class="button" value="Submit">			
                </form>
                       <font class="heading"><strong><font color="red" size="5">!!!<a href="<?php echo $site_link?>" style="text-decoration:none">  <?php echo $site_name ?>  </a>!!!</font><br>
                       <font color="#FF1493" size="5">-- <a href="<?php echo $site_link?>/contact" style="text-decoration:none">Contact us</a>--<br><br> <!--YOUR CONTACT PAGE LINK -->
                       </font></strong></center>
<?php

     } //!isset($_POST['submit'])  closing of this

else {
         // Your work goes here
		 
		 

// $wordToFind = $whomtosent;   // error with capital latter input
$wordToFind = mb_strtolower($whomtosent);  // convert capital latter to lower case
$url = "https://dictionary.cambridge.org/dictionary/english/".$wordToFind;

             // header("Content-Type:text/plain");
             // 1. initialize
                        $ch = curl_init();
 
             // 2. set the options, including the url
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
 
             // 3. execute and fetch the resulting HTML output
                        $output = curl_exec($ch);
 
             // 4. free up the curl handle
                        curl_close($ch);
             // 5. find matching result
                     $re = '/<b class="def">(.*?)<\/b>/';
            	     $count = preg_match_all($re, $output, $matches); //back code is used to display result in for loop $count = preg_match_all($re, $output, $matches, PREG_SET_ORDER, 0);
             // 6. copying array output in a single file 
                                                                                 /*for($i=0;$i<$count;$i++) {  print_r ($matches[$i][1]);  echo "<br>";   }*/
                     $result = implode('<br><br>*******',$matches[0]);
                     // echo $result;
                       $result = str_replace('dictionary.cambridge.org','YOUR SITE NAME WITHOUT HTTP',$result);
                       $result = str_replace('english/','word.php?word=',$result); //FOR CLICK WORD SEARCH
                       $result = str_replace('https','http',$result);

             // 7. Finding pronunciation of searched word .mp3 files  
                $re2 = '/https:\/\/dictionary.cambridge.org\/media\/english\/uk_pron(.*?)"/'; //for UK audio
                $re3 = '/https:\/\/dictionary.cambridge.org\/media\/english\/us_pron(.*?)"/'; //for Us audio              
                 $audio_uk = preg_match($re2, $output, $audiouk);
                 $audio_us = preg_match($re3, $output, $audious);
                     $uk = $audiouk[1]; $us = $audious[1];

             // 7.1 Finding the word pronunciation code
                 $re7 = '/<span class="uk"><span class="pron">\/<span class="ipa">(.*?)\/<\/span>/';
                 $pron_word = preg_match_all($re7, $output, $pronword);

             // 8. Displaying result
              //  echo $result;
              // ?><!-- <br>UK<audio controls><source src="https://dictionary.cambridge.org/media/english/uk_pron<?php echo $uk; ?>" /></audio> --><?php
              // ?><!-- <br>US<audio controls><source src="https://dictionary.cambridge.org/media/english/us_pron<?php echo $us; ?>" /></audio> --><?php               
  
              echo "<center><font class=heading><strong><font color=red size=5>".$script_name." Online Script</font><br><br><br>";          //heading
               // echo "<span class='firstx'>".$result."\n</span><br><br>";                                                                       //Echo MAIN data
                           echo $result;
                           echo '<br>UK - <font color="magenta" size=6><b>'.$pronword[1][0].'</b></font><audio controls><source src="https://dictionary.cambridge.org/media/english/uk_pron'.$uk.'" /></audio>';
                           echo '<br>US - <font color="magenta" size=6><b>'.$pronword[1][1].'</b></font><audio controls><source src="https://dictionary.cambridge.org/media/english/us_pron'.$us.'" /></audio>';
                        // print_r($pronword);
                        // echo $pronword[1][0]; 
                          
		// echo "<span class='firstx'>".$."\n</span><br><br>"; 
         echo "<center><font color=magenta size=3><strong>------------------<a href=index.php> Go Back </a>------------------</strong></font></center>   
         <center><font class=heading><strong><font color=red size=5>!!!   ".$site_name."  !!!</font><br>
         <font color=#FF1493 size=5>-- <a href=".$site_link."/contact style=text-decoration:none>Contact us</a>--<br><br> 
         </font></strong></center>";


                  
    }
?>

<head><title> <?php echo $script_name ?> Online Script</title><link rel="stylesheet" type="text/css" href="style.css">
</head>	
</body>
</html>
