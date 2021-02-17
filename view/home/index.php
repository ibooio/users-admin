<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="shortcut icon" href="<?php echo base_url("assets/favicon.ico")?>" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/app.css")?>" type="text/css">
    </head>
    <body class="home">
        <div id="form-login-box">
            <form action="" method="post" autocomplete="off">
                <div class="title">Inicio de sesión</div>
                <div class="error"><?php echo $this->error_message ;?></div>
                <label>E-mail</label>
                <input type="email" name="email" value="" placeholder="E-mail" required>
                <label>Contraseña</label>
                <input type="password" name="password" value="" placeholder="Contraseña" required>
                <input type="submit" class="btn green" value="ENTRAR">
            </form>
        </div>
        <footer><a href="https://github.com/ibooio/users-admin" target="_blank">GitHub</a></footer>
    </body>
</html>
