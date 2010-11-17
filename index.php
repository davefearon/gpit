<?
if( isset( $_REQUEST['q'] ) )
{
	require_once('imagemaker.php');
	$input = $_REQUEST['q'];
	$image = new Imagemaker();
	$image->input( $input );
	$image->create();
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta charset="utf-8" />
<link rel="icon" href="http://gottaplace.it/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://gottaplace.it/favicon.ico" type="image/x-icon" />

<title>GottaPlace.it | A Placeholder Service</title>
<!-- <script type="text/javascript" src="jquery-1.4.2.min.js"></script> -->
<link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body>
<div class="main">
	<div class="left">
		<div class="title">gottaplace.it</div>
		<div class="tagline">a fast and easy image placeholder service</div>
	</div>
	<div class="content">
		
		<div class="section">
			<div class="how">
				<span>How does it work?</span>
				<br/>
				Just put the placeholder size you want after our url and voila!
			</div>
			<div class="sampleurl">http://gottaplace.it/350x200</div>
		</div>
		
		<div class="section">
			<div class="isthereoptions">
				<span>Is there options?</span>
				<br/>
				Of course there is!
				<ul>
					<li><span>Background color (Use either the word or the hex value)</span></li>
					<li><span>Text color (Use either the word or the hex value)</span></li>
					<li><span>Image size (Width x Height in pixels)</span></li>
					<li><span>Image format (.gif/.jpg/.jpeg/.png)</span></li>
					<li><span>Personalized Message (You can use either _ or + or a space to specify a space)</span></li>
				</ul>
			</div>
		</div>
		
		<div class="section">
			<div class="isthereoptions">
				<span>How do you use all the options?</span>
				<br/>
				To make things super easy for you, her is a breakdown of how you can take full advantage of the options.
				<table width="640" cellpadding="2" cellspacing="0" border="0" style="border:1px dashed #0099ff; padding:10px; margin-top:10px; text-align:center;">
					<colgroup>
						<col width="203"/>
						<col width="89"/>
						<col width="8"/>
						<col width="42"/>
						<col width="8"/>
						<col width="65"/>
						<col width="54"/>
						<col width="8"/>
						<col width="89"/>
						<col width="27"/>
					</colgroup>
					<tr>
						<td style="border-bottom:1px dashed #0099ff">&nbsp;</td>
						<td style="border-bottom:1px dashed #0099ff">Background Color</td>
						<td style="border-bottom:1px dashed #0099ff">&nbsp;</td>
						<td style="border-bottom:1px dashed #0099ff">Text Color</td>
						<td style="border-bottom:1px dashed #0099ff">&nbsp;</td>
						<td style="border-bottom:1px dashed #0099ff">Size (wxh)</td>
						<td style="border-bottom:1px dashed #0099ff">Image Format</td>
						<td style="border-bottom:1px dashed #0099ff">&nbsp;</td>
						<td style="border-bottom:1px dashed #0099ff">Message</td>
						<td style="border-bottom:1px dashed #0099ff">&nbsp;</td>
					</tr>
					<tr>
						<td>&lt;img src="http://gottaplace.it/</td>
							<td>0099ff</td>
							<td>/</td>
							<td>ffffff</td>
							<td>/</td>
							<td>350x200</td>
							<td>.png</td>
							<td>/</td>
							<td>Your_Image</td>
						<td>" /&gt;</td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="section">
			<div class="ortry">
				<span>Want some samples?</span>
				<br/>
				Try these on for size!
			</div>
				
			<div class="sampleuses">
				<img src="0099ff/black/620x100/This Text Is Black" />
				<img src="0099ff/fff/265x50.gif/Hi Mom! <3" class="mr" />
				<img src="white/0099ff/345x50.jpg" class="ml" />
				<img src="181818/0099ff/433x270.jpeg/I'm a block" class="mr" />
				<img src="black/0099ff/177x25.png" class="ml" />
				<img src="green/fff/177x25.png" class="ml" />
				<img src="cyan/red/177x25.png" class="ml" />
				<img src="magenta/000/177x25.png" class="ml" />
				<img src="yellow/000/177x25.png" class="ml" />
				<img src="red/white/177x25.png" class="ml" />
				<img src="blue/fff/177x25.png/RECTANGLE" class="ml" />
				<img src="white/black/177x25.png" class="ml" />
			</div>
		</div>
		
		<div class="section">
			<div class="isthereoptions">
				<span>This site is super helpful!</span>
				<br/>
				While that isn't a question, I'll let it slide this time. Thanks!
			</div>
		</div>
		
	</div>
	
	<div class="footer">
		<div class="created">
			
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="W4U8JLB6ZNEDA">
				<label for="submit"><span>Created by <a href="http://davefearon.com" target="_blank">Dave Fearon</a> to enrich your life | Perhaps you wish to donate?</span></label>
				<input type="image" class="donate" src="Blue.png" style="width:32px; height:32px;" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>

		<div class="hosted">
			<span>Hosted by</span> <a class="mediatemple" href="http://www.mediatemple.net/go/order/?refdom=davefearon.com" target="_blank"><img src="mt.png" alt="Media Temple" /></a>
		</div>
	</div>
</div>
<?
/*
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2895777-8");
pageTracker._trackPageview();
} catch(err) {}</script>
*/?>
</body>
</html>
<?
}
?>