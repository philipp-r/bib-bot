<?php

if(!empty($_POST['submit'])){

  // if user exists: delete
  $currentUserDataJ = file_get_contents("/var/www/bibbot/bot.json");
  $currentUserData = json_decode($currentUserDataJ, true);
  unset( $currentUserData[$_POST['uid']] );

  // add new data
  $userData = $currentUserData;
  $userData[$_POST['uid']] = array($_POST['uid'], $_POST['password'], $_POST['bib']);
  file_put_contents( "bot.json", json_encode($userData) );

  // output
  print_r("Erfolgreich Bot aktiviert für: ".$_POST['uid']);
  die;

}


else{ ?>
<html>
<head>
  <title>Bib-Bot Login</title>
</head>
<body>

  <h1>Bib-Bot</h1>

  <form method="POST" action="login.php">
    <label for="uid">Benutzername</label>
    <input type="text" name="uid" id="uid" />
    <br />
    <label for="password">Passwort</label>
    <input type="password" name="password" id="password" />
    <br />
    <input type="radio" name="bib" id="bib-a3" value="a3" />
    <label for="bib-a3">Bib: A3</label><br />
    <input type="radio" name="bib" id="bib-a5" value="a5" />
    <label for="bib-a5">Bib: A5</label><br />
    <input type="radio" name="bib" id="bib-eh" value="eh" />
    <label for="bib-eh">Bib: Ehrenhof</label><br />
    <input type="radio" name="bib" id="bib-bss" value="bss" />
    <label for="bib-bss">Bib: BWL Schneckenhof</label><br />
    <p>Benutzername und Passwort werden im Klartext gespeichert!<br />
    <em>Daten löschen? E-Mail an bib-bot@8qq.de</em></p>
    <input type="submit" name="submit" id="submit" />
  </form>

</body>
</html>
<?php } ?>
