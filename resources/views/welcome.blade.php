
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Vue js App</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-2">
    <!-- Brand/logo -->
    <div class="container-fluid">
    <!-- Links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <router-link to="/" class="nav-link">Team</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/player" class="nav-link">Player</router-link>
      </li>
    </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
      <!-- Vue Route Render -->
        <router-view></router-view>
      </div>
    </div>
  </div>

</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html> 
