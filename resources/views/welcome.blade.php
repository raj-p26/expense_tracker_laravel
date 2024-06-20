@extends('layouts.main_layout')

@section('main_section')
<h2>Total Income {{ $income_count }}</h2>
<h2>Total Expense {{ $expense_count }}</h2>
<h2>Total Balance {{ $balance }}</h2>
@endsection