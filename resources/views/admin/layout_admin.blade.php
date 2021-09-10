<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>ADMIN</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/upload/logo_mku_shortcut_icon.svg') }}" />

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/back_end/vendors/images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/back_end/vendors/images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/back_end/vendors/images/favicon-16x16.png') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/style.css') }}">
    {{-- sweetaler --}}
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/sweet.css') }}">
    <!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    {{-- sort table --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/sort_table/Contents/bootstrap-sortable.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/src/styles/custom.css') }}">
</head>
<body>
    {{-- HEADER --}}
	@include('admin.layout.header')

	{{-- RIGHT SIDE BAR --}}
    @include('admin.layout.right_side_bar')

	{{-- LEFT SIDE BAR --}}
    @include('admin.layout.left_side_bar')

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			@yield('container')
			@include('admin.layout.footer')
		</div>
	</div>
	<!-- js -->
	<script src="{{ asset('public/back_end/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/layout-settings.js') }}"></script>
	<script src="{{ asset('public/back_end/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('public/back_end/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/back_end/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('public/back_end/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('public/back_end/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/dashboard.js') }}"></script>
	{{-- sort table --}}
    <script src="{{ asset('public/back_end/sort_table/Scripts/bootstrap-sortable.js') }}"></script>

    {{-- custom script --}}
    <script src="{{ asset('public/back_end/src/scripts/upload_image.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/custom.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/upperFirstKey.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/address.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/find_ajax_admin.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/find_ajax_product.js') }}"></script>
    <script src="{{ asset('public/back_end/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/ckeditor_custom.js') }}"></script>
    {{-- sweetaler --}}
    <script src="{{ asset('public/font_end/custom/sweet.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- bootstrap-tagsinput js -->
	<script src="{{ asset('public/back_end/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/custom_order.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/discount_custom.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/find_ajax_process_comment.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/modal_process_comment.js') }}"></script>

    {{-- CKeditor --}}
    <script>
        CKEDITOR.replace('ck_admin_add_product_sort_desc');
        CKEDITOR.replace('ck_admin_add_product_desc',{
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
</body>
</html>
