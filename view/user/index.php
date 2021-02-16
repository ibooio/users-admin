<!DOCTYPE html>
<html>
    <head>
        <title>Administrador de usuarios</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/app.css")?>" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <header><div>Bienvenido/a <?php echo $this->user ?></div><div><a href="<?php echo base_url('home/logout')?>">Salir</a></div></header>
        <div class="container">
            <div class="title">Admin de usuarios</div>
            
            <div>
                <div class="btn add green">Añadir</div>
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
        <?php require_once 'view/user/messages.php'; ?>
        <script src="<?php echo base_url("assets/js/app.js")?>"></script>
    </body>
</html>
