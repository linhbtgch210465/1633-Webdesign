@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">

      <div class="form-group">
        <label for="menu">Name Animal Class</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Enter category name">
      </div>

      <div class="form-group">
        <label>Animal Class</label>
        <select class="form-control" name='parent_id'>
            <option value="0">Parent Animal Class</option>
            @foreach($menus as $menu)
                <option value="{{$menu->id}}">{{$menu->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Describe</label>
        <textarea name="description" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="content" id="content" class="form-control"></textarea>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Create Animal Class</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection