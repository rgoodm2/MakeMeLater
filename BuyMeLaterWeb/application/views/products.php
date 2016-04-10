<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Buy Me Later</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/css/products_css/style.css"); ?>" />
	<meta name=viewport content='width=700'>
	<script>
		$(document).ready(function(){
			$('.listitem').children().click(function(){
				var id = $(this).attr('id');
				var title_text = $(this).text();
				$.get('/Clients/show_products/' + id , function(res){
					$('#ajax').html(res);
					$('#ajax_title').text(title_text);
					console.log(title_text);
					$('.header_image').hide();
				})
			});
			$(document).on('click', ".link", function () {
			    var id = $(this).attr('id');
				var title_text = $(this).attr('name');
				$.get('/Clients/show/' + id , function(res){
					$('#ajax').html(res);
					$('#ajax_title').text(title_text);
					$('.header_image').hide();
				})
			});

		})
	</script>
</head>
		<?php $images = $this->session->userdata('images'); ?>
<body class = "container">
	<div class = "container">
		<div class = "header">
			<h1 class = "header_text"><a class = "header_link" href="/">Buy Me Later</a></h1>
		<div class = "sidebar">
			<ul class = "list">
			</ul>

		</div>
		<div class = "header_image">
			<img src="https://i.ytimg.com/vi/z5frmDeOzM0/maxresdefault.jpg" class = "image" height="647" width="970" align="middle">
		</div>
			<div id = "ajax">

			<?php foreach ($images as $image) { ?>
				<div class = "imgWrap">
					<img src= <?php echo '"assets/' . $image['image'] . '"' ?> height = "382" width = "326">
					<p class = "imgDescription"> <a class="link" name=<?= $image['name'] ?> id=<?= $image['id'] ?>> <?= $image['name'] ?>/ Price: <?= '$' . $image['price']/100 . '.' . $image['price']%10 . $image['price']%100 ?></a></p>
				</div>
			<?php } ?>
		</div>
	</div>
</body>
</html>