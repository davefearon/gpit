<?php
class Imagemaker
{
	private static $_query;
	private static $_image;
	private static $_width = array();
	private static $_height = array();
	private static $_format = "gif";
	private static $_background;
	private static $_bg_r;
	private static $_bg_g;
	private static $_bg_b;
	private static $_bgcolor;
	private static $_text;
	private static $_txt_r;
	private static $_txt_g;
	private static $_txt_b;
	private static $_txtcolor;
	private static $_textsize = 12;
	private static $_string;
	private static $_message = "";
	private static $_matches = array();
	private static $_count = 0;
	private static $_i = 0;
	private static $_sizeloc;
	private static $_header;
	
	public function input( $query = null )
	{
		if( $query == null ) return false;
		
		self::$_query = $query;
		
		self::split_params();
		
		self::set_params();
		
		return true;
	}
	
	private static function split_params()
	{
		self::$_matches = preg_split( "/\//", self::$_query );
		self::$_count = count( self::$_matches );
	}
	
	private static function set_params()
	{
		foreach( self::$_matches as $match )
		{
			if( preg_match( "/([0-9]){1,4}([x])([0-9]){1,4}/", $match ) )
			{
				self::$_sizeloc = self::$_i;
				break;
			}
			self::$_i++;
		}
		if( self::$_sizeloc === 0 )
		{
			
		}
		elseif( self::$_sizeloc === 1 )
		{
			self::$_background = self::$_matches[0];
		}
		elseif( self::$_sizeloc === 2 )
		{
			self::$_background = self::$_matches[0];
			self::$_text = self::$_matches[1];
		}
		
		self::set_widthheight();
		self::set_bgcolors();
		self::set_txtcolors();
		self::set_format();
		self::set_message();
		
	}
	
	private static function set_message()
	{
		if( ( self::$_sizeloc + 1 )  < self::$_count )
		{
			for($i = self::$_sizeloc+1; $i < self::$_count; $i++)
			{
				if( $i == self::$_sizeloc + 1 )
				{
					self::$_message = self::$_matches[self::$_sizeloc + 1];
				}
				else
				{
					self::$_message .= "\n".self::$_matches[$i];
				}
			}
		}
		if( self::$_message === "" )
		{
			self::$_message = self::$_width ." x ". self::$_height;
		}
		else
		{
			 self::$_message = preg_replace( "/[_]+/", " ", self::$_message );
		}
	}
	
	private static function set_widthheight()
	{
		preg_match("/[0-9]+/", self::$_matches[self::$_sizeloc], $w);
		preg_match("/[0-9]+/", self::$_matches[self::$_sizeloc], $h, 0, strpos(self::$_matches[self::$_sizeloc], "x"));
		
		self::$_width = $w[0];
		self::$_height = $h[0];
	}
	
	public function create()
	{
		self::$_image = imagecreate( self::$_width, self::$_height );
		self::$_bgcolor = imagecolorallocate( self::$_image, self::$_bg_r, self::$_bg_g, self::$_bg_b );
		self::$_txtcolor = imagecolorallocate( self::$_image, self::$_txt_r, self::$_txt_g, self::$_txt_b );
		self::$_string = imagettftext( self::$_image, self::$_textsize, 0, round( ( self::$_width / 2 ) - ( ( strlen( self::$_message ) * imagefontwidth( self::$_textsize ) ) / 2 ) ), round( ( self::$_height / 2 ) - ( imagefontheight( self::$_textsize ) / 2 ) ) + self::$_textsize, self::$_txtcolor, "Trebuchet MS", stripslashes( self::$_message ) );
		
		self::$_header = self::set_header();
		imagecolordeallocate( self::$_image, self::$_bgcolor );
		imagecolordeallocate( self::$_image, self::$_txtcolor );
		imagedestroy( self::$_image );
		
		return;
	}
	
	private static function set_format()
	{
		preg_match("/[a-zA-Z]+/", self::$_matches[self::$_sizeloc], $f, 0, strpos(self::$_matches[self::$_sizeloc], ".") + 1);
		
		if( $f != null ) self::$_format = $f[0];
	}
	
