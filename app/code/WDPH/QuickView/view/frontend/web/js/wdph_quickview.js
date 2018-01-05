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
							url: window.weltpixel_quickview.baseUrl + 'wdph_quickview/catalog/updatecart',
							method: "POST"
						});
                    },
                    close: function() {
                      
                    },
                    afterClose: function() {
						if (window.weltpixel_quickview.showMiniCartFlag)
						{
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            setTimeout(function(){ $('.action.showcart').trigger('click'); }, 1000);
						}
                    },
					ajaxContentAdded: function() {
						// Ajax content is loaded and appended to DOM
						console.log('LOADED');
					}
                  }
            });
		}
	};
});