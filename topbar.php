<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 75px">
    <div class="container">
        <a class="navbar-brand float-left" href="#"><img src="attends/logo.png" alt="Çankaya Üniversitesi Logo" style="height: 70px"></a>
        <a class="navbar-brand font-weight-bold" style="margin-left: 60px" href="index.php">LEARNSTH</a>
        <div>
            <form action="search.php" method="get">
                <div class="form-group">
                    <label class="w-100 mt-4">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Student..." required maxlength="20" style="width: 150px"
                            <?php echo (!isset($_SESSION["user_login"])) ? "disabled" : ""?>>
                    </label>
                </div>
                <label class="w-100 d-none"><input type="submit" name="process" value="search" class="btn btn-primary btn-block"></label>
            </form>
        </div>
    </div>
</nav>