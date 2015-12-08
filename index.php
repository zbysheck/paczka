<?php 


// Kickstart the framework 
$f3=require('lib/base.php'); 

$db=new \DB\SQL('mysql:host=localhost;port=3306;dbname=test','admin','');

//$db=new \DB\SQL('mysql:host=mysql.hostinger.pl;port=3306;dbname=u387000275_paczk','u387000275_paczk','paczka123');
$res = $db->exec("SELECT * FROM need");
//var_dump($res);

$f3->set('DEBUG',1); 
if ((float)PCRE_VERSION<7.9) 
	trigger_error('PCRE version is out of date'); 


// Load configuration 
$f3->config('config.ini'); 


$f3->route('GET /', 
	function($f3) { 
		$classes=array( 
			'Base'=> 
				array( 
					'hash', 
					'json', 
					'session' 
				), 
			'Cache'=> 
				array( 
					'apc', 
					'memcache', 
					'wincache', 
					'xcache' 
				), 
			'DB\SQL'=> 
				array( 
					'pdo', 
					'pdo_dblib', 
					'pdo_mssql', 
					'pdo_mysql', 
					'pdo_odbc', 
					'pdo_pgsql', 
					'pdo_sqlite', 
					'pdo_sqlsrv' 
				), 
			'DB\Jig'=> 
				array('json'), 
			'DB\Mongo'=> 
				array( 
					'json', 
					'mongo' 
				), 
			'Auth'=> 
				array('ldap','pdo'), 
			'Bcrypt'=> 
				array( 
					'mcrypt', 
					'openssl' 
				), 
			'Image'=> 
				array('gd'), 
			'Lexicon'=> 
				array('iconv'), 
			'SMTP'=> 
				array('openssl'), 
			'Web'=> 
				array('curl','openssl','simplexml'), 
			'Web\Geo'=> 
				array('geoip','json'), 
			'Web\OpenID'=> 
				array('json','simplexml'), 
			'Web\Pingback'=> 
				array('dom','xmlrpc') 
		); 
		$f3->set('classes',$classes); 
		$f3->set('content','welcome.htm'); 
		echo View::instance()->render('layout.htm'); 
	} 
); 


$f3->route('GET /userref', 
	function($f3) { 
		$f3->set('content','userref.htm'); 
		echo View::instance()->render('layout.htm'); 
	} 
); 

$f3->route('GET /',
	function($f3){
		global $db;
		$res = $db->exec("SELECT * FROM need");
		$f3->set("needs", "lala");
		echo View::instance()->render('view/index.php');
	}
);

$f3->route('GET /editgifts',
	function($f3){
		echo View::instance()->render('view/editgifts.php');
	}
);
$f3->route('POST /editgifts',
	function($f3){
		echo View::instance()->render('view/editgifts.php');
	}
);
$f3->route('GET /dodaj',
	function($f3){
		echo View::instance()->render('view/dodaj.php');
	}
);
$f3->route('POST /dodaj',
	function($f3){
		echo View::instance()->render('view/dodaj.php');
	}
);

function tabgen($res){
	$txt='';
	foreach ($res as $key => $value) {
		$txt.=onetab($value);
	}
	return $txt;
}

function onetab($line){
	return '
              <tr>
                <td class="mdl-data-table__cell--non-numeric">'.$line["opis"].'</td>
                <td>'.getHelpers($line["id"]).'</td>
                <td>
                <!-- Raised button with ripple -->
				  <form action="dodaj" method="post">
				  <input type="hidden" name="need" value = "'.$line["id"].'"/>
				  <input type="submit" name="Pomóż" value="Pomóż"style="border-style:none;"  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"/></form>
				</td>
                <td>'.$line["status"].'</td>
              </tr>';
}

function getHelpers($id){
		global $db;
		$res = $db->exec("SELECT * FROM gift JOIN user ON user.id=user_id where need_id='$id' and approved='1'");
		foreach ($res as $key => $value) {
			$txt.=$value["name"].", ";
		}
	return $txt;
}

$f3->run(); 
