@extends('layouts.main_layout')

@section('main_section')

<x-edit-book-keeping-modal type="income" id="incomeModal" editmode="false" />

@if(count($incomes) > 0)
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
    @foreach ($incomes as $income)
    <tr>
      <td>{{ $income->type_ }}</td>
      <td>{{ $income->description ? $income->description : "No Description" }}</td>
      <td>{{ $income->date_ }}</td>
      <td class="income-amount">{{ $income->amount }}</td>
      <td>
        <a class="btn btn-warning" href="{{ route('finance.edit', ['id' => $income->id]) }}?finance_type=income">
          Edit
        </a>
      </td>
      <td>
        <a href="{{route('finance.delete', ['id' => $income->id]) }}?finance_type=income" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<p>No Incomes Yet.</p>
@endif

<div class="add-btn">
  <button class='btn btn-primary fs-3 text-center shadow rounded-circle' data-bs-target="#incomeModal" data-bs-toggle="modal">
    <i class="bi bi-plus my-auto mx-auto fs-2"></i>
  </button>
</div>

<script>
  const incomes = document.querySelectorAll('.income-amount');
  let sum = 0;

  incomes.forEach(income => {
    sum += Number.parseInt(income.textContent);
  });

  console.log(sum);
</script>
@endsection