	private static function set_bgcolors()
	{
		if( strlen( self::$_background ) > 1 )
		{
			if( preg_match( "/[0-9a-fA-F]{3,6}/", self::$_background ) )
			{
				if( strlen( self::$_background ) == 6 )
				{
					list( $r, $g, $b ) = array( self::$_background[0].self::$_background[1], self::$_background[2].self::$_background[3], self::$_background[4].self::$_background[5] );
				}
				elseif( strlen( self::$_background ) == 3 )
				{
					list( $r, $g, $b ) = array( self::$_background[0].self::$_background[0], self::$_background[1].self::$_background[1], self::$_background[2].self::$_background[2] );
				}
				else
				{
					$r = "c8"; $g = "c8"; $b = "c8";
				}
				self::$_bg_r = hexdec( $r );
				self::$_bg_g = hexdec( $g );
				self::$_bg_b = hexdec( $b );
			}
			else
			{
				//var_dump( self::convert_to_rgb( self::$_background ) );
				list( self::$_bg_r, self::$_bg_g, self::$_bg_b ) = self::convert_to_rgb( self::$_background, true );
			}
		}
		else
		{
			self::$_bg_r = 200;
			self::$_bg_g = 200;
			self::$_bg_b = 200;
		}
	}
	
	private static function set_txtcolors()
	{
		if( strlen( self::$_text ) > 1 )
		{
			if( preg_match( "/[0-9a-fA-F]{3,6}/", self::$_text ) )
			{
				if( strlen( self::$_text ) == 6 )
				{
					list( $r, $g, $b ) = array( self::$_text[0].self::$_text[1], self::$_text[2].self::$_text[3], self::$_text[4].self::$_text[5] );
				}
				elseif( strlen( self::$_text ) == 3 )
				{
					list( $r, $g, $b ) = array( self::$_text[0].self::$_text[0], self::$_text[1].self::$_text[1], self::$_text[2].self::$_text[2] );
				}
				else
				{
					$r = "ff"; $g = "ff"; $b = "ff";
				}
				self::$_txt_r = hexdec($r);
				self::$_txt_g = hexdec($g);
				self::$_txt_b = hexdec($b);
			}
			else
			{
				list( self::$_txt_r, self::$_txt_g, self::$_txt_b ) = self::convert_to_rgb( self::$_text, false );
			}
		}
		else
		{
			self::$_txt_r = 255;
			self::$_txt_g = 255;
			self::$_txt_b = 255;
		}
	}
	
	private static function convert_to_rgb( $color, $isbg = true )
	{
		switch( $color )
		{
			case "red":
				$r = 255; $g = 0; $b = 0;
				break;
			case "black":
				$r = 0; $g = 0; $b = 0;
				break;
			case "white":
				$r = 255; $g = 255; $b = 255;
				break;
			case "yellow":
				$r = 255; $g = 0; $b = 255;
				break;
			case "green":
				$r = 0; $g = 0; $b = 255;
				break;
			case "blue":
				$r = 0; $g = 255; $b = 0;
				break;
			case "cyan":
				$r = 0; $g = 255; $b = 255;
				break;
			case "magenta":
				$r = 255; $g = 255; $b = 0;
				break;
			default:
				if( !$isbg ) { $r = 255; $g = 255; $b = 255; }
				else { $r = 200; $g = 200; $b = 200; }
				break;
		}
		return array( $r, $b, $g );
	}
	
	private static function set_header()
	{
		switch( self::$_format )
		{
			case "gif":
				header( "Content-type: image/gif" );
				imagegif( self::$_image );
				break;
			case "jpg":
				header( "Content-type: image/jpeg" );
				imagejpeg( self::$_image );
				break;
			case "jpeg":
				header( "Content-type: image/jpeg" );
				imagejpeg( self::$_image );
				break;
			case "png":
				header( "Content-type: image/png" );
				imagepng( self::$_image );
				break;
			default:
				header( "Content-type: image/gif" );
				imagegif( self::$_image );
				break;
		}
	}
}
?>