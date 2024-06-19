@extends('layouts.main_layout')

@section('main_section')
<x-edit-book-keeping-modal type="expense" id="expenseModal" />

<div class="add-btn">
  <button class='btn btn-primary fs-3 text-center shadow rounded-circle' data-bs-target="#expenseModal" data-bs-toggle="modal">
    <i class="bi bi-plus my-auto mx-auto fs-2"></i>
  </button>
</div>
@endsection