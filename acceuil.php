
<!DOCTYPE html>
<head>
  <title>INSEA Inscription </title>
  <meta charset="utf-8">
  <link rel="icon" href="images/inseainsc.png">
  <meta name="viewport" content="width=device-width", initial-scale="1">
</head>

<!-- Fonction du bot d'assisstance -->
<script>
"use strict";

!function() {
  var t = window.driftt = window.drift = window.driftt || [];
  if (!t.init) {
    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
    t.factory = function(e) {
      return function() {
        var n = Array.prototype.slice.call(arguments);
        return n.unshift(e), t.push(n), t;
      };
    }, t.methods.forEach(function(e) {
      t[e] = t.factory(e);
    }), t.load = function(t) {
      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
      var i = document.getElementsByTagName("script")[0];
      i.parentNode.insertBefore(o, i);
    };
  }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('s7zn8z4r9gy2');
</script>
<!-- Fin de la fct -->

<style>

body {
    background-image: url("./images/bg-vf.jpg");
    font-family: Helvetica;
    text-align: center;

}

.message{
    margin: 70px auto;
    padding: 25px;
    background: #fff;
    color:grey;
    border-radius: 5px;
    width: 30%;
    animation: hide 0.3s linear 3s 1 forwards;
}
@keyframes hide {
    to {
        opacity: 0;
    }
}
.outer {
    text-align: center;
    display: table;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}

.middle {
    display: table-cell;
    vertical-align: middle;
    color: white;
    text-shadow: 1px 1px #000000;
}
h1 {
    font-size: 150px;
    margin: 0;
}
p {
}

.inputs {
    position: relative;
    left: 42.5%;
    margin: 2px;
    cursor: pointer;
    padding: 9px 12px;
    background-color: Transparent;
    border: 2px solid white;
    border-radius: 7px;
    font-size: 14px;
    color: white;
}
.btn {
    background-color: #599bb3;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    color: #ffffff;
    font-size: 15px;
    font-weight: bold;
    padding: 8px 19px;
}


</style>
</head>

<body>

<div class="outer">
  <div class="middle">
      <h1>INSEA</h1>
      <p> L'école d'exellence</p>
      <button type="button" class="btn" onclick="location. href='http://www.insea.ac.ma/';">Voir plus</button>

  </div>
</div>



<input class= "inputs" type="button" onclick="location.href='index-inscription.php';" value="S'inscrire"/>	
<input class= "inputs"  type="button" onclick="location.href='login.php';" value="s'identifier"/>	

<?php
if(isset($_GET["message"])){
    $message=$_GET["message"];
    echo "<div class='message'>".$message."</div>"; 
}

?>

</body>

</html>