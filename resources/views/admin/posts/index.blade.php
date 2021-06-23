@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    {{Form::open([
        'route' => 'posts.store',
        'file' => true
        ])}}
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
              @include('admin.errors')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Категория</th>
                  <th>Теги</th>
                  <th>Картинка</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($posts as $post)
                  <td>{{$post->id}}</td>
                  <td>{{$post->title}}</td>
                  <td>{{$post->getCategoryTitle()}}</td>
                  <td>{{$post->getTagsTitles()}}</td>
                  <td>
                    <img src="{{$post->getImage()}}" alt="" width="100">
                  </td>
                  <td><a href="{{route('posts.edit' , $post->id)}}" class="fa fa-pencil">
                  {!! Form::open(['route' =>['posts.destroy' , $post->id], 'method'=>'delete']) !!}
                      <button onclick='return confirm("are you sure ?")' class='delete' type='submit'>
                        <i class="fa fa-remove"></i></td>
                      </button>    
                      {!! Form::close() !!}
                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection