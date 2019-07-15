@extends('admin.custom_forms.main')

@section('form')
    <!-- begin wizard -->
    <div id="wizard">
        <!-- begin wizard-step -->
        <ul>
            <li class="col-md-3 col-sm-4 col-6">
                <a href="#step-1">
                    <span class="number">1</span>
                    <span class="info text-ellipsis">
                        Основное
                        <small class="text-ellipsis">Общая информация о мероприятии</small>
                    </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-4 col-6">
                <a href="#step-2">
                    <span class="number">2</span>
                    <span class="info text-ellipsis">
                        Организатор
                        <small class="text-ellipsis">Контактная информация о консультанте</small>
                    </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-4 col-6">
                <a href="#step-3">
                    <span class="number">3</span>
                    <span class="info text-ellipsis">
                        Информация о мероприятии
                        <small class="text-ellipsis">Формат, тип, описание, обложки, USP</small>
                    </span>
                </a>
            </li>
            <li class="col-md-3 col-sm-4 col-6">
                <a href="#step-4">
                    <span class="number">4</span>
                    <span class="info text-ellipsis">
                        Дата и место проведения
                        <small class="text-ellipsis">Дата и место проведения</small>
                    </span>
                </a>
            </li>
        </ul>
        <!-- end wizard-step -->
        <!-- begin wizard-content -->
        <div>
            <!-- begin step-1 -->
            <div id="step-1">
                <!-- begin fieldset -->
                <fieldset>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-8 -->
                        <div class="col-md-8 offset-md-2">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Основная информация о мероприятии</legend>
                            {!! $instance->renderFormControl('name', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('user_id', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('status_id', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('price_type', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('is_ended', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('is_opened', $state, $item ?? null) !!}
                        </div>
                        <!-- end col-8 -->
                    </div>
                    <!-- end row -->
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-1 -->
            <!-- begin step-2 -->
            <div id="step-2">
                <!-- begin fieldset -->
                <fieldset>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-8 -->
                        <div class="col-md-8 offset-md-2">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Контактная информация об организаторе мероприятия</legend>
                            {!! $instance->renderFormControl('contacts_person', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('contacts_phone', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('contacts_email', $state, $item ?? null) !!}
                        </div>
                        <!-- end col-8 -->
                    </div>
                    <!-- end row -->
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-2 -->
            <!-- begin step-3 -->
            <div id="step-3">
                <!-- begin fieldset -->
                <fieldset>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-8 -->
                        <div class="col-md-8 offset-md-2">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Информация о мероприятии</legend>
                            {!! $instance->renderFormControl('event_format_id', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('event_type_id', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('events.description', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('events.usps', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('events.image', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('event_spo_id', $state, $item ?? null) !!}
                        </div>
                        <!-- end col-8 -->
                    </div>
                    <!-- end row -->
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-3 -->
            <!-- begin step-4 -->
            <div id="step-4">
                <!-- begin fieldset -->
                <fieldset>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-8 -->
                        <div class="col-md-8 offset-md-2">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Информация о мероприятии</legend>
                            {!! $instance->renderFormControl('date_start', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('date_end', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('country_id', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('city_id', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('address_street', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('address_house', $state, $item ?? null) !!}
                            {!! $instance->renderFormControl('address_comment', $state, $item ?? null) !!}
                        </div>
                        <!-- end col-8 -->
                    </div>
                    <!-- end row -->
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-4 -->
        </div>
        <!-- end wizard-content -->
    </div>
    <!-- end wizard -->
@endsection

@section('form_js')
    <link href="/assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css" rel="stylesheet" />
    <script src="/assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js"></script>

    <script>
        $('#wizard').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect:'',
            transitionSpeed: 0,
            useURLhash: false,
            showStepURLhash: false,
            toolbarSettings: {
                toolbarPosition: 'bottom',
                toolbarExtraButtons: [
                    $('<button></button>').text('Сохранить')
                        .addClass('btn btn-info m-l-10 jsFormSave'),
                ]
            },
            lang: {  // Language variables for button
                next: 'Далее',
                previous: 'Назад'
            },
        }).on('leaveStep', function(e, anchorObject, stepNumber, stepDirection) {
            $('form #step-' + (stepNumber + 1) + ' [data-req]').each(function(){
                $(this).attr('data-parsley-required', 'true');
            });

            let res = stepDirection == 'forward' ? $('form').parsley().validate() : true;

            $('form #step-' + (stepNumber + 1) + ' [data-parsley-required="true"]').each(function(){
                $(this).removeAttr('data-parsley-required');
            });

            if (res && stepDirection == 'forward' && stepNumber == 2) {
                if (!$('[name="cover_image"]:checked').val() && !$('[name="image"]').val()) {
                    swal({
                        title: "Не выбрано изображение",
                        text: "Выберите загруженную обложку или загрузите свою",
                        showCancelButton: false,
                        icon: 'error',
                        buttons: {
                            confirm: {
                                text: 'Закрыть',
                                value: true,
                                visible: true,
                                className: 'btn btn-success',
                                closeModal: true
                            }
                        }
                    });

                    return false;
                }
            }

            return res;
        }).on('keypress', function( event ) {
            if (event.which == 13 ) {
                $('#wizard').smartWizard('next');
            }
        }).on('showStep', function(e, anchorObject, stepNumber, stepDirection){
            if (stepNumber == 2) {
                toggleCoversByFormatType();
            }

            if (stepNumber == 3) {
                $('.jsFormSave').show();
                $('.sw-toolbar .sw-btn-next').hide();
            } else {
                $('.jsFormSave').hide();
                $('.sw-toolbar .sw-btn-next').show();
            }

            resizeJquerySteps();
        });

        $('.sw-toolbar .sw-btn-prev').removeClass('btn-default').addClass('btn-white');
        $('.sw-toolbar .sw-btn-next').removeClass('btn-default').addClass('btn-success');
        $('.jsFormSave').hide();

        $('form [data-parsley-required="true"]').each(function(){
            $(this).attr('data-req', true)
                .removeAttr('data-parsley-required');
        });

        function toggleCoversByFormatType() {
            let event_format_id = $('#event_format_id').val();
            let event_type_id = $('#event_type_id').val();

            $('#default-tab-1 .covers .cover').hide();
            $('#default-tab-1 .covers .cover[data-format-id="' + event_format_id + '"]').show();
            $('#default-tab-1 .covers .cover[data-type-id="' + event_type_id + '"]').show();

            if (!$('#default-tab-1 .covers input[type="radio"]:checked').length) {
                $('#default-tab-1 .covers .cover:visible').first().find('input[type="radio"]').prop('checked', true);
            }

            resizeJquerySteps();
        }

        function resizeJquerySteps() {
            $('.wizard .content').animate({ height: $('.body.current').outerHeight() }, "slow");
        }

        $('.jsFormSave').click(function(){
            $('form #step-4 [data-req]').each(function(){
                $(this).attr('data-parsley-required', 'true');
            });

            let res = $('form').parsley().validate();

            $('form #step-4 [data-parsley-required="true"]').each(function(){
                $(this).removeAttr('data-parsley-required');
            });

            console.log(res);

            return res;
        });

    </script>

    @stack('js')
@endsection