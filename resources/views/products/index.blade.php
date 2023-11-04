@extends('viewmain')
@section('content')
    @php
        $title = 'All Products';
    @endphp
    @include('products.list')
@endsection
