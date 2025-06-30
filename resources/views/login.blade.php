<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Persib Food Store</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0066CC, #005BB5);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        color: #fff;
      }
      .login-box {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 40px;
        width: 100%;
        max-width: 420px;
        text-align: center;
        color: #333;
      }
      .logo-container {
        width: 90px;
        height: 90px;
        background-color: #ffffff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 25px auto;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }
      .logo-container img {
        width: 60px;
        height: 60px;
      }
      .login-title {
        font-weight: 700;
        margin-bottom: 30px;
        font-size: 2rem;
        color: #333;
      }
      .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
        margin-bottom: 20px;
      }
      .form-control:focus {
        border-color: #0066CC;
        box-shadow: 0 0 0 0.25rem rgba(0, 102, 204, 0.25);
      }
      .btn-primary {
        background-color: #0066CC;
        border-color: #0066CC;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        flex-grow: 1;
        margin: 0 5px;
      }
      .btn-primary:hover {
        background-color: #005BB5;
        border-color: #005BB5;
      }
      .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        flex-grow: 1;
        margin: 0 5px;
      }
      .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
      }
      .d-flex.justify-content-between {
        margin-top: 10px;
      }
      .error-message {
        color: #dc3545;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 500;
      }
    </style>
</head>
<body>
  <div class="login-box">
    <div class="logo-container" style="overflow: hidden; border-radius: 50%;">
      <img src="{{ asset('loginlogo.jpg') }}" alt="Persib Logo" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;" />
    </div>
    <div class="login-title">Persib Official Store</div>
    <!-- @if($errors->any()) -->
    <!-- <div class="error-message">{{ $errors->first() }}</div> -->
    <!-- @endif -->
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input
        type="text"
        name="username"
        class="form-control"
        placeholder="Nama Pengguna"
        value="{{ old('username') }}"
        required
        autofocus
      />
      <input
        type="password"
        name="password"
        class="form-control"
        placeholder="Kata Sandi"
        required
      />
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Login</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
