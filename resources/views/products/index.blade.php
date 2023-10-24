@extends('layouts.app')

@section('content-header', 'List Produk')
@section('content-actions')
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Produk</li>
</ol>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="card card-primary">
    <div class="card-header info">
    <h3 class="card-title">Produk</h3>
</div>
</div>
</div>
</div>
<div class="card card-primary card-outline">
@if (Auth::user()->role == 1 )
<div class="card-header bg-white">
		<div>
		<a href="{{route('products.create')}}" class="btn text-white btn-primary">Tambah Produk</a>
		</div>
	</div>
@endif
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead style="background: #F4F6F9">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <!--<th>Image</th>-->
                    <th>Barcode</th>
                    <th>No Barcode</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                    <th>UoM</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
               {{-- @php 
                    $no = 1;
                @endphp --}}
                @foreach ($products as $product)
                <tr>
                    {{-- <td>{{$no++}}</td>--}}
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <!--<td><img class="product-img" src="{Storage::url($product->image) }}" alt=""></td>-->
                    <td>
                        {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->barcode, 'EAN13', 2, 100) . '" alt="barcode"   />'!!}
                    </td>
                    <td>{{$product->barcode}}</td>
                    <td class="text-nowrap">{{ config('settings.currency_symbol') }} {{number_format($product->price)}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{
                        \App\Models\Product::UOM[$product->uom] ?? ''
                    }}</td>
                    <td>
                        <span
                            class="right badge badge-{{ ($product->status==1) ? 'success' : 'danger' }}">{{($product->status==1) ? 'Tersedia' : 'Tidak Tersedia'}}</span>
                    </td>
                    <td class="d-flex" style="gap: 5px">
                        @if (Auth::user()->role == 1 )
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger btn-delete" href="{{ URL::to('delete_products/'.$product->id) }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                        @endif
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('.table-datatable').DataTable({
        "order": [[ 5, "desc" ]],
        columnDefs: [
            { width: '10%', targets: 0 },
            { width: '10%', targets: 1 },
            { width: '10%', targets: 2 },
            { width: '10%', targets: 3 },
            { width: '10%', targets: 4 },
            { width: '10%', targets: 5 },
            { width: '10%', targets: 6 },
            { width: '10%', targets: 7 },
            { width: '10%', targets: 8 },
            { width: '10%', targets: 9 },
        ],
        fixedColumns: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        });
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger mr-2'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection
