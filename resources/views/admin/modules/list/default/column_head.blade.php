@if ($column->isSortable())
    <a href="?{!! http_build_query(request()) !!}&order={!! $column->getOrderBy() !!}{!! adminGetDirectionByOrder($column->getOrderBy()) !!}">
        <i class="fa fa-sort{{ adminGetDirectionIconByOrder($column->getOrderBy()) }}"></i>
        {!! $column->getTitle() !!}
    </a>
@else
    {!! $column->getTitle() !!}
@endif