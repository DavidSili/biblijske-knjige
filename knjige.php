<?php
if(isset($_POST['do'])) $do=$_POST['do'];
else $do="";
if(isset($_POST['koliko'])) $koliko=$_POST['koliko'];
else $koliko="";
if(isset($_POST['stps'])) $stps=$_POST['stps'];
else $stps=0;
if(isset($_POST['gde'])) $gde=$_POST['gde'];
else $gde=0;
if (isset($_POST['rtime'])) $ptime=$_POST['rtime'];
else $ptime="";

if ($gde==2) {
	$uslov=' WHERE zavet="1"';
	$fbgde='Starog Zaveta';
	}
elseif ($gde==3) {
	$uslov=' WHERE zavet="2"';
	$fbgde='Novog Zaveta';
	}
else {
	$uslov="";
	$fbgde='celog Svetog Pisma';
	}

if ($koliko>20 AND $do=="b") {
	if ($gde==2) $kolko=39;
	elseif ($gde==3) $kolko=27;
		else $kolko=$koliko;
}
	else $kolko=$koliko;
$fbtext="";
if ($stps==2) {
$etime=$_SERVER['REQUEST_TIME'];
	if ($do=="a") {

		$checkok=0;
		for ($i = 1; $i <= $koliko; $i++) {
		
			if (isset($_POST['o'.$i])) ${'o'.$i}=$_POST['o'.$i];
				else ${'o'.$i}="";
			if (isset($_POST['a'.$i.'ID1'])) ${'a'.$i.'ID1'}=$_POST['a'.$i.'ID1'];
				else ${'a'.$i.'ID1'}="";
			if (isset($_POST['a'.$i.'ID2'])) ${'a'.$i.'ID2'}=$_POST['a'.$i.'ID2'];
				else ${'a'.$i.'ID2'}="";
			if (isset($_POST['a'.$i.'ime1'])) ${'a'.$i.'ime1'}=$_POST['a'.$i.'ime1'];
				else ${'a'.$i.'ime1'}="";
			if (isset($_POST['a'.$i.'ime2'])) ${'a'.$i.'ime2'}=$_POST['a'.$i.'ime2'];
				else ${'a'.$i.'ime2'}="";
				
			if ((${'a'.$i.'ID1'}<${'a'.$i.'ID2'} AND ${'o'.$i}==1) OR (${'a'.$i.'ID1'}>${'a'.$i.'ID2'} AND ${'o'.$i}==2)) {
			$checkok++;
			${'tac'.$i}=1;
			}
			
		}
	
	}
	if ($do=="b") {
		$checkok=0;
		for ($i = 1; $i <= $kolko; $i++) {
			if(isset($_POST['shuf'.$i])) ${'shuf'.$i}=($_POST['shuf'.$i]);
				else ${'shuf'.$i}="";
			if(isset($_POST['ime'.$i])) ${'ime'.$i}=$_POST['ime'.$i];
				else ${'ime'.$i}="";
			if(isset($_POST['o'.$i])) ${'o'.$i}=$_POST['o'.$i];
				else ${'o'.$i}="";
			if(isset($_POST['to'.$i])) ${'to'.$i}=$_POST['to'.$i];
				else ${'to'.$i}="";
			${'shuf'.$i}=unserialize(${'shuf'.$i});

			if (${'o'.$i}==${'to'.$i}) {
				$checkok++;
				${'tac'.$i}=1;
			}

		}
	
	}

	$razlika=$etime-$ptime;
	$sortvreme=date ('i:s',$razlika);
	$poena=$checkok/$kolko*500;
	$vpoena=((($kolko*20)-$razlika)/($kolko*20)*500)*($checkok/$kolko);
	if ($vpoena<0) $vpoena=0;
	$poena=$poena+$vpoena;
	$poena=round($poena);
	if ($do=="a") $fbdo="redosleda knjiga ";
		else $fbdo="broja poglavlja knjiga ";
		
	$fbtext='Imam '.$poena.' bodova u poznavanju '.$fbdo.$fbgde;
}
?>
<html>
<head profile="http://www.w3.org/2005/20/profile">
<link rel="icon"
	  type="image/png"
	  href="images/favicon.png">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title id="Timerhead">Biblijske igre: Knjige Biblije</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script language="javascript" type="text/javascript">
var Timer;
var TotalSeconds;
var TimeStr;


function CreateTimer(TimerID, Time) {
    Timer = document.getElementById(TimerID);
    TotalSeconds = Time;
    
    UpdateTimer()
    window.setTimeout("Tick()", 1000);
}

function Tick() {
    TotalSeconds += 1;
    UpdateTimer()
    window.setTimeout("Tick()", 1000);
}

function UpdateTimer() {
    var Seconds = TotalSeconds;
    
    var Minutes = Math.floor(Seconds / 60);
    Seconds -= Minutes * (60);


    var TimeStr = LeadingZero(Minutes) + ":" + LeadingZero(Seconds)

    Timer.innerHTML = "Prošlo je vremena: " + TimeStr;
	
}

function LeadingZero(Time) {

    return (Time < 10) ? "0" + Time : + Time;

}

</script>
</head>
<body>
<?php
	echo '<div id="wrapper" ';
if ($do=="b" AND $koliko==10) echo 'style="height:780px"';
elseif ($do=="b" AND $koliko==20) echo 'style="height:1260px"';
elseif ($do=="b" AND $koliko==50) {

	if ($gde==2) {
		if ($stps==1) echo 'style="height:2370px"';
			else echo 'style="height:2220px"';
	}
	elseif ($gde==3) {
		if ($stps==1) echo 'style="height:1750px"';
			else echo 'style="height:1580px"';
	}
		else echo 'style="height:2870px"';

}
	echo '>';
	
	$knjige=array("1"=> array("1. Mojsijeva","50","70"),
	"2"=> array("2. Mojsijeva","40","70"),
	"3"=> array("3. Mojsijeva","27","70"),
	"4"=> array("4. Mojsijeva","36","70"),
	"5"=> array("5. Mojsijeva","50","70"),
	"6"=> array("Isusa Navina","24","40"),
	"7"=> array("o sudijama","21","40"),
	"8"=> array("o Ruti","4","15"),
	"9"=> array("1. Samuilova","31","50"),
	"10"=> array("2. Samuilova","24","40"),
	"11"=> array("1. Carevima","22","35"),
	"12"=> array("2. Carevima","25","40"),
	"13"=> array("1. Dnevnika","29","40"),
	"14"=> array("2. Dnevnika","36","50"),
	"15"=> array("Jezdrina","10","30"),
	"16"=> array("Nemijina","13","30"),
	"17"=> array("Jestira","10","20"),
	"18"=> array("O Jovu","42","60"),
	"19"=> array("Psalmi","150","170"),
	"20"=> array("Priče","31","50"),
	"21"=> array("propovednikova","12","30"),
	"22"=> array("Pesma nad pesmama","8","20"),
	"23"=> array("proroka Isaije","66","80"),
	"24"=> array("proroka Jeremije","52","70"),
	"25"=> array("plač Jeremijin","5","15"),
	"26"=> array("proroka Jezekilja","48","70"),
	"27"=> array("proroka Danila","12","30"),
	"28"=> array("proroka Osije","14","30"),
	"29"=> array("proroka Joila","3","10"),
	"30"=> array("proroka Amosa","9","25"),
	"31"=> array("proroka Avdija","1","5"),
	"32"=> array("proroka Jone","4","15"),
	"33"=> array("proroka Miheja","7","20"),
	"34"=> array("proroka Nauma","3","12"),
	"35"=> array("proroka Avakuma","3","12"),
	"36"=> array("proroka Sofonije","3","12"),
	"37"=> array("proroka Ageja","2","8"),
	"38"=> array("proroka Zaharije","14","35"),
	"39"=> array("proroka Malahije","4","12"),
	"40"=> array("jevanđelje po Mateju","28","40"),
	"41"=> array("jevanđelje po Marku","16","40"),
	"42"=> array("jevanđelje po Luki","24","40"),
	"43"=> array("jevanđelje po Jovanu","21","40"),
	"44"=> array("dela apostolska","28","50"),
	"45"=> array("Rimljanima","16","30"),
	"46"=> array("1. Korinćanima","16","30"),
	"47"=> array("2. Korinćanima","13","30"),
	"48"=> array("Galatima","6","18"),
	"49"=> array("Efescima","6","14"),
	"50"=> array("Filipljanima","4","12"),
	"51"=> array("Kološanima","4","12"),
	"52"=> array("1. Solunjanima","5","16"),
	"53"=> array("2. Solunjanima","3","12"),
	"54"=> array("1. Timotiju","6","20"),
	"55"=> array("2. Timotiju","4","12"),
	"56"=> array("Titu","3","10"),
	"57"=> array("Filemonu","1","6"),
	"58"=> array("Jevrejima","13","30"),
	"59"=> array("Jakovljeva","5","15"),
	"60"=> array("1. Petrova","5","15"),
	"61"=> array("2. Petrova","3","10"),
	"62"=> array("1. Jovanova","5","10"),
	"63"=> array("2. Jovanova","1","8"),
	"64"=> array("3. Jovanova","1","8"),
	"65"=> array("Judina","1","8"),
	"66"=> array("Otkrivenje","22","40"));
