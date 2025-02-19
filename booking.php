<head>
<style>
    body {
        background-image: url("https://media.istockphoto.com/id/146765403/photo/a-luxurious-florida-beach-hotel-during-sunrise.jpg?s=2048x2048&w=is&k=20&c=IvfMrAT6rGuIQ5sKj41ovSRdmhvs6WGRpV3VLle6EhA=");
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: rgba(0, 0, 0, 0.8);
        padding-right: 40px;
        padding-left:30px;
        padding-top:10px;
        padding-bottom:20px;
        border-radius: 15px;
        width: 350px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }
    h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #f8c471;
    }
    input, button {
        margin: 10px;
        padding: 12px;
        width: 97%;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }
    input {
        background: rgba(255, 255, 255, 0.9);
    }
    button {
        background-color: #f8c471;
        color: black;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
        margin-left: 20px;
        width: 40%;
    }
    button:hover {
        background-color: #d68910;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Hotel Booking Form</h2>
        <form method="POST" action="#">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="date" name="checkin_date" required>
            <input type="date" name="checkout_date" required>
            <input type="number" name="gent" min="0" max="4" placeholder="Number of Gents" required>
            <input type="number" name="ladies" min="0" max="4" placeholder="Number of Ladies" required>
            <input type="number" name="children" min="0" max="4" placeholder="Number of Children" required>
            <button type="submit" name = "booknow">Book Now</button>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['booknow'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $gent = $_POST['gent'];
    $ladies = $_POST['ladies'];
    $children = $_POST['children'];

    $today = date("Y-m-d");

    if (strtotime($checkin_date) >= strtotime($today) && strtotime($checkout_date) > strtotime($checkin_date)) {
        
        $sql = "INSERT INTO booking (name, email, phone, checkin_date, checkout_date, gent, ladies, children) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

       
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssiiii", $name, $email, $phone, $checkin_date, $checkout_date, $gent, $ladies, $children);

            if ($stmt->execute()) {
                echo "<script>alert('Booking Successful');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Statement preparation failed');</script>";
        }
    } else {
        echo "<script>alert('Invalid dates! Check-in must be today or later, and check-out must be after check-in.');</script>";
    }
}
$conn->close();
?>
