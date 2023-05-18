<?php
error_reporting(0);
define('SYSTEM_ROOT', dirname(preg_replace('@\\(.*\\(.*$@', '', preg_replace('@\\(.*\\(.*$@', '', __FILE__))) . '/');
session_start();
$seconds = '3';//时间段/秒
$refresh = '5';//刷新次数
$cur_time = time();
if(isset($_SESSION['last_time'])){
 $_SESSION['refresh_times'] += 1;
}else{
 $_SESSION['refresh_times'] = 1;
 $_SESSION['last_time'] = $cur_time;
}
if($cur_time - $_SESSION['last_time'] < $seconds){
 if($_SESSION['refresh_times'] >= $refresh){
  header(sprintf('Location:%s', 'http://127.0.0.1'));
  exit('Access Denied');
 }
}else{
 $_SESSION['refresh_times'] = 0;
 $_SESSION['last_time'] = $cur_time;
}
date_default_timezone_set('Asia/Shanghai');
header('Content-Type: text/html; charset=UTF-8');
function getspider($useragent=''){
	if(CC_Defender==2)return false;
	if(!$useragent){$useragent = $_SERVER['HTTP_USER_AGENT'];}
$useragent=strtolower($useragent);
	if (strpos($useragent, 'baiduspider') !== false){return 'baiduspider';}
	if (strpos($useragent, 'googlebot') !== false){return 'googlebot';}
	if (strpos($useragent, 'soso') !== false){return 'soso';}
	if (strpos($useragent, 'bing') !== false){return 'bing';}
	if (strpos($useragent, 'yahoo') !== false){return 'yahoo';}
	if (strpos($useragent, 'sohu-search') !== false){return 'Sohubot';}
	if (strpos($useragent, 'sogou') !== false){return 'sogou';}
	if (strpos($useragent, 'youdaobot') !== false){return 'YoudaoBot';}
	if (strpos($useragent, 'yodaobot') !== false){return 'YodaoBot';}
	if (strpos($useragent, 'robozilla') !== false){return 'Robozilla';}
	if (strpos($useragent, 'msnbot') !== false){return 'msnbot';}
	if (strpos($useragent, 'lycos') !== false){return 'Lycos';}
	if (strpos($useragent, 'ia_archiver') !== false || strpos($useragent, 'iaarchiver') !== false){return 'alexa';}
	if (strpos($useragent, 'archive.org_bot') !== false){return 'Archive';} 
	if (strpos($useragent, 'robozilla') !== false){return 'Robozilla';} 
	if (strpos($useragent, 'sitebot') !== false){return 'SiteBot';} 
	if (strpos($useragent, 'mj12bot') !== false){return 'MJ12bot';} 
	if (strpos($useragent, 'gosospider') !== false){return 'gosospider';} 
	if (strpos($useragent, 'gigabot') !== false){return 'Gigabot';} 
	if (strpos($useragent, 'yrspider') !== false){return 'YRSpider';} 
	if (strpos($useragent, 'gigabot') !== false){return 'Gigabot';} 
	if (strpos($useragent, 'jikespider') !== false){return 'jikespider';} 
	if (strpos($useragent, 'addsugarspiderbot') !== false){return 'AddSugarSpiderBot';/*非常少*/} 
	if (strpos($useragent, 'testspider') !== false){return 'TestSpider';} 
	if (strpos($useragent, 'etaospider') !== false){return 'EtaoSpider';} 
	if (strpos($useragent, 'wangidspider') !== false){return 'WangIDSpider';} 
	if (strpos($useragent, 'foxspider') !== false){return 'FoxSpider';} 
	if (strpos($useragent, 'docomo') !== false){return 'DoCoMo';} 
	if (strpos($useragent, 'yandexbot') !== false){return 'YandexBot';} 
	if (strpos($useragent, 'ezooms') !== false){return 'Ezooms';/*个人*/} 
	if (strpos($useragent, 'sinaweibobot') !== false){return 'SinaWeiboBot';} 
	if (strpos($useragent, 'catchbot') !== false){return 'CatchBot';} 
	if (strpos($useragent, 'surveybot') !== false){return 'SurveyBot';} 
	if (strpos($useragent, 'dotbot') !== false){return 'DotBot';} 
	if (strpos($useragent, 'purebot') !== false){return 'Purebot';} 
	if (strpos($useragent, 'ccbot') !== false){return 'CCBot';} 
	if (strpos($useragent, 'mlbot') !== false){return 'MLBot';} 
	if (strpos($useragent, 'adsbot-google') !== false){return 'AdsBot-Google';}
	if (strpos($useragent, 'ahrefsbot') !== false){return 'AhrefsBot';}
	if (strpos($useragent, 'spbot') !== false){return 'spbot';}
	if (strpos($useragent, 'augustbot') !== false){return 'AugustBot';}
	return false;
}