?>
		<div id="header">
			<div style="height:75px;width:290px;float:left"><div style="font-size:24;font-weight:bold;float:left">Učenje Biblijskih knjiga</div><div style="float:left">
			
<!-- Histats.com  START  (standard)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="counter create hit" ><script  type="text/javascript" >
try {Histats.start(1,1847240,4,602,110,40,"00011111");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?1847240&101" alt="counter create hit" border="0"></a></noscript>
<!-- Histats.com  END  -->

</div></div>
<?php if ($stps==0 OR $stps==2) { ?>
			<div style="float:left;margin-left:10px;text-align:right;width:100px;height:80px;line-height:24px">
				Koja igra:<br/>
				Odakle:<br/>
				Koliko pitanja:
			</div>
			<div style="float:left;margin-left:10px;width:140px;height:80px">
				<form method="POST" action="knjige.php">
					<div style="height:25px">
						<select name="do">
							<option value="a" <?php if ($do=="a") echo "selected" ?>>raspored knjiga</option>
							<option value="b" <?php if ($do=="b") echo "selected" ?>>broj poglavlja</option>
						</select>
					</div>
					<div style="height:25px">
						<select name="gde">
							<option <?php if ($gde==1) echo "selected" ?> value="1">Cela Biblija</option>
							<option <?php if ($gde==2) echo "selected" ?> value="2">Stari zavet</option>
							<option <?php if ($gde==3) echo "selected" ?> value="3">Novi Zavet</option>
						</select>
					</div>
					<div style="height:25px">
						<select name="koliko">
							<option <?php if ($koliko==10) echo "selected" ?>>10</option>
							<option <?php if ($koliko==15) echo "selected" ?>>15</option>
							<option <?php if ($koliko==20) echo "selected" ?>>20</option>
							<option <?php if ($koliko==25) echo "selected" ?>>25</option>
						</select>
					<input type="hidden" name="stps" value="1" />
					<input type="submit" value="počni" />
					</div>
				</form>
			</div>
<?php }
if ($stps==1) {
?>
			<div id="timer" style="float:right;font-size:24;font-weight:bold">
				<script type="text/javascript">
					window.onload = CreateTimer("timer", 0);
				</script>
			</div>
<?php
}
if ($stps==2) {
	
		echo '<div style="float:left;width:230px;height:80px"><div><b>Tačnih: '.$checkok.' od '.$kolko.' ('.round(($checkok/$kolko)*100).'%)</div>';
		echo '<div style="font-size:32">Bodova: '.$poena.'</div>';
		echo '<div><div style="float:left">Vreme: '.$sortvreme.'</div><a style="float:right" href="http://www.facebook.com/sharer.php?s= 100&amp;p[title]=Igra poznavanja Biblijskih knjiga&amp;p[url]=http://www.vodicbg.com/bib-igre/knjige.php&amp;p[images][0]=http://dl.dropbox.com/u/10871766/biblija.jpg&amp;p[summary]='.$fbtext.'"><img src="images/fbshare.gif" /></a></b></div>';
?>
		<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
				type="text/javascript">
		</script>
<?php
		echo '</div>';
	
	
}
		echo '</div><div';
		if ($stps!=0) echo ' style="padding:10px"';
		echo '>';
		
if ($stps==1) {
	echo '<form name="test" method="POST" action="knjige.php">';
	if ($do=="a") { 
		$i=1;
		while ($i <= $koliko) {

			if ($gde==1) {
				$rnd1 = rand(1,66);
				do {
				  $rnd2 = rand(1,66);
				} while ($rnd1 == $rnd2);
			}
			elseif ($gde==2) {
				$rnd1 = rand(1,39);
				do {
				  $rnd2 = rand(1,39);
				} while ($rnd1 == $rnd2);
			}
			else {
				$rnd1 = rand(40,66);
				do {
				  $rnd2 = rand(40,66);
				} while ($rnd1 == $rnd2);
			}
			echo '<div style="height:60px"><b>'.$i.'. ';
				echo 'Da li je knjiga <span style="color:#0000FF">'.$knjige[$rnd1][0].'</span> pre ili posle knjige <span style="color:#0000FF">'.$knjige[$rnd2][0].'</span>?</b><br/>';
					echo '<input type="radio" name="o'.$i.'" value="1" />pre<br/><input type="radio" name="o'.$i.'" value="2" />posle';
					echo '<input type="hidden" name="a'.$i.'ID1" value="'.$rnd1.'" />';
					echo '<input type="hidden" name="a'.$i.'ID2" value="'.$rnd2.'" />';
					echo '<input type="hidden" name="a'.$i.'ime1" value="'.$knjige[$rnd1][0].'" />';
					echo '<input type="hidden" name="a'.$i.'ime2" value="'.$knjige[$rnd2][0].'" />';
				echo '</div><br/>';
				$i++;

		}

		$rtime=$_SERVER['REQUEST_TIME'];
		echo '<input type="hidden" name="rtime" value="'.$rtime.'" />';
		echo '<input type="hidden" name="stps" value="2" />';
		echo '<input type="hidden" name="koliko" value="'.$koliko.'" />';
		echo '<input type="hidden" name="do" value="'.$do.'" />';
		echo '<input type="hidden" name="gde" value="'.$gde.'" />';
		echo '<input type="submit" value="pošalji odgovore" />';
		echo '</form>';
		
	}
	if ($do=="b") {
	echo '<div style="font-size:20;font-weight:bold;margin-bottom:20px">Koliko poglavlja imaju knjige:</div>';
	echo '<form name="test2" method="POST" action="knjige.php">';
	
	$sveknjige=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
	$stari=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39");
	$novi=array("40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66");
	
	shuffle($sveknjige);
	shuffle($stari);
	shuffle($novi);
		for ($i = 1; $i <= $koliko; $i++) {
			
			if ($gde==1) $glavna=$sveknjige;
			elseif ($gde==2) $glavna=$stari;
			else $glavna=$novi;
			
			$ID=$glavna[$i];
			$ime=$knjige[$ID][0];
			$glava=$knjige[$ID][1];
			$max=$knjige[$ID][2];
		
			echo '<div id="box">';
			echo '<b>('.$i.') - '.$ime.':</b><br/>';
			
			${'odg'.$i}[0]=intval($glava);

			$ii=1;
			while ($ii <= 4) {
				$a=rand(1,$max);
				if (in_array($a,${'odg'.$i})==false) {
				array_push(${'odg'.$i},$a);
				$ii++;
				}
			}
			
			shuffle(${'odg'.$i});
				foreach (${'odg'.$i} as $iii) {
					echo '<div style="margin:0 0 5px 20px;padding:0 3px"><input type="radio" name="o'.$i.'" value="'.$iii.'" style="margin-right:7px"/>'.$iii.'</div>';
				}
				$shuf=serialize(${'odg'.$i});
				echo '<input type="hidden" name="shuf'.$i.'" value="'.$shuf.'" />';
				echo '<input type="hidden" name="to'.$i.'" value="'.$glava.'" />';
				echo '<input type="hidden" name="ime'.$i.'" value="'.$ime.'" />';
			echo '</div>';

		}
		$rtime=$_SERVER['REQUEST_TIME'];
		echo '<input type="hidden" name="rtime" value="'.$rtime.'" />';
		echo '<input type="hidden" name="stps" value="2" />';
		echo '<input type="hidden" name="koliko" value="'.$koliko.'" />';
		echo '<input type="hidden" name="do" value="'.$do.'" />';
		echo '<input type="hidden" name="gde" value="'.$gde.'" />';
		echo '<div style="float:right;height:30px;margin:50px 50px 0 0"><input type="submit" value="pošalji odgovore" style="width:200px;height:50px;font-size:16"/></div>';
		echo '</form>';

	}

}

if ($stps==2) {

	if ($do=="a") {

		$checkok=0;
		for ($i = 1; $i <= $koliko; $i++) {
		
			echo '<div style="width:780px;height:60px"><div style="float:left"><b>'.$i.'. Da li je knjiga <span style="color:#0000FF">'.${'a'.$i.'ime1'}.'</span> pre ili posle knjige <span style="color:#0000FF">'.${'a'.$i.'ime2'}.'</span>?</b><br/>';
				echo '<input type="radio" name="x'.$i.'" value="1" ';
				if (${'o'.$i}==1) echo 'checked';
				echo '/>pre<br/><input type="radio" name="x'.$i.'" value="2" ';
				if (${'o'.$i}==2) echo 'checked';
				echo '/>posle';
			echo '</div>';
			echo '<div style="float:left;margin:10px">';
				echo '<img src="images/';
				if (isset(${'tac'.$i}) AND ${'tac'.$i}==1) echo 'da';
					else echo 'ne';
				echo '.gif" />';
			echo '</div></div><br/>';
		}
		

	}

	if ($do=="b") {
		
		echo '<div style="font-size:20;font-weight:bold;margin-bottom:10px">Rezultati:</div>';
		for ($i = 1; $i <= $kolko; $i++) {

				
			echo '<div id="box">';
				echo '<span style="color:#';
				if (isset(${'tac'.$i}) AND ${'tac'.$i}==1) echo '0000FF';
					else echo 'FF0000';
				echo '"><b>('.$i.') - '.${'ime'.$i}.':</b></span><br/>';
			
				foreach (${'shuf'.$i} as $iii) {
					echo '<div style="margin:0 0 5px 20px;padding:0 3px"><input type="radio" name="o'.$i.'" value="'.$iii.'" style="margin-right:7px" ';
					if ($iii==${'o'.$i}) echo 'checked ';
					echo '/><span';
					if ($iii==${'to'.$i} AND $iii==${'o'.$i}) echo ' style="color:#0000FF"';
					elseif ($iii!=${'to'.$i} AND $iii==${'o'.$i}) echo ' style="color:#FF0000"';
					elseif ($iii==${'to'.$i} AND $iii!=${'o'.$i}) echo ' style="color:#009900"';
					echo '>'.$iii.'</span></div>';
				}
					
			echo '</div>';
			
		}

	}

}

?>
		</div>
	</div>
</body>
</html>