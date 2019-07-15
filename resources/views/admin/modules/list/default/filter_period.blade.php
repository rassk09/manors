<div class="btn-group pull-left m-r-10 m-b-20">
    <form id="default-daterange">
        <button type="button" class="btn btn-white dropdown-toggle" id="default-daterange">
            <i class="fa fa-calendar m-r-5"></i> {{ request('date_start') && request('date_end') ? date('d.m.Y', strtotime(request('date_start'))).' - '.date('d.m.Y', strtotime(request('date_end'))) : $filter->getTitle() }}
            <input type="hidden" name="daterange" value="" />
        </button>
        <input type="hidden" name="params" value="{!! http_build_query($filter->getRequestWithoutThis(['page', 'date_start', 'date_end'])) !!}" />
    </form>
</div>

@push('custom_js')
    <script>
        $('#default-daterange').daterangepicker({
            opens: 'left',
            format: 'DD.MM.YYYY',
            separator: ' to ',
        @if (request('date_start') && request('date_end'))
            startDate: '{{date('d.m.Y', strtotime(request('date_start')))}}',
            endDate: '{{date('d.m.Y', strtotime(request('date_end')))}}',
        @endif
            minDate: '01.01.2012',
            maxDate: '31.12.2028',
            locale: {
                direction: 'ltr',
                format: 'DD.MM.YYYY',
                separator: ' - ',
                applyLabel: 'Применить',
                cancelLabel: 'Отмена',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData().firstDayOfWeek()
            }
        },
        function (start, end) {
            var params = $('[name="params"]').val();
            var url = '';
            if (params) url = '?' + params + '&date_start=' + start.format('YYYY-MM-DD') + '&date_end=' + end.format('YYYY-MM-DD');
            else url = '?date_start=' + start.format('YYYY-MM-DD') + '&date_end=' + end.format('YYYY-MM-DD');

            window.location.href = url;
        });
    </script>
@endpush
