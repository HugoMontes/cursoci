<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>LISTA DE PERSONAS</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>EDAD</th>
        </tr>
        <?php foreach($personas as $p){ ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['nombre']; ?></td>
            <td><?php echo $p['edad']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>