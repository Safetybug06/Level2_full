<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 664 --><!--version 10.2.3.9011 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#8a8a8a;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 2 Polish</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_f852434 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?93C634E4"></script>
	<script src="data/player.js?93C634E4"></script>
    <div id="content"></div>
    <div id="spr0_f852434"><audio id="snd0_f852434" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_f852434" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_f852434" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_f852434" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_f852434" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_f852434" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_f852434" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_f852434" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_f852434" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_f852434" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_f852434" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_f852434" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_f852434" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_f852434" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_f852434" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_f852434" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_f852434" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio></div>
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