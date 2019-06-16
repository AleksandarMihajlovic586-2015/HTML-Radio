<html>
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />

<style>
div#audio_player{ width:450px; height:60px; background: url(images/skin1.png) no-repeat; border-radius:4px;}
div#audio_controls{ margin-left:66px; }
div#audio_controls > button{ border:none; cursor:pointer; outline:none; display:block; float:left; margin:22px 10px 0px 0px; }
div#audio_controls > input{ outline:none; display:block; float:left; margin:24px 10px 0px 0px; }
button#playpausebtn{
	background:url(images/pause.png) no-repeat;
	width:12px;
	height:14px;
}
button#mutebtn{
	background:url(images/speaker.png) no-repeat;
	width:5px;
	height:14px;
}
input#seekslider{
	width:100px;
}
input#volumeslider{
	width: 70px;
}
div#timebox{
	margin: 23px 10px 0px 0px;
	float:left;
	width:80px;
	background:#000;
	border-bottom:#333 1px solid;
	text-align:center;
	color: #09F;
	font-family: Arial, Helvetica, sans-serif;
	font-size:11px;
}
input[type='range'] {
    -webkit-appearance: none !important;
	margin:0px;
	padding:0px;
    background: #000;
    height:13px;
	border-bottom:#333 1px solid;
}
input[type='range']::-ms-fill-lower  {
	background:#000;
}
input[type='range']::-ms-fill-upper  {
	background:#000;
}
input[type='range']::-moz-range-track {
	border:none;
    background: #000;
}
input[type='range']::-webkit-slider-thumb {
    -webkit-appearance: none !important;
    background: radial-gradient(#FFF, #333);
    height:11px;
    width:11px;
	border-radius:100%;
	cursor:pointer;
}
input[type='range']::-moz-range-thumb {
    background: radial-gradient(#FFF, #333);
    height:11px;
    width:11px;
	border-radius:100%;
	cursor:pointer;
}
input[type='range']::-ms-thumb {
    -webkit-appearance: none !important;
    background: radial-gradient(#FFF, #333);
    height:11px;
    width:11px;
	border-radius:100%;
	cursor:pointer;
}
</style>
<script>
function initAudioPlayer(){
	var audio, playbtn, mutebtn, seekslider, volumeslider, seeking=false, seekto, curtimetext, durtimetext, playlist_status, dir, playlist, ext;
	dir = "muzka/Pop_Rock_Punk/"; //folder gde je muzika
	playlist = ["Arctic Monkeys - Do I Wanna Know","Complicated -- Avril Lavigne","Arctic Monkeys - R U Mine","Last One Standing - Simple Plan","Arctic Monkeys - Why'd You Only Call Me When You're High","NickelBack - Far Away","Owl City - Fireflies","NickelBack - How You Remind Me","Simple Plan - Astronaut","NickelBack - Lullaby","Simple Plan - Cant Keep My Hands Off You ft. Rivers Cuomo","NickelBack - Photograph","Simple Plan - Jet Lag ft. Natasha Bedingfield","NickelBack - Savin' Me","Simple Plan - Summer Paradise ft. Sean Paul","NickelBack - This Afternoon","Simple Plan - This Song Saved My Life","Sum 41 - In Too Deep","Simple Plan featuring Nelly - I Dont Wanna Go To Bed","The Pussycat Dolls - I Hate This Part","Singing In The Rain-Simple Plan"];
	playlist_index = Math.floor(Math.random()*20);
	ext = ".mp3";

	playbtn = document.getElementById("playpausebtn");
	mutebtn = document.getElementById("mutebtn");
	seekslider = document.getElementById("seekslider");
	volumeslider = document.getElementById("volumeslider");
	curtimetext = document.getElementById("curtimetext");
	durtimetext = document.getElementById("durtimetext");
	playlist_status = document.getElementById("playlist_status"); //trenutna pesma
	// Audio Object
	audio = new Audio();
	audio.src = dir+playlist[playlist_index]+ext;
	audio.loop = false;
	audio.play();
	playlist_status.innerHTML = "ON AIR: "+ playlist[playlist_index];
	// Za "Hendlovanje"
	playbtn.addEventListener("click",playPause);
	mutebtn.addEventListener("click", mute);
	seekslider.addEventListener("mousedown", function(event){ seeking=true; seek(event); });
	seekslider.addEventListener("mousemove", function(event){ seek(event); });
	seekslider.addEventListener("mouseup",function(){ seeking=false; });
	volumeslider.addEventListener("mousemove", setvolume);
	audio.addEventListener("timeupdate", function(){ seektimeupdate(); });
	audio.addEventListener("ended", function(){ switchTrack(); });
	// Funkcije
	function switchTrack(){  //funkcija koja menja pesmu
		if(playlist_index == (playlist.length - 1)){
			playlist_index = 0;
		} else {
			playlist_index++;
			document.getElementById("lajk").src= "images/unlike.png";
			newsrc= "lajk.png";
		}
		playlist_status.innerHTML = "ON AIR: "+ playlist[playlist_index];
		audio.src = dir+playlist[playlist_index]+ext;
	    audio.play();
	}
	function playPause(){
		if(audio.paused){
		    audio.play();
		    playbtn.style.background = "url(images/pause.png) no-repeat";
	    } else {
		    audio.pause();
		    playbtn.style.background = "url(images/play.png) no-repeat";
	    }
	}
	function mute(){
		if(audio.muted){
		    audio.muted = false;
		    mutebtn.style.background = "url(images/speaker.png) no-repeat";
	    } else {
		    audio.muted = true;
		    mutebtn.style.background = "url(images/speaker_muted.png) no-repeat";
	    }
	}
	function seek(event){
	    if(seeking){
		    seekslider.value = event.clientX - seekslider.offsetLeft;
	        seekto = audio.duration * (seekslider.value / 100);
	        audio.currentTime = seekto;
	    }
    }
	function setvolume(){
	    audio.volume = volumeslider.value / 100;
    }
	function seektimeupdate(){
		var nt = audio.currentTime * (100 / audio.duration);
		seekslider.value = nt;
		var curmins = Math.floor(audio.currentTime / 60);
	    var cursecs = Math.floor(audio.currentTime - curmins * 60);
	    var durmins = Math.floor(audio.duration / 60);
	    var dursecs = Math.floor(audio.duration - durmins * 60);
		if(cursecs < 10){ cursecs = "0"+cursecs; }
	    if(dursecs < 10){ dursecs = "0"+dursecs; }
	    if(curmins < 10){ curmins = "0"+curmins; }
	    if(durmins < 10){ durmins = "0"+durmins; }
		curtimetext.innerHTML = curmins+":"+cursecs;
	    durtimetext.innerHTML = durmins+":"+dursecs;
	}
}
window.addEventListener("load", initAudioPlayer);
var newsrc = "lajk.png";
function lajkovanjePesme(){
	if(newsrc=="lajk.png"){
	document.getElementById("lajk").src= "images/lajk.png";
	newsrc="unlike.png";
	window.open("lajkovanje.php","","width=520,height=620");

 }
}
</script>
<body>
	<div style="color:white;font-size:10;position: fixed;top: 90%;left:25%;margin-top: 10px;margin-left: -400px;background-color:black;width:400px;border:1px solid black;padding:10px;margin:-60px;">
	<h1 id="playlist_status"></h1> <!--trenutna pesma-->
    </div>
		<img src="images/unlike.png" id="lajk" onclick="lajkovanjePesme()" style="width:4%;height:7%;position:fixed;top:78%;left:73%">
<div id="audio_player">
  <div id="audio_controls">
    <input id="seekslider" type="range" min="0" max="100" value="0" step="1" style="visibility:hidden">
    <div id="timebox" style="visibility:hidden">
      <span id="curtimetext" style="visibility:hidden">00:00</span> / <span id="durtimetext" style="visibility:hidden">00:00</span>
    </div>
		<button id="playpausebtn" style='padding: 28px 14px'></button>
		<button id="mutebtn" style="padding: 28px 14px"></button>
    <input id="volumeslider" type="range" min="0" max="100" value="100" step="1">
  </div>
</div>
</body>
</html>
