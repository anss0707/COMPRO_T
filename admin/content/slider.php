<!-- untuk menambahkan data user -->

<?php
$query = mysqli_query($koneksi, "SELECT * FROM sliders ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
      <h1>Data User </h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Slider</h5>

                <div class="mb-3" align="right">
                    <a href="?page=tambah-slider" class="btn btn-primary">Tambah</a> 
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th></th>
                    </tr>
                </thead>
                <tb>
                    <?php foreach($rows as $key => $row):?>
                    <tr>
                        <td><?php echo $key += 1?></td>
                        <td><img src="uploads/<?php echo $row['image']?>" alt="" width="250px"></td>
                        <td><?php echo $row['title']?></td>
                        <td><?php echo $row['description']?></td>
                        <td>
                            <a href="?page=tambah-slider&edit=<?php echo $row['id']?>" class="btn btn-sm btn-success">
                                edit
                    </a>
                        
                        <a
                        onclick="return confirm('yakin ingin delete?')" 
                        href="?page=tambah-slider&delete=<?php echo $row['id']?>" 
                        class="btn btn-sm btn-danger">
                            delete
                    </a>
                        </td>
                    </tr>
                </tb>
                <?php endforeach;?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>