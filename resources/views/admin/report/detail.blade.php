@extends('layouts/adminMaster')

@section('title', $subscription->name)

@section('content')

  @if (session()->has('success'))
    <div class="alert alert-danger">{{ session('success') }}</div>
  @endif

  <table class="table">
    <thead>
      <th>Package Name</th>
      <th>Price</th>
      <th>Invoices quota</th>
      <th>Contacts quota</th>
    </thead>
    <tbody>
      <tr>
        <td>{{ $subscription->name }}</td>
        <td>Rp.{{ number_format($subscription->price,2,",",".") }}</td>
        <td>{{ $subscription->num_invoices }}</td>
        <td>{{ $subscription->num_users }}</td>
      </tr>
    </tbody>
  </table>

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header text-center">
          <h4 class="my-0 font-weight-normal">payment</h4>
        </div>
      </div>
    </div>
  </div>
  <br>

  <table class="table">
    <thead>
      <th>#</th>
      <th>Date</th>
      <th>Uniq Code</th>
      <th>Store Name</th>
      <th>Owner</th>
      <th>Period</th>
      <th>Amount</th>
    </thead>
    <tbody>
      @php
        $i=1;
        $total = 0;
      @endphp
      @foreach ($payments as $payment)
        <tr>
          <th scope="row">{{ $i }}</th>
            <td>{{ date('d-m-Y', strtotime($payment->updated_at)) }}</td>
            <td>{{ $payment->uniq_code}}</td>
            {{-- mencari store name --}}
            @foreach ($stores as $store)
              @if ($store->id == $payment->store_id)
                <td><a class="btn" href="/admin/store/{{ $store->id }}">{{ $store->name }}</a></td>
                {{-- mencari user yang memiliki store --}}
                @foreach ($users as $user)
                    @if ($store->user_id == $user->id)
                      <td><a class="btn" href="/admin/user/{{ $store->user_id }}">{{ $user->name }}</a></td>
                    @endif
                @endforeach

              @endif
              {{-- mencari store --}}
            @endforeach
            <td>{{ $payment->period }}</td>
            <td>Rp.{{ number_format($payment->amount,2,",",".") }}</td>
        </tr>
        @php
          $total = $payment->amount + $total;
          $i++;
        @endphp
        {{-- perulangan paymnet --}}
      @endforeach
      <tr>
        <th>Total</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Rp.{{ number_format($total,2,",",".") }}</td>
      </tr>
    </tbody>
  </table>

@endsection