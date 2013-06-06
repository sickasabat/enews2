jQuery.noConflict();
var path = window.location.pathname;
var firstslash = path.indexOf("/",1);
var secondslash = path.indexOf("/", (firstslash+1));
path = path.slice(firstslash+1,secondslash+1);

jQuery.fn.center = function () {
  this.css("position","absolute");
  this.css("top", ( jQuery(window).height() - this.height() ) / 2+jQuery(window).scrollTop() + "px");
  this.css("left", ( jQuery(window).width() - this.width() ) / 2+jQuery(window).scrollLeft() + "px");
  return this;
};

function load_imglist(){
  jQuery('#img_list').fileTree({
root: '../uploads/',
script: '../../composer/jqueryFileTree.php',
expandSpeed: 1000,
collapseSpeed: 1000,
multiFolder: false
}, function(file) {
//alert(file);
file = file.substring(3);
jQuery('#img_upload').val(file);
});
}


function SetContents(value)
{
	// Get the editor instance that we want to interact with.
	var oEditor = CKEDITOR.instances.text2;
//	var value = document.getElementById( 'htmlArea' ).value;

	// Set editor contents (replace current contents).
	// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.editor.html#setData
	oEditor.setData( value );
}

function GetContents()
{
	// Get the editor instance that you want to interact with.
	var oEditor = CKEDITOR.instances.text2;

  var v = oEditor.getData();
	// Get editor contents
	// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.editor.html#getData
  return v;
}

