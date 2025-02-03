<?php
    session_start();

    // Check if user is logged in, redirect to login if not
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    include 'header.php';
    include 'dbcon.php';
?>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="card-header ">
                <h5 class="card-title text-secondary">Student Details</h5>
                <!-- ADD Button to trigger modal -->
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">ADD</button>
                    <a href="logout.php" class="btn btn-danger">Logout</a> 
                </div>
            </div>

            <!-- Student Details Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // Fetch all records from the student table
                        $query = "SELECT * FROM student";
                        $result = mysqli_query($connection, $query);

                        if ($result) {
                            // Loop through each record and display in the table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td class='text-center'>{$row['id']}</td>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td>{$row['age']}</td>
                                        <td>
                                            <!-- Edit Button with data attributes for modal -->
                                            <button class='btn btn-success' data-toggle='modal' data-target='#updateModal' 
                                                data-id='{$row['id']}' data-fname='{$row['first_name']}' 
                                                data-lname='{$row['last_name']}' data-age='{$row['age']}'>Edit</button>
                                            <!-- Delete Button -->
                                            <a href='delete_data.php?delete_id={$row['id']}' class='btn btn-danger' 
                                                onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            // If no records are found
                            echo "<tr><td colspan='5'>No records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- For Add Modal -->
            <form action="insert_data.php" method="post">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                            </div>
                            <div class="modal-body">
                                <!-- Input fields for adding a student -->
                                <div class="form-group">
                                    <label for="f_name">First Name:</label>
                                    <input type="text" class="form-control" name="f_name" placeholder="Enter First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="l_name">Last Name:</label>
                                    <input type="text" class="form-control" name="l_name" placeholder="Enter Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="add_students">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- For Update Modal -->
            <form action="update_data.php" method="post">
                <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Student</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!-- Hidden field to store student ID -->
                                <input type="hidden" name="id" id="update_id">
                                <!-- Input fields for updating student details -->
                                <div class="form-group">
                                    <label for="f_name">First Name:</label>
                                    <input type="text" class="form-control" name="f_name" id="update_fname" required>
                                </div>
                                <div class="form-group">
                                    <label for="l_name">Last Name:</label>
                                    <input type="text" class="form-control" name="l_name" id="update_lname" required>
                                </div>
                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="number" class="form-control" name="age" id="update_age" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="update_student">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        // Populate the update modal with student data
        $('#updateModal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget);
            $('#update_id').val(button.data('id'));
            $('#update_fname').val(button.data('fname'));
            $('#update_lname').val(button.data('lname'));
            $('#update_age').val(button.data('age'));
        });
    </script>

<?php include('footer.php'); ?>
