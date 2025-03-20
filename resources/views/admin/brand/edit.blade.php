@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Brand</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol> -->
            <a href="{{url('admin/brand/list')}}" class="btn btn-danger">Back</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form action="" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label >Brand Name<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" required="" name="name" placeholder="Enter Brand Name">
                  </div>

                  <div class="form-group">
                    <label >Slug<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('slug',$getRecord->slug) }}"  name="slug" placeholder="Slug">
                    <div style="color: red"><i>{{ $errors->first('slug') }}</i></div>
                  </div>
                  
                  <div class="form-group">
                    <label >Status<span style="color: red">*</span></label>
                    <select class="form-control" required="" name="status">
                      <option  {{ (old('status',$getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option  {{ (old('status',$getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label >Meta Title<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('meta_title',$getRecord->meta_title) }}"  name="meta_title" placeholder="Meta Title  ">
                  </div>

                  <div class="form-group">
                    <label >Meta Description<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('meta_description',$getRecord->meta_description) }}"  name="meta_description" placeholder="Meta Description">
                  </div>

                  <div class="form-group">
                    <label >Meta Keywords<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('meta_keywords',$getRecord->meta_keywords) }}"  name="meta_keywords" placeholder="Meta Keywords">
                  </div>
                  
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
</div>
@endsection
@section('script')

@endsection