<?php 


// Kickstart the framework 
$f3=require('lib/base.php'); 

$db=new \DB\SQL('mysql:host=localhost;port=3306;dbname=test','admin','');
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
		$db=new \DB\SQL('mysql:host=localhost;port=3306;dbname=test','admin','');
		$res = $db->exec("SELECT * FROM need");
		$f3->set("needs", tabgen($res));
		echo View::instance()->render('view/index.php');
	}
);

function tabgen($res){
	$txt='';
	//var_dump($res);
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
                <td>'.$line["status"].'</td>
              </tr>';
}

function getHelpers($id){
		$db=new \DB\SQL('mysql:host=localhost;port=3306;dbname=test','admin','');
		$res = $db->exec("SELECT * FROM gift JOIN user ON user.id=user_id where need_id='$id'");
		foreach ($res as $key => $value) {
			$txt.=$value["name"].", ";
		}
	return $txt;
}

$f3->run(); 
