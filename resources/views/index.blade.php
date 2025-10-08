<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff9eb5, #ffe6eb, #fff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255, 105, 135, 0.25);
            width: 100%;
            max-width: 420px;
            padding: 45px 35px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card h2 {
            text-align: center;
            font-weight: 600;
            color: #c44569;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .form-control:focus {
            border-color: #ff6b9d;
            box-shadow: 0 0 6px rgba(255, 107, 157, 0.4);
        }

        .text-danger {
            font-size: 0.8rem;
            margin-bottom: 10px;
            display: block;
            min-height: 18px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .text-danger.show {
            opacity: 1;
        }

        .btn-login {
            background: linear-gradient(135deg, #ff6b9d, #c44569);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 600;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 107, 157, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 18px;
            color: #666;
        }

        .login-link a {
            color: #c44569;
            text-decoration: none;
            font-weight: 500;
        }

        .login-illustration {
            width: 100px;
            display: block;
            margin: 0 auto 15px;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" class="login-illustration" alt="login icon">
        <h2>Welcome Back!</h2>

        <form id="loginForm" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email address">
                <span class="text-danger error-text email_error"></span>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="text-danger error-text password_error"></span>
            </div>

            <button type="submit" class="btn btn-login">Login</button>

            <div class="login-link">
                <p>Don’t have an account? <a href="/registration">Register →</a></p>
            </div>
        </form>
    </div>

    <script>
        $(document).on("submit", "#loginForm", function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "/login",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    localStorage.setItem("auth_token", res.token);
                    Swal.fire({
                        title: "Login",
                        text: "Login Successfully!",
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/profile';
                    });
                    $("#loginForm")[0].reset();
                    $('.error-text').text('').removeClass('show');
                },
                error: function (xhr) {
                    $('.error-text').text('').removeClass('show');
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            const errorClass = key + "_error";
                            $('.' + errorClass).text(value[0]).addClass('show');
                        });
                    } else {
                        Swal.fire({
                            title: "Login Failed",
                            text: "Invalid credentials. Please try again.",
                            icon: "error",
                        });
                    }
                }
            });
        });

        // Auto-clear error when typing
        $(document).on('input change', 'input', function () {
            const field = $(this).attr('name');
            $('.' + field + "_error").text('').removeClass('show');
        });
    </script>
</body>

</html>
