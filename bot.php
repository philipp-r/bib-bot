<?php
// user logins
$userDataJ = file_get_contents("bot.json");
$userdata = json_decode($userDataJ, true);

// next 14 days
$dates = array(
  date("Y-m-d", time() + ( 1*24*60*60) ),
  date("Y-m-d", time() + ( 2*24*60*60) ),
  date("Y-m-d", time() + ( 3*24*60*60) ),
  date("Y-m-d", time() + ( 4*24*60*60) ),
  date("Y-m-d", time() + ( 5*24*60*60) ),
  date("Y-m-d", time() + ( 6*24*60*60) ),
  date("Y-m-d", time() + ( 7*24*60*60) ),
  date("Y-m-d", time() + ( 8*24*60*60) ),
  date("Y-m-d", time() + ( 9*24*60*60) ),
  date("Y-m-d", time() + (10*24*60*60) ),
  date("Y-m-d", time() + (11*24*60*60) ),
  date("Y-m-d", time() + (12*24*60*60) ),
  date("Y-m-d", time() + (13*24*60*60) ),
);

// foreach user
foreach( $userdata as $user ){
  // string with dates
  $bookdates = "";
  foreach( $dates as $bookday ){
    $bookdates .= "choice-".$bookday."=".$user[2]."&";
  }

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://www.bib.uni-mannheim.de/reservation/");
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $bookdates."lastuid=".$user[0]."&email=checked&uid=".$user[0]."&password=".$user[1] );
  $apiReturns = curl_exec($ch);
  curl_close($ch);

}
