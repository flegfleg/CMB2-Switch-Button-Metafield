/*
 * Handle js switch button
 *
 * @package   CommonsBooking2
 */

(function ($) {
	'use strict';
	/** allow jumping to admin tabs via url hash  */
	$(function () {
			$(".cmb2-switch .cmb2-enable").click(function () {
				console.log('clicked');
				var parent = $(this).parents('.cmb2-switch');
				$('.cmb2-disable', parent).removeClass('selected');
				$(this).addClass('selected');
			});
			$(".cmb2-switch .cmb2-disable").click(function () {
				var parent = $(this).parents('.cmb2-switch');
				$('.cmb2-enable', parent).removeClass('selected');
				$(this).addClass('selected');
			});
	});
})(jQuery);

