<?php
/*$subject1 = "[1]--The.Keeper.Of.Lost.Causes:+.s04.e1.04.2013.720p.BluRay.DTS.x264-PHD.mkv";
$subject2 = "[1]--The.Keeper.Of.Lost.Causes:+.2013.720p.BluRay.DTS.x264-PHD.mkv";
$subject3 = "[1]--.1984.720p.BluRay.DTS.x264-PHD.mkv";*/

function DetectType($subject){
	
	$pattern ="/[Ss][\|\-\._]{0,1}[0-9]{1,2}|[Ee][\|\-\._]{0,1}[0-9]{1,2}/";
	preg_match_all($pattern, $subject, $matches);
	
	if ((count ($matches[0])) >= 2){
	echo "Serie";
	
	$sNumber = substr ( $matches[0][0] , 1, 3 );
	$eNumber = substr ( $matches[0][1] , 1, 3 );
	
	echo " - Season - ".(str_pad($sNumber, 2, "0", STR_PAD_LEFT))." - Episode - ".(str_pad($eNumber, 2, "0", STR_PAD_LEFT))."\n";
	
	} else {
	echo "Movie \n";	
	}
}

function ReplaceParts($subject, $pattern, $substitute){
	
	$newSubject = preg_replace($pattern, $substitute, $subject);
	return $newSubject;
	
}

function MatchParts($subject, $pattern){

	preg_match_all($pattern, $subject, $matches);
	return $matches;
}

DetectType($subject1);

/**remove parenteses, conchetes e chaves e seu conteudo**/
$pattern = array ('/\([^)]+\)/','/\[[^]]+\]/','/\{[^}]+\}/');
$work1 = ReplaceParts($subject1, $pattern, "");

/** se encontrar qualquer dos itens do array remove o item e o que vier depois**/
$pattern = array('/1080p.*/','/720p.*/','/BluRay.*/','/dvdrip.*/','/bdrip.*/','/limited.*/','/h264.*/','/x264.*/','/hdtv.*/','/webdl.*/','/mp4.*/','/mkv.*/');

$work2 = ReplaceParts($work1, $pattern, "");

/** remove numeraçao de temporada/episodio**/
$pattern = "/[Ss][\|\-\._]{0,1}[0-9]{1,2}[\|\-\._]{0,1}[Ee][\|\-\._]{0,1}[0-9]{1,2}[\|\-\._]{0,1}[0-9]{0,2}[\|\-\._ ]/";

$work3 = ReplaceParts($work2, $pattern, "");

/** remove caracteres especiais **/
$pattern = array("/~/", "/`/", "/!/", "/@/", "/#/", "/\$/", "/%/", "/^/", "/&/", "/\*/", "/=/", "/\+/", "/\|/", "/;/", "/:/", "/'/", "/&#8216;/", "/&#8217;/", "/&#8220;/", "/&#8221;/", "/&#8211;/", "/&#8212;/","/—/", "/\-/", "/,/", "/</", "/>/", "/\//", "/\?/");

$work4 = ReplaceParts($work3, $pattern, "");

/**substitui separadores estranhos por espaços**/
$pattern = "/[\|\-\._]/";

$work5 = ReplaceParts($work4, $pattern, " ");

/** remover espaços do inicio de do final da linha**/
$pattern = "/^[ ]*|[ ]*$/";

$work6 = ReplaceParts($work5, $pattern, "");

/**Remove ano do conteudo**/
$pattern = array ("/[ ]+19[0-9][0-9]/" , "/[ ]+20[0-9][0-9]/");

$work7 = ReplaceParts($work6, $pattern, "");

echo $work7;
/*shell_exec("echo $work7 >> test.txt");*/
?> 