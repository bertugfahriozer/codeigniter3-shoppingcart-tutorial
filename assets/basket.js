(function (window, document, $) {
	'use strict';
	$('.addCart').on('click', function () {
		var id = $(this).data('id');
		var qty = $('#qty' + id).val();
		$.ajax({
			type: 'POST',
			url: 'welcome/insertCart',
			dataType: 'json',
			data: {
				qty: qty,
				id: id
			},
			success: function (data) {
				var cart = '';
				$.each(data, function (index, element) {
					cart = cart.concat('<div class="dropdown-item border">' +
						element.name + ' | ' + element.qty + ' | ' + element.subtotal +
						'</div>');
				});
				$('#basket').html(cart);
			}
		});
	});

	$('.updateCart').on('change', function () {
		var id = $(this).data('rowid');
		var qty = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'updateCart',
			dataType: 'json',
			data: {
				qty: qty,
				rowid: id
			},
			success: function (data) {
				var cart = '';
				$.each(data, function (index, element) {
					cart = cart.concat('<div class="dropdown-item border">' +
						element.name + ' | ' + element.qty + ' | ' + element.subtotal +
						'</div>');
				});
				$('#basket').html(cart);
				alert('sepet güncellendi');
				location.reload();
			}
		});
	});

	$('.removeCart').on('click', function () {
		var id = $(this).data('rowid');
		$.ajax({
			type: 'POST',
			url: 'deleteOneProductInCart',
			dataType: 'json',
			data: {
				rowid: id
			},
			success: function (data) {
				var cart = '';
				$.each(data, function (index, element) {
					cart = cart.concat('<div class="dropdown-item border">' +
						element.name + ' | ' + element.qty + ' | ' + element.subtotal +
						'</div>');
				});
				$('#basket').html(cart);
				alert('sepetten ürün silindi.');
				location.reload();
			}
		});
	});

	$('#deleteCart').on('click', function () {
		$.ajax({
			type: 'POST',
			url: 'deleteCart',
			dataType: 'json',
			success:function (){
				location.reload();
			}
		});
	});
})(window, document, jQuery);
