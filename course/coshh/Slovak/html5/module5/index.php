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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 5 COSHH</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_f921551 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?5B2760A2"></script>
	<script src="data/player.js?5B2760A2"></script>
    <div id="content"></div>
    <div id="spr0_f921551"><audio id="snd0_f921551" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_f921551" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_f921551" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_f921551" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_f921551" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_f921551" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_f921551" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_f921551" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_f921551" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_f921551" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_f921551" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_f921551" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_f921551" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_f921551" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_f921551" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_f921551" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_f921551" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_f921551" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_f921551" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_f921551" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_f921551" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio></div>
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