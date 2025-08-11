<!-- untuk menambahkan data user -->

<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$rowedit = ['password' => '', 'name' => '', 'email' => ''];     



if(isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = mysqli_query($koneksi, "DELETE FROM users WHERE id = '$id'");

  if($delete){
    header("location:?page=user&hapus=berhasil");
  }
} else {
//   var_dump($_GET);
// die();
}

if ($id) {
  $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id'");
  $rowedit = mysqli_fetch_assoc($query);
  $title = "Edit User";
} else {
  $title = "Tambah User";
}



if(isset($_POST['simpan'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'] ?: $rowedit['password']; // pakai yg lama kalau kosong

  // print_r($password);
  // die;
  if ($id) {
    // UPDATE
    $update = mysqli_query($koneksi, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id'");
    if ($update) {
      header("location:?page=user&ubah=berhasil");
      exit;
    }
  } else {
    // INSERT
    $insert = mysqli_query($koneksi, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    if($insert) {
      header("location:?page=user&tambah=berhasil");
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
              <form action="" method="post">
                <div class="mb-3">
                  <label for="">Nama</label>
                  <input type="text" class="form-control"
                      name="name" placeholder="Masukkan nama anda" required value="<?php echo ($id) ? $rowedit['name'] : '' ?>">
                </div>
                <div class="mb-3">
                  <label for="">Email</label>
                  <input type="text" class="form-control"
                      name="email" placeholder="Masukkan email anda" required value="<?php echo ($id) ? $rowedit['email'] : '' ?>">
                </div>
                <div class="mb-3">
                  <label for="">Password</label>
                  <input type="password" class="form-control"
                      name="password" placeholder="Masukkan password anda" <?php echo (!$id) ? 'required' : ''?>>
                      <?php echo ($id) ? '<small>* Isi password jika ingin mengubah password</small>' : ''?>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary"type="submit" name="simpan">Simpan</button>
                  <a href="?page=user" class="text-noted">Kembali</a>
                </div>
              </form> 
              
            </div>
          </div>
        </div>
      </div>
    </section>