<?php

include_once 'elements/main_el.php';

function error_404(){

	$file = '<!doctype html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Oggeto</title>
      <link rel="icon" type="image/x-icon" href="https://oggetto-coffee.localzet.com/favicon.png">
      
      '.pages_main_styles_css().'

  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">


      <div class="wrapper">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

<div class="gradient">
    <div class="container">
        <img src="https://tu.exesfull.com/assets/images/error/404.png" class="img-fluid mb-4 w-50" alt="">
        <h2 class="mb-0 mt-4 text-white">ОЙ! Ничего не найдено.</h2><br>
        <a class="btn bg-white text-primary d-inline-flex align-items-center" href="https://oggetto-coffee.localzet.com/">Главная</a>
    </div>
    <div class="box">
        <div class="c xl-circle">
            <div class="c lg-circle">
                <div class="c md-circle">
                    <div class="c sm-circle">
                        <div class="c xs-circle">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      </div>

    '.pages_main_scripts_js().'
  </body>
</html>';
return $file;
}

function mainpages_dashboard(){
	// главная страница личного кабинета

$file = '<!DOCTYPE html>
<html lang="ru">
<head>
	'.pages_main_element_headcode().'
	<title>Главная</title>
</head>
<body>
	<div class="app align-content-stretch d-flex flex-wrap">
		'.pages_main_element_menu().'
		<div class="app-container">
			'.pages_main_element_head().'
			<div class="app-content">
				<div class="content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<div class="page-description page-description-tabbed">
									<h1>Ваши мероприятия</h1>
								</div>
							</div>
						</div>
						
						<div id="big_meeting_button" onclick="api_main_user_events_change_meeting_agree();" class="row">
							
						</div>
						<br><br>

                        <div id="events_block"></div>

                        <!--<div class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">Address 2</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">State</label>
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputZip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                        </div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	'.pages_main_element_footercode().'
    <script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/countdown/jquery.countdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
    <script>api_main_events_start();</script>
</body>
</html>';
return $file;
}

function mainpages_profile(){
    $file = '<!DOCTYPE html>
    <html lang="ru">
    <head>
        '.pages_main_element_headcode().'
        <title>Профиль</title>
    </head>
    <body>
        <div class="app align-content-stretch d-flex flex-wrap">
            '.pages_main_element_menu().'
            <div class="app-container">
                '.pages_main_element_head().'
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description page-description-tabbed">
                                        <h1>Профиль</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="avatar avatar-xl m-r-xs"> <img id="ui_profile_img" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png"> </div>
                                                </div>									
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputFirstName" class="form-label">Имя</label>
                                                    <input readonly type="text" class="form-control" id="profile_user_firstname" placeholder="" value=""> 
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputLastName" class="form-label">Фамилия</label>
                                                    <input readonly type="text" class="form-control" id="profile_user_lastname" placeholder="" value="">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputLastName" class="form-label">Отчество</label>
                                                    <input onkeyup="api_main_user_profile_update_middlename();" type="text" class="form-control" id="profile_user_middlename" placeholder="" value="">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control" readonly id="profile_user_email">
                                                </div>
                                            </div>
    
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsState" class="form-label">Пол</label>
                                                    <select onchange="api_main_user_profile_update_sex();" class="js-states form-control" id="user_sex" tabindex="-1" style="display: none; width: 100%">
                                                        <optgroup id="user_sex_build">
                                                            
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>Дата последнего входа: <br> <span id="profile_last_enter"></span></p>
                                                </div>									
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Расскажите о себе</h4>
                                                    <textarea type="name" class="form-control" onkeyup="api_main_user_profile_update_about();" id="profile_about" aria-describedby="name" placeholder=""></textarea>
                                                </div>		
                                                <div style="margin-top:20px;">
                                                    <div class="alert alert-custom alert-indicator-left indicator-info" role="alert">
                                                        <div class="alert-content">
                                                            <span class="alert-title">Если не знаете о чем писать, то можете воспользоваться подсказкой:</span> 
                                                            <span class="alert-text">
                                                                <p>1  Специальность ?</p>
                                                                <p>2 Какие хобби есть?</p>
                                                                <p>3 Какие книги предпочитаешь?</p>
                                                                <p>4 Какому виду отдыха отдаешь предпочтения?</p>
                                                                <p>5 Какой пище предпочтение отдаешь?</p>
                                                                <p>6 Есть капибара?</p>
                                                                <p>7 Какие взгляды на жизнь?(выбор ответа выплывающий желательно)</p>
                                                                <p>8 Почему выбрал эту профессию?</p>
                                                                <p>9 Как относишься к такому формату «кофебрейкингов»?</p>
                                                                <p>10 Как часто планируешь посещать кофебрейки?</p>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>						
                                            </div>
                                        </div>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        '.pages_main_element_footercode().'
        <script>
        api_main_user_profile_get_info();
        </script>
    </body>
    </html>';
    return $file;
    }

