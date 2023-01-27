<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form Edit</title>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap.min.css">
	<style>
    .navbar {
      background-color: #2E5EDA;
      width: 100%;
    }
    .main {
      padding-top: 40px;
    }
  </style>
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="<?= base_url() ?>">E-Mahasiswa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="<?= base_url() ?>">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
	<div class="card main">
		<div class="card-body">
			<div class="row">
				<h1 style="text-align: center;">Edit Data</h1>
				<form method="post" enctype="multipart/form-data" action="<?= base_url()?>user/e_data">
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">User ID</label>
						<div class="col-sm-10">
							<input type="hidden" name="getid" class="form-control" value="<?= $getdata->user_id; ?>">
							<input type="number" name="user_id" class="form-control" value="<?= $getdata->user_id; ?>">
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" value="<?= $getdata->nama; ?>">
						</div>
					</div>
			  	<fieldset class="row mb-3">
						<legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
						<div class="col-sm-10">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="jk" value="laki-laki" <?php if($getdata->jk=="laki-laki") echo 'checked="checked"'; ?> >
								<label class="form-check-label">Laki-laki</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="jk" value="perempuan" <?php if($getdata->jk=="perempuan") echo 'checked="checked"'; ?> >
								<label class="form-check-label">Perempuan</label>
							</div>
						</div>
				  	</fieldset>
			  		<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<textarea type="text" name="alamat" class="form-control"><?= $getdata->alamat; ?></textarea>
						</div>
					</div>
			  		<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Foto</label>
						<img src="<?= base_url().'assets/images/'.$getdata->gambar?>" style="width: 120px;">
						<div class="col-sm-9">
							<input type="file" name="foto" accept="image/png, image/gif, image/jpeg" class="form-control">
						</div>
					</div>
					<button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
					<a href="<?= base_url()?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
</body>
</html>