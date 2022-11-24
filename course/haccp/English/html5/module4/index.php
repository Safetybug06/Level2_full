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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Haccp module 4</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_33f554fd {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?5B0BB962"></script>
	<script src="data/player.js?5B0BB962"></script>
    <div id="content"></div>
    <div id="spr0_33f554fd"><audio id="snd0_33f554fd" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_33f554fd" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_33f554fd" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_33f554fd" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_33f554fd" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_33f554fd" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_33f554fd" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_33f554fd" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_33f554fd" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_33f554fd" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_33f554fd" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_33f554fd" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_33f554fd" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_33f554fd" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_33f554fd" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio></div>
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