function mainpages_admin_users(){

    $file = '<!DOCTYPE html>
    <html lang="ru">
    <head>
        '.pages_main_element_headcode().'
        <title>Все пользователи</title>
        <style>
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        th {
            min-width: 150px;
        }
        </style>
    </head>
    <body>
        <div class="app align-content-stretch d-flex flex-wrap">
            '.pages_main_element_menu().'
            <div class="app-container">
                '.pages_main_element_head().'
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description page-description-tabbed">
                                        <h1>Администрация - пользователи</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable4" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                <th>ID</th>
                                                <th>Имя</th>
                                                <th>Фамилия</th>
                                                <th>Отчество</th>
                                                <th>Email</th>
                                                <th>Верифицирован</th>
                                                <th>Администратор</th>
                                                <th>Дата входа</th>
                                                </tr>
                                            </thead>
                                            <tbody id="search_block">
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="stat_room_info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Информация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="lists_block">
                    </div>
                    <hr>
                    <button data-bs-dismiss="modal" type="button" class="btn btn-primary">Закрыть</button>
                </div>
                
            </div>
        </div>
    </div>
        '.pages_main_element_footercode().'
        <script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/datatables/datatables.js"></script>
        <script src="https://assets.exesfull.com/exesfull/themes/lagoon/js/custom.js"></script>
        <script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/pace/pace.min.js"></script>
        <script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/highlight/highlight.pack.js"></script>
        <script>
            api_hhc_statistics_get_table();
        </script>
    </body>
    </html>';
    return $file;    
    
}

function mainpages_admin_users_byid($id){
    $file = '<!DOCTYPE html>
    <html lang="ru">
    <head>
        '.pages_main_element_headcode().'
        <title>Профиль</title>
        <script>window.user_id='.$id.'</script>
    </head>
    <body>
        <div class="app align-content-stretch d-flex flex-wrap">
            '.pages_main_element_menu().'
            <div class="app-container">
                '.pages_main_element_head().'
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description page-description-tabbed">
                                        <h1>Профиль</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="avatar avatar-xl m-r-xs"> <img id="ui_profile_img" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png"> </div>
                                                </div>									
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputFirstName" class="form-label">Имя</label>
                                                    <input  onkeyup="api_main_admin_profile_update_firstname();"  type="text" class="form-control" id="profile_user_firstname" placeholder="" value=""> 
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputLastName" class="form-label">Фамилия</label>
                                                    <input  onkeyup="api_main_admin_profile_update_lastname();" type="text" class="form-control" id="profile_user_lastname" placeholder="" value="">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputLastName" class="form-label">Отчество</label>
                                                    <input onkeyup="api_main_admin_profile_update_middlename();" type="text" class="form-control" id="profile_user_middlename" placeholder="" value="">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsInputEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control" readonly id="profile_user_email">
                                                </div>
                                            </div>
    
                                            <div class="row m-t-lg">
                                                <div class="col-md-12">
                                                    <label for="settingsState" class="form-label">Пол</label>
                                                    <select onchange="api_main_user_profile_update_sex();" class="js-states form-control" id="user_sex" tabindex="-1" style="display: none; width: 100%">
                                                        <optgroup id="user_sex_build">
                                                            
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>Дата последнего входа: <br> <span id="profile_last_enter"></span></p>
                                                </div>									
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Рассказ пользователя о себе</h4>
                                                    <textarea readonly type="name" class="form-control" onkeyup="api_main_user_profile_update_about();" id="profile_about" aria-describedby="name" placeholder=""></textarea>
                                                    <br>
                                                    <p onclick="api_main_admin_profile_update_about_delete();" style="color:red">Отчистить</p>
                                                </div>				
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Управлние</h4>
                                                    <div id="ui_id_ver"> </div>
                                                   
                                                </div>				
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        '.pages_main_element_footercode().'
        <script>
        api_main_user_admin_profile_get_info();
        </script>
    </body>
    </html>';
    return $file;
}


function mainpages_history_events(){

$file = '<!DOCTYPE html>
<html lang="ru">
<head>
	'.pages_main_element_headcode().'
	<title>История встречь</title>
</head>
<body>
	<div class="app align-content-stretch d-flex flex-wrap">
		'.pages_main_element_menu().'
		<div class="app-container">
			'.pages_main_element_head().'
			<div class="app-content">
				<div class="content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<div class="page-description page-description-tabbed">
									<h1>Ваши мероприятия</h1>
								</div>
							</div>
						</div>
						
						</div>
						<br><br>

                        <div id="list_block"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	'.pages_main_element_footercode().'
    <script src="https://assets.exesfull.com/exesfull/themes/lagoon/plugins/countdown/jquery.countdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
    <script>setTimeout(api_main_user_events_his_get_list, 1000);</script>
</body>
</html>';
return $file;
}
    

?>