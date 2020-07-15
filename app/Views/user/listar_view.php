<?php echo view('templates/header'); ?>
<a href="<?php echo base_url('/user/new'); ?>" class="btn btn-primary">Nuevo Usuario</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>USUARIO</th>
        <th>EMAIL</th>
        <th>FECHA REGISTRO</th>
        <th>OPCIONES</th>
    </tr>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->created_at; ?></td>
            <td>
                <a href="<?php echo site_url('user/edit/' . $user->id); ?>" 
                   class="btn btn-success btn-sm"
                   title="Editar">
                   <span class="fa fa-pencil"></span>
                </a>
                <a href="<?php echo site_url('user/delete/' . $user->id); ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="eliminarRegistro(event, this.href)"
                   title="Eliminar">
                   <span class="fa fa-trash"></span>
                </a>
            </td>
        </tr>
    <?php } ?>
</table>
<script>
    function eliminarRegistro(event, url){
        event.preventDefault();
        if(confirm("Esta seguro de eliminar el registro?")){
            window.location.href = url;
        }
    }
</script>
<?php echo view('templates/footer'); ?>