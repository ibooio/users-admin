<!DOCTYPE html>
<html>
    <head>
        <title>Administrador de usuarios</title>
        <link rel="stylesheet" href="assets/css/app.css" type="text/css">
    </head>
    <body>
        <div>Admin de usuarios</div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($this->model->get_all() as $r){
            ?>
                <tr data-id="<?php echo $r->id ?>">
                    <td><?php echo $r->name ?></td>
                    <td><?php echo $r->last_name ?></td>
                    <td><div>Editar</div><div>Eliminar</div></td>
                </tr>
            <?php
                }
            ?>                
            </tbody>
        </table>

        <?php require_once 'view/user/edit.php'; ?>
        <script src="assets/js/app.js"></script>
    </body>
</html>
