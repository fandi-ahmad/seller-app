<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
	<link rel="icon" href="<?php echo base_url('assets/img/shop.png') ?>">
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
				<a class="nav-link" aria-current="page" href="<?php echo site_url('dashboard')?>">
                    <span class="icon"><i class="fa-solid fa-house"></i></span>
                    <span>Dashboard</span>
                </a>
			</div>
			<div class="sidebar-list">
				<a class="nav-link" aria-current="page" href="<?php echo site_url('produk')?>">
                    <span class="icon"><i class="fa-solid fa-box-open"></i></span>
                    <span>Product</span>
                </a>
			</div>
			<div class="sidebar-list bg-soft-blue">
				<a class="nav-link" aria-current="page" href="<?php echo site_url('pembelian')?>">
                    <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span> 
                    <span>Order</span>   
                </a>
			</div>
		</div>
        <div class="h-50 mt-5 d-flex align-items-end justify-content-center">
			<a href="<?php echo site_url('produk/logout')?>" class="fw-bold logout">
				<i class="fa-solid fa-right-from-bracket"></i>
				Log Out
			</a>
		</div>
	</div>

    <div class="w-100 content p-4">
		<h1 class="mb-4">Order</h1>
        <form action="<?= site_url('pembelian/simpan') ?>" method="post">
            <?php if (isset($pembelian)) { ?>
                <input type="hidden" name="idpembelian" value="<?= $pembelian['idpembelian'] ?>">
                <div class="w-100 d-flex justify-content-between gap-4">
                    <div class="form-group w-100">
                        <label for="idproduk">Product Name</label>
                        <select name="idproduk" class="form-select" required>
                            <option value="">- select product -</option>
                            <?php foreach ($produks as $produk) { ?>
                                <option value="<?php echo $prd[$produk['id']] = $produk['id'] ?>"><?php echo $prd[$produk['id']] = $produk['namaproduk'] ?></option>
                            <?php } ?>
                        </select>
                        <small class="text-danger"><?= form_error('idproduk') ?></small>
                    </div>
                    <div class="form-group w-100">
                        <label for="jumlah">Count</label>
                        <input type="number" name="jumlah" placeholder="0" class="form-control" required>
                        <small class="text-danger"><?= form_error('jumlah') ?></small>
                    </div>
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm btn-hover">Save</button>
                    </div>
                </div>
            <?php } ?>
        </form>

        <div class="mt-4">
			<div class="d-flex">
				<b class="w-25 ms-2">No</b>
				<b class="w-100">Product</b>
				<b class="w-100">Price</b>
				<b class="w-100">Count</b>
				<b class="w-100">Total Price</b>
				<b class="w-100">Action</b>
			</div>
            <?php 
            $index = 1;
            $total = 0;
            foreach ($detils as $det) { ?>
                <div class="d-flex align-items-center table-list">
                    <p class="w-25 pt-2"><?= $index ?>.</p>
                    <p class="w-100 pt-2"><?= $det['namaproduk'] ?></p>
                    <p class="w-100 pt-2">Rp. <?= $det['price'] ?></p>
                    <p class="w-100 pt-2"><?= $det['jumlah'] ?></p>
                    <p class="w-100 pt-2">Rp. <?= $det['price'] * $det['jumlah'] ?></p>
                    <div class="w-100">
                        <a href="<?= site_url('pembelian/hapus/' . $det['iddetailpembelian']) ?>" class="text-danger hover-btn">
							<i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
            <?php 
                $total += $det['price'] * $det['jumlah']; 
                $index++; 
                } 
            ?>
            <div class="d-flex align-items-center table-list mt-4">
                <p class="w-25 pt-2"></p>
                <p class="w-100 pt-2"></p>
                <p class="w-100 pt-2"></p>
                <p class="w-100 pt-2">Total Pay :</p>
                <p class="w-100 pt-2"><b>Rp. <?php echo $total; ?></b></p>
                <div class="w-100"></div>
            </div>
		</div>

        <div class="pt-2 text-center">
            <small>Follow me on <a href="https://github.com/fandi-ahmad" target="_blank"><i class="fa-brands fa-square-github"></i> Github</a></s>
        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>