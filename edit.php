<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Builder</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <?php
    include_once("config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"];
      $nama = $_POST["nama"];
      $alamat = $_POST["alamat"];
      $telepon = $_POST["telepon"];
      $email = $_POST["email"];
      $web = $_POST["web"];
      $pendidikan = nl2br($_POST["pendidikan"]);
      $pengalaman_kerja = nl2br($_POST["pengalaman_kerja"]);
      $keterampilan = nl2br($_POST["keterampilan"]);
      // Cek apakah ada file yang diunggah
      if ($_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["foto"]["tmp_name"];
        $name = $_FILES["foto"]["name"];
        $foto_path = "img/" . $name; // Tentukan path file tujuan
        
        // Pindahkan file ke folder "img"
        move_uploaded_file($tmp_name, $foto_path);
      }

      $sql = "UPDATE cv_data SET 
        nama='$nama', 
        alamat='$alamat', 
        telepon='$telepon', 
        email='$email', 
        web='$web', 
        pendidikan='$pendidikan', 
        pengalaman_kerja='$pengalaman_kerja', 
        keterampilan='$keterampilan', 
        foto_path='$foto_path' 
        WHERE id=$id";

      if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    ?> 
        <h2 class="text-center mb-5">PEMBUATAN CV</h2> 
        <form action="edit.php" method="POST" enctype="multipart/form-data">
        <?php
      include_once("config.php");

      $sql = "SELECT * FROM cv_data WHERE id = 1"; // Ganti '1' dengan ID entri yang ingin Anda tampilkan
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $row["nama"]; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat"><?php echo $row["alamat"]; ?></textarea>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $row["telepon"]; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>">
            </div>
            <div class="form-group">
                <label for="web">Web:</label>
                <input type="text" class="form-control" id="web" name="web" value="<?php echo $row["web"]; ?>">
            </div>
            <div class="form-group">
                <label for="pendidikan">Pendidikan:</label>
                <textarea class="form-control" id="pendidikan" name="pendidikan"><?php echo $row["pendidikan"]; ?></textarea>
            </div>
            <div class="form-group">
                <label for="pengalaman_kerja">Pengalaman Kerja:</label>
                <textarea class="form-control" id="pengalaman_kerja"
              name="pengalaman_kerja"><?php echo $row["pengalaman_kerja"]; ?></textarea>
            </div>
            <div class="form-group">
                <label for="keterampilan">Keterampilan:</label>
                <textarea class="form-control" id="keterampilan"
              name="keterampilan"><?php echo $row["keterampilan"]; ?></textarea>    
            <div class="form-group">
                <label for="foto_path">Foto Path:</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

        </form>
        
        <?php
        }
      } else {
        echo "Tidak ada data.";
      }

      $conn->close();
      ?>
            <button type="submit" class="btn btn-primary">Simpan</button>

    </div>
</body>
</html>