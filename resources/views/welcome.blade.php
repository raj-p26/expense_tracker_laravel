@extends('layouts.main_layout')

@section('main_section')

<style>
  .card {
    height: 200px;
  }
</style>

<div class="row g-3 my-3">
  @foreach ($data as $item)
  @php $value = explode(": ", $item); @endphp

  <div class="col-sm-6 col-md-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $value[0] }}</h4>
        <h5 class="card-subtitle mt-2 text-body-secondary">{{ $value[1] }}&#8360;</h5>
      </div>
    </div>
  </div>

  @endforeach
</div>

@endsection