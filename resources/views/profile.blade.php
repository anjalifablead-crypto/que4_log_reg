<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255, 105, 135, 0.25);
            width: 100%;
            max-width: 700px;
            padding: 40px 35px;
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

        .profile-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .profile-header img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ff6b9d;
            margin-bottom: 10px;
        }

        .profile-header h4 {
            color: #c44569;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #ff6b9d;
            box-shadow: 0 0 6px rgba(255, 107, 157, 0.4);
        }

        .btn-custom {
            background: linear-gradient(135deg, #ff6b9d, #c44569);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 107, 157, 0.3);
        }

        .logout-btn {
            background: #dc3545;
            border-radius: 10px;
            color: #fff;
            font-weight: 600;
            padding: 10px 20px;
        }

        .text-danger {
            font-size: 0.8rem;
        }

        .form-section {
            display: none;
        }

        .update-section {
            display: none;
        }
    </style>
</head>

<body>
    <div class="profile-card">
        <div class="profile-header">
            <img id="userImage" src="https://via.placeholder.com/100" alt="Profile">
            <h4 id="userName">User Name</h4>
            <p id="userEmail">user@example.com</p>
        </div>

        <div class="view-section">
            <p><strong>Age:</strong> <span id="userAge"></span></p>
            <p><strong>Gender:</strong> <span id="userGender"></span></p>
            <p><strong>Hobby:</strong> <span id="userHobby"></span></p>
            <p><strong>City:</strong> <span id="userCity"></span></p>

            <div class="text-center mt-4">
                <button class="btn btn-custom" id="editProfile">Edit Profile</button>
                <button class="btn logout-btn" id="logoutBtn">Logout</button>
            </div>
        </div>

        <!-- Update Profile Section -->
        <div class="update-section">
            <form id="updateForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="uname" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <select name="city" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Mumbai">Mumbai</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                            <option value="Pune">Pune</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
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
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Change Password (optional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep old password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Profile Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Save Changes</button>
                    <button type="button" class="btn btn-secondary" id="cancelEdit">Cancel</button>
                </div>
            </form>
        </div>

        <div id="errorMsg" class="alert alert-danger mt-3" style="display:none;">
            You are not logged in. Please <a href="/">login</a>.
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const token = localStorage.getItem("auth_token");

            // Fetch user profile
            $.ajax({
                url: "/api/profile1",
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(res) {
                    const user = res.user;

                    $("#userName").text(user.uname);
                    $("#userEmail").text(user.email);
                    $("#userAge").text(user.age);
                    $("#userGender").text(user.gender);
                    $("#userHobby").text(user.hobby);
                    $("#userCity").text(user.city);

                    if (user.image) {
                        $("#userImage").attr("src", "/uploads/" + user.image);
                    }

                    // Pre-fill update form
                    $.each(user, function(key, value) {
                        $('[name="' + key + '"]').val(value);
                        console.log(user.hobby);
                        // Handle hobby checkboxes
                        $('input[name="hobby[]"]').prop('checked', false); // Uncheck all first

                        if (user.hobby) {
                            // Split by comma and trim spaces
                            let hobbies = user.hobby.split(',').map(h => h.trim());

                            // Check the ones that match
                            hobbies.forEach(h => {
                                $('input[name="hobby[]"][value="' + h + '"]').prop('checked', true);
                            });
                        }
                    });




                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        $("#errorMsg").show();
                        localStorage.removeItem("auth_token");
                    }
                }
            });
            $("#editProfile").click(function() {
                $(".view-section").hide();
                $(".update-section").fadeIn();
            });

            // Cancel button
            $("#cancelEdit").click(function() {
                $(".update-section").hide();
                $(".view-section").fadeIn();
            });

            // Update form submit
            $(document).on("submit", "#updateForm", function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "/api/profile-update",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "Authorization": "Bearer " + token,
                    },
                    success: function(res) {
                        Swal.fire({
                            title: "Updated!",
                            text: "Profile updated successfully.",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $(".update-section").hide();
                        $(".view-section").fadeIn();
                        location.reload();
                    },
                    error: function() {
                        Swal.fire("Error", "Something went wrong!", "error");
                    }
                });
            });

            // Logout
            $("#logoutBtn").click(function() {
                $.ajax({
                    url: "/logout",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    headers: {
                        "Authorization": "Bearer " + token,
                    },
                    success: function() {
                        localStorage.removeItem("auth_token");
                        window.location.href = "/";
                    },
                    error: function() {
                        Swal.fire("Error", "Logout failed", "error");
                    }
                });
            });
        });
    </script>
</body>

</html>