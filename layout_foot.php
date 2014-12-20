</div>
<!-- /container -->

<!-- JQuery for all of the Bootstrap plugins and whatnot -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- All of the required plugins and stuff for bootstrap to run -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
	$('.add-to-cart').click(function(){
		var id = $(this).closest('tr').find('.product-id').text();
		var album = $(this).closest('tr').find('.product-name').text();
		var quantity = $(this).closest('tr').find('input').val();
		window.location.href = "add_to_cart.php?id=" + id + "&album=" + album + "&quantity=" + quantity;
	});
	
	$('.update-quantity').click(function(){
		var id = $(this).closest('tr').find('.product_id').text();
		var name = $(this).closest('tr').find('.product-name').text();
		var quantity = $(this).closest('tr').find('input').val();
		window.location.href = "update_quantity.php?id=" + id + "&album=" + name + "&quantity=" + quantity;
	});
});
</script>

</body>
</html>