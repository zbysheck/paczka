<?php

  if(!isset($_POST["phone"])){
    global $db;
    var_dump($_POST);
    $need= $_POST["need"];
    unset($_POST);
    $res = $db->exec("select * from need where id='$need'");
  ?>
          Witaj!<br/>
          Chcesz pomóc przy: <?php echo $res[0]["opis"];?><br/>
          <form action="" method="post"><br/>
          Twoja nazwa (Imię i nazwisko, bądź klasa, jeśli deklarujesz się jako całość)<br/>
            <input type ="text" name="name"></input><br/>
          Adres e-mail (potrzebny do kontaktu)<br/>
            <input type ="text" name="mail"></input><br/>
          Numer telefonu (<b>wymagany</b> do weryfikacji)<br/>
            <input type ="text" name="phone"></input><br/>
          Uwagi (tu możesz napisać dokładnie co, lub w jakiej ilości jesteś w stanie zaofiarować)<br/>
            <textarea name="opis", value="uwagi"></textarea><br/>
            <input type="submit"></input><br/>
            <input type="hidden" name="need", value="<?php echo $need;?>"></input><br/>
          </form>
    <?php

	}else{
	    $mail=$_POST["mail"];
	    $name=$_POST["name"];
	    $phone=$_POST["phone"];
	    $uwagi=$_POST["uwagi"];
	    $need_id=$_POST["need"];

	    global $db;
	    $res = $db->exec("INSERT INTO user (name, phone, mail) values ('$name', '$phone', '$mail')");
	    $res = $db->exec("SELECT * FROM user where phone= '$phone'");
	    $user_id= $res[0]["id"];
	    $res = $db->exec("INSERT INTO gift (uwagi, need_id, user_id, newest, approved) values ('$uwagi', '$need_id', '$user_id', '1', '0')");
	  	var_dump($res);
	    echo "Dziękujemy! Skontaktujemy się telefonicznie jak najszybciej aby potwierdzić darowiznę :)";
	  }