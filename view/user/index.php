<!DOCTYPE html>
<html>
    <head>
        <title>Administrador de usuarios</title>
        <link rel="stylesheet" href="assets/css/app.css" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="title">Admin de usuarios</div>
            <div>
                <div class="btn add">Añadir</div>
                <table id="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                <!-- <?php 
                        foreach($this->model->get_all() as $r){
                    ?>
                        <tr data-id="<?php echo $r->id ?>">
                            <td><?php echo $r->name ?></td>
                            <td><?php echo $r->last_name ?></td>
                            <td>
                                <div class="btn edit">Editar</div>
                                <div class="btn delete">Eliminar</div>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>  -->              
                    </tbody>
                </table>
            </div>
        </div>
        <?php require_once 'view/user/edit.php'; ?>
        <script src="assets/js/app.js"></script>
    </body>
</html>
