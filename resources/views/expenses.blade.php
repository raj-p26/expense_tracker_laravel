@extends('layouts.main_layout')

@section('main_section')
<x-edit-book-keeping-modal type="expense" id="expenseModal" />

@if(count($expenses) > 0)
<table class="table">
  <thead>
    <tr>
      <th scope="col">Income Type</th>
      <th scope="col">Income Description</th>
      <th scope="col">Income Date</th>
      <th scope="col">Income Amount</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($expenses as $expense)
    <tr>
      <td>{{ $expense->type_ }}</td>
      <td>{{ $expense->description ? $expense->description : "No Description" }}</td>
      <td>{{ $expense->date_ }}</td>
      <td class="expense-amount">{{ $expense->amount }}</td>
      <td>
        <a class="btn btn-warning" href="{{ route('finance.edit', ['id' => $expense->id]) }}?finance_type=expense">
          Edit
        </a>
      </td>
      <td>
        <a href="{{route('finance.delete', ['id' => $expense->id]) }}?finance_type=expense" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<p>No Expenses Yet.</p>
@endif


<div class="add-btn">
  <button class='btn btn-primary fs-3 text-center shadow rounded-circle' data-bs-target="#expenseModal" data-bs-toggle="modal">
    <i class="bi bi-plus my-auto mx-auto fs-2"></i>
  </button>
</div>
@endsection