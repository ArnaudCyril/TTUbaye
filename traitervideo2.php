<?php
include "parametres.php";
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

		$id=$_POST['id'];
		$videoname=$_POST['name'];
		$videoId=$_POST['lien'];
		//$videoId="FOIjvHjK0Rw";
		$t=true;
		//$id=200;
		//$videoname="titre";
		$name="Video YouTube - ".$videoId;
		$headers = get_headers('http://gdata.youtube.com/feeds/api/videos/' . $videoId);
                if (!strpos($headers[0], '200')) {
                    $t=false;
                }
		if($t)
		{
			$maRequette="insert into media values($id,'$name','$videoname','$videoId',null);";
			$resultat=mysql_query($maRequette);
		}
		$maRequette2="insert into tempvideo values('tset',15);";
		$resultat2=mysql_query($maRequette2);

?>
