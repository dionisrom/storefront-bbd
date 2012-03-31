<?php
session_start();
include("../inc/global.php");
?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<!-- TinyMCE -->
		<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				// General options
				mode : "textareas",
				theme : "advanced",
				plugins : "lists,style,layer,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,advlist",

				// Theme options
				theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
 
				// Drop lists for link/image/media/template dialogs
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",

				// Style formats
				style_formats : [
					{title : 'Bold text', inline : 'b'},
					{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
					{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
					{title : 'Example 1', inline : 'span', classes : 'example1'},
					{title : 'Example 2', inline : 'span', classes : 'example2'},
					{title : 'Table styles'},
					{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
				]
			});
			
			function getPageContent(id_page)
			{
				$.ajax({
					type : 'POST',
					url : 'getPageContent.php',
					dataType : 'json',
					data: {
						operation : 'getcontent',
						pagina : id_page
					},
					success : function(data){
						if (data.error === true)
							alert("Eroare ajax: "+data.msg);
						else
						{
							//alert(data.continut);
							$("#page_name").val(data.denumire);
							tinyMCE.activeEditor.setContent(data.continut);
						}
					}
				});
			};
			function putPageContent()
			{
				$.ajax({
					type : 'POST',
					url : 'getPageContent.php',
					dataType : 'json',
					data: {
						operation : 'putcontent',
						continut : tinyMCE.activeEditor.getContent(),
						pagina : $("#pagina").val()
					},
					success : function(data){
						if (data.error === true)
							alert("Eroare ajax: "+data.msg);
						else
						{
							$("#message").html(data.msg);
						}
					}
				});
			};
		</script>
		<!-- /TinyMCE -->
	</head>
	<body role="application">
		<div class="titlu_pag">Administrare pagini</div>
		<form id="page_frm" method="post">
		<div style="float: left; width:97%;">
			<div id="message"></div>
			<br />
			<input type="hidden" id="page_name" name="page_name" value="">
			<select name="pagina" id="pagina" class="input" onchange="$('#message').html('');getPageContent($(this).val());">
	            <option value="">- ALEGE -</option>
	            <?
	            $str_files = "SELECT id_file, denumire FROM files ORDER BY denumire";
	            $q_files = mysql_query($str_files) or die("Eroare aparuta la preluarea fisierelor!");
	            while ( $rs_files = mysql_fetch_array($q_files) )
	            {
					echo "<option value='".$rs_files[0]."'>".$rs_files[1]."</option>\n";
	            }
	            ?>
	        </select>
	        <br />
	        <div style="width:97%; float: left;">
				<textarea id="elm1" name="elm1" rows="35" style="width: 95%; float: left;">
					
				</textarea>
				<br />
				<input type="button"  name="save" value="Submit" onclick="putPageContent();" />
				<input type="reset" name="reset" value="Reset" />
				<br />
				<br />
				<br />
			</div>
		</div>
		</form>
		<script type="text/javascript">
		jQuery("#main_frame",window.parent.document).load(function(){
			var db1 = jQuery(document).height();
			var docHeight = db1;
			jQuery("#main_frame",window.parent.document).height(docHeight +50);
			jQuery("#body",window.parent.document).height(docHeight +60);
		})
	</script>
	</body>
</html>