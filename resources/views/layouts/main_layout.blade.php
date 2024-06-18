<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}/">ExpenseTracker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/expenses">Expenses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/incomes">Incomes</a>
          </li>
        </ul>
        <div class="d-flex align-items-center justify-content-between">
          @if(session()->has('username'))
          <span class="me-3">
            Hi There!, {{ session()->get('username') }}
          </span>
          <form action="{{ route('user.logout') }}">
            <button type="submit" class="btn btn-primary">Logout</button>
          </form>
          @else
          <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
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

  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalLabel">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('user.login') }}">
            @csrf
            <div class="mb-3">
              <label for="validationCustomEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="validationCustomEmail" name="userEmail" required />
              <div class="invalid-feedback">
                Please Enter a valid Email.
              </div>
            </div>
            <div class="mb-3">
              <label for="userPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="userPassword" name="userPassword" required />
              <div class="invalid-feedback">
                Please Enter a valid Password.
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="signupModalLabel">Signup</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('user.register') }}">
            @csrf
            <div class="mb-3">
              <label for="validationCustomUsername" class="form-label">Username</label>
              <input type="text" class="form-control" id="validationCustomUsername" name="username" required />
              <div class="invalid-feedback">
                Please enter a valid username.
              </div>
            </div>
            <div class="mb-3">
              <label for="validationCustomEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="validationCustomEmail" name="userEmail" aria-describedby="emailHelp" required />
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              <div class="invalid-feedback">
                Please Enter a valid Email.
              </div>
            </div>
            <div class="mb-3">
              <label for="validationCustomPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="validationCustomPassword" name="userPassword" required />
              <div class="invalid-feedback">
                Please Enter a valid Password.
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <main>
    @yield('main_section')
  </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
  (() => {
    'use strict'

    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })();
</script>

</html>