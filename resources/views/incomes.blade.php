@extends('layouts.main_layout')

@section('main_section')

<x-edit-book-keeping-modal type="income" id="incomeModal" editmode="false" />

@if(count($incomes) > 0)
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
    @foreach ($incomes as $income)
    <tr class="record">
      <td>{{ $income->type_ }}</td>
      <td>{{ $income->description ? $income->description : "No Description" }}</td>
      <td class="income-date">{{ $income->date_ }}</td>
      <td class="income-amount">
        {{ $income->amount }}
      </td>
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
<p>Total Income: <span class="total-income"></span></p>
@else
<p>No Incomes Yet.</p>
@endif

<div class="add-btn">
  <button class='btn btn-primary fs-3 text-center shadow rounded-circle' data-bs-target="#incomeModal" data-bs-toggle="modal">
    <i class="bi bi-plus my-auto mx-auto fs-2"></i>
  </button>
</div>

<script>
  const incomesTotal = () => {
    let total = 0;
    $('.select-month').hide();
    $('.custom-date').hide();

    $('.record').each((idx, elem) => {
      $(elem).show();
      let income = Number.parseInt($(elem).children('.income-amount').text());
      total += income;
      $('.total-income').text(total);
    });
  }

  $(document).ready(() => {
    $('.select-month').hide();
    incomesTotal();
  });

  $('#filter').change((event) => {
    let value = event.target.value;

    if (value == 'monthly') {
      $('.select-month').show().change(event => {
        let selectedMonth = event.target.value;
        let currentYear = new Date().getFullYear();
        let total = 0;

        $('.income-date').each((idx, elem) => {
          let [year, month, _day] = elem.textContent.split('-');
          if (Number.parseInt(month) != selectedMonth ||
            Number.parseInt(year) != currentYear) {
            $(elem).closest('.record').hide();
          } else {
            $(elem).closest('.record').show();
            let amt = $(elem).next('.income-amount').text();
            total += Number.parseInt(amt);
          }
          $('.total-income').text(total);
        });
      });
    } else if (value == 'all') {
      incomesTotal();
    } else if (value == 'this_year') {
      $('.custom-date').hide();
      $('.select-month').hide();

      let total = 0;
      $('.income-date').each((idx, elem) => {
        let [year, _month, _day] = elem.textContent.split('-');
        let currentYear = new Date().getFullYear();

        if (Number.parseInt(year) != currentYear) {
          $(elem).closest('.record').hide();
        } else {
          $(elem).closest('.record').show();
          let amt = $(elem).next('.income-amount').text();
          total += Number.parseInt(amt);

          $('.total-income').text(total);
        }
      });
    } else if (value == 'custom') {
      $('.select-month').hide();
      $('.custom-date').show();

      $('.custom-date').change(event => {
        let total = 0;
        $('.income-date').each((idx, elem) => {
          if ($(elem).text() == event.target.value) {
            $(elem).closest('.record').show();
            let income = $(elem).next('.income-amount').text();
            total += Number.parseInt(income);
          } else {
            $(elem).closest('.record').hide();
          }
        });
        $('.total-income').text(total);
      });
    }
  });
</script>
@endsection