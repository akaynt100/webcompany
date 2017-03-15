@extends('layouts.app')

@section('content')

    <div class="main-content">
        <section class="container">
            @include('partials.alert')

            <h1 class="title">Новый заказ</h1>

            @include('partials.breadcrumbs')

            <div class="content__wrap clearfix_">
                @include('partials.user')
                <div class="content">
                    <form action="{{ route('orders.do-create', Request::route('user_id')) }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="clearfix_">
                            <div class="form-column-sm fl_l">
                                <div class="column__title">Основная информация</div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                    <span class="block">
                                        <input type="text" name="theme" class="field" value="{{ old('theme') }}"
                                               placeholder="">
                                    </span>
                                        <span class="custom-placeholder">Тема вашей работы</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                        <span class="block">
                                            <select class="field custom-select" name="type">
                                                <option value="0" selected disabled>Выберите тип работы</option>
                                                <option value="Реферат">Реферат</option>
                                                <option value="Курсовая работа">Курсовая работа</option>
                                                <option value="Реферат">Реферат</option>
                                            </select>
                                        </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                    <span class="block">
                                        <textarea class="field custom-textarea" name="description"
                                                  placeholder="">{{ old('description') }}</textarea>
                                    </span>
                                        <span class="custom-placeholder">Описание работы</span>
                                    </label>
                                </div>
                                <div class="captcha field__wrap">
                                    {!! Recaptcha::render() !!}
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                        <input type="submit" class="submit__btn btn btn-lg btn_green"
                                               value="Заказать работу">
                                    </label>
                                </div>
                            </div>
                            <div class="form-column-md fl_r">
                                <div class="column__title">Дополнительная информация</div>
                                <div class="field__wrap flex_row flex_start">
                                    <div class="field-inner_label">Количество страниц</div>
                                    <label class="field__label custom-placeholder-wrap field__label-xs">
                                    <span class="block">
                                        <input type="number" value="{{ old('pages_from') }}" name="pages_from"
                                               class="field" maxlength="3"
                                               placeholder="">
                                    </span>
                                        <span class="custom-placeholder">от</span>
                                    </label>
                                    <label class="field__label custom-placeholder-wrap field__label-xs">
                                    <span class="block">
                                        <input type="number" value="{{ old('pages_to') }}" name="pages_to" class="field"
                                               maxlength="3" placeholder="">
                                    </span>
                                        <span class="custom-placeholder">до</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                        <span class="block">
                                            <input type="text" value="{{ old('deadline') }}" name="deadline"
                                                   class="field" placeholder="">
                                        </span>
                                        <span class="custom-placeholder">Срок сдачи</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                    <span class="block">
                                        <select class="field custom-select" name="city">
                                            <option value="0" selected disabled>Город</option>
                                            <option value="Минск">Минск</option>
                                            <option value="Брест">Брест</option>
                                            <option value="Витебск">Витебск</option>
                                        </select>
                                    </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                    <span class="block">
                                        <select class="field custom-select" name="educational_institution">
                                            <option value="0" selected disabled>ВУЗ</option>
                                            <option value="БГУИР">БГУИР</option>
                                            <option value="БНТУ">БНТУ</option>
                                            <option value="БГЭУ">БГЭУ</option>
                                        </select>
                                    </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                    <span class="block">
                                        <select class="field custom-select" name="faculty">
                                            <option value="0" selected disabled>Факультет</option>
                                            <option value="ФИТУ">ФИТУ</option>
                                            <option value="НГЭГ">НГЭГ</option>
                                        </select>
                                    </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                        <span class="block">
                                            <input type="text" value="{{ old('specialty') }}" name="specialty"
                                                   class="field" placeholder="">
                                        </span>
                                        <span class="custom-placeholder">Специальность</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="custom-input-file">
                                    <span class="custom-input-file-wrap">
                                        <input type="file" name="files[]" multiple>
                                        <span class="add-file-btn btn btn_blue-inverse">Добавить файл</span>
                                        <span class="custom-input-file__text"><span>Файл не выбран</span></span>
                                    </span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

