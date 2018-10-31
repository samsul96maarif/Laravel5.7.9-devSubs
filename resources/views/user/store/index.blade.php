@extends('layouts/userMaster')

@section('title', 'home')

@section('headline', 'Company Profile')

@section('content')
  
    <form class="" action="/store/{{ $store->id }}" method="post" value="post">
      {{ method_field('PUT') }}

      {{-- kolom untuk isi tabel "name" --}}
      {{-- old('nama variable') = untuk menyimpan nilai lama, jadi bila tidak valid hanya tabel yang tidak valid
      yang nilainya akan terhapus --}}
      <input type="text" name="name" value="{{ $store->name }}" placeholder="Business Name"><br><br>
      {{-- untuk mengeluarkan error pada value "name" --}}
      @if($errors->has('name'))
        <p>{{ $errors->first('name') }}</p>
      @endif

      <input type="text" name="phone" value="{{ $store->phone }}" placeholder="Phone"><br><br>
      @if($errors->has('phone'))
        <p>{{ $errors->first('phone') }}</p>
      @endif

      <textarea name="company_address" rows="8" cols="80" placeholder="Company Address">{{ $store->company_address }}</textarea><br><br>
      @if($errors->has('company_address'))
        <p>{{ $errors->first('company_address') }}</p>
      @endif

      <input type="text" name="zipcode" value="{{ $store->zipcode }}" placeholder="zipcode"><br><br>
      @if($errors->has('zipcode'))
        <p>{{ $errors->first('zipcode') }}</p>
      @endif

      <input type="submit" name="submit" value="save">
      {{ csrf_field() }}
      {{-- </form><br>
      <form class="" action="/store/{{ $store->id }}/delete" method="post">
        {{ method_field('DELETE') }}
        <input type="submit" name="submit" value="delete">
        {{ csrf_field() }}
      </form> --}}
@endsection
