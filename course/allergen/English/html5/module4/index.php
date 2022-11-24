<?php
session_start();


if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 664 --><!--version 9.7.7.21004 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#b2c4b2;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Allergen Awareness English Mod 3</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_391b7f2f {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?2494CA97"></script>
	<script src="data/player.js?2494CA97"></script>
    <div id="content"></div>
    <div id="spr0_391b7f2f"><audio id="snd0_391b7f2f" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_391b7f2f" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_391b7f2f" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_391b7f2f" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_391b7f2f" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_391b7f2f" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_391b7f2f" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_391b7f2f" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_391b7f2f" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_391b7f2f" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_391b7f2f" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_391b7f2f" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_391b7f2f" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_391b7f2f" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio></div>
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