<?php
$filename = "../" . $_POST['efile'];
$filep = fopen($filename, 'r');
$contents = fread($filep, filesize($filename));
fclose($filep);
//fix double ''
$contents = preg_replace("/''/","'",$contents);
//Add a doctype
$contents = preg_replace("/<html>/","<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n<html>\n",$contents);
//Add s1 div
$contents = preg_replace("/<table.*\/table>/is","<div id=\"s1\">\n$0\n</div>",$contents);
//Add id=main to main table
$contents = preg_replace("/<table/i","$0 id=\"main\" ",$contents,1); //style=\"border-collapse:collapse;margin:0 auto;width:800px\" ",$contents,1);
//Fix issue with images titles (title=id=)
$docname = preg_replace("/(\w+)=(\w+)=/","$1='' $2=",$docname);
//Remove class='gmail' 
$docname = preg_replace("/ class='gmail'/i","",$docname);
$docname = preg_replace("/ class=\"gmail\"/i","",$docname);
//Add in the necessary scripts
$contents = preg_replace('/<\/title>/',"</title>
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
<script type=\"text/javascript\" src=\"jquery-1.4.2.min.js\"></script>
<script type=\"text/javascript\" src=\"jscolor/jscolor.js\"></script>
<script type=\"text/javascript\" src=\"ckeditor/ckeditor.js\"></script>
<script type=\"text/javascript\" src=\"scripts.js\"></script>
<link rel=\"stylesheet\" href=\"styles.css\">
    <script type=\"text/javascript\" src=\"jqueryFileTree/jqueryFileTree.js\"></script>
    <link rel=\"stylesheet\" href=\"jqueryFileTree/jqueryFileTree.css\">\n",$contents);
