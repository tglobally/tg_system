<!DOCTYPE html>
<html>

<head>
  <title>SEPROK - SCI </title>
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <link rel="stylesheet" type="text/css" href="assets/css/splash.css">

  <meta name="theme-color" content="#f3f2f2" />
  <script src="assets/js/splash.js"></script>
  <script src="assets/js/notification.js"></script>


</head>

<body onload="splash()">
  <div id="loader"></div>

  <div aria-live="polite" aria-atomic="true" style="position: absolut;">
    <div class="toast" style="position: absolute; top: 0; right: 0; background:#f3f2f2;border:none; box-shadow: 0px 0px 0px 0px;" data-autohide="false">
      <button type="submit" class="notification">Por favor, habilite las notificaciones.</button>
    </div>
  </div>

  <div class="session" div style="display:none;" id="login">
    <div class="left">
      <img src="img/logo_login.png" width="140"><br>
    </div>
    <form class="form-signin" method="post" action="./index.php?seccion=adm_session&accion=loguea">
      <h4><span>Bienvenido</span></h4>
      <p>Sistema de Control Inmobiliario.</p>
      <div class="floating-label">
        <input placeholder="Usuario" name="user" id="username" autocomplete="off">
        <label for="username">Usuario:</label>
        <div class="icon">
          <svg enable-background="new 0 0 100 100" version="1.1" viewBox="0 0 100 100" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
            <g transform="translate(0 -952.36)">
              <path d="m17.5 977c-1.3 0-2.4 1.1-2.4 2.4v45.9c0 1.3 1.1 2.4 2.4 2.4h64.9c1.3 0 2.4-1.1 2.4-2.4v-45.9c0-1.3-1.1-2.4-2.4-2.4h-64.9zm2.4 4.8h60.2v1.2l-30.1 22-30.1-22v-1.2zm0 7l28.7 21c0.8 0.6 2 0.6 2.8 0l28.7-21v34.1h-60.2v-34.1z" />
            </g>
            <rect class="st0" width="100" height="100" />
          </svg>

        </div>
      </div>
      <div class="floating-label">
        <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off">
        <label for="password">Contraseña:</label>
        <div class="icon">
          <svg enable-background="new 0 0 24 24" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
            <style type="text/css">

            </style>
            <rect class="st0" width="24" height="24" />
            <path class="st1" d="M19,21H5V9h14V21z M6,20h12V10H6V20z" />
            <path class="st1" d="M16.5,10h-1V7c0-1.9-1.6-3.5-3.5-3.5S8.5,5.1,8.5,7v3h-1V7c0-2.5,2-4.5,4.5-4.5s4.5,2,4.5,4.5V10z" />
            <path class="st1" d="m12 16.5c-0.8 0-1.5-0.7-1.5-1.5s0.7-1.5 1.5-1.5 1.5 0.7 1.5 1.5-0.7 1.5-1.5 1.5zm0-2c-0.3 0-0.5 0.2-0.5 0.5s0.2 0.5 0.5 0.5 0.5-0.2 0.5-0.5-0.2-0.5-0.5-0.5z" />
          </svg>
        </div>

      </div>
      <button type="submit" value="Entrar">Iniciar sesión</button>
    </form>
  </div>
  </div>
</body>
</html>