<?php

require 'config.php';
require 'model/client.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$data = Client::getAll($conn);
if (!$data) {
    echo "Error while user loading clients";
    die();
}

$result = mysqli_query($conn, "SELECT * FROM clients");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Beauty Salon Nina</title>
</head>

<body>

    <div class="collapse" id="navbarToggleExternalContent">
        <div class="p-4" style="background-color:  #480263;">
            <a style="text-decoration:none" href="index.php">
                <h5 class="text-white h4">Home page</h5>
            </a>

            <a style="text-decoration:none" href="login.php">
                <h5 class="text-white h4">Login</h5>
            </a>

            <a style="text-decoration:none" href="main.php">
                <h5 class="text-white h4">Make an appointment</h5>
            </a>

        </div>
    </div>
    <nav class="navbar navbar-dark" style="background-color: #480263;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div style=" float: right;">
                <input type="text" style="text-decoration: #480263; margin-right: 90px;border:#d90d0d; " id="searching" onkeyup="search()" placeholder="Find your appointment" title="Clients appointment">
                <a href="logout.php" class="btn btn-third" style=" background-color: white; margin-right: 15px;min-width: 100px; border-radius: 8px; border: none;">Logout</a>
            </div>
        </div>
    </nav>
    <br>
    <div class="container w-50" style="margin:0%; margin:20px; margin-left: 400px; float:center;">
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-success" role="alert" style=" background-color:  #ffedf6fd; border-color:  #ffedf6fd; margin-bottom: -35px; text-align: center;">
                    <?php echo "WELCOME TO OUR BEAUTY SALON NINA"; ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Appointments</h2>
                    </div>
                    <div class="col-sm-6">
                        <button id="btn-sort" class="btn btn-normal" onclick="sort()">Sort</button>
                        <button id="btn-add" data-bs-target="#modalAddAppointment" class="btn btn-second" data-bs-toggle="modal"> <span>Make an appointment</span></button>
                        <button type="button" data-bs-target="#modalDeleteAppointment" class="btn btn-second" data-bs-toggle="modal"> <span>Delete</span></button>
                    </div>
                </div>
            </div>

            <table id="wholeTable" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Appointment Date</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td>
                                <label class="form-check-label">
                                    <input type="checkbox" name="slct" value="<?php echo $row['id']; ?> ">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["surname"]; ?></td>
                            <td><?php echo $row["date"]; ?></td>
                            <td><?php echo $row["service"]; ?></td>
                            <td>
                                <a href="#modalEditAppointment" class="edit" data-bs-toggle="modal"><i class="btn-edit material-icons" data-bs-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#modalDeleteAppointment" class="delete" data-bs-toggle="modal"><i class=" material-icons" data-bs-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                    <?php

                    }

                    ?>
                    <?php
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>


            <nav aria-label="navigation" class="clearfix">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item "><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>



    <div id="modalAddAppointment" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="#" id="addForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Add your appointment</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required style="border-radius: 7px;">
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="surname" placeholder="Your Surname" required style="border-radius: 7px;">
                        </div>
                        <div class="form-group">
                            <label>Time</label>
                            <input type="datetime-local" class="form-control" name="date" placeholder="Add desired date and time" required style="border-radius: 7px;">
                        </div>
                        <div class="form-group">
                            <label>Service</label>
                            <input type="text" class="form-control" name="service" placeholder="What service do you want?" required style="border-radius: 7px;">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <button id="btnAdd" type="submit" class="btn" style="background-color: #e6c4bc; border-radius: 7px;">Add apointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div id="modalEditAppointment" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="post" action="#">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit your appointment</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Id</label>
                            <input id="id" class="form-control" name="id" value="" type="text" readonly style="border-radius: 7px;">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="" required style="border-radius: 7px;">
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input id="surname" type="text" class="form-control" name="surname" value="" required style="border-radius: 7px;">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input id="date" class="form-control" name="date" value="" type="datetime-local" required style="border-radius: 7px;">

                        </div>
                        <div class="form-group">
                            <label>Service</label>
                            <input id="service" class="form-control" name="service" value="" type="text" required style="border-radius: 7px;">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <button id="btnEdit" type="submit" class="btn" style="background-color: #e6c4bc; border-radius: 7px;">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="modalDeleteAppointment" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="post" id="deleteForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete the appointment</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this appointment?</p>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <button id="btnDelete" formmethod="POST" class="btn" style="background-color: #e6c4bc; border-radius: 7px;">Delete appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include 'headings/footer.php';
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="main.js"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#message');
            }, 3000);
        });




        function sort() {
            var table, tableRows, change, i, el1, el2, rotate;
            table = document.getElementById("wholeTable");
            change = true;

            while (change) {
                change = false;
                tableRows = table.rows;
                for (i = 1; i < (tableRows.length - 1); i++) {
                    rotate = false;
                    el1 = tableRows[i].getElementsByTagName("td")[1];
                    el2 = tableRows[i + 1].getElementsByTagName("td")[1];
                    if (el1.innerHTML.toLowerCase() > el2.innerHTML.toLowerCase()) {
                        rotate = true;
                        break;
                    }
                }
                if (rotate) {
                    tableRows[i].parentNode.insertBefore(tableRows[i + 1], tableRows[i]);
                    change = true;
                }
            }
        }



        function search() {
            var entered, chose, table, tr, td, i, value;

            entered = document.getElementById("searching");
            chose = entered.value.toUpperCase();
            table = document.getElementById("wholeTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    value = td.textContent || td.innerText;
                    if (value.toUpperCase().indexOf(chose) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";

                    }
                }
            }


        }
    </script>

</body>

</html>