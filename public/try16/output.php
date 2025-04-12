<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
<script>
  window.addEventListener("load", loadparam, false);
  function loadparam(){
    const params = new URLSearchParams(window.location.search);
    const title = document.getElementById("titlep");
    title.innerHTML = params.get('inputtext');
  }
</script>
  <body class="cyberpunk-bg">
    <div class="login-box">
    <h1 id="titlep"></h1>
<table style="width: 100%;border:1px black solid" id="tbl">
<tr>
	<td style="border: 3px solid #b3ebff;text-align:center">データ</td>
</tr>
<script>
const params = new URLSearchParams(window.location.search);
for(let i = 1; i <= 5; i++){
	if(params.get('data' + i)){
		document.write("<tr><td style=\"border: 3px solid #b3ebff;padding:5px\">" 
                     + params.get('data' + i) + "</td></tr>");
	}
}
</script>
</table>
    </div>
  </body>
</html>
