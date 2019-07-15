<div class="form-group row">
    {!! Form::label('link', $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <div class="input-group">
            <span class="input-group-addon">https://youtu.be/</span>
            {!! Form::text('link', isset($item) ? str_replace('https://www.youtube.com/embed/', '', $item->link) : '', ['class' => 'form-control', 'data-parsley-required' => 'true', 'data-parsley-maxlength' => 190, 'placeholder' => 'Введите значение...']) !!}
        </div>
    </div>
</div>

@pushonce('js:link')
    <script>
        (function(){
            $('[name="link_type"]').change(function(){
                refreshAddon();
            });
            refreshAddon();

            function refreshAddon() {
                let link_type = +$('[name="link_type"]').val();
                if (link_type == 1) {
                    $('[name="link"]').parents('.input-group').find('.input-group-addon').show();
                } else {
                    $('[name="link"]').parents('.input-group').find('.input-group-addon').hide();
                }
            }
        })();
    </script>
@endpushonce