@extends('admin.main')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th style="width: 150px">ID</th>
            <th>Animal Name</th>
            <th>Animal Class</th>
            <th>Price</th>
            <th>Sale Price</th>
            <th>Update At</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td>{{ $product ->id }}</td>
            <td>{{ $product ->name }}</td>
            <td>{{ $product ->menu->name }}</td>
            <td>{{ $product ->price }}</td>
            <td>{{ $product ->price_sale }}</td>
            <td>{{ $product ->updated_at }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route( 'product.edit', $product )}}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="{{ route( 'product.delete', $product->id )}}">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
            {{-- <td>
                <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a  class="btn btn-danger btn-sm" href="/admin/products/destroy/{{ $product->id }}">
                    <i class="fas fa-trash"></i>
                </a>
            </td> --}}
        </tr>
        @endforeach
    </tbody>
</table>

    <div class="card-footer clearfix">
        {!! $products->links() !!}
{!!$products->links()!!}
@endsection