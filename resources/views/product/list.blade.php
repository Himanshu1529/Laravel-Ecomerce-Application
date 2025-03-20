@extends('layouts.app')
@section('style')
<style>
	.active-color{
		border: 2px solid black;
	}
</style>
@endsection
@section('content')


		<main class="main">
        	<div class="page-header text-center" style="background-image: url('client/images/page-header-bg.jpg')">
        		<div class="container">

        			@if(!empty($getSubCategory))
        			<h1 class="page-title">{{ $getSubCategory->name }}<!-- <span>Shop</span> --></h1>
        			@elseif(!empty($getCategory))
        			<h1 class="page-title">{{ $getCategory->name }}<!-- <span>Shop</span> --></h1>
                    @else
                    <h1 class="page-title">Search for {{ Request::get('q') }}</h1>
        			@endif
        			

        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                        @if(!empty($getSubCategory))
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{url($getCategory->slug)}}">{{ $getCategory->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $getSubCategory->name }}</li>
                        @elseif(!empty($getCategory))
                        <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->name }}</li>
                        @endif
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
                				<div class="toolbox-left">
                					<div class="toolbox-info">
                						Showing <span>{{ $getProduct->total() }} of {{$getProduct->perPage()}} </span> Products
                					</div><!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control changeSortBy">
												<option value="">Select</option>
												<option value="popularity">Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div>
                					
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->

                            <div id="getProductAjax">
                            	@include('product._list');
                            </div>

                		</div><!-- End .col-lg-9 -->
                		<aside class="col-lg-3 order-lg-first">
                			<form action="" id="FilterForm" method="post">
                				{{ csrf_field() }}

                                <input type="hidden" name="q" value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}">
                                
                                <input type="hidden" name="old_category_id" value="{{ !empty($getCategory) ? $getCategory->id : '' }}">
                                <input type="hidden" name="old_sub_category_id" value="{{ !empty($getSubCategory) ? $getSubCategory->id : '' }}">

                				<input type="hidden" name="sub_category_id" id="get_sub_category_id">
                				<input type="hidden" name="brand_id" id="get_brand_id">
                				<input type="hidden" name="color_id" id="get_color_id">
                				<input type="hidden" name="sort_by_id" id="get_sort_by_id">
                                <input type="hidden" name="start_price" id="get_start_price">
                                <input type="hidden" name="end_price" id="get_end_price">
                			</form>
                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                					<label>Filters:</label>
                					<a href="#" class="sidebar-filter-clear">Clean All</a>
                				</div><!-- End .widget widget-clean -->
                                @if(!empty($getSubCategoryFilter))
                    				<div class="widget widget-collapsible">
        								<h3 class="widget-title">
    									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
    									        Category
    									    </a>
    									</h3><!-- End .widget-title -->

    									<div class="collapse show" id="widget-1">
    										<div class="widget-body">
    											<div class="filter-items filter-items-count">
    												@foreach($getSubCategoryFilter as $f_category)
    												<div class="filter-item">
    													<div class="custom-control custom-checkbox">
    														<input type="checkbox" value="{{$f_category->id}}" class="custom-control-input changeCategory" id="cat-{{$f_category->id}}">
    														<label class="custom-control-label" for="cat-{{$f_category->id}}">{{$f_category->name}}</label>
    													</div>
    													<span class="item-count">{{$f_category->TotalProduct()}}</span>
    												</div>
    												@endforeach

    												
    											</div><!-- End .filter-items -->
    										</div><!-- End .widget-body -->
    									</div><!-- End .collapse -->
            						</div><!-- End .widget -->
                                @endif

        						<!-- <div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
									        Size
									    </a>
									</h3>

									<div class="collapse show" id="widget-2">
										<div class="widget-body">
											<div class="filter-items">
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-1">
														<label class="custom-control-label" for="size-1">XS</label>
													</div>
												</div>

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-2">
														<label class="custom-control-label" for="size-2">S</label>
													</div>
												</div>

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" checked id="size-3">
														<label class="custom-control-label" for="size-3">M</label>
													</div>
												</div>

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" checked id="size-4">
														<label class="custom-control-label" for="size-4">L</label>
													</div>
												</div>

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-5">
														<label class="custom-control-label" for="size-5">XL</label>
													</div>
												</div>

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-6">
														<label class="custom-control-label" for="size-6">XXL</label>
													</div>
												</div>
											</div>
										</div>
									</div>
        						</div> -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
									        Colour
									    </a>
									</h3>

									<div class="collapse show" id="widget-3">
										<div class="widget-body">
											<div class="filter-colors">
												@foreach($getColor as $f_color)
													<a href="javascript:;" class="changeColor" data-val="0" id="{{ $f_color->id }}" style="background:{{$f_color->code}};"><span class="sr-only">{{$f_color->name}}</span></a>
												@endforeach
											</div>
										</div>
									</div>
        						</div>

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-4">
									    <div class="widget-body">
									        <div class="filter-items">
									            @foreach($getBrand as $f_brand)
									                <div class="filter-item">
									                    <div class="custom-control custom-checkbox">
									                        <input type="checkbox" class="custom-control-input changeBrand" value="{{ $f_brand->id }}" id="brand-{{ $f_brand->id }}">
									                        <label class="custom-control-label" for="brand-{{ $f_brand->id }}">{{ $f_brand->name }}</label>
									                    </div>
									                </div>
									            @endforeach
									        </div>
									    </div>
									</div>
        						</div>

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
									        Price
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-5">
										<div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
                                                    Price Range:
                                                    <span id="filter-price-range"></span>
                                                </div><!-- End .filter-price-text -->

                                                <div id="price-slider"></div><!-- End #price-slider -->
                                            </div><!-- End .filter-price -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@section('script')
	<script src="{{ url('client/js/wNumb.js')}}"></script>
    <script src="{{ url('client/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{ url('client/js/nouislider.min.js')}}"></script>
    <script>

    	$('.changeSortBy').change(function() {
    		var ids = $(this).val();
    		
    		$('#get_sort_by_id').val(ids);
    		FilterForm();
    	});


    	$('.changeCategory').change(function() {
    		var ids = '';
    		$('.changeCategory').each(function() {
    			if (this.checked) {
    				var id = $(this).val();
    				ids += id+',';
    			}
    		});
    		$('#get_sub_category_id').val(ids);
    		FilterForm();
    	});

    	$('.changeBrand').change(function() {
    		var ids = '';
    		$('.changeBrand').each(function() {
    			if (this.checked) {
    				var id = $(this).val();
    				ids += id+',';
    			}
    		});
    		$('#get_brand_id').val(ids);
    		FilterForm();
    	});


    	$('.changeColor').click(function() {
    		var id = $(this).attr('id');
    		var status = $(this).attr('data-val');
    		if (status == 0) {
    			$(this).attr('data-val',1);
    			$(this).addClass('active-color');
    		}
    		else{
    			$(this).attr('data-val',0);
    			$(this).removeClass('active-color');
    		}
    		var ids = '';
    		$('.changeColor').each(function() {
    			var status = $(this).attr('data-val');
    			if (status == 1) {
    				var id = $(this).attr('id');
    				ids += id+',';
    			}
    		});
    		$('#get_color_id').val(ids);
    		FilterForm();
    	});

        var xhr;
    	function FilterForm() {

            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
		    xhr = $.ajax({
		        type: "POST",
		        url: "{{ url('get_filter_product_ajax') }}",
		        data: $('#FilterForm').serialize(),
		        dataType: "json",
		        success: function(data) {
		            // Check if 'success' property exists in the data object
		            if (data && data.success) {
		                $('#getProductAjax').html(data.success);
		            } else {
		                // Handle the case where 'success' property is missing or false
		                console.error("Unexpected response format:", data);
		            }
		        },
		        error: function(xhr, status, error) {
		            // Handle AJAX errors
		            console.error("AJAX Error:", status, error);
		        }
		    });
		}


    var i = 0;
    if ( typeof noUiSlider === 'object' ) {
        var priceSlider  = document.getElementById('price-slider');

        noUiSlider.create(priceSlider, {
            start: [ 0, 2999 ],
            connect: true,
            step: 50,
            margin: 200,
            range: {
                'min': 0,
                'max': 10000
            },
            tooltips: true,
            format: wNumb({
                decimals: 0,
                prefix: '₹'
            })
        });

        
        priceSlider.noUiSlider.on('update', function( values, handle ){
            var start_price = values[0];
            var end_price = values[1];
            $('#get_start_price').val(start_price)
            $('#get_end_price').val(end_price)
            $('#filter-price-range').text(values.join(' - '));
            if (i == 0 || i == 1) 
            {
                i++;
            }
            else
            {
                FilterForm();
            }
        });
    }

    </script>
@endsection

@endsection