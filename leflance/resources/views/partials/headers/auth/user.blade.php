<header class="header header-authorized gradient_theme gradient_theme-animated">
    <div class="header-inner container flex_row">
        <div class="logo">
            <a href=""><img src="{{ asset('assets/images/logo.png') }}" alt=""/></a>
        </div>
        <div class="user-notifications clearfix_">
            <div class="notification">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <div class="notifications__count">1</div>
            </div>
            <div class="notification">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <div class="notifications__count">1</div>
            </div>
        </div>
        <nav class="nav">
            <ul class="nav-list clearfix_">
                <li class="nav-list__item">
                    <a href="{{ route('orders.custom.list', Request::route('user_id')) }}" class="nav-list-link link white_link">Мои заказы</a>
                </li>
                <li class="nav-list__item">
                    <a href="{{ route('response-to-order.show', Request::route('user_id')) }}" class="nav-list-link link white_link">Мои отклики</a>
                </li>
            </ul>
        </nav>
        <div class="header__authorized-user-btns">
            <div class="flex_row">
                <div>
                    <a href="{{ route('orders.create', Request::route('user_id')) }}" class="btn btn-md-w btn_white-inverse">Заказать работу</a>
                </div>
                <div class="user-info" data-uk-dropdown>
                    <div class="flex_row">
                        <div class="user__name">Дмитрий</div>
                        <div class="user__image-wrap">
                            <img src="{{ asset('assets/images/user-photo.png') }}" alt="" class="user__image">
                        </div>
                        <div class="dropdown-arrow">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="user-info-nav-wrap uk-dropdown">
                        <ul class="user-info-nav">
                            <li class="user-info-nav__item">
                                <a href="{{ route('orders.list', Request::route('user_id')) }}" class="user-info-nav__link">Все заказы</a>
                            </li>
                        </ul>
                        <ul class="user-info-nav">
                            <li class="user-info-nav__item">
                                <a href="{{ route('settings.subscribe.show', Request::route('user_id')) }}" class="user-info-nav__link">Подписка</a>
                            </li>
                            <li class="user-info-nav__item">
                                <a href="" class="user-info-nav__link">Помощь</a>
                            </li>
                            <li class="user-info-nav__item">
                                <a href="" class="user-info-nav__link">Настройки</a>
                            </li>
                        </ul>
                        <div class="logout">
                            <a href="" class="user-info-nav__link">Выход</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>