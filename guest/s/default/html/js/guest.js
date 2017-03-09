
(function($) {

	$.fn.disable = function() {
		return this.each(function() {
			$(this).attr('disabled', 'disabled').addClass('disabled');
		});
	};

	$.fn.enable = function() {
		return this.each(function() {
			$(this).attr('disabled', '').removeClass('disabled');
		});
	};

	$.fn.setenabled = function(enabled) {
		if (enabled)
			return $(this).enable();
		else
			return $(this).disable();
	};

	$.fn.setvisible = function(visible) {
		if (visible)
			return $(this).show();
		else
			return $(this).hide();
	}

	$.fn.checked = function() {
		return $(this).is(':checked');
	};

	$.fn.check_radio = function(field_name, val) {
		return this.find('input[name="' + field_name + '"][value="' + val + '"]').attr('checked', 'checked').change();
	};

	$.fn.val_radio = function(field_name) {
		return this.find('input[name="' + field_name + '"]:checked').val();
	}

	$.fn.setchecked = function(checked) {
		return this.each(function() {
			var self = $(this);
			self.attr('checked', checked ? 'checked' : '').change();
		});
	};
})(jQuery);
