jQuery(document).ready(function(){
    // ajax call for menu
    jQuery('#nav li').click(function() {
		if (jQuery(this).find("a").hasClass("subMenuBtn"))
		{
			menu_text = jQuery(this).find("a").attr("title").toLowerCase();
		}
		else
		{
			menu_text = jQuery(this).find("a").text().toLowerCase();
		}
		menu_text = menu_text.replace(" ","_");
		menu_text = menu_text.replace("/","_");
        jQuery.ajax({ 
            url: './inc/ajax_functions.php',
            data: {
                action : menu_text
            },
            type: 'post',
            dataType : 'json',
            success: function(output) {
                jQuery("#main_frame").attr("src",output.continut);
            }
        });
        return false;
    });
	
	jQuery.ajax({ 
		url: './inc/ajax_functions.php',
		data: {
			action : "statistici"
		},
		type: 'post',
		dataType : 'json',
		success: function(output) {
			jQuery("#cele_mai_vizitate_div").html(output.continut_vizitate);
			jQuery("#cele_mai_vandute_div").html(output.continut_vandute);

		},
		errors: function(output) {
			alert(output.error_msg);
		}
	});
});
/**
* Toggle ClassName
* Works on els with multiple classnames
*/

function toggleClassname (el, newClassname, defaultClassname) {
		var re;
        if (hasClass( el, defaultClassname)){
        re = new RegExp("(^|s)" + defaultClassname + "(s|$)");
        el.className = el.className.replace(re, ' '+ newClassname +' ');

        } else if (hasClass( el, newClassname)){
        re = new RegExp("(^|s)" + newClassname + "(s|$)");
        el.className = el.className.replace(re, ' '+ defaultClassname +' ');

        } else
        el.className += ' ' + newClassname;

}

function toggle_ch(el)
{
    var elem = document.getElementById(el);
    if (elem.checked)
    {
        elem.checked = false; 
        elem.value = 0;   
    }
    else
    {
        elem.checked = true;
        elem.value = 1;
    }
}

function toggle(el)
{
    var elem = document.getElementById(el);
    if (elem.checked)
    {
        elem.value = 1;   
    }
    if (!elem.checked)
    {
        elem.value = 2;
    }
}

/**
* Has Class? (Matt Kruse)
* Kruse's hasClass, with slight modification
* Determine if an object or class string contains a given class.
* see http://groups.google.com/group/comp.lang.javascript/browse_thread/thread/b68cac304ee6de78/e445c1df18698a3f?lnk=gst&q=hasclass&rnum=3
*/

function hasClass (obj, className) {

        if (typeof obj == 'undefined' || obj==null || !RegExp) {
        return false;
        }

        var re = new RegExp("(^|s)" + className + "(s|$)");
        if (typeof(obj)=="string") {
        return re.test(obj);
        }
        else if (typeof(obj)=="object" && obj.className) {
        return re.test(obj.className);
        }
        return false;
}

function autoResize(id){
    var newheight;
    if(document.getElementById){
        newheight=document.getElementById(id).contentWindow.document.body.scrollHeight;
    }
    document.getElementById(id).height= (newheight) + "px";
}