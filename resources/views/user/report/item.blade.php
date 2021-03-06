@extends('layouts/'.$extend)

@section('title', 'Report')

@section('headline', 'Report By Items '.$by)

@section('content')

  <script type="text/javascript">

  $(document).ready(function(){
    // custome-search
    $('.hidden-custome-search').hide();
    $('#custome-search').click(function(){
      $('.hidden-custome-search').toggle();
    });
  });
  </script>

  <div class="row">
    <div class="col-md-4">
      <a class="btn btn-outline-primary" href="/report/customer"><i class="fas fa-arrow-circle-right"></i> Show Report By Customer</a>
    </div>

    <div class="offset-md-5 col-md-3" style="padding-right:0!important;">
      <div class="row text-right btn-block" style="margin-right:0!important;">

        <form class="col-md-12" action="/report/item" method="post">
          <div class="input-group mb-3" style="margin-bottom:0!important;">
            <select class="form-control" aria-describedby="button-addon2" autocomplete="off" name="by">
              <option value="week">This Week</option>
              <option value="month">This Month</option>
              <option value="year">This Year</option>
              <option value="all">All Periode</option>
            </select>
            <div class="input-group-append">
              <button id="button-addon2" class="btn btn-primary" type="submit" name="submit">Filter</button>
            </div>
          </div>
          {{ csrf_field() }}
        </form>

        {{-- div class="row text-right btn-block" --}}
      </div>
      <div class="row text-right btn-block">
        <div class="col-md-12 btn-atas">
          <button id="custome-search" class="btn btn-block btn-primary" type="button" name="button">Custome Search</button>
        </div>

        <div class="hidden-custome-search">
          <form class="" action="/report/item" method="post">
            <div class="card">
              <div class="card-header text-justify">
                Custome Search
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col">

                    <label for="">Start Date</label>
                  </div>
                  <div class="col">
                    <input type="date" name="start_date" value="{{ $now }}">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <label for="">End Date</label>
                  </div>
                  <div class="col">
                    <input type="date" name="end_date" value="{{ $now }}">
                  </div>
                </div>
                <br>
                <input class="btn btn-primary" type="submit" name="submit" value="search">
              </div>
            </div>
            {{ csrf_field() }}
          </form>
          {{-- hidden --}}
        </div>
        {{-- row --}}
      </div>
      {{-- offset md 5 col md 3 --}}
    </div>
    {{-- row --}}
  </div>

  <br>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th>Item Name</th>
      <th>Quantity</th>
      <th>Amount</th>
    </tr>
  </thead>
  <tbody>
    @php
      $i = 1;
      $j = 0;
      $total = 0;
    @endphp
  @foreach ($items as $item)
    <tr>
        <th scope="row">{{ $i }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->count }}</td>
        <td>Rp.{{ number_format($item->total,2,",",".") }}</td>
        @php
          $total = $item->total + $total;
          $i++;
          $j++;
        @endphp
    </tr>
  @endforeach
  @if ($j == 0)
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  @endif
  <tr>
    <th>Total</th>
    <td></td>
    <td></td>
    <td>Rp.{{ number_format($total,2,",",".") }}</td>
  </tr>
</tbody>
</table>

@endsection
