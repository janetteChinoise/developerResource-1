<?php 
// 要提取google搜索的部分数据，发现google对于软件抓取它的数据屏蔽的厉害，以前伪造下 USER-AGENT 就可以抓数据，但是现在却不行了。利用抓包数据发现，Google 判断了 cookies，当你没有cookies的时候，直接返回 302 跳转，而且是连续几十个302跳转，根本抓不了数据。
// 因此，在发送搜索命令时，需要先提取 cookies 并保存，然后利用保存下来的这个cookies再次发送搜索命令即可正常抓数据了。这其实和论坛的模拟登录一个道理，先POST登录，获取cookies并保存，然后利用这个cookies访问就可以了。
 
// 一、定义Cookie存储路径

// 必须使用绝对路径

$cookie_jar = dirname(__FILE__)."/pic.cookie";



// 二、获取Cookie

// 将cookie存入文件

$url = "http://1.2.3.4/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
$content = curl_exec($ch);
curl_close($ch);




// 三、模拟浏览器获取验证码

// 该服务器验证码有漏洞，可以自己指定

// 取出cookie，一起提交给服务器，让服务器以为是浏览器打开登陆页面

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://1.2.3.4/getCheckpic.action?rand=6836.185874812305');
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ret = curl_exec($ch);
curl_close($ch);




// 四、POST提交

$post = "name=2&userType=1&passwd=asdf&loginType=1&rand=6836&imageField.x=25&imageField.y=7";   
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://1.2.3.4/loginstudent.action");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
$result=curl_exec($ch);
curl_close($ch);




// 五、到指定页面获取数据

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://1.2.3.4/accountcardUser.action");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,0);       
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
$html=curl_exec($ch);
// var_dump($html);
curl_close($ch);

?>