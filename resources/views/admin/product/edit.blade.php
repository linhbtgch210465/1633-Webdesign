@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Animal name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"  placeholder="Input product name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Animal Class</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $product->menu_id === 
                                $menu->id ?  'selected' : ''}}> {{$menu->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Cost</label>
                        <input type="number" name="price" value="{{ $product->price }}"  class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Reduced Price</label>
                        <input type="number" name="price_sale" value="{{ $product->price_sale }}"  class="form-control" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Describe </label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Image Animal</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $product->thumb }}" target="_blank"> <img src="{{ $product->thumb }}" width="100px"> </a>

                </div>
                <input type="hidden" name="thumb" value="{{ $product->thumb }}" id="thumb">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Edit Animal</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection