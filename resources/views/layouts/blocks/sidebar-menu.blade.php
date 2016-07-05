<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-users"></i> Контакты <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('companies.index') }}">Компании</a></li>
                    <li><a>Сотрудники <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{ action('\\Sentinel\Controllers\UserController@index') }}">Пользователи</a></li>
                            <li><a href="{{ action('\\Sentinel\Controllers\GroupController@index') }}">Группы</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>