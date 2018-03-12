define([
    'jquery',
    'magnificPopup'
    ], function ($, magnificPopup) {
    "use strict";

    return {
		displayContent: function(productUrl)
		{
			if (!productUrl.length) return false;
            $.magnificPopup.open({
                items: {
                  src: productUrl
                },
                type: 'iframe',
                closeOnBgClick: false,
                preloader: true,
                tLoading: '',
                callbacks: {
                    open: function() {
                      $('.mfp-preloader').css('display', 'block');
                    },					
                    beforeClose: function() {
                        $('[data-block="minicart"]').trigger('contentLoading');
                        $.ajax({
							url: window.wdph_quickview.baseUrl + 'wdph_quickview/catalog/updatecart',
							method: "POST"
						});
                    },
                    close: function() {
                      
                    },
                    afterClose: function() {						
                    },
					ajaxContentAdded: function() {									
					}
                  }
            });
		}
	};
});