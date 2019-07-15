@if (session()->has('message'))
    <script>
        swal({
            title: "Готово!",
            text: "{{session()->get('message')}}",
            showCancelButton: false,
            icon: 'success',
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
    </script>
@endif