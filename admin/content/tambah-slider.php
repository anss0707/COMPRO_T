<!-- untuk menambahkan data sliders-->

<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
// $rowedit = ['password' => '', 'name' => '', 'email' => ''];     



if(isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = mysqli_query($koneksi, "DELETE FROM sliders WHERE id = '$id'");

  if($delete){
    header("location:?page=slider&hapus=berhasil");
  }
} else {
//   var_dump($_GET);
// die();
}

if ($id) {
  $query = mysqli_query($koneksi, "SELECT * FROM sliders WHERE id = '$id'");
  $rowedit = mysqli_fetch_assoc($query);
  $title = "Edit sliders";
} else {
  $title = "Tambah sliders";
}



if(isset($_POST['simpan'])){
  $judul_foto = $_POST['judul_foto'];
  $description = $_POST['description'];

  if(!empty($_FILES['image'] ['name'])) {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $type = mime_content_type($tmp_name);



        $eks_allowed = ["image/png" , "image/jpg" , "image/jpeg"];
        if(in_array($type, $eks_allowed)){

        $path = "uploads/";
        
        if(!is_dir($path)){
          mkdir($path); 
          
        }

        $image_name = time() . "-" . basename($image);
        $target_file = $path . $image_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // jika gambarnya ada maka gambar sebelumnya akan diganti oleh gambar baru
            if (!empty($row['image'])) {
                unlink($path . $row['image']);
            }
        }
        } else {
          echo "gagal, gambar tidak sesuai arahan";
          die;
        }

        
  }
  // print_r($password);
  // die;
  if ($id) {
    // UPDATE
    $update = mysqli_query($koneksi, "UPDATE sliders SET title='$judul_foto', description='$description', image='$image_name' WHERE id='$id'");
    if ($update) {
      header("location:?page=slider&ubah=berhasil");
      exit;
    }
  } else {
    // INSERT
    $insert = mysqli_query($koneksi, "INSERT INTO sliders (title, description, image) VALUES ('$judul_foto', '$description', '$image_name')");
    if($insert) {
      header("location:?page=slider&tambah=berhasil");
      exit;
    }
  }
}
?>






<div class="pagetitle">
      <h1><?php echo $title?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $title?></h5>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="" class="fw-bold">Gambar</label>
                  <input type="file" class="form-control"
                      name="image" required >
                      <small class="text-muted">)* Size : 1920*1088</small>
                  <img width="100" src="uploads/<?php echo ($id) ? $rowedit['image'] : '' ?>" alt="">
                </div>
                <div class="mb-3">
                  <label for="" class="fw-bold">Judul</label>
                  <input type="text" class="form-control"
                      name="judul_foto"   required value="<?php echo ($id) ? $rowedit['title'] : '' ?>" alt="">
                </div>
                <div class="mb-3">
                  <label for="" class="fw-bold">Isi</label>
                  <textarea name="description" id="" class="form-control"><?php echo ($id) ? $rowedit['description'] : '' ?></textarea>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary"type="submit" name="simpan">Simpan</button>
                  <a href="?page=slider" class="text-noted">Kembali</a>
                </div>
              </form> 
              
            </div>
          </div>
        </div>
      </div>
    </section>