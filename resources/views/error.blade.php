<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center h-100" style="min-height: 100vh;">
    <div>
      <h1 class="h1 text-center">
        @if(session()->has('error_code'))
        {{ session()->get('error_code') }}
        @elseif (isset($error_code))
        {{ $error_code }}
        @else
        404
        @endif
      </h1>
      <h3>
        @if (session()->has('error_message'))
        {{ session()->get('error_message') }}
        @elseif (isset($error_message))
        {{ $error_message }}
        @else
        Not Found
        @endif
      </h3>
      <div class="d-flex justify-content-center">
        <a class="btn btn-primary mt-3" href="{{ url('/') }}">Back To Home</a>
      </div>
    </div>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>