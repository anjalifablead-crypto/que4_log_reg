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

        .container-fluid {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row {
            height: 100%;
            width: 100%;
            margin: 0;
        }

        /* .left-side {
            background-image: url("https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=668&q=80");
            background: linear-gradient(135deg, #ff6b9d, #c44569);
            background-size: cover;
            background-blend-mode: overlay; 
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        } */
        .left-side {
            background-image: url("https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=668&q=80");
            background-color: rgba(255, 107, 157, 0.5);
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
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

            </div>
            <div class="col-md-6 right-side">
                <div class="form-container">
                    <h1 class="form-title">Registration From</h1>
                    <form id="registrationForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <!-- <label for="fullName" class="form-label">Full Name</label> -->
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Name...">
                            <span class="text-danger error-text uname_error"></span>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="age" class="form-label">Age</label> -->
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age...">
                            <span class="text-danger error-text age_error"></span>
                        </div>

                        <div class="mb-3">
                            <!-- <label for="email" class="form-label">Email</label> -->
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Email address...">
                            <span class="text-danger error-text mail_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Male">
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Female">
                                <label class="form-check-label">Female</label>
                            </div>

                        </div>
                        <span class="text-danger error-text gender_error"></span>
                        <div class="mb-3">
                            <label class="form-label mt-3">Hobbies</label>
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

                        </div>
                        <span class="text-danger error-text hobby_error"></span>
                        <div class="mb-3">
                            <select class="form-control mb-3" name="city">
                                <option value="">-- Select City --</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Pune">Pune</option>
                            </select>
                            <span class="text-danger error-text city_error"></span>
                        </div>
                        <div class="input-group mb-3">
                            <!-- <label class="input-group-text" for="inputGroupFile01">Upload</label> -->
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-danger error-text image_error"></span>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                            <span class="text-danger error-text pass_error"></span>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="repeatPassword" class="form-label">Repeat Password</label> -->
                            <input type="password" class="form-control" id="rpass" name="rpass" placeholder="Repeat Password">
                            <span class="text-danger error-text rpass_error"></span>
                        </div>

                        <button type="submit" class="btn btn-signup">Register</button>
                        <div class="login-link">
                            <p>Already have an account? <a href="/">Login →</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).on("submit", "#registrationForm", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "/api/registration",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    Swal.fire({
                        title: "Registered",
                        text: "Registered Successfully!.",
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => window.location.href = res.redirect);
                    $("#customerForm")[0].reset();
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