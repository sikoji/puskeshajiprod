<?php
require_once("facebook.php"); // set the right path
$config = array();
$config['appId'] = '569878899882920';
$config['secret'] = '8d4e75854221f881788b775d163b1660';
$config['fileUpload'] = false; // optional
$fb = new Facebook($config);

#https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=569878899882920&client_secret=8d4e75854221f881788b775d163b1660&fb_exchange_token=EAAIGTUVke6gBAOMXpbggg5CZA9TjRQJNEpNeGVB6h73ux99Qco8wS8ZBtNDZCnRztUOgFQPYPbXVmZAsGDkx8V7Q7RTP2adUr7iPHxFVAvdMlULgFjfdqcDdCd464eWv2DmLO5dM9sxirM3wH6UogTctU7TKVTV4nsq0BUVatQZDZD
$params = array(
  // this is the main access token (facebook profile)
  "access_token" => "EAAIGTUVke6gBAO8rpqjvyvIofmNgUFLJ9eZAyZAY04Ebrx2gW8Tfk0MC6bTc0gfqJfIai7xE7cpIf1Q4HTJZBJpQ3ZBUsiZBowBMMSNVq6uxxfCH5vKm5plkwW8X3nyl52w1708wjZCrfnZBCSWLyf9iei9kZBqhP1AZD",
  "message" => $_POST['title'],
  "link" => $_POST['link'],
  "picture" => $_POST['picture']
  
  /*,
  "picture" => "http://i.imgur.com/lHkOsiH.png",
  "name" => "How to Auto Post on Facebook with PHP",
  "caption" => "www.pontikis.net",
  "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
	*/
);

try {
  $ret = $fb->api('/me/feed', 'POST', $params);
  $params = array(
  	"access_token" => "EAAIGTUVke6gBAKZAEfWYuZCbG1w23OLCI1RDr3h8ztPB7YhYPRyV4ZCZBd51EVzYlYBGTJqMXZAd59ZBqk8EohsdCxThY63ZCthCNZC7MMVdWRw27wnbqatiTjoF77ZBGjEKLuVlMkSlVzKRwXCP9wKFM0l9wWoRx5RqQ0NwTfG7KNQZDZD",
  	"message" => $_POST['title'],
  	"link" => $_POST['link'],
    "picture" => $_POST['picture']
  );

  $ret = $fb->api('/1746222102304404/feed', 'POST', $params);
 
} catch(Exception $e) {
  echo $e->getMessage();
}
?>