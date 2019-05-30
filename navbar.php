<div class="user-login bg-warning">
    <?php echo login_user_greeter(); ?>
    | <a class="font-weight-bold text-dark" href="user_edit.php"> Edit</a>
    | <a class="font-weight-bold text-dark" href="system/process.php?process=logout"> Log Out</a>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
        <ul class="navbar-nav col-12">
            <li class="nav-item col-3 text-center">
                <a class="btn btn-primary btn-block" href="index.php">HOME PAGE</a>
            </li>
            <li class="nav-item col-3 text-center dropdown">
                <a class="btn btn-primary btn-block dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    LESSONS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="lessons.php">View Lessons</a>
                    <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                        <hr>
                        <a class="dropdown-item" href="lesson_add.php">Add Lesson</a>
                        <a class="dropdown-item" href="lesson_delete.php">Delete Lesson</a>
                    <?php } ?>
                    <hr>
                    <a class="dropdown-item" href="lesson_adds.php">Add Lesson File</a>
                </div>
            </li>
            <li class="nav-item col-3 text-center">
                <a class="btn btn-primary btn-block" href="projects.php">PROJECTS</a>
            </li>
            <li class="nav-item col-3 text-center dropdown">
                <a class="btn btn-primary btn-block dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    STUDENTS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="messages.php">My Messages</a>
                    <hr>
                    <a class="dropdown-item" href="ungratuated_students.php">Undergratuated Students</a>
                    <a class="dropdown-item" href="gratuated_students.php">Gratuated Students</a>
                </div>
            </li>
        </ul>
    </div>
</nav>