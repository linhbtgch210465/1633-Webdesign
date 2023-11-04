@extends('viewmain')
@section('content')
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @include('products.list')
        </div>
    </div>
</div>
@endsection