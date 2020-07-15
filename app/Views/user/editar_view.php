<?php echo view('templates/header'); ?>
<?php $errors = \Config\Services::validation()->getErrors(); ?>
<?php if($errors){ ?>
<div class="alert alert-danger" role="alert">
    <ul>
    <?php foreach ($errors as $error) : ?>
        <li><?= esc($error) ?></li>
    <?php endforeach ?>
    </ul>
</div>
<?php } ?>

<?php echo form_open('/user/update'); ?>
<?php echo form_hidden('id', $user->id); ?>
<div class="form-group">
    <?php echo form_label('Nombre de usuario:', 'txtUsername'); ?>
    <?php echo form_input(array(
        'id' => 'txtUsername',
        'name' => 'username',
        'value' => set_value('username', $user->username),
        'placeholder' => 'Ingrese el nombre de usuario',
        'class' => 'form-control'
    )); ?>
</div>
<div class="form-group">
    <?php echo form_label('Correo electronico:', 'txtEmail'); ?>
    <?php echo form_input(array(
        'id' => 'txtEmail',
        'name' => 'email',
        'value' => set_value('email', $user->email),
        'placeholder' => 'ejemplo@gmail.com',
        'class' => 'form-control'
    )); ?>
</div>
<?php echo form_submit(array('value'=>'Guardar',
                             'class'=>'btn btn-primary')); ?>
<?php echo form_close(); ?>
<?php echo view('templates/footer'); ?>