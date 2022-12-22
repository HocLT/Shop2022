@extends('admin.layout.layout')

@section('contents')

<section class="content">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Products</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Products</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
      <thead>
        <tr>
          <th>Name</th>
          <th>Short Description</th>
          <th>Price</th>
          <th>Image</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($prods as $item) 
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->short_desc }}</td>
          <td>{{ $item->price }}</td>
          <td>
            <!-- kiểm tra trong db có image thì mới hiển thị -->
            @if ($item->image != null && $item->image != '')
            <img src="images/{{ $item->image }}" alt="{{ $item->name }}" style="width:100px; height:auto;">
            @endif
          </td>
          <td>
            <a class="btn btn-primary" href="{{ Route('admin.product.edit', $item->id) }}">Edit</a>
            <form action="{{ Route('admin.product.destroy', $item->id) }}" 
                        method="post" style="display: inline-block">
              @csrf
              @method('delete')
              <input type="submit" value="Delete" class="btn btn-danger"/>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection