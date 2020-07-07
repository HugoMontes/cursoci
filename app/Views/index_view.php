<?php echo view('templates/header'); ?>
    <a href="<?php echo site_url('hola/ruta');?>">
        1. Hola desde Route.php con get
    </a><br/>
    <a href="<?php echo site_url('hola/ruta/add');?>">
        2. Hola desde Route.php con add
    </a><br/>
    <a href="<?php echo site_url('/hola/controlador');?>">
        3. Hola desde Hola_controller.php
    </a><br/>
    <a href="<?php echo site_url('/hola/parametros/Alex/16');?>">
        4. Paso de parametros
    </a><br/>
<?php echo view('templates/footer'); ?>