jQuery(document).ready(function() {
  //select all the a tag with name equal to modal
  var clicked = "";
  //Remove online cell if editing
  if(jQuery('.online')){
    jQuery('.online').remove();
  }
  if(jQuery('.unsub')){
    jQuery('.unsub').remove();
  }
  jQuery('td[name=modal],a[name=modal]').live('click',function(e) {
    //Cancel the link behavior
    e.preventDefault();
    clicked ='#'+jQuery(this).attr('id');
    var val = jQuery(clicked).html();
    SetContents(val);
    //Get the A tag
    var id = jQuery(this).attr('href');
    //Get the screen height and width
    var maskHeight = jQuery(document).height();
    var maskWidth = jQuery(window).width();
    //Set height and width to mask to fill up the whole screen
    jQuery('#mask').css({'width':maskWidth,'height':maskHeight});
    //transition effect
    jQuery('#mask').fadeIn(100);
    jQuery('#mask').fadeTo("fast",0.8);
    //Get the window height and width
    var winH = jQuery(window).height();
    var winW = jQuery(window).width();
    //Set the popup window to center
    jQuery(id).css('top',  (winH/2-jQuery(id).height()/2) + (jQuery(window).scrollTop()));
    jQuery(id).css('left', (winW/2-jQuery(id).width()/2) + (jQuery(window).scrollLeft()));
    //transition effect
    jQuery(id).fadeIn(200);
  });

  //Change the colors
  jQuery('#colorchange').click(function(e){
    e.preventDefault();
    var font = jQuery('#eg').css("font-family");
    var text = jQuery('#selecttextcolor').val();
    text = '#' + text;
    var bg = jQuery('#selectbackgroundcolor').val();
    bg = '#' + bg;
    jQuery('#main').css('color',text);
    jQuery('#main').css('background-color',bg);
    jQuery('#main').css('font-family', font);
    jQuery('#tablecolor').hide();
  });

  //if close button is clicked
  jQuery('.window .close').click(function (e) {
    //Cancel the link behavior
    e.preventDefault();
    jQuery('#mask, .window').hide();
  });

  //if save button is clicked
  jQuery('.save').click(function(e){
    e.preventDefault();
    var val = GetContents();
    jQuery(clicked).html(val);
    jQuery('#mask, .window').hide();
  });

  //if mask is clicked
  jQuery('#mask').click(function () {
    jQuery(this).hide();
    jQuery('.window').hide();
  });

  jQuery('.add2575').click(function(e){
    e.preventDefault();
    jQuery('.unsub').remove();
    var celln = jQuery('.dashed:last').attr('id');
    var parts = celln.match(/(\D+)(\d+)$/);
    var lastcell = parts[2];
    var newrow  = jQuery('<tr></tr>');
    newrow.html('<td href="#dialog" name="modal" id="cell'+(+lastcell+1)+'" class="dashed" colspan="2" style="vertical-align:top" valign="top">&nbsp;</td>\n<td href="#dialog" name="modal" id="cell'+(+lastcell+2)+'" colspan="4" class="dashed" style="vertical-align:top" valign="top">&nbsp;</td>');
    jQuery('#main').append(newrow);
  });

  jQuery('.add5050').click(function(e){
    e.preventDefault();
    jQuery('.unsub').remove();
    var celln = jQuery('.dashed:last').attr('id');
    var parts = celln.match(/(\D+)(\d+)$/);
    var lastcell = parts[2];

    var newrow  = jQuery('<tr></tr>');
    newrow.html('<td href="#dialog" name="modal" id="cell'+(+lastcell+1)+'" class="dashed" colspan="3" style="vertical-align:top" valign="top">&nbsp;</td>\n<td href="#dialog" name="modal" id="cell'+(+lastcell+2)+'" colspan="3" class="dashed" style="vertical-align:top" valign="top">&nbsp;</td>');

    jQuery('#main').append(newrow);
  });

  jQuery('.add7525').click(function(e){
    e.preventDefault();
    jQuery('.unsub').remove();
    var celln = jQuery('.dashed:last').attr('id');
    var parts = celln.match(/(\D+)(\d+)$/);
    var lastcell = parts[2];

    var newrow  = jQuery('<tr></tr>');
    newrow.html('<td href="#dialog" name="modal" id="cell'+(+lastcell+1)+'" class="dashed" colspan="4" style="vertical-align:top" valign="top">&nbsp;</td>\n<td href="#dialog" name="modal" id="cell'+(+lastcell+2)+'" colspan="2" class="dashed" style="vertical-align:top" valign="top">&nbsp;</td>');

    jQuery('#main').append(newrow);
  });

  jQuery('.add1000').click(function(e){
    e.preventDefault();
    jQuery('.unsub').remove();
    var celln = jQuery('.dashed:last').attr('id');
    var parts = celln.match(/(\D+)(\d+)$/);
    var lastcell = parts[2];
    var newrow  = jQuery('<tr></tr>');
    newrow.html('<td href="#dialog" name="modal" id="cell'+(+lastcell+1)+'" class="dashed" colspan="6" style="vertical-align:top" valign="top">&nbsp;</td>');
    jQuery('#main').append(newrow);
  });

  jQuery('.add3333').click(function(e){
    e.preventDefault();
    jQuery('.unsub').remove();
    var celln = jQuery('.dashed:last').attr('id');
    var parts = celln.match(/(\D+)(\d+)$/);
    var lastcell = parts[2];
    var newrow = jQuery('<tr></tr>');
    newrow.html('<td href="#dialog" name="modal" id="cell'+(+lastcell+1)+'" class="dashed" colspan="2" style="vertical-align:top" valign="top">&nbsp;</td>\n<td href="#dialog" name="modal" id="cell'+(+lastcell+2)+'" colspan="2" class="dashed" style="vertical-align:top" valign="top">&nbsp;</td>\n<td href="#dialog" name="modal" id="cell'+(+lastcell+3)+'" colspan="2" class="dashed" style="vertical-align:top" valign="top">&nbsp;</td>');
    jQuery('#main').append(newrow);
  });

  jQuery('.write').click(function(e){
    e.preventDefault();
    //This section checks for the .html extension and adds it if it's missing.
    if(jQuery('#filename').val().indexOf('.html') >= 0){
      jQuery('#file').val(jQuery('#filename').val());
    }
    else{
      jQuery('#file').val(jQuery('#filename').val()+".html");
    }
    if((jQuery('.unsub').length == 0)&&(jQuery('.template').length ==0)){
      jQuery('#main > tbody:last').append("<tr class='unsub'><td colspan='6' style='padding:10px 0 0 0;font-size:14px'><p align=center>To Unsubscribe from these mailings please click <a href='mailto:adminnewaccountemail@blueorchidmarketing.com?subject=unsubscribe'>here</a> or send an email to adminnewaccountemail@blueorchidmarketing.com with unsubscribe in the subject.</td></tr>");
    }
    jQuery('.remove').remove();	
    var contents = jQuery('#s1').html();
    if(jQuery('.temponline').length != 0){
      contents = contents.replace(/class="temponline" href=""/i, 'class="temponline" href="'+jQuery('#file').val()+'"');
    }
    else{
contents = contents.replace(/<TBODY>/i,"<tbody><tr class=\"online\"><td colspan=\"6\" style=\"font-size:14px\"><p align=center>If this is not displaying correctly view it online <a href='"+jQuery('#file').val()+"'>here.</a></td></tr>");
    }
    //Insert [eTrack] (uncomment this for active clients)
    //contents = contents.replace(/<\/tbody>/i,"[eTrack]\n</tbody>");
  // If it has email a friend then fix the URL
  if(jQuery('.templateMail').length != 0){
    contents = contents.replace(/class="templateMail" href=""/i,'class="templateMail" href="mailto:friend@email.com?subject=Something interesting for you to read&body='+jQuery('#filename').val()+'"');
  }
      // If it's from the template get the background color from the first table 
    if(jQuery('.template').length == 0){
    var pagedata = '<html><head><title>E-letter</title></head><body style="text-align:left;margin:50px auto;">'+contents+'</body></html>';
    }
    else{
    var pagedata = '<html><head><title>E-letter</title></head><body style="text-align:left;margin:50px auto;background-color:'+jQuery('.template').attr('bgcolor')+'">'+contents+'</body></html>';
    }


    jQuery('input#pagedata').val(pagedata);
    jQuery('#saveform').submit();
    jQuery('#file_list2').fileTree({
        root: '../'+path,
        script: '../../composer/jqueryFileTree.php',
        expandSpeed: 1000,
        collapseSpeed: 1000,
        multiFolder: false
    }, function(file) {
    file = file.substring(3);
    jQuery('#filename').val(file);
    });

    jQuery('#save_list').toggle();
  });



  jQuery('#preview').click(function(e){
    e.preventDefault();
    if((jQuery('.unsub').length == 0)&&(jQuery('.template').length ==0)){
      jQuery('#main > tbody:last').append("<tr class='unsub'><td colspan='6' style='padding:10px 0 0 0;font-size:14px'><p align=center>To Unsubscribe from these mailings please click <a href='mailto:adminnewaccountemail@blueorchidmarketing.com?subject=unsubscribe'>here</a> or send an email to adminnewaccountemail@blueorchidmarketing.com with unsubscribe in the subject.</td></tr>");
    }
    jQuery('.remove').remove();	
    var contents = jQuery('#s1').html();
    if(jQuery('.temponline').length != 0){
      contents = contents.replace(/class="temponline" href=""/i, 'class="temponline" href="'+jQuery('#filename').val()+'"');
    }
    else{
contents = contents.replace(/<TBODY>/i,"<tbody><tr class=\"online\"><td colspan=\"6\" style=\"font-size:14px\"><p align=center>If this is not displaying correctly view it online <a href='"+jQuery('#filename').val()+"'>here.</a></td></tr>");
    }
  // If it has email a friend then fix the URL
  if(jQuery('.templateMail').length != 0){
    contents = contents.replace(/class="templateMail" href=""/i,'class="templateMail" href="mailto:friend@email.com?subject=Something interesting for you to read&body='+jQuery('#filename').val()+'"');
  }
      // If it's from the template get the background color from the first table 
    if(jQuery('.template').length == 0){
    var pagedata = '<html>\n<head>\n<title>E-letter</title>\n</head>\n<body style="text-align:center;margin:50px auto;">'+contents+'</body></html>';
    }
    else{
    var pagedata = '<html>\n<head>\n<title>E-letter</title>\n</head>\n<body style="text-align:center;margin:50px auto;background-color:'+jQuery('.template').attr('bgcolor')+'">\n'+contents+'\n</body>\n</html>';
    }

    jQuery('input#prevDataID').val(pagedata);
    jQuery.post("../../composer/preview.php",jQuery('#previewform').serialize(),
        function(data) {
          var win = window.open('', 'childWindow');
          win.document.open();
          win.document.write(data);
   });

  });
/*    Set Up the editor (CKEditor)   */


  CKEDITOR.replace(jQuery('.textbox').get(0),
      {
        filebrowserBrowseUrl : 'Filemanager/index.html'
      }
      );

  CKEDITOR.on( 'dialogDefinition', function( ev ) {
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    if ( dialogName == 'image' ) {
      dialogDefinition.removeContents( 'Link' );
      dialogDefinition.removeContents( 'advanced' );
      dialogDefinition.removeContents( 'Upload' );
    }
  });


  jQuery('.read').click(function(e){
    e.preventDefault();
    jQuery('#efile').val(jQuery('#efilename').val());
    jQuery('#editform').submit();
  });

  jQuery('#edit').click(function (){
    jQuery('.menu:not(#edit_list)').hide();
    jQuery('#edit_list').toggle();
    jQuery('#file_list').fileTree(
      {
        root: '../'+path,
        script: '../../composer/jqueryFileTree.php',
        expandSpeed: 1000,
        collapseSpeed: 1000,
        multiFolder: false
        }, function(file) {
        file = file.substring(3);
        jQuery('#efilename').val(file);
    });
  });

  jQuery('#save').click(function (){
    jQuery('.menu:not(#save_list)').hide();
    jQuery('#save_list').toggle();
    jQuery('#file_list2').fileTree({
        root: '../'+path,
      script: '../../composer/jqueryFileTree.php',
      expandSpeed: 1000,
      collapseSpeed: 1000,
      multiFolder: false
    }, function(file) {
      //alert(file);
      file = file.substring(3);
      jQuery('#filename').val(file);
    });

  });

jQuery('#img').click(function (){
    jQuery('.menu:not(#images)').hide();
    jQuery('#images').toggle();
    load_imglist();
    });

jQuery('#addrow').click(function(){
  jQuery('.menu:not(#add_row)').hide();
  jQuery('#add_row').toggle();
  });

jQuery('.close').click(function(){
  jQuery('.menu').hide();
});


jQuery('#menu_title').click(function () { 
    jQuery('#menu_content').slideToggle('medium');
    });

jQuery('#set').click(function(){
    jQuery('.menu:not(#settings)').hide();
    jQuery('#settings').toggle();
    jQuery("#font").change(function () {
      if( jQuery("#arial:selected").length ){
      jQuery('#family').val("Helvetica,sans-serif");
      jQuery('#eg').css("font-family","Arial, Helvetica, sans-serif");
      }
      if(jQuery("#BookAntiqua:selected").length){
      jQuery('#family').val("'Palatino Linotype', Palatino, serif");
      jQuery('#eg').css("font-family","'Book Antiqua','Palatino Linotype',Palatino,serif");
      }
      if(jQuery("#georgia:selected").length){
      jQuery('#family').val("serif");
      jQuery('#eg').css("font-family","Georgia,serif");
      }
      if(jQuery("#arialBlack:selected").length){
      jQuery('#family').val("Gadget, sans-serif");
      jQuery('#eg').css("font-family","'Arial Black',Gadget,sans-serif");
      }
      if(jQuery("#comicSans:selected").length){
      jQuery('#family').val("cursive, sans-serif");
      jQuery('#eg').css("font-family","'Comic Sans',cursive,sans-serif");
      }
      if(jQuery("#CourierNew:selected").length){
        jQuery('#family').val("Courier, monospace");
        jQuery('#eg').css("font-family","'Courier New',Courier,monospace");
      }
      if(jQuery("#Impact:selected").length){
        jQuery('#family').val("Charcoal, sans-serif");
        jQuery('#eg').css("font-family","Impact,Charcoal,sans-serif");
      }
      if(jQuery("#LucidaConsole:selected").length){
        jQuery('#family').val("Monaco, monospace");
        jQuery('#eg').css("font-family","'Lucida Console',Monaco, monospace");
      }
      if(jQuery("#LucidaSansUnicode:selected").length){
        jQuery('#family').val("'Lucida Grande', sans-serif");
        jQuery('#eg').css("font-family","'Lucida Sans Unicode','Lucida Grande',sans-serif");
      }
      if(jQuery("#Tahoma:selected").length){
        jQuery('#family').val("Geneva, sans-serif");
        jQuery('#eg').css("font-family","Tahoma,Geneva,sans-serif");
      }
      if(jQuery("#TimesNewRoman:selected").length){
        jQuery('#family').val("Times, serif");
        jQuery('#eg').css("font-family","'Times New Roman',Times,serif");
      }
      if(jQuery("#TrebuchetMS:selected").length){
        jQuery('#family').val("Helvetica, sans-serif");
        jQuery('#eg').css("font-family","'Trebuchet MS',Helvetica,sans-serif");
      }
      if(jQuery("#Verdana:selected").length){
        jQuery('#family').val("Geneva, sans-serif");
        jQuery('#eg').css("font-family","Verdana,Geneva,sans-serif");
      }
    });
});


});

/*
 * End of the jQuery(document).ready(function(){});
 */

function confirm_delete(filename){
  var cd = confirm("Are you sure that you want to delete "+filename+"?");
  if (cd == true){
    var result = "odd";
    jQuery.ajax({
      type: 'post',
      url: '../../composer/deletefile.php',
      data: {name: filename},
      success: function(msg){
        result = msg;
      }
    });
// jQuery('#files').load('filelist.php');
jQuery('#file_list').fileTree({
        root: '../'+path,
        script: '../../composer/jqueryFileTree.php',
        expandSpeed: 1000,
        collapseSpeed: 1000,
        multiFolder: false
    }, function(file) {
    file = file.substring(3);
    jQuery('#efilename').val(file);
    });

load_imglist();

  }
  else{
  }
}
