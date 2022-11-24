<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 664 --><!--version 10.2.3.9011 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#b2c4b2;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Allergen Awareness English Mod 1</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_1270600 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?1565AD23"></script>
	<script src="data/player.js?1565AD23"></script>
    <div id="content"></div>
    <div id="spr0_1270600"><audio id="snd0_1270600" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_1270600" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_1270600" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_1270600" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_1270600" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_1270600" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_1270600" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_1270600" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_1270600" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_1270600" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_1270600" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_1270600" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio></div>
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