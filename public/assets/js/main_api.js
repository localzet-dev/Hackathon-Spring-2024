function api_main_user_get_info(){
    // Получение информации о пользователе
	var form = new FormData();
	axios.get('https://oggetto-coffee.localzet.com/api/user')
		.then(function (response) {
            var user = response.data['data'];
            window.user = user;
            document.getElementById('ui_main_user_img_url').src = 'https://ui-avatars.com/api/?size=512&background=random&name='+user['firstname'];
            document.getElementById('ui_main_user_first_name').innerHTML = user['firstname']+`<br><span class="user-state-info">Пользователь</span>`;

            document.getElementById('menu_mod').innerHTML = document.getElementById('menu_mod').innerHTML + `
            <li class="sidebar-title">
                Управление
            </li>
            <li><a href="https://oggetto-coffee.localzet.com/admin_users"><i class="material-icons">manage_accounts</i>Пользователи</a></li>
            `;
		}).catch(function (error) {
		console.log(error);
	});
}

function api_main_start(){
    api_main_user_get_info();
}

function api_main_user_profile_get_info(){
    // Получение информации о пользователе
	var form = new FormData();
	axios.get('https://oggetto-coffee.localzet.com/api/user')
		.then(function (response) {
            var user = response.data['data'];
            if (user['img_url'] == null){
                user['img_url'] = 'https://ui-avatars.com/api/?size=512&background=random&name='+user['firstname'];
            }
            document.getElementById('profile_user_firstname').scr = user['img_url'];
            document.getElementById('profile_user_firstname').value = user['firstname'];
            document.getElementById('profile_user_lastname').value = user['lastname'];
            document.getElementById('profile_user_middlename').value = user['middlename'];
            document.getElementById('profile_user_email').value = user['email'];
            document.getElementById('profile_about').innerHTML = user['about'];
            document.getElementById('profile_last_enter').innerHTML = user['last_enter_date'];
            

           if (user['sex'] == 2){
                var sex = `<option  value="1">Не указан</option><option selected value="2">Мужской</option><option value="3">Женский</option>`;
            }else if (user['sex'] == 3){
                var sex = `<option  value="1">Не указан</option><option  value="2">Мужской</option><option selected value="3">Женский</option>`;
            }else{
                var sex = `<option selected value="1">Не указан</option><option value="2">Мужской</option><option  value="3">Женский</option>`;
            }

            document.getElementById('user_sex').innerHTML = sex;

		}).catch(function (error) {
		console.log(error);
	});
}

