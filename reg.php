<?php
if (!empty($_POST['website'])) {
	echo '<div id="content2"><form id="login" action="register.php" method="POST">
		<input class="inputl" type="text" name="regusername" value="Nutzername" />
		<input class="inputl" type="password" name="regpassword" value="Passwort" />
		<input class="inputl" type="text" name="regmail" value="name@domain.tld" />
		<input class="inputl" type="text" name="website" value="" style="display:none;"/>
		<input class="buttonl" type="submit" value="Registrieren" /> 
	</form></div>';      
} elseif (!empty($_POST['regusername']) && !empty($_POST['regpassword']) && !empty($_POST['regmail'])) {
	require_once('dbconnect.php');
	$username = mysql_real_escape_string($_POST["regusername"]);
	$password = sha1($_POST["regpassword"]. $salt);
	$mail = mysql_real_escape_string($_POST['regmail']);
	$reg_qry = mysql_query("INSERT INTO `user` (`name`, `password`, `mail`) VALUES ('". $username. "', '". $password."', '". $mail."')");
	if(mysql_num_rows(mysql_query("SELECT * FROM feeds WHERE id = 0")) == 1){
		mysql_query("INSERT INTO feeds_subscription (feedid, userid) VALUES (0, ".mysql_insert_id().")");
	}
	if ($reg_qry != false) {
		echo "<p class='okay'>Registrierung erfolgreich! <a href='/'>Zur Hauptseite</a></p>";
	} else {
		echo "<p class='error'>Registrierung fehlgeschlagen! Eventuell ist dieser Nutzername bereits vergeben! <a href='javascript:history.back()'>Zurück</a></p>";
	}
} else {
	echo '<div id="header"></div><div id="content2">
		<form id="login" action="register.php" method="POST">
		  <input class="inputl" type="text" name="regusername" value="Nutzername" />
		  <input class="inputl" type="password" name="regpassword" value="Passwort" />
		  <input class="inputl" type="text" name="regmail" value="name@domain.tld" />
		  <input class="inputl" type="text" name="website" value="" style="display:none;"/>
		  <input class="buttonl" type="submit" value="Registrieren" /> 
		</form>
	  <a href="index.php" class="buttonl">Abbrechen</a>
	  <div class="clear"></div></div>';
}
?>
