<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <span class="navbar-brand">ExpenseTracker</span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link {{ explode(':8000', URL::current())[1] == '' ? 'active' : '' }}" aria-current="page" href="/">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ explode(':8000', URL::current())[1] == '/expenses' ? 'active' : '' }}" href="{{ route('user.expenses') }}">Expenses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ explode(':8000', URL::current())[1] == '/incomes' ? 'active' : '' }}" href="{{ route('user.incomes') }}">Incomes</a>
          </li>
        </ul>
        <div class="d-flex align-items-center justify-content-between">
          @if(session()->has('username'))
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Hi There, {{ ucwords(session()->get('username')) }}!
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item text-danger" href="{{ route('user.delete', ['id' => session()->get('id')]) }}">Delete Account</a>
              </li>
            </ul>
          </div>
          @endif
        </div>
      </div>
    </div>
  </nav>

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session()->get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <main>
    <div class="container">
      @yield('main_section')
    </div>
  </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
  (() => {
    'use strict'

    const forms = document.querySelectorAll('.needs-validation')

    console.log(forms);

    // handling form validation.
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    });

    // Handling tooltips.
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  })();
</script>

</html>