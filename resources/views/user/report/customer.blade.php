@extends('layouts/userMaster')

@section('title', 'Report')

@section('content')
  <h1>Report By Customer</h1>

  <table>
    <th>No</th>
    <th>Customer</th>
    <th>Amount</th>
    @php
      $i = 1;
      $total = 0;
    @endphp
  @foreach ($customers as $customer)
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->total }}</td>
        @php
          $total = $customer->total + $total;
          $i++;
        @endphp
    </tr>
  @endforeach
  <tr>
    <td>Total</td>
    <td>{{ $total }}</td>
  </tr>
  </table>
  <form class="" action="/sales_order/create" method="get">
    <input type="submit" name="submit" value="tambah sales order">
  </form>

@endsection
