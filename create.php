<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "exposicion";

$connection = new mysqli($server, $username, $password, $database);

$nombre = "";
$email = "";
$celular = "";
$direccion = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $celular = $_POST["celular"];
    $direccion = $_POST["direccion"];

    do {
        if ( empty($nombre) || empty($email) || empty($celular) || empty($direccion) ){
            $errorMessage = "Todos los campos requeridos";
            break;
        }

        $sql="INSERT INTO exposicion (nombre, email, celular, direccion) ". 
             "VALUES ('$nombre', '$email', '$celular', '$direccion')";
        $result=$connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalido: " . $connection->error;
            break;
        }

        $nombre = "";
        $email = "";
        $celular = "";
        $direccion = "";

        $successMessage = "Registrado Correctamente";

        header("location: /expo/index.php");
        exit;

    } while(false);

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nuevo Registro</h2>

        <?php
        if ( !empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Celular</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="celular" value="<?php echo $celular; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Direccion</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="direccion" value="<?php echo $direccion; ?>">
                </div>
            </div>

            <?php
            if ( !empty($successMessage)) {
                echo "
                <div> class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/expo/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>