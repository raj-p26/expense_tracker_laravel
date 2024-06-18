@extends('layouts.main_layout')

@section('main_section')
<div class="modal fade" id="incomeModal" tabindex="-1" aria-labelledby="incomeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="incomeModalLabel">Add Income</h1>
      </div>
      <form class="needs-validation" novalidate method="post" action="{{ url('/') }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="financeType" class="form-label">{{ $type }} Type</label>
            <input type="text" class="form-control" id="financeType" placeholder="Nunchaku" name="{{ $type }}_type" required />
            <div class="invalid-feedback">
              Please Enter a valid {{ $type }} Type.
            </div>
          </div>
          <div class="mb-3">
            <label for="financeAmount" class="form-label">{{ $type }} Amount</label>
            <input type="number" class="form-control" id="financeAmount" placeholder="399" name="{{ $type }}_amount" min="0" required />
            <div class="invalid-feedback">
              Please Enter a valid {{ $type }} Amount.
            </div>
          </div>
          <div class="mb-3">
            <label for="{{ $type }}_description" class="form-label">{{ $type }} Description</label>
            <textarea name="{{ $type }}_description" class="form-control" placeholder="Optional" id="{{ $type }}_description"></textarea>
          </div>
          <div class="mb-3">
            <label for="{{ $type }}_date" class="form-label">{{ $type }} Date</label>
            <input type="date" class="form-control" required />
            <div class="invalid-feedback">
              Please Enter the date of {{ $type }}.
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add {{ $type }}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<h2>Incomes Layout</h2>
<div class="add-btn">
  <button class='btn btn-primary btn-rounded text-center shadow rounded-circle' data-bs-target="#incomeModal" data-bs-toggle="modal">
    <i class="bi bi-plus my-auto mx-auto fs-2"></i>
  </button>
</div>
@endsection