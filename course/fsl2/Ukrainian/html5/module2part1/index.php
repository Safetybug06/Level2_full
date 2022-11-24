<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 614 --><!--version 10.2.3.9011 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#8a8a8a;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 2 Part 1 Russian</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_f4b87ea {display:none;}</style>
    
    
    <style>
		#playerView {
			position:absolute;
			-webkit-tap-highlight-color:rgba(0,0,0,0);
			-webkit-user-select:none;
			-moz-user-select:none;
			-webkit-touch-callout:none;
			-webkit-user-drag:none;
		}
		#playerView * {
			position:absolute;
		}
		#preloader {
			width: 50px;
			height: 50px;
			position: absolute;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			margin: auto;
			border-radius: 10px;
			background-color: rgba(0, 0, 0, 0.5);
		}

		#preloader::after {
			content: '';
			position: absolute;
			background: url(data:image/png;base64,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UmVhZHlxyWU8AAADcmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMwNjcgNzkuMTU3NzQ3LCAyMDE1LzAzLzMwLTIzOjQwOjQyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOmFjOGVjNDFhLTZkYWItODQ0Ni04YzkzLWU1Mjk3N2YwMmE4NSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFRThCNzU3NDYzNjcxMUU1QTZDRUE5NTVGOUJGQ0E3MCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFRThCNzU3MzYzNjcxMUU1QTZDRUE5NTVGOUJGQ0E3MCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNSAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0OWFlZmI1OC00ZWFmLWQ3NDgtYTI0ZS0zNmNhNGQ2M2QwNTYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6N0MwQkFBM0M2MjAxMTFFNUI4QjBERTk4MjY5MjQwQjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6MGSVVAAAE3klEQVR42uycW4hWVRiG15Q4eYzGQySSQlriEQ9BF2mE4iSdESRRIb0RD+mNmHgICjqQEGUe6sqgCy1i0iRinAzELrooQhHLGQURUTzMiM7omCLj+/F/czX/t/890z6s9e/3hZcZ1l6z19r7mXXca62arq4uR/mjh/gKCIQiEAKhCIRAKAIhEIpACIQiEIpACIQiEAKhCIRAKAIhEMoX9Yu62NbWxjcUobq6OpaQQpcQz/QwPBOeDU+Fx8Oj4UfhoRrnJnwDvgC3wCfgY/Bf8P0QHrImahmQB1VWLfwGvAieqy+/LxJIR+Dv4QPwf75WWb4CGQavg9fo70mqFd4F79DfCSRCA+HN8Hp4cMppdcBfwB/Bt9mo99Sr8Cl4SwYwnKYhaf2jaXMconoE/hL+CR6TQ/pPato7NS+FbtSfgH+Gp8eMfwv+HT6qpakZvqzVT/d//ePw0/BEeI72ygbFvP/f8MvwpSK2IfLSGuGxFeJ1aby98CG4s5fpDNAqaTlcL89cIf45jddcpDZknI4PKsFo0NKzQLusnX1Iq1P/doHe60CF+GM1b+OK0obIYO5XeGREnLPwfHghfDzBtOVeb+q9z0bEG6njltHVDqQ2RuP9HTwDbkoxH02axv4YjX1tNQP5LKIBl7ZiK/yWToGkLUljsaZpNaTTNc9VCeR1eHUEjHfgD3OoQiXNVRFQVmveqwrIEHh3xPXNOp2Rl77WPFiSvA+tJiCb4FHGNanHP/FggCp52Gdck7y/Wy0Dw2Hatx9s9KZmZNRmxC3JMjh8qsy1Du0St4Y+DomaKFzlEQxRu+apnOQZ1oVeZfWPeMCGlLu2/6dL3BDRwPcPGYiMjocbvaoPnL963+h1DddnChbIMiP8cMIj8KQln34be/lM3gOREW69cW2v81/fGOH1aY7e0wTyrNGYyxT6wQCAHNS8lmvcZ4UIZL4RLt8z7gQA5I7mtZyeCxHIS0b4UReOrLw+EyIQqxScDAiIldcJIQLZYTTmvwUEpMUIHxMikB/gta40PXIF/lwHVrcCAnLVCH8srQR9X7mYt2RUbq1yrOFia390N9SReugaYoR3EEg+GmGEtxNIPhpvhJ8nkHw02Qj/l0Dy0Rwj/DSBZC9ZeD3buPYHgWSv11z5RdrSw/qTQLLX20Z4o0toSxyBxJdsKrVmq79NM2ECKa/3XPltC9fgXwgkW81zpVX35fSVS3HahEB6SqZK9hjXujeJOgLJTrLG19qos1OrLALJSLL+eLFx7SL8cRaZIJCSVrrSfnVL8qHtJoFkoy3ablibQeWz849ZZaZfgUHIfg/Z97EkIs5xLR2OQNLv2u5x0Ttt5UShV1wfj91glRVP01xp8UVTBRiyuOFFheJYQpKVzNrKwQErXPyDA2SF+5k8MhsykCnwPdfzaA3ZYy6nREyCX4Cfd/EPs+nV0RoEUlqWsx1eCie9Bkc2nW5wOa87Dg3Ipy75bWXntSd1yIcHDK1RT3KzTIcOBif6AqOo3d42HX/I0tZW3zIXWgnp68chmfaQjZxyoKac0bXNRxghlpCN2m1dpj/btXEfpD0uqYaua89Luq3dx8TKN3AeE1vt4mLrAohACIQiEAKhCIRAKAIhEIpACq7IqROKJYRA+AoIhCIQAqEIhEAoAiEQikCKrQcCDABHPgH2w7NQdAAAAABJRU5ErkJggg==);
			background-size: cover;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			animation: preloader_spin 1s infinite linear;
			-webkit-animation: preloader_spin 1s infinite linear;
		}

		@keyframes preloader_spin { 0% {transform: rotate(0deg);} 100% {transform: rotate(360deg);} }
		@-webkit-keyframes preloader_spin { 0% {-webkit-transform: rotate(0deg);} 100% {-webkit-transform: rotate(360deg);}}
    </style>
