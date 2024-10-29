<?php
@session start();
if ((isset($_SESSION['user'])) && (isset($_SESSION['name'])))
{
echo "Ви авторизовані, як ".$_SESSION['user']." <a href=\"Вихід\">";
}else{
echo "Вам потрібно <a href=\"..\A_U.html\">авторизуватись</a>.";
die();
}
?>