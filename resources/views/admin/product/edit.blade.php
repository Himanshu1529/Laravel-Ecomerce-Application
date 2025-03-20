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
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol> -->
            <a href="{{url('admin/product/list')}}" class="btn btn-danger">Back</a>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label >Product Title<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="{{ old('title',$product->title) }}" required="" name="title" placeholder="Enter Product Title">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label >SKU<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="{{ old('sku',$product->sku) }}" required="" name="sku" placeholder="SKU">
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category<span style="color: red">*</span></label>
                        <select id="ChangeCategory" class="form-control" name="category_id">
                          <option value="">Select Category</option> 
                          @foreach($getCategory as $value)
                          <option {{ ($product->category_id ==$value->id) ? 'selected' : ''  }} value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sub Category<span style="color: red">*</span></label>
                        <select id="getSubCategory" class="form-control" name="sub_category_id">
                          <option value="">Select Sub Category</option>
                          @foreach($get_sub_category as $value)
                          <option {{ ($product->sub_category_id ==$value->id) ? 'selected' : ''  }} value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Brand<span style="color: red">*</span></label>
                        <select class="form-control" name="brand_id">
                          <option value="">Select Sub Category</option>
                          @foreach($getBrand as $brand)
                          <option {{ ($product->brand_id ==$brand->id) ? 'selected' : ''  }} value="{{$brand->id}}">{{$brand->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label >Color<span style="color: red">*</span></label>
                          <div>
                          @foreach($getColor as $color)

                            @php
                              $checked = '';
                            @endphp

                            @foreach($product->getColor as $pcolor)
                            @if($pcolor->color_id == $color->id)

                              @php
                                $checked = 'checked';
                              @endphp
                            @endif

                            @endforeach

                            <label><input {{$checked}} type="checkbox" value="{{$color->id}}" name="color_id[]">{{$color->name}}</label>
                          @endforeach
                          </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label >Size<span style="color: red">*</span></label>
                        <div>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="AppendSize">
                              @php
                                $i_s = 1;
                              @endphp
                              @foreach($product->getSize as $size)
                              <tr id="DeleteSize{{$i_s}}">
                                <td><input type="text" placeholder="Name" value="{{$size->name}}" class="form-control" name="size[{{$i_s}}][name]"></td>
                                <td><input type="text" placeholder="Price" value="{{$size->price}}" class="form-control" name="size[{{$i_s}}][price]"></td>
                                <td style="width: 100px">
                                  <button class="btn btn-danger DeleteSize" id="{{$i_s}}" type="button">Delete</button>
                                </td>
                              </tr>
                              @php
                                $i_s++;
                              @endphp
                              @endforeach
                              <tr>
                                <td><input type="text" placeholder="Name" class="form-control" name="size[100][name]"></td>
                                <td><input type="text" placeholder="Price" class="form-control" name="size[100][price]"></td>
                                <td style="width: 100px">
                                  <button class="btn btn-primary AddSize" type="button">Add</button>
                                </td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label >Price<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="{{!empty($product->price) ? $product->price : ''}}" required="" name="price" placeholder="Price">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label >Old Price<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="{{!empty($product->old_price) ? $product->old_price : ''}}" required="" name="old_price" placeholder="Old Price">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label >Image<span style="color: red">*</span></label>
                        <input type="file" name="image[]" multiple="" class="form-control" style="padding: 5px" accept="image/*">
                      </div>
                    </div>
                  </div>

                  @if(!empty($product->getImage->count()))
                    <div class="row" id="sortable">
                      @foreach($product->getImage as $image)
                        @if(!empty($image->getLogo()))
                          <div class="col-md-1 sortable_image" id="{{$image->id}}" style="text-align: center;">
                            <img style="width: 100px;height: 100px;padding: 5px" src="{{ $image->getLogo() }}">
                            <a onclick="return confirm('Are you sure you want to Delete?');" href="{{url('admin/product/image_delete/'.$image->id)}}" class="mt-2 btn btn-danger btn-sm">Delete</a>
                          </div>
                        @endif
                      @endforeach
                    </div>
                  @endif
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label >Short Description<span style="color: red">*</span></label>
                        <textarea name="short_description" class="form-control" placeholder="Short Description">{{$product->short_description}}</textarea>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-outline card-info">
                        <div class="card-header">
                          <h3 class="card-title">
                            Description
                          </h3>
                        </div>
                        <div class="card-body">
                          <textarea  name="description" class="form-control editor"  placeholder="Description">{{$product->description}}</textarea>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  


                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-outline card-info">
                        <div class="card-header">
                          <h3 class="card-title">
                            Additional Information
                          </h3>
                        </div>
                        
                        <div class="card-body">
                          <textarea  name="additional_info" class="form-control editor" placeholder="Additional Information">{{$product->additional_info}}</textarea>
                        </div>
                      </div>
                    </div>
                    
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-outline card-info">
                        <div class="card-header">
                          <h3 class="card-title">
                           Shipping Returns
                          </h3>
                        </div>
                        
                        <div class="card-body">
                          <textarea  name="shipping_returns" class="form-control editor"  placeholder="Shipping Returns">{{$product->shipping_returns}}</textarea>
                        </div>
                      </div>
                    </div>
                    
                  </div>


                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label >Status<span style="color: red">*</span></label>
                        <select class="form-control" required="" name="status">
                          <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Active</option>
                          <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  


                  
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable({
      update : function(event,ui){
          var photo_id = new Array();
          $('.sortable_image').each(function(){
              var id = $(this).attr('id');
              photo_id.push(id);
          });
          $.ajax({
            type: "POST",
            url: "{{ url('admin/product_image_sortable') }}",
            data: {
              "photo_id": photo_id,
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
              
            },
            error: function(data) {
              console.error('Error:', data);
            }
          });
      }
    });
  });
  </script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '#ChangeCategory', function(e) {
      var id = $(this).val();

      $.ajax({
        type: "POST",
        url: "{{ url('admin/get_sub_category') }}",
        data: {
          "id": id,
          "_token": "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function(data) {
          $('#getSubCategory').html(data.html);
        },
        error: function(data) {
          console.error('Error:', data);
        }
      });
    });
  });
</script>
<script>
  var i = 101;
  $('body').delegate('.AddSize','click',function(){
    var html = '<tr id="DeleteSize'+i+'">\n\
                    <td><input type="" placeholder="Name" class="form-control" name="size['+i+'][name]"></td>\n\
                    <td><input type="" placeholder="Price" class="form-control" name="size['+i+'][price]"></td>\n\
                    <td>\n\
                      <button id="'+i+'" class="btn btn-danger DeleteSize" type="button">Delete</button>\n\
                    </td>\n\
                </tr>';
    i++;
    $('#AppendSize').append(html);
  });

   $('body').delegate('.DeleteSize','click',function(){
    var id = $(this).attr('id');
    $('#DeleteSize'+id).remove();

   });

</script>
<script>
  $(function () {
    // Summernote
    $('.editor').summernote({
      height: 250

    });
  }) 

  
</script>

@endsection