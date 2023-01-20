<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
			<div class="sidebar-list bg-soft-blue">
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
			<div class="sidebar-list">
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
        <h1>Dashboard</h1>
        <?php
            $jumlah_produk = count($produks);
            $jumlah_order = count($detils);
            $total = 0;
            foreach ($detils as $det) {
                $total += $det['price'] * $det['jumlah'];
            };
        ?>

        <div class="d-flex jusitfy-content-between gap-3">
            <div class="bg-white w-100 card-block">
                <div class="d-flex flex-row align-items-center">
                    <div class="my-round bg-primary text-white">
                        <i class="fa-solid fa-box-open fs-5"></i>
                    </div>
                    <div class="ms-2">
                        <div><small>Total Product</small></div>
                        <h1><?php echo $jumlah_produk; ?></h1>
                    </div>
                </div>
            </div>
            <div class="bg-white w-100 card-block">

                <div class="d-flex flex-row align-items-center">
                    <div class="my-round bg-warning">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                    </div>
                    <div class="ms-2">
                        <div><small>Total Order</small></div>
                        <div class="d-flex flex-row align-items-center gap-1">
                            <h1 id="totalOrder"><?php echo $jumlah_order ?></h1>
                            <span class="text-green" id="plusIcon">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg-white w-100 card-block">
                <div class="d-flex flex-row align-items-center">
                    <div class="my-round bg-success text-white">
                        <i class="fa-solid fa-dollar-sign fs-5"></i>
                    </div>
                    <div class="ms-2">
                        <div><small>Total Pay</small></div>
                        <div class="d-flex flex-row gap-2">
                            <h4>
                                <span>Rp. </span>
                                <span id="totalPay"><?php echo $total ?></span>
                            </h4>
                            <span class="text-green" style="font-size: 20px;" id="upIcon">
                                <i class="fa-solid fa-arrow-up"></i>
                                <span style="font-size: 12px;">100K</span>
                            </span>
                            <span class="text-danger" style="font-size: 20px;" id="downIcon">
                                <i class="fa-solid fa-arrow-down"></i>
                                <span style="font-size: 12px;">100K</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 card-block bg-white mt-4" style="height: 400px;">
            <canvas id="myChart" class=""></canvas>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('myChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Refunded', 'Cancel', 'Payment', 'Admin', 'Order', 'Product'],
        datasets: [{
            label: 'Data Ratio',
            data: [
                0,
                0,
                0,
                1,
                <?php echo $jumlah_order; ?>,
                <?php echo $jumlah_produk ?>,
                <?php echo $jumlah_produk + 2 ?>
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
    }
});

const totalPay = document.getElementById('totalPay')
const upIcon = document.getElementById('upIcon')
const downIcon = document.getElementById('downIcon')
const totalOrder = document.getElementById('totalOrder').innerHTML
const plusIcon = document.getElementById('plusIcon')

let pay = totalPay.innerHTML
let payValue = parseInt(pay)

if (payValue >= 100000) {
    upIcon.classList.add('d-block')
    downIcon.classList.add('d-none')
} else {
    upIcon.classList.add('d-none')
    downIcon.classList.add('d-block')
}

let totalOrderValue = parseInt(totalOrder)
if (totalOrderValue > 0) {
    plusIcon.classList.add('block')
    plusIcon.classList.remove('d-none')
} else {
    plusIcon.classList.add('d-none')
    plusIcon.classList.remove('d-block')
}

</script>
</body>
</html>