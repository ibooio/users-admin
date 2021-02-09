<!DOCTYPE html>
<html>
    <head>
        <title>Administrador de usuarios</title>
        <link rel="stylesheet" href="assets/css/app.css" type="text/css">
    </head>
    <body>
        <div>Admin de usuarios</div>
        <?php 
            foreach($this->model->get_all() as $r): 
                echo $r.'<br>';    
            endforeach;
        ?>
        <script src="assets/js/app.js"></script>
    </body>
</html>
