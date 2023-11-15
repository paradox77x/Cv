    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Curriculum Vitae</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .profile-img {
                max-width: 100%;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="ms-4 navbar-brand">Curriculum vitae</a>
                <form class="form-inline">             
                <a href="edit.php" class="btn btn-warning my-2 my-sm-0 me-4" >Edit</a>
                </form>
            </nav>


            <hr>

            <div class="row">
                <div class="col-md-6">
                    <?php
                    include_once("config.php");

                    $sql = "SELECT * FROM cv_data WHERE id = 1"; // Ganti '1' dengan ID entri yang ingin Anda tampilkan
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <img src="<?php echo $row["foto_path"]; ?>" alt="Your Photo" class="profile-img">
                        </div>
                        <div class="col-md-6">
                            <h3>Informasi Pribadi</h3>
                            <ul class="list-unstyled">
                                <li><strong>Nama:</strong> <?php echo $row["nama"]; ?></li>
                                <li><strong>Alamat:</strong> <?php echo $row["alamat"]; ?></li>
                                <li><strong>Telepon:</strong> <?php echo $row["telepon"]; ?></li>
                                <li><strong>Email:</strong> <?php echo $row["email"]; ?></li>
                                <li><strong>Website:</strong> <a href="<?php echo $row["web"]; ?>"><?php echo $row["web"]; ?></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3>Pendidikan</h3>
                        <ul>
                            <li><strong><?php echo $row["pendidikan"]; ?></strong></li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h3>Pengalaman Kerja</h3>
                        <ul>
                            <li><strong><?php echo $row["pengalaman_kerja"]; ?></strong></li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h3>Keterampilan</h3>
                        <ul>
                            <p><?php echo $row["keterampilan"]; ?></p>
                        </ul>
                    </div>
                    <?php
                        }
                    } else {
                        echo "Tidak ada data.";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-o1+zUH0G9pXyxfU7UJXJL8C5CY3S0jYVqdoR2EeXT7A0Q5IYk4N9dizqAAZcS6pA"
                crossorigin="anonymous"></script>
        </div>
    </body>

    </html>
