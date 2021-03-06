@extends('layouts/adminMaster')

@section('title', 'Subscriptions')

@section('headline', 'Subscriptions')

@section('content')

  @if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
  @endif

  @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="btn-atas">
    <a href="/admin/subscription/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New</a>
  </div>

  <table class="table">
    <thead>
      <th>#</th>
      <th>Package Name</th>
      <th>Price</th>
      <th>Items Quota</th>
      <th>Invoices Quota</th>
      <th>Employees Quota</th>
      <th>Action</th>
    </thead>
    <tbody>
      @php
        $i = 1;
      @endphp

      @foreach ($subscriptions as $subscription)
       <tr>
         <th scope="row">{{ $i }}</th>
         <td><a class="btn" href="/admin/subscription/{{ $subscription['id'] }}">{{ $subscription['name'] }}</a></td>
         <td>Rp.{{ number_format($subscription['price'],2,",",".") }}</td>
         @if ($subscription['num_items'] === null)
           <td><i class="fas fa-infinity"></i></td>
         @else
           <td>{{ number_format($subscription['num_items'], 0, ",", ".") }}</td>
         @endif

         @if ($subscription['num_invoices'] === null)
           <td><i class="fas fa-infinity"></i></td>
         @else
           <td>{{ number_format($subscription['num_invoices'], 0, ",", ".") }}</td>
         @endif

         @if ($subscription['num_users'] === null)
           <td><i class="fas fa-infinity"></i></td>
         @else
           <td>{{ number_format($subscription['num_users'], 0, ",", ".") }}</td>
         @endif
         <td>
           <div class="row">
             <div class="col text-right btn-kiri">
               <a href="/admin/subscription/{{ $subscription['id'] }}/edit" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
             </div>
             <div class="col text-left btn-kanan">
               <form class="" action="/admin/subscription/{{ $subscription['id'] }}/delete" method="post">
                 {{ method_field('DELETE') }}
                 <button onclick="return confirm('Are You Sure Wanna Delete Package {{ $subscription['name'] }}')" class="btn btn-outline-danger" type="submit" name="submit"><i class="fas fa-trash-alt"></i></button>
                 {{ csrf_field() }}
               </form>
             </div>
           </div>
         </td>
       </tr>
       @php
         $i++;
       @endphp
     @endforeach
    </tbody>
  </table>

@endsection
