<aside class="aside">
    <div class="user-data">
        <div class="user-name">{{ $fullName }}</div>
        <div class="user-image user-image__aside">
            <img src="{{ asset('assets/images/user-image.png') }}" alt="">
        </div>

        <div class="user-params">
            <div class="user__param">
                                <span class="param__icon-wrap">
                                    <img src="{{ asset('assets/images/orders-count.png') }}" class="param__icon" alt="">
                                </span>
                <span class="param__text">Заказов: <span class="medium_bold">{{ $cntOrders }}</span></span>
            </div>
            <div class="user__param">
                                <span class="param__icon-wrap">
                                    <img src="{{ asset('assets/images/projects.png') }}" class="param__icon" alt="">
                                </span>
                <span class="param__text">Завершенных сделок: <span class="medium_bold">{{ $cntDeals }}</span></span>
            </div>
            <div class="user__param">
                                <span class="param__icon-wrap">
                                    <img src="{{ asset('assets/images/reviews-count.png') }}" class="param__icon"
                                         alt="">
                                </span>
                <span class="param__text">Отзывов: <span class="medium_bold">{{ $cntReviews }}</span></span>
            </div>
            <div class="user__param">
                                <span class="param__icon-wrap">
                                    <img src="{{ asset('assets/images/profile-vievs.png') }}" class="param__icon"
                                         alt="">
                                </span>
                <span class="param__text">Просмотров: <span class="medium_bold">{{ $cntViews }}</span></span>
            </div>
            <div class="user__param">
                                <span class="param__icon-wrap">
                                    <img src="{{ asset('assets/images/in-service.png') }}" class="param__icon" alt="">
                                </span>
                <span class="param__text">В сервисе: <span class="medium_bold">c {{ $createdAt }}</span></span>
            </div>
            <div class="user-show-profile">
                <a href="" class="add-file-btn btn btn_blue-inverse">посмотреть профиль</a>
            </div>
        </div>
    </div>
</aside>