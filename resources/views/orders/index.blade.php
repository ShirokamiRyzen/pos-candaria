@extends('layouts.app')

@section('title', 'Orders List')
@section('content-header', 'Sell Order List')
@section('content-actions')
    <!-- <a href="{{route('cart.index')}}" class="btn btn-primary">Open POS</a> -->
    <ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Sell Order</li>
</ol>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between">
        <div>
        <form action="{{route('orders.index')}}">
            <div class="d-flex" style="gap: 10px;">
                <div>
                    <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                </div>
                <div>
                    <h3>-</h3>
                </div>
                <div>
                    <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                </div>
                <div>
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>
        </div>
        <div>
        <a href="{{route('cart.index')}}" class="btn btn-primary">Transaksi Baru</a>
        <a class="btn btn-success" href="{{ route('orders.export') }}">Export Excel</a>
        </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-datatable">
        <thead style="background: #F4F6F9">
                <tr>
                    <th>No Invoice</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Uang Diterima</th>
                    <th>Status</th>
                    <th>Kembalian</th>
                    <th>Dibuat Pada</th>
					<th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{
                        'SO-' . $order->created_at->format('Y') . '/' . $order->created_at->format('dm') . '/' . str_pad($order->id, 4, '0', STR_PAD_LEFT)
                    }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $order->formattedTotal() }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Belum Dibayar</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Belum Lunas</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Uang Pas</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Kembalian</span>
                        @endif
                    </td>
                    <td>{{config('settings.currency_symbol')}} {{ number_format(abs($order->total() - $order->receivedAmount()), 2)}}</td>
                    <td>{{
                        // format to 10 Juni 2022
                        $order->created_at->isoFormat('D MMMM Y')
                    }}</td>
					<td>
					<a href="{{ route('orders.show', $order) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    </a>
                    @if (Auth::user()->role == 1 )
                    <button class="btn btn btn-danger btn-delete" href="{{ URL::to('delete_order/'.$order->id) }}" id="delete"><i
                        class="fas fa-trash"></i></button>
                    @endif
                    @if (Auth::user()->role == 2 )
                    <button class="btn btn btn-danger btn-delete" href="{{ URL::to('delete_order/'.$order->id) }}" id="delete" disabled><i
                        class="fas fa-trash"></i></button>
                    @endif
					</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    var table = $('.table-datatable').DataTable({
        "order": [[ 6, "desc" ]]
    });

    $(document).ready(function() {
        $("#export_button").click(function(e) {
            e.preventDefault();
            window.location.href = "{{ route('orders.export') }}";
        });
    });
</script>
@endsection

