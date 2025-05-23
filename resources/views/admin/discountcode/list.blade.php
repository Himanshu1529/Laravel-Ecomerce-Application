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
            <h1>Discount Code List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol> -->
            <a href="{{url('admin/discount_code/add')}}" class="btn btn-primary">Add New Discount Code</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('admin.layouts._message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Discount Code List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>Amount/Percent</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{$value->id}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->type}}</td>
                      <td>{{$value->percent_amount}}</td>
                      <td>{{date('d-m-Y',strtotime($value->expire_date))}}</td>
                      <td>{{($value->status == 0)? 'Active':'Inactive'}}</td>
                      <td>
                        <a href="{{ url('admin/discount_code/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('admin/discount_code/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                <div style="padding: 10px;float: right">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
</div>
@endsection
@section('script')

@endsection