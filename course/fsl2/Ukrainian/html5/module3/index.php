<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 614 --><!--version 10.2.3.9011 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#b2c4b2;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 3 Part2</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_f7f10aa {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?254899EE"></script>
	<script src="data/player.js?254899EE"></script>
    <div id="content"></div>
    <div id="spr0_f7f10aa"><audio id="snd0_f7f10aa" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_f7f10aa" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_f7f10aa" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_f7f10aa" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_f7f10aa" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_f7f10aa" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_f7f10aa" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_f7f10aa" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_f7f10aa" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_f7f10aa" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_f7f10aa" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_f7f10aa" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_f7f10aa" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_f7f10aa" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_f7f10aa" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_f7f10aa" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_f7f10aa" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_f7f10aa" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_f7f10aa" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_f7f10aa" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_f7f10aa" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_f7f10aa" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_f7f10aa" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_f7f10aa" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio></div>
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