</head>
<body>
	<div id="preloader"></div>
	<script src="data/browsersupport.js?E16DA8D0"></script>
	<script src="data/player.js?E16DA8D0"></script>
    <div id="content"></div>
    <div id="spr0_f4b87ea"><audio id="snd0_f4b87ea" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_f4b87ea" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_f4b87ea" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_f4b87ea" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_f4b87ea" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_f4b87ea" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_f4b87ea" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_f4b87ea" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_f4b87ea" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_f4b87ea" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_f4b87ea" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_f4b87ea" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_f4b87ea" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_f4b87ea" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_f4b87ea" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_f4b87ea" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_f4b87ea" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_f4b87ea" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_f4b87ea" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_f4b87ea" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_f4b87ea" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_f4b87ea" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_f4b87ea" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_f4b87ea" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_f4b87ea" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_f4b87ea" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio><audio id="snd26_f4b87ea" preload="none"><source src="data/sound27.mp3" type="audio/mpeg"/></audio><audio id="snd27_f4b87ea" preload="none"><source src="data/sound28.mp3" type="audio/mpeg"/></audio><audio id="snd28_f4b87ea" preload="none"><source src="data/sound29.mp3" type="audio/mpeg"/></audio><audio id="snd29_f4b87ea" preload="none"><source src="data/sound30.mp3" type="audio/mpeg"/></audio></div>
    <script>
		(function(startup){
			function start(savedPresentationState)
			{
				var presInfo = "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";
				PresentationPlayer.start(presInfo, "content", "playerView", onPlayerInit, savedPresentationState);
				function onPlayerInit(player)
				{
					(player);

					var preloader = document.getElementById("preloader");
					preloader.parentNode.removeChild(preloader);
				}
			}

			if (startup)
				startup(start);
			else
				start();
		})();
    </script>
</body>
</html>