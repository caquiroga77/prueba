<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">

<div class="span10 offset1">
<div class="row">
<h3>Crear un cliente</h3>
</div>

<form class="form-horizontal" action="create.php" method="post">
<div class="form-group <?php echo !empty($nameError)?'has-error':'';?>">
<label class="control-label">nombre</label>
<div class="controls">
<input name="name" type="text" placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
<?php if (!empty($nameError)): ?>
<span class="help-inline"><?php echo   $nameError;?></span>
<?php endif; ?>
</div>
</div>
<div class="form-group <?php echo !empty($emailError)?'has-error':'';?>">
<label class="control-label">email</label>
<div class="controls">
<input name="email" type="text" placeholder="Correo Electrónico" value="<?php echo !empty($email)?$email:'';?>">
<?php if (!empty($emailError)): ?>
<span class="help-inline"><?php echo   $emailError;?></span>
<?php endif;?>
</div>
</div>
<div class="form-group <?php echo !empty($mobileError)?'has-error':'';?>">
<label class="control-label">celular</label>
<div class="controls">
<input name="mobile" type="text" placeholder="Mobilnummer" value="<?php echo !empty($mobile)?$mobile:'';?>">
<?php if (!empty($mobileError)): ?>
<span class="help-inline"><?php echo $mobileError;?></span>
<?php endif;?>
</div>
</div>
<div class="form-actions">
<button type="submit" class="btn btn-success">Create</button>
<a class="btn" href="index.php">Back</a>
</div>
</form>
</div>

</div> <!-- /container -->
</body>
</html>

<?php

require 'database.php';

if ( !empty($_POST)) {
// Detectar errores de validación
$nameError = null;
$emailError = null;
$mobileError = null;

// Capturar valores de entrada
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

// Validar entrada
$valid = true;
if (empty($name)) {
$nameError = Por favor, introduce tu nombre';
$valid = false;
}

if (empty($email)) {
$emailError = 'Por favor, introduce una dirección de correo electrónico';
$valid = false;
} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
$emailError = 'Por favor, introduce una dirección de correo electrónico';
$valid = false;
}

if (empty($mobile)) {
$mobileError = 'Por favor, introduce tu número de móvil';
$valid = false;
}

// Daten eingeben
if ($valid) {
     $pdo = Database::connect();
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
     $q = $pdo->prepare($sql);
     $q->execute(array($name,$email,$mobile));
     Database::disconnect();
     header("Location: index.php");
}
      }
?>
