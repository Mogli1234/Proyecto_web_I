<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Bootstrap core CSS -->


    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/icheck/flat/green.css" rel="stylesheet">
    <link href="/css/floatexamples.css" rel="stylesheet" />


    <script src="/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background:#F7F7F7;">

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <form  class="form-horizontal" role="form" method="POST" action="/auth/register">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h1>Register Form</h1>
                    <div>
                        <label>Nombre Completo</label>
                        <input type="text" class="form-control required" name="name"/>
                    </div>
                    <div>
                        <label>Correo Electronico</label>
                        <input type="email" class="form-control required" placeholder="example@gmail.com" name="email">
                    </div>
                    <div>
                        <label>Contraseña</label>
                        <input type="password" class="form-control required" name="password">
                    </div>
                    <div>
                        <label>Confirmar Contraseña</label>
                        <input type="password" class="form-control required" name="password_confirmation">
                    </div>

                    <div>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-default">Register</button>
                        <a href="login"><input type="button" class="btn btn-default" value="Cancel"></a>
                    </div>
                    <div class="clearfix"></div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>

    </div>
</div>

</body>

</html>
