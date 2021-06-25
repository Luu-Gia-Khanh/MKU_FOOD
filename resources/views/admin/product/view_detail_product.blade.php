@extends('admin.layout_admin')
@section('container')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Chi Tiết Sản Phẩm</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/all_product') }}">Danh sách sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="blog-wrap">
        <div class="container pd-0">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="blog-detail card-box overflow-hidden mb-30">
                        <div class="blog-img">
                            <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" height="376px" width="669px">
                        </div>
                        <div class="blog-caption">
                            <h4 class="mb-10">Mô tả ngắn sản phẩm</h4>
                            <p>{!! $product->product_sort_desc !!}</p>
                            <h5 class="mb-10">Mô tả sản phẩm</h5>
                            <p>{!! $product->product_desc !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card-box mb-30">
                        <h5 class="pd-20 h5 mb-0">Thông Tin</h5>
                        <div class="latest-post">
                            <ul>
                                <li>
                                    <h4><a href="#">Tên sản phẩm</a></h4>
                                    <span>{{ $product->product_name }}</span>
                                </li>
                                <li>
                                    <h4><a href="#">Loại sản phẩm</a></h4>
                                    <span>
                                        @foreach ($all_cate as $cate)
                                            @if ($cate->cate_id == $product->category_id)
                                                {{ $cate->cate_name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                                <li>
                                    <h4><a href="#">Giá sản phẩm</a></h4>
                                    <span>{{ number_format($product_price->price, 0, ',', '.') }} vnđ</span>
                                </li>
                                <li>
                                    <h4><a href="#">Số lượng trong kho</a></h4>
                                    <span>{{ $storage_product->total_quantity_product }}</span>
                                </li>
                                <li>
                                    <h4><a href="#">Đơn vị tính</a></a></h4>
                                    <span>
                                        @foreach ($all_unit as $unit)
                                            @if ($unit->unit_id == $product->unit_id)
                                                {{ $unit->unit_name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                                <li>
                                    <h4><a href="#">Kho</a></h4>
                                    <span>
                                        @foreach ($all_storage as $storage)
                                            @if ($storage->storage_id == $storage_product->storage_id)
                                                {{ $storage->storage_name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-box overflow-hidden">
                        <h5 class="pd-20 h5 mb-0">Ngày Thêm Sản Phẩm</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item d-flex align-items-center justify-content-between">
                                {{ date("d-m-Y H:i", strtotime($product->create_at)) }}
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
