<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sales System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .hero-section {
            text-align: center;
            padding: 2rem;
        }
        
        .logo {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .tagline {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .btn-primary {
            background-color: #4a6bff;
            border-color: #4a6bff;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #3a5bef;
            border-color: #3a5bef;
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
        }
        
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .modal-title {
            font-weight: bold;
            color: #1e3c72;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }
        
        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #4a6bff;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="hero-section">
                    <div class="logo">
                        <i class="bi bi-cart-check-fill"></i> POS System
                    </div>
                    <div class="tagline">
                        Powerful Point of Sales Solution for Your Business
                    </div>
                    <p class="mb-4">
                        Streamline your sales, inventory, and customer management with our all-in-one POS system.
                    </p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Get Started
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="loginModalLabel">POS System Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="loginForm">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary login-btn">Login</button>
                        </div>
                        <div class="text-center mt-3">
                            <!-- <a href="#" class="text-muted">Forgot password?</a> -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <!-- <p class="text-muted mb-0">Don't have an account? <a href="#" class="text-primary">Contact Admin</a></p> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
     <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sweet Alert 2 -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <script>
    $('#loginForm').on('submit', function(e){
        e.preventDefault();
        console.log('berhasil');

        var data = $(this).serialize()
        
        $.ajax({
            method:'POST',
            url:'<?= base_url("Auth/loginProses")?>',
            dataType:'JSON',
            data:data,
            success: function(response){
                if( response.response === 1){
                    Swal.fire({
                        title:'Berhasil Masuk',
                        icon:'success'
                    })

                    setTimeout(function(){
                        window.location.href='<?= base_url('Dashboard/index')?>'
                    },2000)
                }
            }
        })
    })
    </script>
</body>
</html>