function api_main_user_profile_update_sex(){
    var form = new FormData();
    form.append('sex', document.getElementById('user_sex').value);
    axios.put('https://oggetto-coffee.localzet.com/api/user', form)
        .then(function () {
            api_alert_success();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_user_profile_update_middlename(){
    var form = new FormData();
    form.append('middlename', document.getElementById('profile_user_middlename').value);
    axios.put('https://oggetto-coffee.localzet.com/api/user', form)
        .then(function () {
            api_alert_success();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_user_profile_update_about(){
    var form = new FormData();
    form.append('about', document.getElementById('profile_about').value);
    axios.put('https://oggetto-coffee.localzet.com/api/user', form)
        .then(function () {
            api_alert_success();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_alert_error(text="Ошибка API"){
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).fire({
        icon: 'error',
        title: text
      });
}

function api_alert_success(text='Данные сохранены', time=2000){
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: time,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).fire({
        icon: 'success',
        title: text
      });
}

function open_url(url) {
	window.open(url, '_blank').focus();
}

function api_main_events_start(){
    api_main_user_is_meeting_agree();
    api_main_user_events_get_list();
}

function api_main_user_is_meeting_agree(){
    var form = new FormData();
    //form.append('meeting_agree(', document.getElementById('user_sex').value);
    axios.get('https://oggetto-coffee.localzet.com/api/user', form)
        .then(function (response) {
            user = response.data['data'];
            window.is_user_friendly = user['meeting_agree'];
            if (user['meeting_agree'] == true){
                var color = '198754';
                var text  = 'Вы участвуете в кофебрейках';

                var timerout = `
                    <h6 class="text-light">Распределение через
                    <span class="timer__item timer__days">00</span> дней
                    <span class="timer__item timer__hours">00</span> часов
                    <span class="timer__item timer__minutes">00</span> минут
                    <span class="timer__item timer__seconds">00</span> секунд </h6>
                `;
                //document.getElementById('timerout_block').innerHTML = timerout;
                
            }else{
                var color = 'dc3545';
                var text  = 'Вы упускаете возможность :(';
                var timerout = '';
            }

            var file = `
            <a style="text-decoration:unset;" >
                <div class="col-xl-12">
                    <div style="margin:unset; border-radius: 10px; padding: 40px 30px; background: #`+color+`; display: block;" class="invoice-header">
                        <div class="row">
                            <div class="col-9">
                                <h3>`+text+`</h3>
                            </div>
                            <div class="col-3">
                                <h5 class="invoice-issue-date">Нажмите, чтобы изменить</h5>
                            </div>
                        </div>
                        `+timerout+`
                    </div>
                </div>
            </a>
            `;
            document.getElementById('big_meeting_button').innerHTML = file;

            if (user['meeting_agree'] == true){
                api_mane_view_timerout();
            }
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}



function api_main_user_events_change_meeting_agree(){
    var form = new FormData();
    if (window.is_user_friendly){
        window.is_user_friendly = false;
    }else{
        window.is_user_friendly = true
        const jsConfetti = new JSConfetti()

        jsConfetti.addConfetti()
    }
    form.append('meeting_agree', window.is_user_friendly);
    axios.put('https://oggetto-coffee.localzet.com/api/user', form)
        .then(function () {
            api_main_user_is_meeting_agree();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}




function api_mane_view_timerout(){
    var d = new Date();
    d.setDate(d.getDate() + (1 + 7 - d.getDay()) % 7);
    console.log(d);
    const deadline = d;
    // id таймера
    let timerId = null;
    // склонение числительных
    function declensionNum(num, words) {
        return words[(num % 100 > 4 && num % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(num % 10 < 5) ? num % 10 : 5]];
    }
    // вычисляем разницу дат и устанавливаем оставшееся времени в качестве содержимого элементов
    function countdownTimer() {
        const diff = deadline - new Date();
        if (diff <= 0) {
        clearInterval(timerId);
        }
        const days = diff > 0 ? Math.floor(diff / 1000 / 60 / 60 / 24) : 0;
        const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
        const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
        const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
        $days.textContent = days < 10 ? '0' + days : days;
        $hours.textContent = hours < 10 ? '0' + hours : hours;
        $minutes.textContent = minutes < 10 ? '0' + minutes : minutes;
        $seconds.textContent = seconds < 10 ? '0' + seconds : seconds;
        $days.dataset.title = declensionNum(days, ['день', 'дня', 'дней']);
        $hours.dataset.title = declensionNum(hours, ['час', 'часа', 'часов']);
        $minutes.dataset.title = declensionNum(minutes, ['минута', 'минуты', 'минут']);
        $seconds.dataset.title = declensionNum(seconds, ['секунда', 'секунды', 'секунд']);
    }
    // получаем элементы, содержащие компоненты даты
    const $days = document.querySelector('.timer__days');
    const $hours = document.querySelector('.timer__hours');
    const $minutes = document.querySelector('.timer__minutes');
    const $seconds = document.querySelector('.timer__seconds');
    // вызываем функцию countdownTimer
    countdownTimer();
    // вызываем функцию countdownTimer каждую секунду
    timerId = setInterval(countdownTimer, 1000);
}


function api_main_user_events_get_last_(){

}

function api_main_user_events_get_list(){
    var form = new FormData();
    axios.get('https://oggetto-coffee.localzet.com/api/user/events?type=latest', form)
        .then(function (response) {
            var events = response.data['data'];
            if (events.length !== 0){
                if (ev['description'] == null){
                    ev['description'] = '';
                }
                bb = `
                <div class="alert alert-custom alert-indicator-top indicator-success" role="alert">
                    <div class="alert-content">
                        <span class="alert-title">`+ev['title']+`</span>
                        <span class="alert-text">`+ev['description']+`</span>
                    </div>
                </div>
                    `;
                
            }else{
                var bb = `

                `;
            }
            document.getElementById('events_block').innerHTML = bb;
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_hhc_statistics_get_table(){
    var form = new FormData();
	axios.get('https://oggetto-coffee.localzet.com/api/users', form)
		.then(function (response) {
			var block = ``;
            var allow_cols = ['id', 'firstname', 'lastname', 'middlename', 'email', 'is_admin', 'last_enter_date' ];
            response.data['data'].forEach((row) => {
                block = block + `<tr>`;
                for (var key in row) {
                    item = row[key];
                    if (row[key] == null){
                        row[key] = '';
                    }
                    if (row[key] == true){
                        row[key] = 'Да';
                    }
                    if (row[key] == false){
                        row[key] = '';
                    } 
                    
                }
                block = block + `<td><a style="text-decoration: unset;" href="https://oggetto-coffee.localzet.com/admin_users/`+row['id']+`">`+row['id']+`</a></td>`;
                block = block + `<td><a style="text-decoration: unset;" href="https://oggetto-coffee.localzet.com/admin_users/`+row['id']+`">`+row['firstname']+`</a></td>`;
                block = block + `<td><a style="text-decoration: unset;" href="https://oggetto-coffee.localzet.com/admin_users/`+row['id']+`">`+row['lastname']+`</a></td>`;
                block = block + `<td><a style="text-decoration: unset;" href="https://oggetto-coffee.localzet.com/admin_users/`+row['id']+`">`+row['middlename']+`</a></td>`;
                block = block + `<td><a style="text-decoration: unset;" href="https://oggetto-coffee.localzet.com/admin_users/`+row['id']+`">`+row['email']+`</a></td>`;
                block = block + `<td>`+row['is_ver']+`</td>`;
                block = block + `<td>`+row['is_admin']+`</td>`;
                block = block + `<td>`+row['last_enter_date']+`</td>`;
                block = block + `</tr>`;
            });
            document.getElementById('search_block').innerHTML = block;
            api_alert_success('Данные загружены');
            api_hhc_statistics_table_build();
        }).catch(function (error) {
            console.log(error);
        });
}

function api_hhc_statistics_table_build(){
    
    $('#datatable4 thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<p>'+title+'</p><input type="text" class="form-control" placeholder="'+title+'" />' );
    } );
 
    // DataTable
    var table = $('#datatable4').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });

}

function api_main_user_admin_profile_get_info(){
    // Получение информации о пользователе
	var form = new FormData();
	axios.get('https://oggetto-coffee.localzet.com/api/users/'+window.user_id)
		.then(function (response) {
            var user = response.data['data'];
            if (user['img_url'] == null){
                user['img_url'] = 'https://ui-avatars.com/api/?size=512&background=random&name='+user['firstname'];
            }
            document.getElementById('profile_user_firstname').scr = user['img_url'];
            document.getElementById('profile_user_firstname').value = user['firstname'];
            document.getElementById('profile_user_lastname').value = user['lastname'];
            document.getElementById('profile_user_middlename').value = user['middlename'];
            document.getElementById('profile_user_email').value = user['email'];
            document.getElementById('profile_about').innerHTML = user['about'];
            document.getElementById('profile_last_enter').innerHTML = user['last_enter_date'];
            if (user['is_ver']){
                btn = `<button onclick="api_main_admin_profile_update_is_ver();" type="button" class="btn btn-warning"><i class="material-icons">close</i>Отменить верификацию</button>    `;
            }else{
                btn = `<button onclick="api_main_admin_profile_update_is_ver();" type="button" class="btn btn-success"><i class="material-icons">check_circle</i>Верифицировать</button>    `;
            }
            document.getElementById('ui_id_ver').innerHTML = btn + ' <button onclick="api_main_admin_profile_user_delete();" type="button" class="btn btn-danger"><i class="material-icons">delete_outline</i>Удалить</button>    ';
            window.is_ver = user['is_ver'];
            

           if (user['sex'] == 2){
                var sex = `<option  value="1">Не указан</option><option selected value="2">Мужской</option><option value="3">Женский</option>`;
            }else if (user['sex'] == 3){
                var sex = `<option  value="1">Не указан</option><option  value="2">Мужской</option><option selected value="3">Женский</option>`;
            }else{
                var sex = `<option selected value="1">Не указан</option><option value="2">Мужской</option><option  value="3">Женский</option>`;
            }

            document.getElementById('user_sex').innerHTML = sex;

		}).catch(function (error) {
		console.log(error);
	});
}

function api_main_admin_profile_user_delete(){
    var form = new FormData();
    axios.delete('https://oggetto-coffee.localzet.com/api/users/'+window.user_id)
        .then(function () {
            window.location.replace("https://oggetto-coffee.localzet.com/admin_users");
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_admin_profile_update_is_ver(){

    if(window.is_ver){
        window.is_ver = false;
    }else{
        window.is_ver = true;
    }

    var form = new FormData();
    form.append('is_ver', window.is_ver);
    axios.put('https://oggetto-coffee.localzet.com/api/users/'+window.user_id, form)
        .then(function () {
            api_alert_success();
            api_main_user_admin_profile_get_info();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_admin_profile_update_about_delete(){
    var form = new FormData();
    form.append('about', '');
    axios.put('https://oggetto-coffee.localzet.com/api/users/'+window.user_id, form)
        .then(function () {
            api_alert_success();
            api_main_user_admin_profile_get_info();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_admin_profile_update_firstname(){
    var form = new FormData();
    form.append('firstname', document.getElementById('profile_user_firstname').value);
    axios.put('https://oggetto-coffee.localzet.com/api/users/'+window.user_id, form)
        .then(function () {
            api_alert_success();
            api_main_user_admin_profile_get_info();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_admin_profile_update_lastname(){
    var form = new FormData();
    form.append('lastname', document.getElementById('profile_user_lastname').value);
    axios.put('https://oggetto-coffee.localzet.com/api/users/'+window.user_id, form)
        .then(function () {
            api_alert_success();
            api_main_user_admin_profile_get_info();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_admin_profile_update_middlename(){
    var form = new FormData();
    form.append('middlename', document.getElementById('profile_user_middlename').value);
    axios.put('https://oggetto-coffee.localzet.com/api/users/'+window.user_id, form)
        .then(function () {
            api_alert_success();
            api_main_user_admin_profile_get_info();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_user_profile_update_sex(){
    var form = new FormData();
    form.append('sex', document.getElementById('user_sex').value);
    axios.put('https://oggetto-coffee.localzet.com/api/users/'+window.user_id, form)
        .then(function () {
            api_alert_success();
    }).catch(function (error) {
        console.log(error);
        api_alert_error();
    });
}

function api_main_user_events_his_get_list(){
    var form = new FormData();
    axios.get('https://oggetto-coffee.localzet.com/api/user/events', form)
        .then(function (response) {
            var events = response.data['data'];
            events.reverse();
            if (events.length !== 0){
                bb = '';
                events.forEach((ev) => {

                    if(ev['description'] == null){
                        ev['description'] = '';
                    }

                    if(ev['about'] == null){
                        ev['about'] = '';
                    }

                    if (ev['is_online']){
                        img = 'https://emojigraph.org/media/apple/selfie_1f933.png';
                        on_text = 'Онлаин';
                    }else{
                        img = 'https://emojigraph.org/media/apple/handshake_1f91d.png';
                        on_text = 'Личная встреча';
                    }

                    users = ev['users'];
                    users.forEach(user => {
                        if (user['id'] != window.user['id']){
                            window.friend = user;
                        }
                    });

                    bb = bb + `
                    <div class="col-xl-12">
                        <div class="card widget widget-popular-blog">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="widget-connection-request-container d-flex">
                                            <div class="widget-connection-request-avatar">
                                                <div class="avatar avatar-xl m-r-xs">
                                                    <img src="`+'https://ui-avatars.com/api/?size=512&background=random&name='+window.friend['firstname']+`" alt="" />
                                                </div>
                                            </div>
                                            <div class="widget-connection-request-info flex-grow-1">
                                                <span class="widget-connection-request-info-name">
                                                   <b>`+window.friend['lastname']+` `+window.friend['firstname']+`</b><br>
                                                </span>
                                                <span class="widget-connection-request-info-count">
                                                   `+ev['about']+`
                                                </span>
                                                <span class="widget-connection-request-info-count">
                                                   `+ev['about']+`
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="widget-connection-request-container d-flex">
                                            <div class="widget-connection-request-avatar">
                                                <div class="avatar avatar-xl m-r-xs">
                                                    <img src="`+img+`" alt="" />
                                                </div>
                                            </div>
                                            <div class="widget-connection-request-info flex-grow-1">
                                                <span class="widget-connection-request-info-name">
                                                    <b>`+on_text+`</b><br>
                                                </span>
                                                <span class="widget-connection-request-info-count">
                                                    Место встречи: `+ev['address']+`
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="widget-popular-blog-container">
                                            <div class="widget-popular-blog-content ps-4">
                                                <span class="widget-popular-blog-title">
                                                    `+ev['title']+`
                                                </span>
                                                <span class="widget-popular-blog-text">
                                                `+ev['description']+`
                                                </span>
                                                <span class="widget-popular-blog-text">
                                                    Дата встречи: `+ev['date']+`
                                                </span>
                                                <span class="widget-popular-blog-text">
                                                    Номер недели: `+ev['week']+`
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                });
            }else{

            }
            document.getElementById('list_block').innerHTML = bb;
        });
    
}