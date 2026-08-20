<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>JavaScript Slideshow - TinySlideshow</title>
<link rel="stylesheet" href="pasador_style.css" />
</head>
<body>

<ul id="slideshow">
				
    <li>
        <h3></h3>
        <span>images_pasador/pasador_cuadrante.gif</span>
        <p></p>
        <a href="#"><img src="images_pasador/pasador_cuadrante.gif"/></a>		
    </li>
    
   <li>
        <h3></h3>
        <span>images_pasador/pasador_signos.gif</span>
        <p></p>
        <a href="#"><img src="images_pasador/pasador_signos.gif"/></a>		
    </li>
    
    <li>
        <h3></h3>
        <span>images_pasador/pasador_vbb.gif</span>
        <p></p>
        <a href="#"><img src="images_pasador/pasador_vbb.gif"/></a>		
    </li>
    
								
</ul>

<div id="wrapper">
		<div id="fullsize">
			<div id="imgprev" class="imgnav" title="Previous Image"></div>
			<div id="imglink"></div>
			<div id="imgnext" class="imgnav" title="Next Image"></div>
			<div id="image"></div>
			<div id="information">
				<h3></h3>
				<p></p>
			</div>
		</div>
		
</div>
<script type="text/javascript" src="pasador_compressed.js"></script>
<script type="text/javascript">
	$('slideshow').style.display='none';
	$('wrapper').style.display='block';
	var slideshow=new TINY.slideshow("slideshow");
	window.onload=function(){
		slideshow.auto=true;
		slideshow.speed=5;
		slideshow.link="linkhover";
		
		slideshow.scrollSpeed=4;
		slideshow.spacing=5;
		slideshow.active="#fff";
		slideshow.init("slideshow","image","imgprev","imgnext","imglink");
	}
</script>

</body>
</html>