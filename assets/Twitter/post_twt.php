<?php

require_once("autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;

$tw = new TwitterOAuth("5ddXzZbSIG1p7kQM4jjIc5b1X", "BWwBzrLxf2XKTWWiTGTqA6B0Z0Eo6Xa8EJeRNIloA2WWdsomeA", "781309174567370756-GqQmmjBy7woQyUN4vu0HEhs4rBh5DbL", "OyNXHQiL5gFcDpWBVDdv8dM8OjPkj9RRGCMApTti1hW6H");
$content = $tw->get("account/verify_credentials");
 
$status = $_POST['status'];
if(strlen($status) > 140) {
    $status = substr($status, 0, 140);
}
 
$tw->post('statuses/update', array(
    'status' => $status
));

?>