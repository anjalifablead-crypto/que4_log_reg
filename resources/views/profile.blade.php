<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="container mt-5">

    <h2 class="mb-4">User Profile</h2>

    <div class="card p-4" id="profileCard" style="display:none;">
        <div class="row">
            <div class="col-md-3">
                <img id="userImage" src="" alt="Profile Image" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-9">
                <p><strong>Name:</strong> <span id="userName"></span></p>
                <p><strong>Email:</strong> <span id="userEmail"></span></p>
                <p><strong>Age:</strong> <span id="userAge"></span></p>
                <p><strong>Gender:</strong> <span id="userGender"></span></p>
                <p><strong>Hobby:</strong> <span id="userHobby"></span></p>
                <p><strong>City:</strong> <span id="userCity"></span></p>
            </div>
        </div>
    </div>
    <form id="logoutForm">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    <div id="errorMsg" class="alert alert-danger" style="display:none;">
        You are not logged in. Please <a href="/">login</a>.
    </div>

    <script>
        $(document).ready(function() {
            let token = localStorage.getItem("auth_token");
            // Fetch user profile using token
            $.ajax({
                url: "/api/profile1",
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("auth_token"),
                },
                success: function(res) {
                    res = res.user;
                    $("#profileCard").show();
                    $("#userName").text(res.uname);
                    $("#userEmail").text(res.email);
                    $("#userAge").text(res.age);
                    $("#userGender").text(res.gender);
                    $("#userHobby").text(res.hobby);
                    $("#userCity").text(res.city);

                    if (res.image) {
                        $("#userImage").attr("src", "/uploads/" + res.image);
                    } else {
                        $("#userImage").attr("src", "https://via.placeholder.com/150");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        // Token expired or invalid
                        $("#errorMsg").show().text("Session expired... Please login again.");
                        localStorage.removeItem("auth_token"); // clear old token
                    }
                }
            });
            $(document).on("submit", "#logoutForm", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "/logout",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Send CSRF token as data
                    },
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem("auth_token"),
                    },
                    // headers: {
                    //     "Authorization": "Bearer " + localStorage.getItem("token"), // send stored token
                    // },
                    success: function(res) {
                        // Clear token from storage
                        localStorage.removeItem("token");

                        // Redirect to login page
                        window.location.href = "/";
                    },
                    error: function() {
                        alert("Logout failed!");
                    }
                });
            });
        });
    </script>

</body>

</html>