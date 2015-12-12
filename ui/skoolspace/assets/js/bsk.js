$(document).ready(function()
{
//	$('#intro').modal('show');

	// Activate Carousel
	$('.carousel').carousel({
		pause: "false"
	});

	// Freeze header bar on scroll
	$('.section-header').scrollToFixed({
		zIndex: 499
	});

	// Catalog Navigation
	var catalog = $('#catalogSection');
	var catalogHeader = catalog.children('.section-header');
	var catalogContent = catalog.children('.section-content');
	var linkToArticle = $('.article__link');
	var backToCatalog = $('#back');
	var articleContainer = $('.section-article');

	$(catalog)
		.find(linkToArticle).click(function(e){
			e.preventDefault();
			$(e.target)
				.hide()
				.closest(articleContainer)
					.addClass('is-active')
					.siblings().not('is-active').hide()
				.closest(catalogContent)
					.toggleClass('and-cataloged and-readable');
			$('#moreNews,#allNews,#search').removeClass('is-active');
			$('#back,#shareThis').addClass('is-active');
		})
		.end()
		.find(backToCatalog).click(function(e){
			e.preventDefault();
			$(e.target)
				.closest(catalog)
					.find(catalogContent)
						.toggleClass('and-readable and-cataloged')
					.end()
					.find(articleContainer)
						.not('is-active').show()
						.removeClass('is-active')
					.end()
					.find(linkToArticle)
						.show();
			$('#back,#shareThis').removeClass('is-active');
			$('#moreNews,#allNews,#search').addClass('is-active');
		});
	// End catalog navigation
});