//Add the body style
$contents = preg_replace("/<body.*>/i","<body style=\"background-color:#77bbff;margin:0px auto\">
    <div id=\"menubar\">
      <div id=\"menu_content\">
        <div style=\"float:left;width:100px;\">
          <a href=\"../composer/\" class=\"menulink\"><img border=\"0\" src=\"images/newicon.png\"><br>New</a>
        </div>
        <div style=\"float:left;width:100px;\">
          <a id=\"edit\"  class=\"menulink\"><img border=\"0\"  src=\"images/editicon.png\"><br>Edit</a>
        </div>
        <div style=\"float:left;width:100px\">
          <a id=\"preview\"  class=\"menulink\"><img border=\"0\" src=\"images/previewicon.png\" alt=\"\" /><br>Preview</a>
        </div>
        <div style=\"float:left;width:100px;\">
            <a  id=\"save\" class=\"menulink\"><img border=\"0\" src=\"images/saveicon.png\"><br>Save</a>
        </div>
        <div style=\"float:left;width:100px\">
          <a  id=\"set\" class=\"menulink\"><img border=\"0\" src=\"images/settingsicon.png\"><br>Settings</a>
        </div>
        <div style=\"float:left;width:100px\">
          <a  id=\"img\" class=\"menulink\"><img border=\"0\" src=\"images/imgicon.png\"><br>Image<br>Manager</a>
        </div>
      </div>
        <!-- This div provides the editable file list and allows opening or deleting of those files /-->
        <div id=\"edit_list\" class=\"menu\">


          <img border=\"0\" src=\"images/close_sm.png\" style=\"position:relative;left:288px;top:-8px\" class=\"close\">
          <div id=\"file_list\" style=\"max-height:250px;overflow:auto\"></div>
          <div>

            <input id=\"efilename\" type=\"text\" size=\"30\">
            <br>
            <button class=\"read\" style=\"float:left\">Open</button>            
            <button style=\"float:left\" class=\"close\">Cancel</button>
            <button style=\"float:right\" onclick=\"javascript:if(jQuery('#efilename').val()){return confirm_delete(jQuery('#efilename').val());}else{alert('No file selected');}\">Delete</button>
          </div>
        </div>
        <!-- This div provides the saving file list and allows saving as an old file by selection or new file by text input /-->
        <div id=\"save_list\" class=\"menu\">
          <img border=\"0\" src=\"images/close_sm.png\" style=\"position:relative;left:288px;top:-8px\" class=\"close\">
          <div id=\"file_list2\" style=\"max-height:250px;overflow:auto\"></div>
          <div>
            <input id=\"filename\" type=\"text\" size=\"30\">
            <br>
            <button class=\"write\" style=\"float:left\">Save</button>
            <button style=\"float:left\" class=\"close\">Cancel</button>
          </div>
        </div>
        <!-- This div provides the image manager and allows uploading and deleting of images -->
        <div id=\"images\" class=\"menu\" >
          <img border=\"0\" src=\"images/close_sm.png\" style=\"position:relative;left:288px;top:-8px\" class=\"close\">
          <div id=\"img_list\" style=\"max-height:250px;overflow:auto\"></div>
          <div>
            <br>
            <input id=\"img_upload\" type=\"text\" size=\"30\">
            <br>
            <button style=\"float:left\">Upload</button>
            <button style=\"float:left\" class=\"close\">Cancel</button>
            <button style=\"float:right\" onclick=\"javascript:if(jQuery('#img_upload').val()){return confirm_delete(jQuery('#img_upload').val());}else{alert('No file selected');}\">Delete</button>
          </div>
        </div>
        <!-- This div provides the settings window for the default font/colours of the newsletter /-->
        <div id=\"settings\" class=\"menu\">
          <img border=\"0\" src=\"images/close_sm.png\" style=\"position:relative;left:288px;top:-8px\" class=\"close\">

          Set Font:<select style=\"width:90%\" id=\"font\">
                    <option id=\"arial\" value=\"arial\" select=\"selected\" style=\"font-family:arial\">Arial</option>
                    <option id=\"BookAntiqua\" value=\"Book Antiqua\" style=\"font-family:'Book Antiqua'\">Book Antiqua</option>
                    <option id=\"georgia\" value=\"Georgia\" style=\"font-family:Georgia\">Georgia</option>
                    <option id=\"arialBlack\" value=\"Arial Black\" style=\"font-family:'Arial Black'\">Arial Black</option>
                    <option id=\"comicSans\" value=\"Comic Sans\" style=\"font-family:'Comic Sans'\">Comic Sans</option>
                    <option id=\"CourierNew\" value=\"Courier New\" style=\"font-family:'Courier New'\">Courier New</option>
                    <option id=\"Impact\" value=\"Impact\" style=\"font-family:Impact\">Impact</option>
                    <option id=\"LucidaConsole\" value=\"Lucida Console\" style=\"font-family:'Lucida Console'\">Lucida Console</option>
                    <option id=\"LucidaSansUnicode\" value=\"Lucida Sans Unicode\" style=\"font-family:'Lucida Sans Unicode'\">Lucida Sans Unicode</option>  
                    <option id=\"Tahoma\" value=\"Tahoma\" style=\"font-family:Tahoma\">Tahoma</option>
                    <option id=\"TimesNewRoman\" value=\"Times New Roman\" style=\"font-family:'Times New Roman'\">Times New Roman</option>
                    <option id=\"TrebuchetMS\" value=\"Trebuchet MS\" style=\"font-family:'Trebuchet MS'\">Trebuchet MS</option>
                    <option id=\"Verdana\" value=\"Verdana\" style=\"font-family:Verdana\">Verdana</option>
                  </select>
          <p>
          <br>
          Font-family:<input id=\"family\" type=\"text\" disabled=\"true\" style=\"width:90%\" value=\"Helvetica, Sans Serif\">
          </select>
          <p>
          <br>
          Sample Text:
          <p id=\"eg\" style=\"padding:5px;border:1px black solid;color:black;text-align:center\">
          The quick brown fox jumps over the lazy dog
          </p>
          <p>
          <br>
          Set Font Color:
          <br>
            <input style=\"width:90%\" class=\"color\" id=\"selecttextcolor\" value=\"000000\">
          <p>
          Set Background-color:
          <br>
            <input style=\"width:90%\" class=\"color\" id=\"selectbackgroundcolor\">
            <p>
            <br>
            <button id=\"colorchange\" style=\"float:left\">OK</button>
          <button style=\"float:right\" class=\"close\">Cancel</button>
        </div>
        <div style=\"width:800px;margin:0 auto;\">
        <div id=\"menu_title\" class=\"menulink\">Menu</div>
        </div>
        </div>
    <h1 style=\"width:500px;color:#004488;padding-top:50px;margin:0 auto;text-align:center\">E-letter Composer</h1>
        ",$contents);

//Remove the unnecessary style info
$contents = preg_replace("/<td style=\"margin: 0px; padding: 0px; font-size: 0px;\" class=\"dashed\"/","<td class=\"dashed\"",$contents);
//Get the number of class='dashed' cells
$count = preg_match_all("/class=\"dashed\"/",$contents,$matches);
//loop through adding the other info
$count = 0;
function cellnumber($matches){
  global $count;
  $str = $matches[1]." href=\"#dialog\" name=\"modal\" class=\"dashed\" id=\"cell".$count."\"".$matches[2];
  $count++;
  return $str;
}
$contents = preg_replace_callback("/(<td)(.*?)(class=\"dashed\")/i","cellnumber",$contents);

//add the editor, mask and save
if(strpos($contents,'template') == false){
$contents = preg_replace("/<\/body>/","
      <div style=\"margin:0 auto;text-align:center\">
        <a  id=\"addrow\"><img border=\"0\" src=\"images/add_sm.png\"></a>
      </div>
      <div id=\"add_row\" class=\"menu\">
          <img border=\"0\" class=\"close\" src=\"images/close_sm.png\" style=\"position:relative;left:288px;top:-8px\">
        <div style=\"margin:2px\">
          <img class=\"add5050\" src=\"images/5050.PNG\">
        </div>
        <div style=\"margin:2px\">
          <img class=\"add2575\" src=\"images/2575.PNG\">
        </div>
        <div style=\"margin:2px\">
          <img class=\"add7525\" src=\"images/7525.PNG\">
        </div>
        <div style=\"margin:2px\">
          <img class=\"add1000\" src=\"images/1000.PNG\">
        </div>
        <div style=\"margin:2px\">
          <img class=\"add3333\" src=\"images/3333.png\"> 
        </div>
        <div>
          <button id=\"addrowbutton\" class=\"unselected\" style=\"float:left\">Add Row</button>
          <button style=\"float:right\" class=\"close\">Cancel</button>
        </div>
        <br>
      </div>


    <div id=\"boxes\">  

      <div id=\"dialog\" class=\"window\">
        <form action=\"\">
          <textarea class=\"textbox\" id=\"text2\" style=\"width:600px;height:300px\" rows=\"\" cols=\"\"></textarea> 
        </form>
        <br><button class=\"save\">OK</button>
        <button class=\"close\">Cancel</button>
        <!-- #customize your modal window here -->  

      </div>  

      <!-- Do not remove div#mask, because you'll need it to fill the whole screen -->    
      <div id=\"mask\"></div>  
    </div>

    <div>
      <form id=\"saveform\" method=\"post\" action=\"save.php\">
        <input type=\"hidden\" id=\"file\" name=\"file\" value=\"temp1.html\">
        <input type=\"hidden\" id=\"pagedata\" name=\"data\">

      </form>

      <form id=\"editform\" method=\"post\" action=\"test.php\">
        <input type=\"hidden\" id=\"efile\" name=\"efile\" value=\"temp1.html\">
      </form>

      <form id=\"previewform\" method=\"\">
        <input type=\"hidden\" id=\"prevDataID\" name=\"prevDataName\">
      </form>

  </body>",$contents);
}
else{
$contents = preg_replace("/<\/body>/","
    <div id=\"boxes\">  
      <div id=\"dialog\" class=\"window\">
        <form action=\"\">
          <textarea class=\"textbox\" id=\"text2\" style=\"width:600px;height:300px\" rows=\"\" cols=\"\"></textarea> 
        </form>
        <br><button class=\"save\">OK</button>
        <button class=\"close\">Cancel</button>
        <!-- #customize your modal window here -->  

      </div>  

      <!-- Do not remove div#mask, because you'll need it to fill the whole screen -->    
      <div id=\"mask\"></div>  
    </div>

    <div>
      <form id=\"saveform\" method=\"post\" action=\"save.php\">
        <input type=\"hidden\" id=\"file\" name=\"file\" value=\"temp1.html\">
        <input type=\"hidden\" id=\"pagedata\" name=\"data\">

      </form>

      <form id=\"editform\" method=\"post\" action=\"test.php\">
        <input type=\"hidden\" id=\"efile\" name=\"efile\" value=\"temp1.html\">
      </form>

      <form id=\"previewform\" method=\"\">
        <input type=\"hidden\" id=\"prevDataID\" name=\"prevDataName\">
      </form>

  </body>",$contents);
}

$filename = 'edit.html';
$filep = fopen($filename, 'w');
$contents = fwrite($filep, $contents);
fclose($filep);
//echo $contents;
header("Location: edit.html");
?>
