<?php
function showGravatar($email, $size){
echo "<div id='avatar'>";
$url = 'http://www.gravatar.com/avatar/';
$default = 'monsterid';
$grav_url = $url.'?gravatar_id='.md5( strtolower($email) ).
'&default='.urlencode($default).'&size='.$size; 
echo "<img src=$grav_url;/>";
//echo "<img src=http://www.gravatar.com/avatar/321eeced14b95d701021138ce695a314?s=80;/>";
echo "</div>";
}
?>