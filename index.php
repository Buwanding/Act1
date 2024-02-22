<?php

require 'conn.php';
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST"){
        $schoolid = $_REQUEST['schoolid'];
        $first_name = $_REQUEST['first_name'];
        $middle_initial = $_REQUEST['middle_initial'];
        $last_name = $_REQUEST['last_name'];
        $gender = $_REQUEST['gender'];
        $date_of_birth = $_REQUEST['date_of_birth'];
        $course = $_REQUEST['course'];
        $sql = "INSERT INTO tblstudents (schoolid, first_name, middle_initial, last_name, gender, date_of_birth, course) VALUES ('$schoolid', '$first_name','$middle_initial','$last_name','$gender','$date_of_birth','$course')";
        $res = $conn->query($sql);
        if ($res === TRUE) {
            echo "Record added";
        } else {
            echo "Error: " . $conn->error;
        }
}
elseif($method === "PUT"){
     $_PUT = file_get_contents("php://input");
        parse_str($_PUT, $put_vars);
        $schoolid = $put_vars['schoolid'];
        $first_name = $put_vars['first_name'];
        $middle_initial = $put_vars['middle_initial'];
        $last_name = $put_vars['last_name'];
        $gender = $put_vars['gender'];
        $date_of_birth = $put_vars['date_of_birth'];
        $course = $put_vars['course'];
        $sql = "UPDATE tblstudents SET first_name='$first_name', middle_initial='$middle_initial', last_name='$last_name', gender='$gender', date_of_birth='$date_of_birth', course='$course' WHERE schoolid='$schoolid'";
        $res = $conn->query($sql);
        if ($res === TRUE) {
            echo "Record updated";
        } else {
            echo "Error: " . $conn->error;
        }
}
elseif($method === "DELETE"){
     $schoolid = $_GET['schoolid'];
        $sql = "DELETE FROM tblstudents WHERE schoolid='$schoolid'";
        $res = $conn->query($sql);
        if ($res === TRUE) {
            echo "Record deleted";
        } else {
            echo "Error: " . $conn->error;
        }
     
}
else{

        var_dump($_GET);
        $data = $_GET;
        if (isset($data['search'])) {
            $search = $data['search'];
            $sql = "SELECT * FROM tblstudents WHERE schoolid = '$search' OR first_name = '$search'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo json_encode($row, JSON_PRETTY_PRINT);
                }
            } else {
                echo "No results found.";
            }
        } else {
            $sql = "SELECT * FROM tblstudents";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo json_encode($row, JSON_PRETTY_PRINT);
                }
            } else {
                echo "No results found.";
            }
        }
};
?>