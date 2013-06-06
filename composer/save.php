<?php
$path = $_POST['path'];
$filename0 = $_POST['file'];
$filep = fopen("../".$path.$filename0, 'w');
$data = stripslashes($_POST['data']);
//Fix the image locations to point to the server
$docname = $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI'];
$docname = preg_replace("/(?<=\/)[a-z]*\.php/Ui","",$docname);
$docname = preg_replace("/composer\//","",$docname);
$filepath = $docname.$path.$filename0;
//This line sets the image src to a absolute path
$data = preg_replace("/\"\.\.\/uploads\//","\"http://".$docname."uploads/",$data);
//fixes url images
$docname = preg_replace("/url\(\.\.\/uploads/","url(http://".$docname."uploads",$data);
//remove alt tags
$docname = preg_replace("/alt=\".*?\"/","",$docname);
//Add the doctype html transitional
$docname = preg_replace("/<html>/i","<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n<html>",$docname);
//Try and fix the UTF-8 problem
$docname = preg_replace("/<head>/i","<head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>",$docname);
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
//Set image borders to 0
$dom = new DOMDocument();
@$dom->loadHTML($docname);
$imgs = $dom->getElementsByTagName("img");
foreach($imgs as $img){
  if(!$img->hasAttribute("border")){
    $img->setAttribute("border","0");
  }
}
$docname = $dom->saveHTML();

//Set absolute path for images in v3
$docname = preg_replace("/src=\"\/portal2/i","src=\"http://www.bom-portal.com/portal2",$docname);
//These three lines try to clear up things left from other removals
$docname = preg_replace("/style=\" *?\"/i","",$docname);
$docname = preg_replace("/\"\"/","",$docname);
$docname = preg_replace("/[ ]{2,}/"," ",$docname);
//Try and fix removed quotation marks (in explorer)
$docname = preg_replace("/class=dashed/","class=\"dashed\"",$docname);
$docname = preg_replace("/class=unsub/","class=\"unsub\"",$docname);
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
//Try to fix the issues with GMAIL (make sure to remove these classes on editing)
$docname = preg_replace("/<p>/i","<p class='gmail'>",$docname);
$docname = preg_replace("/<tr>/i","<tr class='gmail'>",$docname);
$docname = preg_replace("/<ul>/i","<ul class='gmail'>",$docname);
$docname = preg_replace("/<br>/i","<br class='gmail'>",$docname);
fwrite($filep,$docname);
fclose($filep);
//The next three lines cause the browser to download the file locally.
header('Content-disposition: attachment; filename='.$filename0);
header('Content-type: text/html');
readfile("../".$path.$filename0);
//This last bit removes the "click here to view online" section from the online version
$filep = fopen("../".$path.$filename0,'r');
$filedata = fread($filep, filesize("../".$path.$filename0));
$filedata = preg_replace("/<tr class=\"online\">.*?<\/tr>/","",$filedata);
//Remove mailmerge terms [.*Var]
$filedata = preg_replace("/\[.*Var\]/i","",$filedata);
$filedata = preg_replace("/\[eTrack\]/i","",$filedata);
fclose($filep);
$filep = fopen("../".$path.$filename0,'w');
fwrite($filep,$filedata);
fclose($filep);

?>
