<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/app.css")?>" type="text/css">
    </head>
    <body class="home">
        <div id="form-login-box">
        
            <form action="" method="post" autocomplete="off">
                <div><?php echo $this->error_message ;?></div>
                <label>E-mail</label>
                <input type="email" name="email" value="" placeholder="E-mail" required>
                <label>Contraseña</label>
                <input type="password" name="password" value="" placeholder="Contraseña" required>
                <input type="submit" class="btn green" value="ENTRAR">
            </form>
        </div>
    </body>
</html>
