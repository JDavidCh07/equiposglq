<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>GALQUI SAS</title>
        <link rel="icon" href="../img/logo.png">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	    <script type="text/javascript" src="../js/bootstrap.js"></script>

    </head>
    <body>
        <div class="contenedor">
            <span class="char1">G</span>
            <span class="char2">A</span>
            <span class="char3">L</span>
            <span class="char4">Q</span>
            <span class="char5">U</span>
            <span class="char6">I</span>
        </div>

        <div class="carga">
            <div class="barra"></div>
        </div>
    </body>
</html>

<style>
    body {
        font-size: 4em;
        display: block;
        background-color: #f7f2ef;
        font-weight: bold;
    }

    .contenedor{
        margin: 350px auto 100PX auto;
        padding: 0;
        text-align: center;
        display: block;
        width: 100%;
    }

/** CARGANDO **/
@keyframes chars{
    0%{
        color: rgba(7,54,99);
    }
    
    25%{
        color: rgba(7,54,99,.25);
    }
    
    50%{
        color: rgba(7,54,99,.50);
    }
    
    75%{
        color: rgba(7,54,99,.75);
    }
    
    100%{
        color: rgba(7,54,99,0);
    }
}

.char1 {
    color: rgb(7,54,99);
    animation: chars 3s infinite linear;
}

.char2 {
    color: rgb(7,54,99);
    animation: chars 3s infinite linear;
    animation-delay: 0.1s;
}

.char3 {
    color: rgb(7,54,99);
    animation: chars 3s infinite linear;
    animation-delay: 0.4s;
}

.char4 {
    color: rgb(7,54,99);
    animation: chars 3s infinite linear;
    animation-delay: 0.6s;
}

.char5 {
    color: rgb(7,54,99);
    animation: chars 3s infinite linear;
    animation-delay: 0.8s;
}

.char6 {
    color: rgb(7,54,99);
    animation: chars 3s infinite linear;
    animation-delay: 1s;
}

/****/

.carga {
    width: 40%;
    height: 25px;
    margin: 0 auto;
    background-color: rgba(7,54,99);
    border: 4px solid rgba(7,54,99);
}

.barra {
    animation: animacion 2s infinite ease-in-out;
    background-color: #f7f2ef;
}

@keyframes animacion {
    0% {
        width: 0%;
        height: 100%;
    }
    100% {
        width: 100%;
        height: 100%;
    }
}

@media screen and (min-width: 451px) and (max-width: 1280px){
    .contenedor{
        margin: 175px auto 50PX auto;
    }
}

@media screen and (max-width: 450px) {
    body {
        font-size: 2.5em;
    }
    .contenedor{
        width: 80%;
        margin: 275px auto 50PX auto;
    }

    .carga {
        width: 70%;
    }
}
</style>

<?php echo "<script>setTimeout(function(){ window.location.href = '../pmod.php'; }, 1950);</script>";?>
