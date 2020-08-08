<?php 
	class Controller
	{
		public $connection;
		
		### CONNECTION MANAGER
		public function __construct()
		{
			$this->connection = new PDO('mysql:host='.$GLOBALS['DBHOST'].';dbname='.$GLOBALS['DBNAME'].';charset=utf8', $GLOBALS['DBUSER'], $GLOBALS['DBPASS']);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		
		// SQL Injection Check - By Nirjhor //
		public function sqlInjCheck($value)
		{
			// Decode HTML to Text //
			$value = urldecode($value);
			
			// Strip Slashes //
			if (get_magic_quotes_gpc())
			{
				$value = stripslashes($value);
			}
			
			// Quote if not a Number //
			if (!is_numeric($value))
			{
				@$value = strip_tags(mysql_real_escape_string($value));
			}
			
			// Trim //
			$value = trim($value);
			
			return @$value;
		}
		
		// Character + Number + Space Checking Function - By Nirjhor //
		public function letNumCheck($value)
		{
			$value = urldecode($value); // Changable //
			if (!preg_match('/[^a-z A-Z 0-9\s]/i', $value))
			{
				return $value;
			} 
			else 
			{
				return '';
			}
		}
		
		// Letter + Space Checking Function - By Nirjhor //
		public function alphaCheck($value)
		{
			$value = urldecode($value); // Changable //
			if (!preg_match('/[^a-z A-Z\s]/i', $value))
			{
				return $value;
			} 
			else 
			{
				return '';
			}
		}
		
		// Function to Check Password Field (Alphabets + Numbers + At-The-Rate Sign + #&-.@) - By Nirjhor //
		public function passCheck($value)
		{
			$value = trim($value);
			
			if(preg_match('/[$%^()+=\\[\]\';,\/{}|":<>?~\\\\]/', $value) == 0)
			return $value;
			else
			return '';
		}
		
		// Function to Check Mail Field - By Nirjhor //
		public function mailCheck($value)
		{
			$value = trim($value);
			
			if(preg_match('/[#$%^&*()+=\\[\]\';,\/{}|":<>?~\\\\]/', $value) == 0)
			return $value;
			else
			return '';
		}
		
		/* ---------- ---------- ---------- SECURITY FUNCTION ---------- ---------- ---------- */
		
		// SEND SIGNUP MAIL / ADMIN or USER //
		public function smtpMail($mailConfig, $mailDetails, $mailReceiver)
		{
			require_once 'novaLibrary/smtpMail/swift_required.php';
			
			$transport = Swift_SmtpTransport::newInstance($mailConfig['host'], $mailConfig['port'])
			->setUsername($mailConfig['email'])
			->setPassword($mailConfig['pass'])
			;
			
			$mailer = Swift_Mailer::newInstance($transport);
			
			$fullMessage = Swift_Message::newInstance($mailDetails['title'])
			->setFrom(array($mailConfig['email'] => $mailConfig['name']))
			->setTo($mailReceiver)
			->setContentType($mailConfig['type'])
			->setBody($mailDetails['body']);
			
			
			$result = $mailer->send($fullMessage);
		}
		
		// VERIFY FILE FORMAT // IMAGE TYPES //
		public function checkImage($fileType, $fileSize, $fileError)
		{
			// 50 MB = 52428800 Bytes //
			if ((($fileType == "image/gif")
			|| ($fileType == "image/jpeg")
			|| ($fileType == "image/jpg")
			|| ($fileType == "image/pjpeg")
			|| ($fileType == "image/x-png")
			|| ($fileType == "image/png"))
			&& ($fileSize < 52428800)
			&& ($fileError <= 0))
			{
				return 1;
			}
			else 
			return 0;
		}
		
		// MAKE PASSWORD // RETURN TO USER for SIGNUP //
		public function makePass() 
		{
			$alphabet = "56789abcdefghijklmnopqrstuwxyz@#%#@ABCDEFGHIJKLMNOPQRSTUWXYZ01234";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) 
			{
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass); //turn the array into a string
		}
		
		public function makeCaptcha($digitNo, $digitColor)
		{
			if($digitNo == 4)
			{
				$rangeValue = rand(1000,9999);
				$my_img = imagecreate( 41, 24 );
			}
			else if($digitNo == 5)
			{
				$rangeValue = rand(10000,99999);
				$my_img = imagecreate( 50, 24 );
			}
			else if($digitNo == 6)
			{
				$rangeValue = rand(100000,999999);
				$my_img = imagecreate( 59, 24 );
			}
			
			if($digitColor == "black")
			{
				$background = imagecolorallocate( $my_img, 255, 255, 255 );
				$text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
			}
			else if($digitColor == "white")
			{
				$background = imagecolorallocate( $my_img, 0, 0, 0 );
				$text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
			}
			$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
			imagestring( $my_img, 5, 3, 3, $rangeValue, $text_colour );
			imagesetthickness ( $my_img, 5 );
			
			
			header( "Content-type: image/png" );
			imagepng( $my_img );
			imagecolordeallocate( $line_color );
			imagecolordeallocate( $text_color );
			imagecolordeallocate( $background );
			imagedestroy( $my_img );
		}
		
		public function makePdf($pdfName, $htmlBody)
		{
			require_once("novaLibrary/domPdf/dompdf_config.inc.php");
			$dompdf = new DOMPDF();
			$dompdf->load_html($htmlBody);
			$dompdf->render();
			$dompdf->stream($pdfName);
		}
		
		// CHECK USER AGENT TYPE // PC-USER OR MOBILE-USER OR BOT //
		public function agentCheck()
		{
			$user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
			
			if ( preg_match ( "/abrowse\/|acoo browser\/|america online browser\/|amigavoyager\/|aol\/|arora\/|avant browser\/|beonex\/|bonecho\/|browzar\/|camino\/|charon\/|cheshire\/|chimera\/|cirefox\/|chrome\/|chromeplus\/|classilla\/|cometbird\/|comodo_dragon\/|conkeror\/|crazy browser\/|cyberdog\/|deepnet explorer\/|deskbrowse\/|dillo\/|dooble\/|element browser\/|elinks\/|enigma browser\/|enigmafox\/|epiphany\/|escape\/|firebird\/|firefox\/|fireweb navigator\/|flock\/|fluid\/|galaxy\/|galeon\/|granparadiso\/|greenbrowser\/|hana\/|hotjava\/|ibm webexplorer\/|ibrowse\/|icab\/|iceape\/|icecat\/|iceweasel\/|inet browser\/|internet explorer\/|irider\/|iron\/|k-meleon\/|k-ninja\/|kapiko\/|kazehakase\/|kindle browser\/|kkman\/|kmlite\/|konqueror\/|leechcraft\/|links\/|lobo\/|lolifox\/|lorentz\/|lunascape\/|lynx\/|madfox\/|maxthon\/|midori\/|minefield\/|mozilla\/|myibrow\/|myie2\/|namoroka\/|navscape\/|ncsa_mosaic\/|netnewswire\/|netpositive\/|netscape\/|netsurf\/|omniweb\/|opera\/|orca\/|oregano\/|osb-browser\/|palemoon\/|phoenix\/|pogo\/|prism\/|qtweb internet browser\/|rekonq\/|retawq\/|rockmelt\/|safari\/|seamonkey\/|shiira\/|shiretoko\/|sleipnir\/|slimbrowser\/|stainless\/|sundance\/|sunrise\/|surf\/|sylera\/|tencent traveler\/|tenfourfox\/|theworld browser\/|uzbl\/|vimprobable\/|vonkeror\/|w3m\/|weltweitimnetzbrowser\/|worldwideweb\/|wyzo\//", $user_agent ) )
			$user = "PC";
			
			if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|kyocera|handspring|android|android webkit browser|blackberry|blazer|bolt|browser for s60|doris|dorothy|fennec|go browser|ie mobile|iris|maemo browser|mib|minimo|netfront|opera mini|opera mobile|semc-browser|skyfire|teashark|teleca-obigo|uzard web|epoc|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|mobile|pda;|avantgo|eudoraweb|minimo|smartphone|netfront|motorola|mmp|opwv|playstation portable|brew|teleca|lg;|lge |wap;| wap|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) )
			$user = "MOBILE";
			
			if ( preg_match ( "/rambler|008|abachobot|accoona-ai-agent|addsugarspiderbot|anyapexbot|arachmo|b-l-i-t-z-b-o-t|baiduspider|becomebot|beslistbot|billybobbot|bimbot|bingbot|blitzbot|boitho.com-dc|boitho.com-robot|btbot|catchbot|cerberian drtrs|charlotte|converacrawler|cosmos|covario ids|dataparksearch|diamondbot|discobot|dotbot|earthcom.info|emeraldshield.com webbot|envolk[its]spider|esperanzabot|exabot|fast enterprise crawler|fast-webcrawler|fdse robot|findlinks|furlbot|fyberspider|g2crawler|gaisbot|galaxybot|geniebot|gigabot|girafabot|googlebot|googlebot-image|gurujibot|happyfunbot|hl_ftien_spider|holmes|htdig|iaskspider|ia_archiver|iccrawler|ichiro|igdespyder|irlbot|issuecrawler|jaxified bot|jyxobot|koepabot|l.webis|lapozzbot|larbin|ldspider|lexxebot|linguee bot|linkwalker|lmspider|lwp-trivial|mabontland|magpie-crawler|mediapartners-google|mj12bot|mlbot|mnogosearch|mogimogi|mojeekbot|moreoverbot|morning paper|msnbot|msrbot|mvaclient|mxbot|netresearchserver|netseer crawler|newsgator|ng-search|nicebot|noxtrumbot|nusearch spider|nutchcvs|nymesis|obot|oegp|omgilibot|omniexplorer_bot|oozbot|orbiter|pagebiteshyperbot|peew|polybot|pompos|postpost|psbot|pycurl|qseero|radian6|rampybot|rufusbot|sandcrawler|sbider|scoutjet|scrubby|searchsight|seekbot|semanticdiscovery|sensis web crawler|seochat::bot|seznambot|shim-crawler|shopwiki|shoula robot|silk|sitebot|snappy|sogou spider|sosospider|speedy spider|sqworm|stackrambler|suggybot|surveybot|synoobot|teoma|terrawizbot|thesubot|thumbnail.cz robot|tineye|truwogps|turnitinbot|tweetedtimes bot|twengabot|updated|urlfilebot|vagabondo|voilabot|vortex|voyager|vyu2|webcollage|websquash.com|wf84|wofindeich robot|womlpefactory|xaldon_webspider|yacy|yahoo! slurp|yahoo! slurp china|yahooseeker|yahooseeker-testing|yandexbot|yandeximages|yandexmetrika|yasaklibot|yeti|yodaobot|yooglifetchagent|youdaobot|zao|zealbot|zspider|zyborg|yahoo|abachobot|accoona|aciorobot|aspseek|cococrawler|dumbot|geonabot|lycos|scooter|altavista|idbot|estyle|adsbot|yahoobot|watchmouse|pingdom\.com/", $user_agent ) ) 
			$user = "WEBBOT";
			
			if ( preg_match ( "/abilogicbot|link valet|link validity check|linkexaminer|linksmanager.com_bot|mojoo robot|notifixious|online link validator|ploetz + zeller|reciprocal link system pro|rel link checker lite|sitebar|vivante link checker|w3c-checklink|xenu link sleuth/", $user_agent ) )
			$user = "LINKBOT";
			
			if ( preg_match ( "/awasu|bloglines|everyfeed-spider|feedfetcher-google|greatnews|gregarius|magpierss|nfreader|universalfeedparser/", $user_agent ) )
			$user = "FEEDBOT";
			
			return $user;
		}
		
		public function ipCheck()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) // IP from Share Internet
			{
				$ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) // Whether IP is Pass from Proxy
			{
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
				$ip=$_SERVER['REMOTE_ADDR'];
			}
			
			if($ip="::1")
			$ip="127.0.0.1";
			
			return $ip;
		}
		
		public function hostCheck()
		{
			$ip = $this->ipCheck();
			$host = gethostbyaddr($ip);
			
			return $host;
		}
		
		public function safeDownload($fileLink, $downloadAs)
		{
			$path = $fileLink;
			
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=" . $downloadAs);
			header( "Content-Description: File Transfer");
			header ("Content-type: octet/stream"); 
			@readfile($path);
		}
		
		## [C]ovnert Function
		public function convertDataToChartFormat($data)
		{
			$newData = array();
			$firstLine = true;
			
			foreach ($data as $dataRow)
			{
				if ($firstLine)
				{
					$newData [ ] = array_keys($dataRow);
					$firstLine = false;
				}				
				$newData [ ] = array_values($dataRow); 
			}			
			return $newData;
		}
	}
?>