<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Lista de Registros</h2>
        <a class="btn btn-primary" href="/expo/create.php" role="button">Nuevo Registro</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Direccion</th>
                    <th>Fecha</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $server = "localhost";
                $username = "root";
                $password = "";
                $database = "exposicion";

                $connection = new mysqli($server, $username, $password, $database);

                if ($connection->connect_error){
                    die("Conexion fallida: " . $connection->connect_error);
                }

                $sql="SELECT * FROM exposicion";
                $result=$connection->query($sql);

                if (!$result) {
                    die("Invalido: " . $connection->error);
                }

                while($row=$result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[nombre]</td>
                        <td>$row[email]</td>
                        <td>$row[celular]</td>
                        <td>$row[direccion]</td>
                        <td>$row[fecha]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/expo/edit.php?id=$row[id]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='/expo/delete.php?id=$row[id]'>Eliminar</a>
                        </td>
                    </tr>
                    ";
                }

                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>