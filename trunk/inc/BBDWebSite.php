<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BBDWebSite
 *
 * @author bbajanica
 */
class BBDWebSite {
    
    var $width = 1012;
    var $leftWidth = 206;
    var $rightWidth = 166;
    var $EOF = "\n";
    var $content = "";
    var $headInclude = "";
    var $headerContent = "";
	var $header_left_content = "";
	var $header_right_content = "";
    var $bodyContent = "";
    var $body_left_content = "";
	var $body_right_content = "";
	
    var $top_left = false;
    var $top_right = false;
    var $body_left = true;
    var $body_right = true;
    var $bottom_left = false;
    var $bottom_right = false;
    
    var $menu_position = "";
    var $menu = null;
    
    var $css = "";
    
    public function __construct() 
    {
        $this->setFormatPage();
    }
    
    public function setWidth( $custom_width = 0, $leftWidth = 0, $rightWidth = 0 )
    {
        if ( $custom_width == 0 )
            $custom_width = $this->width;
        if ( $leftWidth == 0 )
            $leftWidth = $this->leftWidth;
        if ( $rightWidth == 0 )
            $rightWidth = $this->rightWidth;
        
        $this->width = $custom_width;
        $this->leftWidth = $leftWidth+2;
        $this->rightWidth = $rightWidth+2;
    }
    
    public function setHeaderContent($content)
    {
        $this->headerContent .= $content;
    }
    
    public function setBodyContent($content)
    {
        $this->bodyContent .= $content;
    }
    
    public function setFormatPage()
    {
        $this->menu_type = "horizontal";
        $this->menu_position = "left bottom";
    }
    
    public function setContentPage()
    {
        $content = "<div id='content'>".$this->EOF;
        $header = "<div id='header' class='header'>$this->headerContent</div>".$this->EOF;
        if (!$this->top_left)
            $head_left_div = "".$this->EOF;
        else
            $head_left_div = "<div id='head_left' class='hl'>$this->header_left_content</div>".$this->EOF;
        
        if (!$this->top_right)
            $head_right_div = "".$this->EOF;
        else
            $head_right_div = "<div id='head_right' class='hr'>$this->header_right_content</div>".$this->EOF;
        
        if (!$this->body_left)
            $body_left_div = "".$this->EOF;
        else
            $body_left_div = "<div id='body_left' class='bl'>$this->body_left_content</div>".$this->EOF;
        
        if (!$this->body_right)
            $body_right_div = "".$this->EOF;
        else
            $body_right_div = "<div id='body_right' class='br'>$this->body_right_content</div>".$this->EOF;
        
        if (!$this->bottom_left)
            $bottom_left_div = "".$this->EOF;
        else
            $bottom_left_div = "<div id='bottom_left_left' class='fl'></div>".$this->EOF;
        
        if (!$this->bottom_right)
            $bottom_right_div = "".$this->EOF;
        else
            $bottom_right_div = "<div id='bottom_right' class='fr'></div>".$this->EOF;
        
        $body = "<div id='body' class='body'>".$this->bodyContent."</div>".$this->EOF;
        $footer = "
			<div id='footer' class='footer'>
				<div style=' padding: 0; margin: 0; width:99%; text-align: left; float: left; font-weight: bold; white-space: nowrap; height: 15px;'>
					<ul><li>Acasa</li><li>Despre noi</li><li>Livrare</li><li>Cum cumpar</li><li>Harta Site</li><li>Contact</li></ul>
				</div>
				<div class='date_created'>Copyright &copy; Ortoprotetica 2012. Toate drepturile rezervate.</div><div class='center'></div>
				<div class='created'></div>
			</div>".$this->EOF;
        
        $content .= $head_left_div . $header . $head_right_div;
        $content .= "<div class='clearfix'><div>";
        $content .= $body_left_div . $body . $body_right_div;
        $content .= "<div class='clearfix'><div>";
        $content .= $bottom_left_div . $footer . $bottom_right_div;
        $content .= "</div>".$this->EOF;
        $this->content = $content;
    }
    
