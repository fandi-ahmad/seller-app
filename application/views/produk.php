<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Produk</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body style="background-color: var(--bs-gray-300);">

<div class="container-fluid p-0 h-100vh d-flex flex-row">

	<div class="sidebar">
		<div class="text-center py-3">
			<div>
				<button class="btn btn-sm bg-light me-2">
					<i class="fa-solid fa-user"></i>
				</button>
				<span>Fandi Ahmad</span>
			</div>
		</div>
		<div class="px-3 mt-5">
			<p>Menu:</p>
			<div class="sidebar-list">
				<span>Dashboard</span>
			</div>
			<div class="sidebar-list bg-soft-blue">
				<a class="nav-link" aria-current="page" href="<?php echo site_url('produk')?>">Product</a>
			</div>
			<div class="sidebar-list">
				<a class="nav-link" aria-current="page" href="<?php echo site_url('pembelian')?>">Order</a>
			</div>
		</div>
		<div class="h-50 mt-5 d-flex align-items-end justify-content-center">
			<a href="<?php echo site_url('produk/logout')?>" class="text-dark fw-bold">
				<i class="fa-solid fa-right-from-bracket"></i>
				Log Out
			</a>
		</div>
	</div>

	<div class="w-100 content p-4">
		<h1 class="mb-4">Product</h1>
		<form action="<?= site_url('produk/simpan') ?>" method="post">
			<?php if (isset($produk)) { ?>
				<input type="hidden" name="id" value="<?= $produk['id'] ?>">
				<div class="w-100 d-flex justify-content-between gap-4">
					<div class="form-group w-100">
						<label for="namaproduk">Product Name</label>
						<input type="text" name="namaproduk" value="<?= $produk['namaproduk'] ?>" placeholder="type here ..." class="form-control">
						<small class="text-danger"><?= form_error('namaproduk') ?></small>
					</div>
					<div class="form-group w-100">
						<label for="price">Price</label>
						<input type="text" name="price" value="<?= $produk['price'] ?>" placeholder="type here ..." class="form-control">
						<small class="text-danger"><?= form_error('price') ?></small>
					</div>
					<div class="d-flex align-items-end">
						<input type="submit" name="update" value="Update" class="btn btn-primary btn-sm">
					</div>
				</div>

				<?php } else { ?>
				<div class="w-100 d-flex justify-content-between gap-4">
					<div class="form-group w-100">
						<label for="namaproduk">Product Name</label>
						<input type="text" name="namaproduk" placeholder="type here ..." class="form-control">
						<small class="text-danger"><?= form_error('namaproduk') ?></small>
					</div>
					<div class="form-group w-100">
						<label for="price">Price</label>
						<input type="text" name="price" placeholder="type here ..." class="form-control">
						<small class="text-danger"><?= form_error('price') ?></small>
					</div>
					<div class="d-flex align-items-end">
						<input type="submit" name="simpan" value="Create" class="btn btn-primary btn-sm">
					</div>
				</div>
			<?php } ?>
		</form>

		<div class="mt-4">
			<div class="d-flex">
				<b class="w-25 ms-2">No</b>
				<b class="w-100">Product</b>
				<b class="w-100">Price</b>
				<b class="w-100">Action</b>
			</div>
			<?php
			$index = 1; 
			foreach ($produks as $prd) { ?>
				<div class="d-flex align-items-center table-list">
					<p class="w-25 pt-2"><?php echo $index ?>.</p>
					<p class="w-100 pt-2"><?php echo $prd['namaproduk'] ?></p>
					<p class="w-100 pt-2">Rp. <?php echo $prd['price'] ?></p>
					<div class="w-100">
						<a href="produk/edit/<?php echo $prd['id']?>" class="text-primary hover-btn">
							<i class="fa-solid fa-pen-to-square"></i>
						</a>
						<a href="produk/hapus/<?php echo $prd['id']?>" class="text-danger hover-btn ms-4">
							<i class="fa-solid fa-trash"></i>
						</a>
					</div>
				</div>
			<?php $index++; } ?>
		</div>
	</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