if($_GET['rand'] && $_SESSION['rand_session']!=$_GET['rand']){
	@header('Content-Type: text/html; charset=UTF-8');
exit('Access Denied');
}
if(!$_SESSION['rand_session'] && $nosecu!=true){
	if(!getspider()){
		$rand_session=md5(uniqid().rand(1,1000));
	$_SESSION['rand_session']=$rand_session;
		exit("<!DOCTYPE HTML>
<html>
<head>
<meta charset=\"UTF-8\"/>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\" />

<title>安全验证</title>
<script>
  var countdown = 3;
  var intervalid;

  function startCountdown() {
    document.getElementById(\"verificationButton\").style.display = \"none\";
    document.getElementById(\"countdown\").style.display = \"inline\";
    intervalid = setInterval(countdownTimer, 1000);
  }

  function countdownTimer() {
    if (countdown == 0) {
      clearInterval(intervalid);
      window.location.href = \"?{$_SERVER['QUERY_STRING']}&rand={$rand_session}\"; 
    } else {
      document.getElementById(\"countdown\").textContent = \"将在 \" + countdown + \" 秒后重定向\";
      countdown--;
    }
  }
</script>

<style>
  html, body { width: 100%; height: 100%; margin: 0; padding: 0; }
  body { background-color: #333333; font-family: Helvetica, Arial, sans-serif; font-size: 100%; }
  h1 { font-size: 1.5em; color: #ffffff; text-align: center; }
  p { font-size: 1em; color: #ffffff; text-align: center; margin: 10px 0 0 0; }
  #spinner { margin: 0 auto 30px auto; display: block; }
  .attribution { margin-top: 20px; }
  .separator {
    width: 100%;
    height: 1px;
    background-color: #ffffff;
    margin: 20px 0;
  }

  .content {
    text-align: center;
    color: #ffffff;
    margin: 0 20px;
  }
    .footer {
      margin-top: 40px;
      font-size: 0.9em;
      color: #b3b3b3;
    }
  #verificationButton button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1em;
    font-weight: bold;
    color: #ffffff;
    background-color: #66ccff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  #verificationButton button:hover {
    background-color: #45a049;
  }
  #countdown {
    display: none;
    font-size: 1em; /* Adjust the font size as desired */
    color: #ffffff; /* Adjust the font color as desired */
    text-align: center;
    margin-top: 20px;
  }
</style>
</head>
<body>
  <table width=\"100%\" height=\"100%\" cellpadding=\"20\">
    <tr>
      <td align=\"center\" valign=\"middle\">
        <noscript><h2>请启用浏览器的 JavaScript 后重试</h2></noscript>
        <h1><span data-translate=\"checking_browser\">检查站点连接是否安全</span></h1>
        </div>
        <div class=\"separator\"></div>
        <div class=\"content\">
          <p>为了确保您不是机器人，请完成人机验证</p>
        </div>
        <p data-translate=\"process_is_automatic\"></p>
        <div id=\"verificationButton\">
          <button onclick=\"startCountdown()\">点击验证</button>
        </div>
        <div id=\"countdown\">
          <p id=\"mes\"></p>
    </div>
    <div class=\"footer\">
      <p>人机验证 - Code by Iruko</p>
    </div>
  </div>
        </div>
      </td>
    </tr>
  </table>
</body>
</html>
");}}
