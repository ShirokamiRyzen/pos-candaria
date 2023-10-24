@extends('layouts.app')

@section('content-header', 'List Akun')

@section('content')

       <div class="row">
<div class="col-md-12">
<div class="card card-primary">
<div class="card-header info">
<h3 class="card-title">List Akun</h3>
</div>
            <!-- /.card-header -->
 <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Nama</th>               
<th>email</th>  
<th>Izin</th> 
<th>Aksi</th>                  
</tr>
</thead>
<tbody>
@foreach($list as $row)
<tr>
<td>{{ $row->id }}</td>
<td>{{ $row->name }}</td>
<td> {{ $row->email }} </td>
<td> 
       @php 


if($row->role==1)
{
       echo 'Admin';
}
if($row->role==2)
{
       echo 'Kasir';
}
if($row->role==3)
{
       echo 'Pending';
}

@endphp 

</td>
<td class="d-flex" style="gap: 5px">
       <a href="{{ URL::to('/edit_user/'.$row->id) }}" class="btn btn-sm btn-primary"><i
               class="fas fa-edit"></i></a>
       <button class="btn btn-sm btn-danger btn-delete" href="{{ URL::to('delete_user/'.$row->id) }}" id="delete"><i
               class="fas fa-trash"></i></button>
               @if($row->role == 3)
        <form action="{{ URL::to('/change_role/'.$row->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i>&nbsp;Izinkan</button>
        </form>
    @endif
</td>
</tr>
@endforeach

</tbody>
       </table>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        </div>

            @endsection