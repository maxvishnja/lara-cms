<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-users"></i> Контакты <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Сотрудники <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{ action('\\Sentinel\Controllers\UserController@index') }}">Пользователи</a></li>
                            <li><a href="{{ action('\\Sentinel\Controllers\GroupController@index') }}">Группы</a></li>
                        </ul>
                    </li>
                    <li><a href="index2.html">Покупатели</a></li>
                    <li><a href="index3.html">Поставщики</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>