<div class="form-group row usps_list">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        @foreach($usps as $usp)
            <div class="checkbox checkbox-css" data-format-id="{{$usp->event_format_id}}">
                {!! Form::checkbox('event_usp[]', $usp->id, $state == 'edit' ? $item->hasUSP($usp->id) : false, ['id' => 'event_usp_' . $usp->id]) !!}
                {!! Form::label('event_usp_' . $usp->id, $usp->name) !!}
            </div>
        @endforeach
        <h5 class="m-t-15">Пользовательские USP</h5>
        <button type="button" class="btn btn-primary btn-sm m-b-10 jsAddUserUSP"><i class="fa fa-plus m-r-5"></i> Добавить</button>
        <div class="jsUsersUSPs">
            @if (isset($item) && $item->users_usps->count() > 0)
                @foreach($item->users_usps as $users_usp)
                    <div class="input-group m-b-10">
                        {!! Form::text('users_event_usp[]', $users_usp->name, ['class' => 'form-control']) !!}
                        <div class="input-group-append">
                            {!! Form::button('Удалить', ['class' => 'btn btn-danger jsUSPDelete']) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@pushonce('js:usps')
    <script>
        (function(){
            $('#event_format_id').change(function(){
                refreshUspsList(true);
            });
            refreshUspsList(false);

            $('.jsAddUserUSP').click(function(){
                $('.jsUsersUSPs').append(`
                    <div class="input-group m-b-10">
                        <input class="form-control" name="users_event_usp[]" type="text" value="" data-parsley-required="true" data-parsley-maxlength="190"/>
                        <div class="input-group-append">
                            <button class="btn btn-danger jsUSPDelete" type="button">Удалить</button>
                        </div>
                    </div>
                `);
            });

            $(document).on('click', '.jsUSPDelete', function(){
                $(this).parents('.input-group').remove();
            });

            function refreshUspsList(is_select_changed) {
                var event_format_id = $('#event_format_id').val();

                $('.usps_list .checkbox').hide();
                $('.usps_list .checkbox[data-format-id="' + event_format_id + '"], .usps_list .checkbox[data-format-id="-1"]').show();

                if (is_select_changed) {
                    $('.usps_list .checkbox input[type="checkbox"]').prop('checked', false);
                    $('.usps_list .checkbox[data-format-id="-1"] input[type="checkbox"]').prop('checked', true);
                }
            }

        })();
    </script>
@endpushonce