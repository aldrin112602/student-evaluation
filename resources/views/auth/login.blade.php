@extends('layouts.app')

@section('content')
<section class="gradient-form" style="background-color: #F5F5DC;">
  <div class="container h-100" style="padding-top: 0;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black shadow-lg">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="{{ asset('images/logo.jpg') }}" 
                       style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1" style="font-family: 'Roboto', sans-serif; font-weight: bold;">Student Evaluation System</h4>
                </div>

                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <p class="text-center" style="font-family: 'Roboto', sans-serif;">Please login to your account</p>

                  @if ($errors->any())
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> 
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <style>
                        /* Custom Alert */
                        #error-alert {
                            position: fixed;
                            top: 20px;
                            right: 20px;
                            z-index: 9999;
                            padding: 15px;
                            border-radius: 10px;
                            font-size: 16px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                            opacity: 1;
                            transition: opacity 0.5s ease;
                            background-color: #f44336;
                            color: white;
                        }
                        #error-alert strong {
                            font-weight: bold;
                        }
                    </style>

                    <script>
                        window.onload = function() {
                            setTimeout(function() {
                                var alert = document.getElementById('error-alert');
                                if (alert) {
                                    alert.style.opacity = '0';
                                    setTimeout(function() {
                                        alert.style.display = 'none';
                                    }, 500);
                                }
                            }, 1500);
                        };
                    </script>
                  @endif

                  <div class="form-outline mb-3">
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                           name="username" value="{{ old('username') }}" required autocomplete="username" autofocus 
                           placeholder="Enter your username here" style="font-size: 1rem;">
                    <label class="form-label" for="username" style="font-family: 'Roboto', sans-serif;">Username</label>
                    @error('username')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-outline mb-3">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password" placeholder="Enter your password here" 
                           style="font-size: 1rem;">
                    <label class="form-label" for="password" style="font-family: 'Roboto', sans-serif;">Password</label>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="text-center pt-1 mb-4 pb-1">
                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                            style="font-size: 1.25rem; padding: 15px 30px; width: 80%; max-width: 400px; background-color: #007bff; border-radius: 50px;">
                      Login
                    </button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2" style="font-family: 'Roboto', sans-serif;">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal"
                            style="font-family: 'Roboto', sans-serif; font-weight: bold; border-radius: 30px;">
                      Create new
                    </button>
                  </div>

                </form>

              </div>
            </div>

            <!-- Right Side: Set Background Image -->
            <div class="col-lg-6 d-flex align-items-center" 
                 style="background-image: url('{{ asset('images/wesleyan.jPg') }}'); background-size: cover; background-position: center;">
              <!-- This column now shows an image as background -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel" style="font-family: 'Roboto', sans-serif;">Register</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="verifyForm">
          <div class="mb-3">
            <label for="student_id" class="form-label" style="font-family: 'Roboto', sans-serif;">ID Number</label>
            <input type="text" placeholder="Input your student id number here (ex. 00-0000-000)" class="form-control" id="student_id" required style="font-size: 1rem;">
          </div>
          <button type="button" class="btn btn-primary" id="verifyButton" style="font-family: 'Roboto', sans-serif; border-radius: 30px;">
            Verify
          </button>
        </form>
        <div id="alertMessage" class="alert alert-danger mt-2 d-none"></div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('verifyButton').addEventListener('click', function() {
    const studentId = document.getElementById('student_id').value;
    fetch(`/api/verify/${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                // Store student or faculty data in local storage
                localStorage.setItem('userId', data.user_id);
                localStorage.setItem('fullname', data.fullname);
                localStorage.setItem('role', data.role);

                // Redirect to the registration page
                window.location.href = "/register";
            } else {
                document.getElementById('alertMessage').textContent = data.message;
                document.getElementById('alertMessage').classList.remove('d-none');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
</script>

@endsection
