<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $phone = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($phone) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        
        $sql = "INSERT INTO contact (name, email, phone, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $phone,$message);

            if ($stmt->execute()) {
                echo "<script>alert('Message sent successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        }
    } else {
        echo "<script>alert('Invalid input! Please enter valid details.');</script>";
    }
}

$conn->close();
?>
<head>
<style>
    body {
        background-image: url('https://images.unsplash.com/photo-1445019980597-93fa8acb246c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGhvdGVsfGVufDB8fDB8fHww');
        background-size: cover;
        background-position: center; 
        background-repeat: no-repeat; 
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
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        width: 350px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }
    h2 {
        color: #f8c471;
    }
    input, textarea, button {
        margin: 10px;
        padding: 12px;
        width: 95%;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }
    input, textarea {
        background: rgba(255, 255, 255, 0.9);
    }
    textarea {
        height: 100px;
        resize: vertical;
    }
    button {
        background-color: #f8c471;
        color: black;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }
    button:hover {
        background-color: #d68910;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form method="POST" action="#">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <textarea name="message" placeholder="Enter Message" required></textarea>
            <button type="submit" name="submit">Send Message</button>
        </form>
    </div>
</body>
</html>

