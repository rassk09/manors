@extends('admin.layouts.app')

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'route' => 'admin_settings_store', 'files' => true]) !!}
            <!-- begin page-header -->
            <h1 class="page-header">Настройки сайта</h1>
            <!-- end page-header -->

            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <div class="card p-20">
                        <h5>Настройки</h5>
                        @foreach($settings as $setting)
                            @php($type = $setting->content_type)
                            @if ($type == 'image')
                                {!! \App\Admin\Form\BaseControl::image($setting->alias, 'Admin\ApiController@uploadSettingImage')->setTitle($setting->name)->renderSetting($setting) !!}
                            @else
                                {!! \App\Admin\Form\BaseControl::$type($setting->alias)->setTitle($setting->name)->renderSetting($setting) !!}
                            @endif
                        @endforeach

                        <div class="form-group">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check m-r-5"></i> Сохранить настройки</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('js')
    @stack('js')
@endsection