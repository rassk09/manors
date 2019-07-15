<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8" data-engine-tabs>
        <button type="button" class="btn {{ isset($item) && $item->hasType(1) ? 'btn-success' : 'btn-default' }}" data-type-id="1" data-rows="image|link_text|text|category">Свежие новости</button>
        <button type="button" class="btn {{ isset($item) && $item->hasType(2) ? 'btn-success' : 'btn-default' }}" data-type-id="2" data-rows="category">Темы</button>
        <button type="button" class="btn {{ isset($item) && $item->hasType(3) ? 'btn-success' : 'btn-default' }}" data-type-id="3" data-rows="image|link_text">Сегодня</button>
        <button type="button" class="btn {{ isset($item) && $item->hasType(4) ? 'btn-success' : 'btn-default' }}" data-type-id="4" data-rows="image">Видео</button>
        <button type="button" class="btn {{ isset($item) && $item->hasType(5) ? 'btn-success' : 'btn-default' }}" data-type-id="5" data-rows="image|link_text">Лайфстайл</button>
        <button type="button" class="btn {{ isset($item) && $item->hasType(6) ? 'btn-success' : 'btn-default' }}" data-type-id="6" data-rows="image|link_text|category|price">Товары</button>
        {!! Form::hidden('engine', null) !!}
    </div>
</div>



@pushonce('js:engine')
    <script>
        (function(){
            let formData = $('form').serializeObject(),
                id = $('[name="id"]').val(),
                shown = 'id|created_at|updated_at|name|link|link_type|engine|is_active';

            refreshFields();

            $('[data-engine-tabs] button').click(function(){
                $(this).toggleClass('btn-default');
                $(this).toggleClass('btn-success');

                refreshFields();
            });

            function refreshFields() {
                let fields = [shown];

                $('.form-group.row').hide();
                $('[data-engine-tabs] button.btn-success').each(function(){
                    fields.push($(this).attr('data-rows'));
                });

                let shown_fields = fields.join('|').split('|').filter(onlyUnique);
                $.each(shown_fields, function(key, field){
                    if (field == 'image') {
                        $('.drop-area').parents('.form-group.row').show();
                    } else {
                        $('[name="' + field + '"]').parents('.form-group.row').show();
                    }
                });

                let types = [];
                $('[data-engine-tabs] .btn-success').each(function(){
                    types.push($(this).attr('data-type-id'));
                });

                $('[name="engine"]').val(types.join(','));
            }

            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }

        })();
    </script>
@endpushonce