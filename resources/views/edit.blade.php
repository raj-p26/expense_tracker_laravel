@extends('layouts.main_layout')

@section('main_section')
<div class="d-flex justify-content-center mt-3">
  <form class="needs-validation w-50" novalidate method="post" action="{{ route('update.'.$type) }}">
    @csrf
    <input type="hidden" name="{{$type}}_id" value="{{$finance->id}}" />
    <div class="mb-3">
      <label for="financeType" class="form-label">{{ $type }} Type</label>
      <input type="text" class="form-control" id="financeType" name="{{ $type }}_type" required value="{{$finance->type_}}" />
      <div class="invalid-feedback">
        Please Enter a valid {{ $type }} Type.
      </div>
    </div>
    <div class="mb-3">
      <label for="financeAmount" class="form-label">{{ $type }} Amount</label>
      <input type="number" class="form-control" id="financeAmount" name="{{ $type }}_amount" min="0" required value="{{$finance->amount}}" />
      <div class="invalid-feedback">
        Please Enter a valid {{ $type }} Amount.
      </div>
    </div>
    <div class="mb-3">
      <label for="{{ $type }}_description" class="form-label">{{ $type }} Description</label>
      <textarea name="{{ $type }}_description" class="form-control" placeholder="Optional" id="{{ $type }}_description">{{$finance->description}}</textarea>
    </div>
    <div class="mb-3">
      <label for="{{ $type }}_date" class="form-label">{{ $type }} Date</label>
      <input type="date" name="{{ $type }}_date" id="{{ $type }}_date" class="form-control" required value="{{$finance->date_}}" />
      <div class="invalid-feedback">
        Please Enter the date of {{ $type }}.
      </div>
    </div>
    <div>
      <button type="submit" class="btn btn-success">Update</button>
    </div>
  </form>
</div>
@endsection