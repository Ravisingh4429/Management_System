<?php
// session_start();
include("../sweat_alert/sw.php");
include("../com.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap.css" />
    <link rel="stylesheet" href="../dashboard/home.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row first">
            <div class="col-md-2 top2">
                <a href="../dashboard/home.php">
                    <h5><i class="fa-brands fa-slack fa-xl"></i> ABC COLLAGE Teacher Portal</h5>
                </a>
            </div>
            <div class="col-md-10 topbar">
                <ul>
                    <li>
                        <a href="../manage account/logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff"></i></a>
                    </li>
                    <li><a href="../notification/fetch.php"><i class="fa-solid fa-bell"></i></a></li>

                    <li><a href="../announcement/anoc.php"><i class="fa-solid fa-bullhorn"></i></a></li>
                    <li><a href="../personal fetch/pfetch.php">
                            <?php
                            if ($_SESSION["uname"] != "") {
                                echo $_SESSION["uname"];
                            } else {
                                header("location:../manage account/login.php");
                            }
                            ?>
                        </a></li>
                </ul>
            </div>
        </div>
        <div class="row sidemain">
            <div class="col-md-2 side">
                <ul>
                    <li>
                        <a href="../dashboard/home.php">
                            <i class="fa-solid fa-house fa-xl" style="color: #000000"></i>Dashboard</a>
                    </li>
                    <li>
            <a href="../teacher_att/startatt.php"><i class="fa-regular fa-square-check fa-xl" style="color: #000000"></i>Teacher
              Attendance</a>
          </li>
          <li>
            <a href="../student_query/fetch_query.php"> <i class="fa-solid fa-clipboard-question fa-xl" style="color: #030303;"></i> student's query</a>
          </li>
          <li><a href="../studey_material/study.php"><i class="fa-solid fa-book fa-xl" style="color: #000000;"></i>Study Material</a>

          </li>
          <li>
            <a href="../time_table/fetch.php"><i class="fa-regular fa-clock fa-xl" style="color: #000000"></i>Time Table</a>
           
          </li>
                    <li>
                        <a href="./year.php"><i class="fa-regular fa-square-check fa-xl" style="color: #000000"></i>Student
                            Attendance</a>
                        <ul id="tec">
                            <li><a href="./att_reg.php">Attendance</a></li>
                            <li><a href="./att_report.php">Attendance Report</a></li>
                        </ul>
                    </li>

                    
                </ul>
            </div>
            <div class="col-md-10">

                <div class="row justify-content-between py-3">
                    <div class="col-md-3">
                        <form action="<?php $_SERVER["PHP_SELF"] ?>" onsubmit="return vali()" method="post">
                            <label class="text-success" for="report">
                                Report Date
                            </label>
                            <input type="date" id="rd" class="form-control" name="date">
                            <p id="errda" class="err"></p>

                    </div>
                    <div class="col-md-3">
                        <label for="year">
                            Year
                        </label>
                        <select name="year" id="year" class="form-control">
                            <option value="">select</option>
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                            <option value="fourth">fourth</option>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="submit" value="Search" class="form-control btn btn-success" name="sub">

                    </div>
                    </form>
                </div>
                <div class="table-responsive py-1">

                    <?php
                    if (isset($_POST["sub"])) {
                        $date = $_POST["date"];
                        $year = $_POST["year"];
                    ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Stu Id</th>
                                <th> Name</th>
                                <th> Time</th>
                                <th>Year</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "mini");
                                $str = "select s.stu_id,s.sname,satt.status,satt.time,satt.year from stu as s , course as c , bba_stuatt as satt where s.course_id = c.course_id and s.stu_id = satt.stu_id and satt.date = '$date' and satt.year='$year' and satt.course_id='$c_id'";
                                $res = mysqli_query($conn, $str);
                                while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["stu_id"] ?></td>
                                        <td><?php echo $row["sname"] ?></td>
                                        <td><?php echo $row["time"] ?></td>
                                        <td><?php echo $row["year"] ?></td>
                                        <td><?php echo $row["status"] ?></td>
                                    </tr>
                            </tbody>
                    <?php
                                }
                            }
                    ?>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var rd = document.getElementById("rd");

        var no = 1;

        function vali() {
            if (rd.value == "") {
                document.getElementById("errda").innerHTML = "select date";
                no = 0;
            } else {
                document.getElementById("errda").innerHTML = "";
                no = 1;

            }



            if (no) {

                return true;
            } else {
                return false;

            }
        }
    </script>
</body>

</html>