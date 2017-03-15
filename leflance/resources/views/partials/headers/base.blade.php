<header class="header gradient_theme">
    <div class="header-inner container flex_row">
        <div class="logo">
            <a href="/"><img src=" {{ asset('assets/images/logo.png') }} " alt="" /></a>
        </div>
        <div class="w_half">
            <div class="flex_row">
                <a href="" class="btn btn-md-w btn_green">Заказать работу</a>
                <a href="" class="link white_link">Задать вопрос</a>
                <a href="tel:+375298569678" class="header__phone"><span class="sm_text">+375 (29)</span> <span class="lg_text">856-96-78</span></a>
            </div>
        </div>
        <div class="header__user-btns">
            <div>
                <a href="{{ url('/register') }}" class="btn btn-md-w btn_white-inverse">Регистрация</a>
            </div>
            <div class="header__login-btn-wrap text_center">
                <a href="{{ url('/login') }}" class="link white_link link_dotted">Авторизация</a>
            </div>
        </div>
    </div>
</header>