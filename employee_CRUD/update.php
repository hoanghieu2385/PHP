<?php
global $link;
require_once 'configure.php';           // yeu cau file config

// dinh nghia cac bien
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";            // neu co loi thi se luu thong bao loi

if(isset($_POST["id"])&& !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name.";
    }elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'.\s ]+$/")))){
        $name_err = 'Please enter a valid name';
    } else{
        $name=$input_name;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)){
        $address_err = "Please enter an address";
    } else{
        $address = $input_address;
    }

    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)){
        $salary_err = "Please enter the salary amount";
    }elseif(!ctype_digit($input_salary)){
        $salary_err ='Please enter a positive integer value';
    }else{
        $salary = $input_salary;
    }

    if (empty($name_err) && empty($address_err) &&empty($salary_err)){
        // thay doi name, address, salary du theo id da chon
        $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)){
            // co 4 tham so thi 3 cai dau la string (s) va cai cuoi la so thi la integer (i)
            mysqli_stmt_bind_param($stmt,"sssi",$param_name, $param_address, $param_salary, $param_id);
            $param_name=$name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)){
                header("location:gallery.php");
                exit();
            }else{
                echo "Something went Wrong. Please try again later";
            }
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    // dong ket noi

} else{ // lan dau up len thi se dung ham get de lay du lieu
    if (isset($_GET["id"])&& !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM employees WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id= $id;

            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) ==1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                } else{
                    header("location: error.php");
                    exit();
                }

            }else{
                echo "Oops!! Something went wrong, try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        // dong ket noi

    }else{
        header("location : error.php");
        exit();
    }
}
?>
<!DOCTYPE  html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                    <h2>Update Record</h2>
                </div>
                <p>Please edit tje input values and submit to update the record</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <label>
                        <!-- Neu co du lieu phu hop thi se duoc them vao name qua ham echo $name  -->
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        </label>
                        <!-- Du lieu khong phu hop thi se duoc in ra loi va bang mau do  -->
                        <span class="help-block"><?php echo $name_err?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($address_err))? 'has-error' : '';?>">
                        <label>Address</label>
                        <label>
                            <!-- Neu co du lieu phu hop thi se duoc them vao address qua ham echo $address  -->
                            <textarea name="address" class="form-control"><?php echo $address;?></textarea>
                        </label>
                        <!-- Du lieu khong phu hop thi se duoc in ra loi va bang mau do  -->
                        <span class="help-block"><?php echo $address_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($salary_err))? 'has-error': '';?>">
                        <label>Salary</label>
                        <label>
                            <!-- Neu co du lieu phu hop thi se duoc them vao salary qua ham echo $salary  -->
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary;?>">
                        </label>
                        <!-- Du lieu khong phu hop thi se duoc in ra loi va bang mau do  -->
                        <span class="help-block"><?php echo $salary_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>