@extends('layouts.memberapp')
@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- หน้าตั้งค่า Profile -->
<main class="container">
    <div class="d-flex align-items-center"></div>
    <div class="row justify-content-center">
        <!-- เปลี่ยน justify-content-center เพื่อจัดให้ตรงกลาง -->
        <div class="b-example-divider"></div>
        <div class="d-grid gap-3">
            <div class="container mt-3">

                <!-- Propic -->
                <div class="text-center">
                    <img src="{{ asset('uploads/propic/image.png') }}" alt="Category Image"
                        class="rounded-circle" style="width: 150px; height: 150px;">
                </div><br>
                <!------------>

                <h3 class="text-center">{{ Auth::user()->name }}</h3><br>
                <div class="d-flex justify-content-center mb-3">
                    <a href=""><button type="button" class="btn btn-secondary">Edit Profile
                            Image</button></a>
                </div>
                <div class="bg-body ">
                    <!-- เปลี่ยน username -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm border">
                        <p>Change Username</p>
                        <form action="{{ route('update-name') }}" method="post">
                            @csrf
                            <input type="text" class="form-control form-control-dark text-bg-gray"
                                placeholder="Enter your new username" aria-label="Search" name="new_name"><br>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"> </small>
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                    <!------------>
                    <!-- เปลี่ยน password -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm border">
                        <p>Change Password </p>
                        <form action="{{ route('update-password') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="password" class="form-control form-control-dark text-bg-gray"
                                    name="new_password" placeholder="Enter your new password" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    id="toggleNewPassword">
                                    <i class="bi bi-eye-slash" id="newPasswordIcon"></i>
                                </button>
                            </div><br>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-dark text-bg-gray"
                                    name="new_password_confirmation" placeholder="Confirm your new password"
                                    required>
                                <button type="button" class="btn btn-outline-secondary"
                                    id="toggleConfirmNewPassword">
                                    <i class="bi bi-eye-slash" id="confirmNewPasswordIcon"></i>
                                </button>
                            </div><br>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Password must be at least 8 characters long.</small>
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                    <!------------>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    const toggleNewPassword = document.querySelector('#toggleNewPassword');
    const toggleConfirmNewPassword = document.querySelector('#toggleConfirmNewPassword');
    const newPassword = document.querySelector('input[name="new_password"]');
    const confirmNewPassword = document.querySelector('input[name="new_password_confirmation"]');
    const newPasswordIcon = document.querySelector('#newPasswordIcon');
    const confirmNewPasswordIcon = document.querySelector('#confirmNewPasswordIcon');

    toggleNewPassword.addEventListener('click', function() {
        const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        newPassword.setAttribute('type', type);
        newPasswordIcon.classList.toggle('bi-eye-slash');
        newPasswordIcon.classList.toggle('bi-eye');
    });

    toggleConfirmNewPassword.addEventListener('click', function() {
        const type = confirmNewPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmNewPassword.setAttribute('type', type);
        confirmNewPasswordIcon.classList.toggle('bi-eye-slash');
        confirmNewPasswordIcon.classList.toggle('bi-eye');
    });
</script>
@endsection