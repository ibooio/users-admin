<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/app.css")?>" type="text/css">
    </head>
    <body class="home">
        <div id="form-login-box">
        <?php echo $this->error_message ;?>
            <form action="" method="post">
                <label>E-mail</label>
                <input type="text" name="email" value="" placeholder="E-mail">
                <label>Contraseña</label>
                <input type="text" name="password" value="" placeholder="Contraseña">
                <input type="submit" class="btn green" value="ENTRAR">
            </form>
        </div>
    </body>
</html>
