<?php
  if(isset($_GET["a"]))
    if($_GET["a"]='del'){
      $id=$_GET["id"];
      global $db;
      $res = $db->exec("SELECT * FROM gift WHERE id='$id'");
      $value = ($res[0]["approved"]=="1")?0:1;
      $res = $db->exec("Update gift SET approved='$value' WHERE id='$id'");

    }


  if(isset($_POST["opis"])){
    var_dump($_POST);
    $opis=$_POST["opis"];
    global $db;
    if(isset($_POST["id"])){
      $opis=$_POST["opis"];
      $status=$_POST["status"];
      $id=$_POST["id"];
      $res = $db->exec("update need set opis='$opis', status='$status' where id='$id'");
    }else
      $res = $db->exec("INSERT INTO need (opis) values ('$opis')");
  }

?>

<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Material Design Lite</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="resources/material.min.css">
    <link rel="stylesheet" href="resources/styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Szlachetna Paczka Gimnazjum nr 123 z oddziałami dwujęzycznymi i oddziałami integracyjnymi</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item">About</li>
            <li class="mdl-menu__item">Contact</li>
            <li class="mdl-menu__item">Legal information</li>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="resources/images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span>
            <?php
              $name = "anonim";
              if(isset($_GET["hash"])){
                $hash=$_GET["hash"];

                global $db;
                $res = $db->exec("SELECT name FROM user where hash='".$hash."'");
                //var_dump($res);
                $name = $res[0]["name"] ?: "anonim";
              }  
              echo $name;
            ?></span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item">hello@example.com</li>
              <li class="mdl-menu__item">info@example.com</li>
              <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i>Trash</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">report</i>Spam</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Forums</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Updates</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Promos</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Purchases</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Social</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">

        <div class="mdl-grid demo-content">
          <div class="demo-table  mdl-cell mdl-cell--8-col mdl-grid">
          <bold class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Użytkownicy</bold></span>
          <table class="mdl-data-table mdl-js-data-table  mdl-shadow--8dp mdl-data-table--selectable ">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric"><span></th>
                <th>nazwa</th>
                <th>adres e-mail</th>
                <th>telefon</th>
                <th>anonim</th>
                <th>admin</th>
                <th>hasz (to tylko dla mnie :) )</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              function tabgen2($res){
                $txt='';
                foreach ($res as $key => $value) {
                  $txt.=onetab2($value);
                }
                return $txt;
              }

              function onetab2($line){
                return '
                            <tr>
                              <td class="mdl-data-table__cell--non-numeric">'.$line["id"].'</td>
                              <td>'.$line["name"].'</td>
                              <td>'.$line["mail"].'</td>
                              <td>'.$line["phone"].'</td>
                              <td>'.$line["anonymous"].'</td>
                              <td>'.$line["admin"].'</td>
                              <td>'.$line["hash"].'</td>
                            </tr>';
              }
              global $db;
              $res = $db->exec("SELECT * FROM user");
              echo tabgen2($res);
            ?>
            </tbody>
          </table></div>
          <div class="demo-table mdl-cell mdl-cell--8-col mdl-grid">
          <bold class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Potrzeby</bold></span>
          <table class="mdl-data-table mdl-js-data-table  mdl-shadow--8dp mdl-data-table--selectable ">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">potrzeba</th>
                <th>status</th>
                <th>Aktualizuj</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              function tabgen4($res){
                //var_dump($res);
                $txt='';
                foreach ($res as $key => $value) {
                  $txt.=onetab4($value);
                }
                return $txt;
              }

              function onetab4($line){
                $label="Aktualizuj";
                $button = '
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" onclick="location.href=\'editgifts/?a=del&id='.$line["id"].'&hash='.$_GET["hash"].'\';">
          '.$label.'
        </button> ';
                return '
                            <tr>
                              <td class="mdl-data-table__cell--non-numeric"><form action="" method="post">
            <textarea name="opis">'.$line["opis"].'</textarea></td>
                              <td><textarea name="status" >'.$line["status"].'</textarea></td>
                              <td>
            <input type="submit" name="id" value="'.$line["id"].'"></input></form></td>
                            </tr>';
              }
              global $db;
              $res = $db->exec("SELECT * FROM need");
              echo tabgen4($res);
            ?>
            </tbody>
          </table></div>
          <form action="editgifts?hash=<?php echo $_GET["hash"]; ?>" method="post">
          Dodaj nową potrzebę
            <textarea name="opis"></textarea>
            <input type="submit"></input>
          </form>
          <div class="demo-table mdl-cell mdl-cell--8-col mdl-grid">
          <bold class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">datki</bold></span>
          <table class="mdl-data-table mdl-js-data-table  mdl-shadow--8dp mdl-data-table--selectable ">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">potrzeba</th>
                <th>osoba</th>
                <th>telefon</th>
                <th>mail</th>
                <th>uwagi</th>
                <th>akceptacja</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              function tabgen3($res){
                //var_dump($res);
                $txt='';
                foreach ($res as $key => $value) {
                  $txt.=onetab3($value);
                }
                return $txt;
              }

              function onetab3($line){
                $label=$line["approved"]=="1"?"odwołaj":"akceptuj";
                $button = '
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" onclick="location.href=\'editgifts/?a=del&id='.$line["id"].'&hash='.$_GET["hash"].'\';">
          '.$label.'
        </button> ';
                return '
                            <tr>
                              <td class="mdl-data-table__cell--non-numeric">'.$line["opis"].'</td>
                              <td>'.$line["name"].'</td>
                              <td>'.$line["phone"].'</td>
                              <td>'.$line["mail"].'</td>
                              <td>'.$line["uwagi"].'</td>
                              <td>'.$button.'</td>
                            </tr>';
              }
              global $db;
              $res = $db->exec("SELECT opis, name, phone, mail, uwagi, approved, gift.id as id FROM gift JOIN user on gift.user_id=user.id JOIN need on need.id=gift.need_id");
              echo tabgen3($res);
            ?>
            </tbody>
          </table></div>
        </div>
      </main>
    </div>
      <a href="google.pl" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>
    <script src="resources/material.min.js"></script>
  </body>
</html>