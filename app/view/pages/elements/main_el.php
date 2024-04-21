<?php
# https://tu.exesfull.com/p/system/pages/main_menu.php


function pages_main_element_headcode()
{
	$file = '
        <base href=""/>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="manifest" href="https://oggetto-coffee.localzet.com/manifest.json">
		
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="preconnect" href="https://assets.exesfull.com">
		
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/pace/pace.css" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/highlight/styles/github-gist.css" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/select2/css/select2.min.css" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/css/main.css" rel="stylesheet">
		<link href="https://assets.exesfull.com/exesfull/themes/lagoon/css/custom.css" rel="stylesheet">
    	<link href="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/dropzone/min/dropzone.min.css" rel="stylesheet">
    	
    	<script>
            if (\'serviceWorker\' in navigator) {
              window.addEventListener(\'load\', function() {
                navigator.serviceWorker.register(\'/sw.js\').then(function(registration) {
                  // Регистрация успешна
                  console.log(\'ServiceWorker registration successful with scope: \', registration.scope);
                }, function(err) {
                  // регистрация не удалась :(
                  console.log(\'ServiceWorker registration failed: \', err);
                });
              });
            }
        </script>
		
		<link rel="icon" type="image/png" href="https://oggetto.team/frontend/assets/favicons/favicon-32x32.png?v=2" />';

	return $file;
}

function pages_main_element_footercode()
{
	$file = '<!-- Javascripts -->
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/jquery/jquery-3.5.1.min.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/bootstrap/js/popper.min.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/pace/pace.min.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/highlight/highlight.pack.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/select2/js/select2.full.min.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/js/main.min.js"></script>
		<script src="https://my.e.donstu.ru/t/dormitory/assets/jsAPI/main.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/dropzone/min/dropzone.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<script src="https://assets.exesfull.com/js/s2a.js"></script>
		<script src="https://assets.exesfull.com/exesfull/themes/lagoon/js/pages/settings.js"></script>
		<script src="https://oggetto-coffee.localzet.com/assets/js/main_api.js"></script>
        <script>api_main_start();</script>';
	return $file;
}

function pages_main_element_head()
{
	$file = '
    <div class="search">
    <form>
      <div class="row" >
      <a style="text-decoration: none;" href="https://my.e.donstu.ru/t/dormitory/" class="form-control col">Главная</a>
      <a style="text-decoration: none;" href="https://donstu.ru/" class="form-control col">ДГТУ</a>
      <a style="text-decoration: none;" href="/auth/logout/" class="form-control col">Выйти</a>
      </div>
    </form>
    <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
  </div>
  <div class="app-header">
    <nav class="navbar navbar-light navbar-expand-lg">
      <div class="container-fluid">
        <div class="navbar-nav" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
            </li>
            
          </ul>
  
        </div>
        <div class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link toggle-search" href="#"><i class="material-icons">person</i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>';
	return $file;
}


function pages_main_element_menu()
{

	$file = '
    <div class="app-sidebar">
				<div class="logo">
					<a style="width:50px;height:50px;border-radius: unset; background: url(https://oggetto.team/frontend/assets/favicons/favicon-32x32.png?v=2) no-repeat;background-size: 90%;" class="logo-icon"><span style="white-space: nowrap;" class="logo-text">Oggetto</span></a>
					<div class="sidebar-user-switcher user-activity-online">
						<a href="#">
							<img id="ui_main_user_img_url" src="">
							<span class="activity-indicator"></span>
							<span class="user-info-text" id="ui_main_user_first_name"></span>
						</a>
					</div>
				</div>
        
				<div class="app-menu">
					<ul class="accordion-menu" id="menu_mod">
						<li class="sidebar-title">
              				Основное
						</li>
						<li><a href="https://oggetto-coffee.localzet.com/my"><i class="material-icons">dashboard</i>Главная</a></li>
                        <li><a href="https://oggetto-coffee.localzet.com/events"><i class="material-icons">history</i>Мои встречи</a></li>			
						<li><a href="https://oggetto-coffee.localzet.com/profile"><i class="material-icons">person</i>Профиль</a></li>
						<li><a href="https://oggetto-coffee.localzet.com/auth/logout"><i class="material-icons">logout</i>Выйти</a></li>
						
					</ul>
				</div>
			</div>';
	return $file;
}

function pages_main_element_share_menu()
{
	$file = '
    <div class="app-sidebar">
				<div class="logo">
					<a style="border-radius: unset; background: url(https://oggetto-coffee.localzet.com/favicon.png) no-repeat;background-size: 90%;" class="logo-icon"><span style="white-space: nowrap;" class="logo-text">T-Plato</span></a>
				</div>
        
				<div class="app-menu">
					<ul class="accordion-menu" id="menu_mod">
						<li class="sidebar-title">
              Основное
						</li>
						<li><a href="https://tu.exesfull.com/p/"><i class="material-icons">home</i>Т-платформа</a></li>
            <li><a href="https://exesfull.com/"><i class="material-icons">star</i>Exesfull</a></li>
					</ul>
				</div>
			</div>';
	return $file;
}

function pages_main_styles_css()
{
	$file = '
			<!-- Favicon -->
			  <link rel="shortcut icon" href="https://oggetto-coffee.localzet.com/favion.png" />
			  <!-- Library / Plugin Css Build -->
			  <link rel="stylesheet" href="https://tu.exesfull.com/assets/css/core/libs.min.css" />
			  
			  
			  <!-- Hope Ui Design System Css -->
			  <link rel="stylesheet" href="https://tu.exesfull.com/assets/css/hope-ui.min.css?v=1.1.2" />
			  
			  <!-- Custom Css -->
			  <link rel="stylesheet" href="https://tu.exesfull.com/assets/css/custom.min.css?v=1.1.2" />
			  
			  <!-- Customizer Css -->
			  <link rel="stylesheet" href="https://tu.exesfull.com/assets/css/customizer.min.css" />
			  
			  <!-- Dark Css -->
			  <link rel="stylesheet" href="https://tu.exesfull.com/assets/css/dark.min.css"/>
			  
			  <!-- RTL Css -->
			  <link rel="stylesheet" href="https://tu.exesfull.com/assets/css/rtl.min.css"/>
		';
	return $file;
}

function pages_main_scripts_js()
{
	// основные скрипты JS
	$file = '
		<!-- Library Bundle Script -->
    <script src="https://tu.exesfull.com/assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="https://tu.exesfull.com/assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="https://tu.exesfull.com/assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="https://tu.exesfull.com/assets/js/charts/vectore-chart.js"></script>
    <script src="https://tu.exesfull.com/assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="https://tu.exesfull.com/assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="https://tu.exesfull.com/assets/js/plugins/setting.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="https://tu.exesfull.com/assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    <script src="https://tu.exesfull.com/assets/vendor/aos/dist/aos.js"></script>
    
    <!-- App Script -->
    <script src="https://tu.exesfull.com/assets/js/hope-ui.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://assets.exesfull.com/js/s2a.js"></script>
		';
	return $file;
}
