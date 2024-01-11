<?php
global $link;
require_once 'configure.php';       // yeu cau file config

// dinh nghia cac bien
$name = $address = $salary="";
$name_err = $address_err = $salary_err = "";     // neu co loi thi se luu thong bao loi

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    //validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name";
    }
    // kiem tra neu co loi thi se hien thi gia tri loi
    elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z' -.\s]+$/")))){
        $name_err = 'Please enter a valid name';
    } else{
        // neu thoa man thi se gan name bang gia tri nhap vao
        $name = $input_name;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)){
        $address_err = "Please enter an address";
    } else{
        // neu thoa man thi se gan name bang gia tri nhap vao
        $address = $input_address;
    }


    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)){
        $salary_err = "Please enter the salary amount";
    }elseif(!ctype_digit($input_salary)){
        // kiem tra neu co loi o salary thi se hien thi gia tri khong hop le
        $salary_err ='Please enter a positive integer value';
    }else{
        $salary = $input_salary;
    }

    //check input errors before inserting in database
    if (empty($name_err)&& empty($address_err) && empty($salary_err)){
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?,?,?)";
                                         // 3 gia tri nen can 3 cai ???
        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"sss",$param_name, $param_address, $param_salary);

            $param_name=$name;
            $param_address = $address;
            $param_salary = $salary;;
            if (mysqli_stmt_execute($stmt)){
                header("location:index.php");
                exit();
            }else{
                echo "Something went Wrong. Please try again later";
            }
        }
        mysqli_stmt_close($stmt);
    }
    // dong ket noi
    mysqli_close($link);
}
?>
<!DOCTYPE  html>
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
                    <h2>Create Record</h2>
                </div>
                <p>Please fill this form and submit to add employee record to the database</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                    <!-- kiem tra $name_err neu co loi thi se hien thi mau do -->
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($address_err))? 'has-error' : '';?>">
                        <!-- kiem tra $address_err neu co loi thi se hien thi mau do -->

                        <label>Address</label>
                        <textarea name="address" class="form-control"><?php echo $address;?></textarea>
                        <span class="help-block"><?php echo $address_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($salary_err))? 'has-error': '';?>">
                        <!-- kiem tra $salary_err neu co loi thi se hien thi mau do -->
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control" value="<?php echo $salary;?>">
                        <span class="help-block"><?php echo $salary_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>