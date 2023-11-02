@extends('layouts.app')

@section('content-header', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-md-12">
  <div class="card card-primary">
  <div class="card-header info">
  <h3 class="card-title">Dashboard</h3>
</div>
</div>
</div>
</div>


<div class="container-fluid">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

      {{ __('Kamu login sebagai') }}  <b> {{ Auth::user()->name }} </b> <b>
    @if(Auth::user()->role === "1")
        (Admin)
    @elseif(Auth::user()->role === "2")
        (Kasir)
    @elseif(Auth::user()->role === "3")
        (Menunggu Persetujuan)
    @else
        (Peran Tidak Dikenal)
    @endif</b>
    </div>

    @if (Auth::user()->role == 1 )
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
              <h4>{{$orders_count}}</h4>
            <p>Total Transaksi</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <div class="small-box">
          <a href="/orders" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
              <h4>{{config('settings.currency_symbol')}} {{number_format($income, 2)}}</h4>
            <p>Pemasukan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/orders" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h4>{{$products_count}}</h4>
            <p>Total Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-pricetags"></i>
          </div>
          <a href="/products" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
</div>
@endif

@if (Auth::user()->role == 2 )
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
              <h4>{{$orders_count}}</h4>
            <p>Total Transaksi</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <div class="small-box">
          <a href="/orders" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
              <h4>{{config('settings.currency_symbol')}} {{number_format($income, 2)}}</h4>
            <p>Pemasukan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/orders" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h4>{{$products_count}}</h4>
            <p>Total Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-pricetags"></i>
          </div>
          <a href="/products" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
</div>
@endif

@if (Auth::user()->role == 3 )
  <div class="alert alert-warning" role="alert">
    Akunmu sedang menunggu persetujuan Admin
  </div>
@endif
 <div>
  <canvas id="myChart" style="max-width: 2000px; max-height: 400px"></canvas></div>
</div>
@endsection


@if (Auth::user()->role == 1 || Auth::user()->role == 2)
@push ('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  const orders_count = {{ $orders_count }};
  const income = {{ $income }};
  const products_count = {{ $products_count }};

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Transaksi', 'Pemasukan', 'Produk'],
      datasets: [{
        label: ['Transaksi', 'Pemasukan', 'Produk'],
        data: [orders_count, income, products_count],
        backgroundColor: ['rgb(66, 188, 245)', 'rgb(1, 143, 6)', 'rgb(235, 5, 5)'],
        borderColor: 'rgb(0, 0, 0)',
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endpush
@endif