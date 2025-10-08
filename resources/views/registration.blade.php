<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffb6c1, #ffe6eb, #fff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(255, 105, 135, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
            color: #c44569;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px 14px;
            border: 1px solid #ddd;
            transition: 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff6b9d;
            box-shadow: 0 0 5px rgba(255, 107, 157, 0.4);
        }

        .btn-signup {
            background: linear-gradient(135deg, #ff6b9d, #c44569);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-signup:hover {
            opacity: 0.95;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 107, 157, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #c44569;
            text-decoration: none;
            font-weight: 500;
        }

        .text-danger {
            font-size: 0.8rem;
        }

        label {
            font-weight: 500;
            color: #444;
        }
    </style>
</head>

<body>
    <div class="register-card">
        <h2>Create Your Account</h2>
        <form id="registrationForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Full Name">
                <span class="text-danger error-text uname_error"></span>
            </div>

            <div class="mb-3">
                <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                <span class="text-danger error-text age_error"></span>
            </div>

            <div class="mb-3">
                <input type="email" class="form-control" id="mail" name="mail" placeholder="Email address">
                <span class="text-danger error-text mail_error"></span>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Male">
                    <label class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Female">
                    <label class="form-check-label">Female</label>
                </div>
                <span class="text-danger error-text gender_error"></span>
            </div>

            <div class="mb-3">
                <label class="form-label">Hobbies</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Reading">
                    <label class="form-check-label">Reading</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Sports">
                    <label class="form-check-label">Sports</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Music">
                    <label class="form-check-label">Music</label>
                </div>
                <span class="text-danger error-text hobby_error"></span>
            </div>

            <div class="mb-3">
                <select class="form-select select2" name="city">
                    <option value="">-- Select City --</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Ahmedabad">Ahmedabad</option>
                    <option value="Pune">Pune</option>
                </select>
                <span class="text-danger error-text city_error"></span>
            </div>

            <div class="mb-3">
                <input type="file" class="form-control" id="image" name="image">
                <span class="text-danger error-text image_error"></span>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                <span class="text-danger error-text pass_error"></span>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="rpass" name="rpass" placeholder="Repeat Password">
                <span class="text-danger error-text rpass_error"></span>
            </div>

            <button type="submit" class="btn btn-signup">Sign Up</button>

            <div class="login-link">
                <p>Already have an account? <a href="/">Login →</a></p>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('.select2').select2({ width: '100%', placeholder: "Select your city" });

            $(document).on("submit", "#registrationForm", function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "/api/registration",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        Swal.fire({
                            title: "Registered",
                            text: "Registered Successfully!",
                            icon: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        }).then(() => window.location.href = res.redirect);
                        $("#registrationForm")[0].reset();
                        $('.select2').val(null).trigger('change');
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            $('.error-text').text('');
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('.' + key.replace(/\./g, '_') + "_error").text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
