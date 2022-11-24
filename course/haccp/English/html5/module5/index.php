<?php
session_start();


if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>

<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 664 --><!--version 9.7.5.15043 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#b2c4b2;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Haccp module 5</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_2f4a13c3 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?8FDECDAD"></script>
	<script src="data/player.js?8FDECDAD"></script>
    <div id="content"></div>
    <div id="spr0_2f4a13c3"><audio id="snd0_2f4a13c3" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_2f4a13c3" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_2f4a13c3" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_2f4a13c3" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_2f4a13c3" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_2f4a13c3" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_2f4a13c3" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_2f4a13c3" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_2f4a13c3" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_2f4a13c3" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_2f4a13c3" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_2f4a13c3" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_2f4a13c3" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio></div>
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