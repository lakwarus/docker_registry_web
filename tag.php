<?php

include('./config.php');

$repo=$_REQUEST["repo"];
#echo $repo;
get_tags($repo,$registry_url,$user,$password);

?>
