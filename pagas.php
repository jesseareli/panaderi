<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "panaderia";

// Conexión a la base de datos
$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panadería Marcianas - Pago</title>
  <link rel="stylesheet" href="estyle.css">
</head>
<body>
  <h1>Panadería Marcianas - Detalles de Pago</h1>
  <div class="container">
    <form id="paymentForm" method="POST">
      <h2>Información del Cliente</h2>
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required>
      </div>
      <div class="form-group">
        <label for="domicilio">Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio" required>
      </div>
      <div class="form-group">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
      </div>
      <div class="form-group">
        <label for="codigopostal">Código Postal:</label>
        <input type="text" id="codigopostal" name="codigopostal" required>
      </div>
      <div class="form-group">
        <label for="colonia">Colonia:</label>
        <input type="text" id="colonia" name="colonia" required>
      </div>
      <div class="form-group">
        <label for="calle">Calle:</label>
        <input type="text" id="calle" name="calle" required>
      </div>

      <h2>Detalles de Pago</h2>
      <div class="form-group">
        <label for="titular">Titular de la Tarjeta:</label>
        <input type="text" id="titular" name="titular" required>
      </div>
      <div class="form-group">
        <label for="cvv">CVV:</label>
        <input type="password" id="cvv" name="cvv" maxlength="3" required>
      </div>
      <div class="form-group">
        <label for="monto">Monto Total:</label>
        <input type="text" id="monto" name="monto" readonly>
      </div>
      <input type="hidden" id="orderDetails" name="orderDetails">
      <button type="submit" name="enviar" class="purchase-button" onclick="window.location.href='confirmacionn.html'">Pagar</button>
    </form>
  </div>

  <script>
    // Recupera los detalles de la orden desde localStorage
    const orderDetails = JSON.parse(localStorage.getItem('orderDetails'));

    if (!orderDetails) {
      alert('No hay detalles de la compra. Regresa al carrito.');
      window.location.href = 'menu.html'; // Redirigir al carrito si no hay detalles
    } else {
      // Mostrar el monto total y detalles de la orden
      document.getElementById('monto').value = `$${orderDetails.total.toFixed(2)}`;
      document.getElementById('orderDetails').value = JSON.stringify(orderDetails);
    }

    // Validación adicional opcional antes de enviar el formulario
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
      const nombre = document.getElementById('nombre').value.trim();
      const apellido = document.getElementById('apellido').value.trim();

      if (!nombre || !apellido) {
        event.preventDefault();
        alert('Por favor, completa todos los campos requeridos.');
          // Redirigir a la página de pago
        window.location.href = 'confirmacionn.html';
      }
    });
  </script>
</body>
</html>
<?php
if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];
    $correo = $_POST['correo'];
    $codigopostal = $_POST['codigopostal'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $titular = $_POST['titular'];
    $monto = $_POST['monto'];

    $insertar = "INSERT INTO venta VALUES('','$nombre', '$apellido', '$telefono', '$domicilio', '$correo', '$codigopostal', '$colonia', '$calle', '$titular', '$monto')";

    $ejecutar = mysqli_query($enlace, $insertar);

  
}
?>
  