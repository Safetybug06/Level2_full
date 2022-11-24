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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 6 English</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_14efbae1 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?9D7DDEC7"></script>
	<script src="data/player.js?9D7DDEC7"></script>
    <div id="content"></div>
    <div id="spr0_14efbae1"><audio id="snd0_14efbae1" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_14efbae1" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_14efbae1" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_14efbae1" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_14efbae1" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_14efbae1" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_14efbae1" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_14efbae1" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_14efbae1" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_14efbae1" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_14efbae1" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_14efbae1" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_14efbae1" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_14efbae1" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_14efbae1" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_14efbae1" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_14efbae1" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_14efbae1" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_14efbae1" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_14efbae1" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_14efbae1" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_14efbae1" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_14efbae1" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_14efbae1" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_14efbae1" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_14efbae1" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio><audio id="snd26_14efbae1" preload="none"><source src="data/sound27.mp3" type="audio/mpeg"/></audio><audio id="snd27_14efbae1" preload="none"><source src="data/sound28.mp3" type="audio/mpeg"/></audio><audio id="snd28_14efbae1" preload="none"><source src="data/sound29.mp3" type="audio/mpeg"/></audio><audio id="snd29_14efbae1" preload="none"><source src="data/sound30.mp3" type="audio/mpeg"/></audio><audio id="snd30_14efbae1" preload="none"><source src="data/sound31.mp3" type="audio/mpeg"/></audio><audio id="snd31_14efbae1" preload="none"><source src="data/sound32.mp3" type="audio/mpeg"/></audio></div>
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