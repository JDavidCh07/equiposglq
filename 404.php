<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Página no encontrada - GALQUI SAS</title>
        <link rel="icon" href="img/logo.png">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	    <script type="text/javascript" src="js/bootstrap.js"></script>

    </head>
    <body>
        <div class="contenedor-login">
            <div class="contenido-login">
    	        <div class="row">
                    <div class="img form-group col-md-4">
                        <img class="imgerr" src="img/404.jpg" alt="">
                    </div>
                    <div class="text form-group col-md-8">
                        <h1><strong></strong>Ooops... Error 404</strong></h1>
                        <h3>Lo sentimos, pero la página que busca no existe.</h3>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
	body {
		background-color: #f7f2ef;
	}
	.contenido-login {
        background-color: rgba(255, 255, 255);
        padding: 40px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        box-shadow: 6px 10px 20px 0 rgba(0, 0, 0, 0.4);
        margin: 0 auto;
        position: relative;
        width: 90%;
	}
    
	.contenedor-login {
        display: flex;
		margin: auto;
		align-items: center;
		justify-content: center;
        margin-top: 80px;
	}

    .img{
        text-align: center;
        padding: 10px;
    }
    
    .imgerr{
        width: 100%;
    }
    
    .text{
        padding: 10px 20px;
        display: flex;
        align-items: flex-start;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
    }

    h1{
        color: #073663;
        display: inline;
    }

    @media screen and (max-width: 767px) {
        .text {
            text-align: center;
            display: inline-block;
        }

        .imgerr{
        width: 80%;
    }
    }
</style>