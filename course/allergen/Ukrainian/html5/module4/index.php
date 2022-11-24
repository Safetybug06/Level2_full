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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Allergen Awareness English Mod 3</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_37fb7555 {display:none;}</style>
    
    
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
			background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAKQ2lDQ1BJQ0MgcHJvZmlsZQAAeNqdU3dYk/cWPt/3ZQ9WQtjwsZdsgQAiI6wIyBBZohCSAGGEEBJAxYWIClYUFRGcSFXEgtUKSJ2I4qAouGdBiohai1VcOO4f3Ke1fXrv7e371/u855zn/M55zw+AERImkeaiagA5UoU8Otgfj09IxMm9gAIVSOAEIBDmy8JnBcUAAPADeXh+dLA//AGvbwACAHDVLiQSx+H/g7pQJlcAIJEA4CIS5wsBkFIAyC5UyBQAyBgAsFOzZAoAlAAAbHl8QiIAqg0A7PRJPgUA2KmT3BcA2KIcqQgAjQEAmShHJAJAuwBgVYFSLALAwgCgrEAiLgTArgGAWbYyRwKAvQUAdo5YkA9AYACAmUIszAAgOAIAQx4TzQMgTAOgMNK/4KlfcIW4SAEAwMuVzZdL0jMUuJXQGnfy8ODiIeLCbLFCYRcpEGYJ5CKcl5sjE0jnA0zODAAAGvnRwf44P5Dn5uTh5mbnbO/0xaL+a/BvIj4h8d/+vIwCBAAQTs/v2l/l5dYDcMcBsHW/a6lbANpWAGjf+V0z2wmgWgrQevmLeTj8QB6eoVDIPB0cCgsL7SViob0w44s+/zPhb+CLfvb8QB7+23rwAHGaQJmtwKOD/XFhbnauUo7nywRCMW735yP+x4V//Y4p0eI0sVwsFYrxWIm4UCJNx3m5UpFEIcmV4hLpfzLxH5b9CZN3DQCshk/ATrYHtctswH7uAQKLDljSdgBAfvMtjBoLkQAQZzQyefcAAJO/+Y9AKwEAzZek4wAAvOgYXKiUF0zGCAAARKCBKrBBBwzBFKzADpzBHbzAFwJhBkRADCTAPBBCBuSAHAqhGJZBGVTAOtgEtbADGqARmuEQtMExOA3n4BJcgetwFwZgGJ7CGLyGCQRByAgTYSE6iBFijtgizggXmY4EImFINJKApCDpiBRRIsXIcqQCqUJqkV1II/ItchQ5jVxA+pDbyCAyivyKvEcxlIGyUQPUAnVAuagfGorGoHPRdDQPXYCWomvRGrQePYC2oqfRS+h1dAB9io5jgNExDmaM2WFcjIdFYIlYGibHFmPlWDVWjzVjHVg3dhUbwJ5h7wgkAouAE+wIXoQQwmyCkJBHWExYQ6gl7CO0EroIVwmDhDHCJyKTqE+0JXoS+cR4YjqxkFhGrCbuIR4hniVeJw4TX5NIJA7JkuROCiElkDJJC0lrSNtILaRTpD7SEGmcTCbrkG3J3uQIsoCsIJeRt5APkE+S+8nD5LcUOsWI4kwJoiRSpJQSSjVlP+UEpZ8yQpmgqlHNqZ7UCKqIOp9aSW2gdlAvU4epEzR1miXNmxZDy6Qto9XQmmlnafdoL+l0ugndgx5Fl9CX0mvoB+nn6YP0dwwNhg2Dx0hiKBlrGXsZpxi3GS+ZTKYF05eZyFQw1zIbmWeYD5hvVVgq9ip8FZHKEpU6lVaVfpXnqlRVc1U/1XmqC1SrVQ+rXlZ9pkZVs1DjqQnUFqvVqR1Vu6k2rs5Sd1KPUM9RX6O+X/2C+mMNsoaFRqCGSKNUY7fGGY0hFsYyZfFYQtZyVgPrLGuYTWJbsvnsTHYF+xt2L3tMU0NzqmasZpFmneZxzQEOxrHg8DnZnErOIc4NznstAy0/LbHWaq1mrX6tN9p62r7aYu1y7Rbt69rvdXCdQJ0snfU6bTr3dQm6NrpRuoW623XP6j7TY+t56Qn1yvUO6d3RR/Vt9KP1F+rv1u/RHzcwNAg2kBlsMThj8MyQY+hrmGm40fCE4agRy2i6kcRoo9FJoye4Ju6HZ+M1eBc+ZqxvHGKsNN5l3Gs8YWJpMtukxKTF5L4pzZRrmma60bTTdMzMyCzcrNisyeyOOdWca55hvtm82/yNhaVFnMVKizaLx5balnzLBZZNlvesmFY+VnlW9VbXrEnWXOss623WV2xQG1ebDJs6m8u2qK2brcR2m23fFOIUjynSKfVTbtox7PzsCuya7AbtOfZh9iX2bfbPHcwcEh3WO3Q7fHJ0dcx2bHC866ThNMOpxKnD6VdnG2ehc53zNRemS5DLEpd2lxdTbaeKp26fesuV5RruutK10/Wjm7ub3K3ZbdTdzD3Ffav7TS6bG8ldwz3vQfTw91jicczjnaebp8LzkOcvXnZeWV77vR5Ps5wmntYwbcjbxFvgvct7YDo+PWX6zukDPsY+Ap96n4e+pr4i3z2+I37Wfpl+B/ye+zv6y/2P+L/hefIW8U4FYAHBAeUBvYEagbMDawMfBJkEpQc1BY0FuwYvDD4VQgwJDVkfcpNvwBfyG/ljM9xnLJrRFcoInRVaG/owzCZMHtYRjobPCN8Qfm+m+UzpzLYIiOBHbIi4H2kZmRf5fRQpKjKqLupRtFN0cXT3LNas5Fn7Z72O8Y+pjLk722q2cnZnrGpsUmxj7Ju4gLiquIF4h/hF8ZcSdBMkCe2J5MTYxD2J43MC52yaM5zkmlSWdGOu5dyiuRfm6c7Lnnc8WTVZkHw4hZgSl7I/5YMgQlAvGE/lp25NHRPyhJuFT0W+oo2iUbG3uEo8kuadVpX2ON07fUP6aIZPRnXGMwlPUit5kRmSuSPzTVZE1t6sz9lx2S05lJyUnKNSDWmWtCvXMLcot09mKyuTDeR55m3KG5OHyvfkI/lz89sVbIVM0aO0Uq5QDhZML6greFsYW3i4SL1IWtQz32b+6vkjC4IWfL2QsFC4sLPYuHhZ8eAiv0W7FiOLUxd3LjFdUrpkeGnw0n3LaMuylv1Q4lhSVfJqedzyjlKD0qWlQyuCVzSVqZTJy26u9Fq5YxVhlWRV72qX1VtWfyoXlV+scKyorviwRrjm4ldOX9V89Xlt2treSrfK7etI66Trbqz3Wb+vSr1qQdXQhvANrRvxjeUbX21K3nShemr1js20zcrNAzVhNe1bzLas2/KhNqP2ep1/XctW/a2rt77ZJtrWv913e/MOgx0VO97vlOy8tSt4V2u9RX31btLugt2PGmIbur/mft24R3dPxZ6Pe6V7B/ZF7+tqdG9s3K+/v7IJbVI2jR5IOnDlm4Bv2pvtmne1cFoqDsJB5cEn36Z8e+NQ6KHOw9zDzd+Zf7f1COtIeSvSOr91rC2jbaA9ob3v6IyjnR1eHUe+t/9+7zHjY3XHNY9XnqCdKD3x+eSCk+OnZKeenU4/PdSZ3Hn3TPyZa11RXb1nQ8+ePxd07ky3X/fJ897nj13wvHD0Ivdi2yW3S609rj1HfnD94UivW2/rZffL7Vc8rnT0Tes70e/Tf/pqwNVz1/jXLl2feb3vxuwbt24m3Ry4Jbr1+Hb27Rd3Cu5M3F16j3iv/L7a/eoH+g/qf7T+sWXAbeD4YMBgz8NZD+8OCYee/pT/04fh0kfMR9UjRiONj50fHxsNGr3yZM6T4aeypxPPyn5W/3nrc6vn3/3i+0vPWPzY8Av5i8+/rnmp83Lvq6mvOscjxx+8znk98ab8rc7bfe+477rfx70fmSj8QP5Q89H6Y8en0E/3Pud8/vwv94Tz+4A5JREAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAADcmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMwNjcgNzkuMTU3NzQ3LCAyMDE1LzAzLzMwLTIzOjQwOjQyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOmFjOGVjNDFhLTZkYWItODQ0Ni04YzkzLWU1Mjk3N2YwMmE4NSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFRThCNzU3NDYzNjcxMUU1QTZDRUE5NTVGOUJGQ0E3MCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFRThCNzU3MzYzNjcxMUU1QTZDRUE5NTVGOUJGQ0E3MCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNSAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0OWFlZmI1OC00ZWFmLWQ3NDgtYTI0ZS0zNmNhNGQ2M2QwNTYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6N0MwQkFBM0M2MjAxMTFFNUI4QjBERTk4MjY5MjQwQjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6MGSVVAAAE3klEQVR42uycW4hWVRiG15Q4eYzGQySSQlriEQ9BF2mE4iSdESRRIb0RD+mNmHgICjqQEGUe6sqgCy1i0iRinAzELrooQhHLGQURUTzMiM7omCLj+/F/czX/t/890z6s9e/3hZcZ1l6z19r7mXXca62arq4uR/mjh/gKCIQiEAKhCIRAKAIhEIpACIQiEIpACIQiEAKhCIRAKAIhEMoX9Yu62NbWxjcUobq6OpaQQpcQz/QwPBOeDU+Fx8Oj4UfhoRrnJnwDvgC3wCfgY/Bf8P0QHrImahmQB1VWLfwGvAieqy+/LxJIR+Dv4QPwf75WWb4CGQavg9fo70mqFd4F79DfCSRCA+HN8Hp4cMppdcBfwB/Bt9mo99Sr8Cl4SwYwnKYhaf2jaXMconoE/hL+CR6TQ/pPato7NS+FbtSfgH+Gp8eMfwv+HT6qpakZvqzVT/d//ePw0/BEeI72ygbFvP/f8MvwpSK2IfLSGuGxFeJ1aby98CG4s5fpDNAqaTlcL89cIf45jddcpDZknI4PKsFo0NKzQLusnX1Iq1P/doHe60CF+GM1b+OK0obIYO5XeGREnLPwfHghfDzBtOVeb+q9z0bEG6njltHVDqQ2RuP9HTwDbkoxH02axv4YjX1tNQP5LKIBl7ZiK/yWToGkLUljsaZpNaTTNc9VCeR1eHUEjHfgD3OoQiXNVRFQVmveqwrIEHh3xPXNOp2Rl77WPFiSvA+tJiCb4FHGNanHP/FggCp52Gdck7y/Wy0Dw2Hatx9s9KZmZNRmxC3JMjh8qsy1Du0St4Y+DomaKFzlEQxRu+apnOQZ1oVeZfWPeMCGlLu2/6dL3BDRwPcPGYiMjocbvaoPnL963+h1DddnChbIMiP8cMIj8KQln34be/lM3gOREW69cW2v81/fGOH1aY7e0wTyrNGYyxT6wQCAHNS8lmvcZ4UIZL4RLt8z7gQA5I7mtZyeCxHIS0b4UReOrLw+EyIQqxScDAiIldcJIQLZYTTmvwUEpMUIHxMikB/gta40PXIF/lwHVrcCAnLVCH8srQR9X7mYt2RUbq1yrOFia390N9SReugaYoR3EEg+GmGEtxNIPhpvhJ8nkHw02Qj/l0Dy0Rwj/DSBZC9ZeD3buPYHgWSv11z5RdrSw/qTQLLX20Z4o0toSxyBxJdsKrVmq79NM2ECKa/3XPltC9fgXwgkW81zpVX35fSVS3HahEB6SqZK9hjXujeJOgLJTrLG19qos1OrLALJSLL+eLFx7SL8cRaZIJCSVrrSfnVL8qHtJoFkoy3ablibQeWz849ZZaZfgUHIfg/Z97EkIs5xLR2OQNLv2u5x0Ttt5UShV1wfj91glRVP01xp8UVTBRiyuOFFheJYQpKVzNrKwQErXPyDA2SF+5k8MhsykCnwPdfzaA3ZYy6nREyCX4Cfd/EPs+nV0RoEUlqWsx1eCie9Bkc2nW5wOa87Dg3Ipy75bWXntSd1yIcHDK1RT3KzTIcOBif6AqOo3d42HX/I0tZW3zIXWgnp68chmfaQjZxyoKac0bXNRxghlpCN2m1dpj/btXEfpD0uqYaua89Luq3dx8TKN3AeE1vt4mLrAohACIQiEAKhCIRAKAIhEIpACq7IqROKJYRA+AoIhCIQAqEIhEAoAiEQikCKrQcCDABHPgH2w7NQdAAAAABJRU5ErkJggg==);
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
	<script src="data/browsersupport.js?5ADF6B27"></script>
	<script src="data/player.js?5ADF6B27"></script>
    <div id="content"></div>
    <div id="spr0_37fb7555"><audio id="snd0_37fb7555" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_37fb7555" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_37fb7555" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_37fb7555" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_37fb7555" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_37fb7555" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_37fb7555" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_37fb7555" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_37fb7555" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_37fb7555" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_37fb7555" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_37fb7555" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_37fb7555" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_37fb7555" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio></div>
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