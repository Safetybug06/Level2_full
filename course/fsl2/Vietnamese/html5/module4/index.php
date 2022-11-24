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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 4 English</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_14c9de12 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?F46A386F"></script>
	<script src="data/player.js?F46A386F"></script>
    <div id="content"></div>
    <div id="spr0_14c9de12"><audio id="snd0_14c9de12" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_14c9de12" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_14c9de12" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_14c9de12" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_14c9de12" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_14c9de12" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_14c9de12" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_14c9de12" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_14c9de12" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_14c9de12" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_14c9de12" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_14c9de12" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_14c9de12" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_14c9de12" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_14c9de12" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_14c9de12" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_14c9de12" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_14c9de12" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_14c9de12" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_14c9de12" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_14c9de12" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_14c9de12" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_14c9de12" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_14c9de12" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_14c9de12" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_14c9de12" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio><audio id="snd26_14c9de12" preload="none"><source src="data/sound27.mp3" type="audio/mpeg"/></audio><audio id="snd27_14c9de12" preload="none"><source src="data/sound28.mp3" type="audio/mpeg"/></audio><audio id="snd28_14c9de12" preload="none"><source src="data/sound29.mp3" type="audio/mpeg"/></audio><audio id="snd29_14c9de12" preload="none"><source src="data/sound30.mp3" type="audio/mpeg"/></audio><audio id="snd30_14c9de12" preload="none"><source src="data/sound31.mp3" type="audio/mpeg"/></audio><audio id="snd31_14c9de12" preload="none"><source src="data/sound32.mp3" type="audio/mpeg"/></audio><audio id="snd32_14c9de12" preload="none"><source src="data/sound33.mp3" type="audio/mpeg"/></audio><audio id="snd33_14c9de12" preload="none"><source src="data/sound34.mp3" type="audio/mpeg"/></audio><audio id="snd34_14c9de12" preload="none"><source src="data/sound35.mp3" type="audio/mpeg"/></audio><audio id="snd35_14c9de12" preload="none"><source src="data/sound36.mp3" type="audio/mpeg"/></audio><audio id="snd36_14c9de12" preload="none"><source src="data/sound37.mp3" type="audio/mpeg"/></audio><audio id="snd37_14c9de12" preload="none"><source src="data/sound38.mp3" type="audio/mpeg"/></audio><audio id="snd38_14c9de12" preload="none"><source src="data/sound39.mp3" type="audio/mpeg"/></audio></div>
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