<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
		  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('assets/navbar-top-fixed.css') ?>">
	<title>Shopping Cart</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	<a class="navbar-brand" href="#">Fixed navbar</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
			aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Link</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
			</li>
		</ul>
		<div class="btn-group dropleft">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor"
					 xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd"
						  d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
				</svg>
			</button>
			<div class="dropdown-menu" id="basket">
				<?php if(!empty($this->cart->contents())): ?>
				<?php  foreach ($this->cart->contents() as $item) : ?>
					<div class="dropdown-item border">
						<?php echo $item['name'].' | '.$item['qty'].' | '.$item['subtotal']; ?>
						</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>
<main role="main" class="container">
	<div class="row">
		<?php foreach ($products as $product) : ?>
		<div class="card col-md-4">
			<div class="card-body">
				<h5 class="card-title"><?=$product->productName?></h5>
				<p class="card-text"><?=$product->price?></p>
			</div>
			<div class="card-footer">
				<input type="number" name="qty" id="qty<?=$product->id?>" value="1" min="1">
				<button class="btn btn-primary addCart" data-id="<?=$product->id?>">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor"
						 xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							  d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
					</svg>
				</button>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</main>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"></script>
<script src="<?=base_url('assets/basket.js')?>"></script>
</body>
</html>
