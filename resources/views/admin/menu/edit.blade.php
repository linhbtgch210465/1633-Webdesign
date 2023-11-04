@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">

      <div class="form-group">
        <label for="menu">Name Animal Class</label>
        <input type="text" name="name" value="{{$menu->name}}" class="form-control" id="menu" placeholder="Enter category name">
      </div>

      <div class="form-group">
        <label>Category</label>
        <select class="form-control" name='parent_id'>
            <option value="0" {{$menu->parent_id == 0 ? 'selected' : '' }}>Parent Category</option>
            @foreach($menus as $menuParent)
                <option value="{{$menuParent->id}}"
                    {{$menu->parent_id == $menuParent->id ? 'selected' : '' }}>
                    {{$menu->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Describe</label>
        <textarea name="description" class="form-control">{{$menu->description}}</textarea>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="content" id="content" class="form-control">{{$menu->description}}</textarea>
      </div>
        
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Update Animal Class</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection
