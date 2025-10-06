<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.all.js" integrity="sha512-kEG1e68iTZ6mp4hawzUG6LqyzSdDY+wXV2OJ2OjU5tfg6daEbVUYKMxYutmnUN7iwKO2BPICXNE7yh2qtS5YHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            height: 100vh;
            overflow: hidden;
            background-color: #f885acff;
        }

        .container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row {
            width: 800px;
        }

        .left-side {
            background-image: url("https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=668&q=80");
            background-color: rgba(219, 14, 83, 0.5);
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }


        .left-side img {
            max-width: 100%;
            height: auto;
            opacity: 0.9;
        }

        .right-side {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: left;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #ddd;
            border-radius: 0;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid #ff6b9d;
        }

        .form-check-input {
            margin-top: 5px;
        }

        .btn-signup {
            background: linear-gradient(135deg, #ff6b9d, #c44569);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: white;
            font-weight: bold;
            width: 100%;
            margin: 20px 0;
        }

        .btn-signup:hover {
            opacity: 0.9;
        }

        .login-link {
            text-align: right;
            margin-top: 10px;
        }

        .login-link a {
            color: #ff6b9d;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 left-side">
                <h1>Welcome Back!</h1>

            </div>
            <div class="col-md-6 right-side">
                <div class="form-container">
                    <h1 class="form-title">Login From</h1>
                    <form id="loginForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <!-- <label for="email" class="form-label">Email</label> -->
                            <input type="email" class="form-control" id="mail" name="email" placeholder="Email address...">
                            <span class="text-danger error-text mail_error"></span>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                            <span class="text-danger error-text pass_error"></span>
                        </div>
                        <button type="submit" class="btn btn-signup">Login</button>
                        <div class="login-link">
                            <p>Don't have an account? <a href="/registration">Register →</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        $(document).on("submit", "#loginForm", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            console.log('gsd');

            $.ajax({
                url: "/login",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    localStorage.setItem("auth_token", res.token);
                    
                    
                    Swal.fire({
                        title: "Login",
                        text: "Login Successfully!.",
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        localStorage.setItem("auth_token", res.token);
                        // localStorage.setItem("user", JSON.stringify(res.user));
                        window.location.href = '/profile';
                        // window.location.href = res.redirect;
                    });
                    $("#loginForm")[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $('.error-text').text('');
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            let errorClass = key.replace(/\./g, '_') + "_error";
                            $('.' + errorClass).text(value[0]);
                        });
                        $(document).on('input change', 'input, select', function() {
                            let fieldName = $(this).attr('name'); // get field name
                            let errorClass = fieldName.replace(/\./g, '_') + "_error";
                            $('.' + errorClass).text(''); // clear the error
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>