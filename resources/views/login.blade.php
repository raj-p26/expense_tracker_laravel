<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $type }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    main {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-color: #339af0;
    }
  </style>
</head>

<body>
  <main>
    <div class="modal in fade" id="loginModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="loginModalLabel">Login to ExpenseTracker</h1>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('user.login') }}">
              @csrf
              <div class="mb-3">
                <label for="userEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" required />
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
              <div>
                <a href="{{ route('user.register') }}">New to ExpenseTracker?</a>
              </div>
              @if (session()->has('error'))
              <div class="my-3">
                <p class="text-danger">{{ session()->get('error') }}</p>
              </div>
              @endif
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="registerModalLabel">Signup</h1>
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
              @if (session()->has('error'))
              <div class="my-3">
                <p class="text-danger">{{ session()->get('error') }}</p>
              </div>
              @endif
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </main>
</body>


<script defer>
  $(window).on('load', function() {
    $('#{{$type}}Modal').modal('show');
  });

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