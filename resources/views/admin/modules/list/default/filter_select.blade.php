<!-- begin dropdown -->
<div class="dropdown pull-left m-r-10 m-b-20">
    <a href="javascript:;" class="btn btn-white btn-white-without-border dropdown-toggle" data-toggle="dropdown">
        @if ($filter->isActiveFilter())
            {!! $filter->getValueName() !!}
        @else
            {!! $filter->getTitle() !!}
        @endif
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="/{!! request()->path() !!}?{!! http_build_query($filter->getRequestWithoutThis(['page'])) !!}">{!! $filter->getTitleAll() !!}</a></li>
        @foreach($filter->getValues() as $value => $name)
            <li>
                <a href="/{!! request()->path() !!}?{!! http_build_query($filter->getRequestWithoutThis(['page'])) !!}&filter[{{$filter->getAttribute()}}]={{$value}}">{!! $name !!}</a>
            </li>
        @endforeach
    </ul>
</div>
<!-- end dropdown -->