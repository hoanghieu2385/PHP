<?php
global $link;
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {              // lay id va xoa khoang trong thua ra bang ham trim
    // import file config
    require_once 'configure.php';
    // truy van toi doi tuong
    $sql = "SELECT * FROM employees WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {          // lay link cua config
        // truyen tham so voi kieu i <integer>
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        // truyen id vao parameter. trim de xoa khoang trong de tranh bi loi
        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) ==1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                header("location : error.php");
                exit();
            }
        } else{
            echo "Oops something went wrong.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    // dong server cho do ton tai nguyen
}else{
    header("location : error.php");     // kiem tra neu loi thi se hien thi file error
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Delete Record</h1>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <p class="form-control-static"><?php echo $row["name"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <p class="form-control-static"><?php echo $row["address"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Salary</label>
                    <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                </div>
                <p><a href="index.php" class="btn btn-primary">Back</a> </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>