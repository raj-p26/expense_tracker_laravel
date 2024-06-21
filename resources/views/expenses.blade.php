@extends('layouts.main_layout')

@section('main_section')
<x-edit-book-keeping-modal type="expense" id="expenseModal" />

@if(count($expenses) > 0)
<div class="d-flex my-3">
  <label for="filter">Filter</label>
  <select name="filter" class="ms-3" id="filter">
    <option value="all">All</option>
    <option value="monthly">Monthly</option>
    <option value="this_year">This Year</option>
    <option value="custom">Custom</option>
  </select>
  <div class="select-month ms-3">
    <label for="month">Select Month</label>
    <select name="month" id="month">
      <option hidden>--Select Month--</option>
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
  </div>
  <div class="custom-date ms-3">
    <label for="date_">Date</label>
    <input type="date" id="date_" />
  </div>
</div>
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
    <tr class="record">
      <td>{{ $expense->type_ }}</td>
      <td>{{ $expense->description ? $expense->description : "No Description" }}</td>
      <td class="expense-date">{{ $expense->date_ }}</td>
      <td class="expense-amount">
        {{ $expense->amount }}
      </td>
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
<p>Total Expense: <span class="total-expense"></span></p>
@else
<p>No Expenses Yet.</p>
@endif


<div class="add-btn">
  <button class='btn btn-primary fs-3 text-center shadow rounded-circle' data-bs-target="#expenseModal" data-bs-toggle="modal">
    <i class="bi bi-plus my-auto mx-auto fs-2"></i>
  </button>
</div>

<script>
  const expenseTotal = () => {
    let total = 0;
    $('.select-month').hide();
    $('.custom-date').hide();

    $('.record').each((idx, elem) => {
      $(elem).show();
      let expense = Number.parseInt($(elem).children('.expense-amount').text());
      total += expense;
      $('.total-expense').text(total);
    });
  }

  $(document).ready(() => {
    $('.select-month').hide();
    $('.custom-date').hide();
    expenseTotal();
  });

  $('#filter').change((event) => {
    let value = event.target.value;

    if (value == 'monthly') {
      $('.select-month').show().change(event => {
        let selectedMonth = event.target.value;
        let currentYear = new Date().getFullYear();
        let total = 0;

        $('.expense-date').each((idx, elem) => {
          let [year, month, _day] = elem.textContent.split('-');
          if (Number.parseInt(month) != selectedMonth ||
            Number.parseInt(year) != currentYear) {
            $(elem).closest('.record').hide();
          } else {
            $(elem).closest('.record').show();
            let amt = $(elem).next('.expense-amount').text();
            total += Number.parseInt(amt);
          }
          $('.total-expense').text(total);
        });
      });
    } else if (value == 'all') {
      $('.select-month').hide();
      $('.custom-date').hide();
      expenseTotal();
    } else if (value == 'this_year') {
      $('.select-month').hide();
      $('.custom-date').hide();

      let total = 0;
      $('.expense-date').each((idx, elem) => {
        let [year, _month, _day] = elem.textContent.split('-');
        let currentYear = new Date().getFullYear();

        if (Number.parseInt(year) != currentYear) {
          $(elem).closest('.record').hide();
        } else {
          $(elem).closest('.record').show();
          let amt = $(elem).next('.expense-amount').text();
          total += Number.parseInt(amt);

          $('.total-expense').text(total);
        }
      });
    } else if (value == 'custom') {
      $('.custom-date').show();
      $('.select-month').hide();

      $('.custom-date').change(event => {
        let total = 0;
        $('.expense-date').each((idx, elem) => {
          if ($(elem).text() == event.target.value) {
            $(elem).closest('.record').show();
            let expense = $(elem).next('.expense-amount').text();
            total += Number.parseInt(expense);
          } else {
            $(elem).closest('.record').hide();
          }
        });
        $('.total-expense').text(total);
      });
    }
  });
</script>
@endsection