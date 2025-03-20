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
            <h1>Edit Shipping Charges</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol> -->
            <a href="{{url('admin/shipping_charge/list')}}" class="btn btn-danger">Back</a>
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
                    <label >Name<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" required="" name="name" placeholder="Enter  Name">
                  </div>


                  <div class="form-group">
                    <label >Price<span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('price',$getRecord->price) }}" required="" name="price" placeholder="Enter Price">
                  </div>
                  
                  
                  <div class="form-group">
                    <label >Status<span style="color: red">*</span></label>
                    <select class="form-control" required="" name="status">
                      <option  {{ (old('status',$getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option  {{ (old('status',$getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
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