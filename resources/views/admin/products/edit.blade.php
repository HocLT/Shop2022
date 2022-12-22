@extends('admin.layout.layout')

@section('contents')

<section class="content">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Products</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ Route('admin.product.update', $product->id) }}" method="POST" 
enctype="multipart/form-data">
      @csrf
      @method('put')
      <input type="hidden" name="id" value="{{ $product->id }}"/> 
      <div class="card-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input class="form-control" id="name" name="name" placeholder="Enter Product name" value="{{ $product->name }}">
        </div>
        <div class="form-group">
          <label for="short_desc">Short Description</label>
          <input class="form-control" id="short_desc" name="short_desc" placeholder=""  value="{{ $product->short_desc }}">
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input class="form-control" id="price" name="price" placeholder="Enter Product price"  value="{{ $product->price }}">
        </div>
        <div class="form-group">
          <label for="desc">Description</label>
          <textarea class="form-control" name="desc" id="desc" cols="30" rows="5">{{ $product->desc }}</textarea>
        </div>
        @if ($product->image != null && $product->image != '')
        <div class="form-group">
        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width:300px; height:auto;">
        </div>
        @endif
        <div class="form-group">
          <label for="image">Image</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="photo" id="image">
              <label class="custom-file-label" for="image">Choose image</label>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div>
          </div>
        </div>
        
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</section>
@endsection