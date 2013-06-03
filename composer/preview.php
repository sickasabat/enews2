<?php
function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
}


$filename0 = "preview.html";
$data = stripslashes($_POST['prevDataName']);
//$data = utf8_urldecode($data);
//Fix the image locations to point to the server
$docname = $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI'];
$docname = preg_replace("/(?<=\/)[a-z]*\.php/Ui","",$docname);
$docname = preg_replace("/composer\//","",$docname);
$filepath = $docname.$filename0;
//This line sets the image src to a absolute path
$data = preg_replace("/\"\.\.\/uploads\//","\"http://".$docname."uploads/",$data);
//fixes url images
$docname = preg_replace("/url\(\.\.\/uploads/","url(http://".$docname."uploads",$data);
//remove alt tags
$docname = preg_replace("/alt=\".*?\"/","",$docname);
//Try and fix the UTF-8 problem
$docname = preg_replace("/<head>/i","<head>\n<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>",$docname);
//This line sets the online version path
$docname = preg_replace("/$filename0/","http://".$filepath,$docname);
//These lines remove tags used for editing
$docname = preg_replace("/ id=\".*?\"/i"," ",$docname);
$docname = preg_replace("/ id=.*? /i"," ",$docname);
$docname = preg_replace("/ id=.*?(?=>)/i"," ",$docname);
$docname = preg_replace("/ name=\".*?\"/i"," ",$docname);
$docname = preg_replace("/ href=\"#dialog\"/i"," ",$docname);
//Fix issue with images titles (title=id=)
$docname = preg_replace("/(\w+)=(\w+)=/","$1=\"\" $2=",$docname);
$docname = preg_replace("/title=>/",">",$docname);
//These two lines remove the borders from the template
$docname = preg_replace("/[ ]{0,}border[\sA-Za-z0-9-:#]*?;/Ui","",$docname);
$docname = preg_replace("/[ ]{0,}border[\sA-Za-z0-9-;:]*?\"/Ui","\"",$docname);
//These three lines try to clear up things left from other removals
$docname = preg_replace("/style=\" *?\"/i","",$docname);
$docname = preg_replace("/\"\"/","",$docname);
$docname = preg_replace("/[ ]{2,}/"," ",$docname);
//Try and fix removed quotation marks (in explorer)
$docname = preg_replace("/class=dashed/","class=\"dashed\"",$docname);
$docname = preg_replace("/class=unsub/","class=\"unsub\"",$docname);
//Trying to fix problem characters
$docname = preg_replace("/¶/","&not;",$docname);
//These lines are to try and fix copy/pasta from Microsoft Word
//To fix the char £
$docname = preg_replace("/¬£/","£",$docname);
//to fix the char ¶
$docname = preg_replace("/¬¶/","¶",$docname);
//to fix the char '
$docname = preg_replace("/‚Äò/","'", $docname);
$docname = preg_replace("/‚Äô/","'", $docname);
//To fix the char " 
$docname = preg_replace("/‚Äú/","\"", $docname);
$docname = preg_replace("/‚Äù/","\"", $docname);
//To fix the char ¨
$docname = preg_replace("/¬¨/","¨",$docname);
$docname = preg_replace("/¨¬/","¨",$docname);
//Set the table style
$docname= preg_replace("/border: 5px solid rgb\(34, 102, 170\);/","",$docname);
//Add border-collapse to the table
$docname = preg_replace("/cellpadding: 0/","cellpadding: 0;border-collapse:collapse",$docname);

//This last bit removes the "click here to view online" section from the online version
$docname = preg_replace("/<tr class=\"online\">.*?<\/tr>/","",$docname);
//Remove mailmerge terms [.*Var]
$docname = preg_replace("/\[.*Var\]/i","",$docname);
//Add a doctype
$docname = preg_replace("/<html>\n/","<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n<html>\n",$docname);
//$utf8 = utf8_encode($docname);
echo $docname; //$utf8;
?>