    public function setHeaderInclude()
    {
        $this->headInclude = "<script type='text/JavaScript' src='js/jquery-1.7.1.min.js'></script>".$this->EOF;
        $this->headInclude .= '<link rel="stylesheet" type="text/css" href="css/reset-min.css" />'.$this->EOF;
        $this->headInclude .= '<link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />'.$this->EOF;
        $this->headInclude .= '<link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />'.$this->EOF;
        $this->headInclude .= '<!--[if lt IE 7]><link rel="stylesheet" href="css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" /><![endif]-->'.$this->EOF;
        $this->headInclude .= '
        <script type="text/javascript" src="js/mootools-yui-compressed.js" ></script>
        <script type="text/javascript" src="js/MenuMatic_0.68.3.js" ></script>
        <script type="text/javascript" src="js/my_scripts.js" ></script>
        <script type="text/javascript" >
            window.addEvent("domready", function() {			
                    var myMenu = new MenuMatic();
            });		
		</script>
		<base target="main_frame">
        '.$this->EOF;
        return $this->headInclude;
    }
    
    public function setCSS()
    {
		/*
		$css_content = file_get_contents("css/_default_.css");
        $css_compiled = "css/default_compiled.css";
        $css_content = str_replace('$this->width',  $this->width, $css_content);
        $css_content = str_replace('$this->leftWidth',  $this->leftWidth, $css_content);
        $css_content = str_replace('$this->rightWidth',  $this->rightWidth, $css_content);
		$headerWidth = $this->width;
		if ($this->top_left) $headerWidth -= $this->leftWidth+2;
		if ($this->top_right) $headerWidth -= $this->rightWidth+2;
		$bodyWidth = $this->width;
		if ($this->body_left) $bodyWidth -= $this->leftWidth+8;
		if ($this->body_right) $bodyWidth -= $this->rightWidth+8;
		$footerWidth = $this->width;
		if ($this->bottom_left) $footerWidth -= $this->leftWidth+2;
		if ($this->bottom_right) $footerWidth -= $this->rightWidth+2;
        $css_content = str_replace('$headerWidth',  ($headerWidth), $css_content);
        $css_content = str_replace('$bodyWidth',  ($bodyWidth), $css_content);
        $css_content = str_replace('$footerWidth',  ($footerWidth), $css_content);
        $menu_pos = explode(" ",$this->menu_position);
        //if ( $menu_pos[0] == "right" )
        $css_content = str_replace('$this->navfloat', "float: ".$menu_pos[0].";", $css_content);
        if (count($menu_pos)>0 && $menu_pos[1] == "bottom")
            $css_content = str_replace('$this->navmargintop', "81", $css_content);
        if ( file_exists($css_compiled) == TRUE )
        {
            unlink($css_compiled);
            unlink("css/default.css");
        }
        file_put_contents($css_compiled, $css_content);
        file_put_contents("css/default.css", $css_content);
		*/
        $this->css = "<link rel='stylesheet' type='text/css' href='css/default_compiled.css' />".$this->EOF;
        return $this->css;
    }
    
    public function setLogo($img_src)
    {
        $logo = "<div class='logo'><img src='".$img_src."'></div>".$this->EOF;
        $this->headerContent .= $logo;
    }
    
    private function recursiveMenuCreation($arr_menu,$parent="")
    {
		foreach ($arr_menu as $key => $item)
        {
            if (is_array($item))
            {
                $parent = $key;
				$this->menu .= "<li><a href='#'>".$key."</a>".$this->EOF;
                $this->menu .= "<ul>".$this->EOF;
                $this->recursiveMenuCreation($item,$parent);
				$parent = "";
                $this->menu .= "</ul>".$this->EOF;
                $this->menu .= "</li>".$this->EOF;
            }
            else
			{
                $this->menu .= "<li><a href='#' title='".$parent." ".$item."'>".$item."</a></li>".$this->EOF;
			}
        }
    }
    
    public function setMenu($arr_menu)
    {
        $this->menu = '<div id="nav_container">'.$this->EOF;
        $this->menu .= '<ul id="nav">'.$this->EOF;
        $this->recursiveMenuCreation($arr_menu);
        $this->menu .= "</ul>".$this->EOF;
        $this->menu .= "</div>".$this->EOF;
        $this->headerContent .= $this->menu;
    }

    public function newPage( )
    {
        $this->setContentPage();
        return $this->content;
    }
    
    
}

?>
