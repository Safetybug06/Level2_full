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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Allergen Awareness Module 2 part 2</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#b2c4b2;}#spr0_38e1c710 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?441B473E"></script>
	<script src="data/player.js?441B473E"></script>
    <div id="content"></div>
    <div id="spr0_38e1c710"><audio id="snd0_38e1c710" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_38e1c710" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_38e1c710" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_38e1c710" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_38e1c710" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_38e1c710" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_38e1c710" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_38e1c710" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_38e1c710" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_38e1c710" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_38e1c710" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_38e1c710" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_38e1c710" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_38e1c710" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_38e1c710" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_38e1c710" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_38e1c710" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_38e1c710" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_38e1c710" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_38e1c710" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio></div>
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