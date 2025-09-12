<div class="custom-table-row d-flex justify-content-between {{$special ? 'special' : ''}}">
    <div class="px-3">
        <div><small>{{$topLeft}}</small></div>
        <div>{{$bottomLeft}}</div>
    </div>
    <div class="text-right flex-shrink-0 px-3">
        <div><small>{{$expired ? 'isteklo' : ''}} {{$topRight}}</small></div>
        <div>{{$bottomRight}}</div>
    </div>
</div>