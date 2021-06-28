! function(e) {
	"use strict";
	var o = {
		initialised: !1,
		mobile: !1,
		init: function() {
			this.initialised || (this.initialised = !0, this.checkMobile(), this.stickyHeader(), this.headerSearchToggle(), this.mMenuIcons(), this.mMenuToggle(), this.mobileMenu(), this.scrollToTop(), this.quantityInputs(), this.tooltip(), this.popover(), this.changePassToggle(), this.changeBillToggle(), this.catAccordion(), this.ajaxLoadProduct(), this.toggleFilter(), this.toggleSidebar(), this.productTabSroll(), this.scrollToElement(), this.loginPopup(), this.windowClick(), e.fn.superfish && this.menuInit(), e.fn.owlCarousel && this.owlCarousels(), "object" == typeof noUiSlider && this.filterSlider(), e.fn.themeSticky && this.stickySidebar(), e.fn.magnificPopup)
		},
		checkMobile: function() {
			/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? this.mobile = !0 : this.mobile = !1
		},
		menuInit: function() {
			e(".menu").superfish({
				popUpSelector: "ul, .megamenu",
				hoverClass: "show",
				delay: 0,
				speed: 80,
				speedOut: 80,
				autoArrows: !0
			})
		},
		stickyHeader: function() {
			if (e(".sticky-header").length) {
				new Waypoint.Sticky({
					element: e(".sticky-header")[0],
					stuckClass: "fixed",
					offset: -10
				});
				if (!e(".header-bottom").find(".logo, .cart-dropdown").length) {
					var o = e(".header-bottom").find(".container");
					e(".header").find(".logo, .cart-dropdown").clone(!0).prependTo(o)
				}
			}
			e("main").find(".sticky-header").each(function() {
				new Waypoint.Sticky({
					element: e(this),
					stuckClass: "fixed-nav"
				})
			})
		},
		headerSearchToggle: function() {
			e(".search-toggle").on("click", function(o) {
				e(".header-search-wrapper").toggleClass("show"), o.preventDefault()
            }), e("body").on("click", function(o) {
				e(".header-search-wrapper").hasClass("show") && (e(".header-search-wrapper").removeClass("show"), e("body").removeClass("is-search-active"))
            }), e(".header-search").on("click", function(e) {
				e.stopPropagation()
			})
		},
		mMenuToggle: function() {
			e(".mobile-menu-toggler").on("click", function(o) {
				e("body").toggleClass("mmenu-active"), e(this).toggleClass("active"), o.preventDefault()
            }), e(".mobile-menu-overlay, .mobile-menu-close").on("click", function(o) {
				e("body").removeClass("mmenu-active"), e(".menu-toggler").removeClass("active"), o.preventDefault()
			})
		},
		mMenuIcons: function() {
			e(".mobile-menu").find("li").each(function() {
				var o = e(this);
				o.find("ul").length && e("<span/>", {
					class: "mmenu-btn"
				}).appendTo(o.children("a"))
			})
		},
		mobileMenu: function() {
			e(".mmenu-btn").on("click", function(o) {
				var t = e(this).closest("li"),
				n = t.find("ul").eq(0);
				t.hasClass("open") ? n.slideUp(300, function() {
					t.removeClass("open")
					}) : n.slideDown(300, function() {
					t.addClass("open")
				}), o.stopPropagation(), o.preventDefault()
			})
		},
		owlCarousels: function() {
			var o = {
				loop: !0,
				margin: 0,
				responsiveClass: !0,
				nav: !1,
				navText: ['<i class="icon-left-open-big">', '<i class="icon-right-open-big">'],
				dots: !0,
				autoplay: !0,
				autoplayTimeout: 15e3,
				items: 1
			},
			t = e(".home-slider");
			t.owlCarousel(e.extend(!0, {}, o, {
				lazyLoad: !0,
				autoplayTimeout: 2e4,
				animateOut: "fadeOut"
			})), t.on("loaded.owl.lazy", function(o) {
			e(o.element).closest(".home-slider").addClass("loaded")
			}), e(".partners-carousel").owlCarousel(e.extend(!0, {}, o, {
				margin: 20,
				nav: !0,
				dots: !1,
				autoHeight: !0,
				autoplay: !1,
				responsive: {
					0: {
						items: 1,
						margin: 0
					},
					480: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					},
					1200: {
						items: 5
					}
				}
            })), e(".featured-products").owlCarousel(e.extend(!0, {}, o, {
				loop: !1,
				margin: 30,
				autoplay: !1,
				responsive: {
					0: {
						items: 2
					},
					700: {
						items: 3,
						margin: 15
					},
					1200: {
						items: 4
					}
				}
            })), e(".widget-featured-products").owlCarousel(e.extend(!0, {}, o, {
				lazyLoad: !0,
				nav: !0,
				navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
				dots: !1,
				autoHeight: !0
            })), e(".testimonials-slider").owlCarousel(e.extend(!0, {}, o, {
				lazyLoad: !0,
				navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
				autoHeight: !0
			})), e(".entry-slider").each(function() {
			e(this).owlCarousel(e.extend(!0, {}, o, {
				margin: 2,
				lazyLoad: !0
			}))
			}), e(".related-posts-carousel").owlCarousel(e.extend(!0, {}, o, {
				loop: !1,
				margin: 30,
				autoplay: !1,
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					1200: {
						items: 3
					}
				}
            })), e(".boxed-slider").owlCarousel(e.extend(!0, {}, o, {
				lazyLoad: !0,
				autoplayTimeout: 2e4,
				animateOut: "fadeOut"
			})), e(".boxed-slider").on("loaded.owl.lazy", function(o) {
			e(o.element).closest(".boxed-slider").addClass("loaded")
			}), e(".product-single-default .product-single-carousel").owlCarousel(e.extend(!0, {}, o, {
				nav: !0,
				navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
				dotsContainer: "#carousel-custom-dots",
				autoplay: !1,
				onInitialized: function() {
					var o = this.$element;
					e.fn.elevateZoom && o.find("img").each(function() {
						var o = e(this),
						t = {
							responsive: !0,
							zoomWindowFadeIn: 350,
							zoomWindowFadeOut: 200,
							borderSize: 0,
							zoomContainer: o.parent(),
							zoomType: "inner",
							cursor: "grab"
						};
						o.elevateZoom(t)
					})
				}
            })), e(".product-single-extended .product-single-carousel").owlCarousel(e.extend(!0, {}, o, {
				dots: !1,
				autoplay: !1,
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					1200: {
						items: 3
					}
				}
			})), e("#carousel-custom-dots .owl-dot").click(function() {
			e(".product-single-carousel").trigger("to.owl.carousel", [e(this).index(), 300])
			})
		},
		filterSlider: function() {
			var o = document.getElementById("price-slider");
			null != o && (noUiSlider.create(o, {
				start: [200, 700],
				connect: !0,
				step: 100,
				margin: 100,
				range: {
					min: 0,
					max: 1e3
				}
            }), o.noUiSlider.on("update", function(o, t) {
				o = o.map(function(e) {
					return "$" + e
				});
				e("#filter-price-range").text(o.join(" - "))
			}))
		},
		stickySidebar: function() {
			e(".sidebar-wrapper, .sticky-slider").themeSticky({
				autoInit: !0,
				minWidth: 991,
				containerSelector: ".row, .container",
				autoFit: !0,
				paddingOffsetBottom: 10,
				paddingOffsetTop: 60
			})
		},
		tooltip: function() {
			e.fn.tooltip && e('[data-toggle="tooltip"]').tooltip({
				trigger: "hover focus"
			})
		},
		popover: function() {
			e.fn.popover && e('[data-toggle="popover"]').popover({
				trigger: "focus"
			})
		},
		changePassToggle: function() {
			e("#change-pass-checkbox").on("change", function() {
				e("#account-chage-pass").toggleClass("show")
			})
		},
		changeBillToggle: function() {
			e("#change-bill-address").on("change", function() {
				e("#checkout-shipping-address").toggleClass("show"), e("#new-checkout-address").toggleClass("show")
			})
		},
		catAccordion: function() {
			e(".catAccordion").on("shown.bs.collapse", function(o) {
				var t = e(o.target).closest("li");
				t.hasClass("open") || t.addClass("open")
            }).on("hidden.bs.collapse", function(o) {
				var t = e(o.target).closest("li");
				t.hasClass("open") && t.removeClass("open")
			})
		},
		scrollBtnAppear: function() {
			e(window).scrollTop() >= 400 ? e("#scroll-top").addClass("fixed") : e("#scroll-top").removeClass("fixed")
		},
		scrollToTop: function() {
			e("#scroll-top").on("click", function(o) {
				e("html, body").animate({
					scrollTop: 0
				}, 1200), o.preventDefault()
			})
		},
		productTabSroll: function() {
			e(".rating-link").on("click", function(o) {
				if (e(".product-single-tabs").length) e("#product-tab-reviews").tab("show");
				else {
					if (!e(".product-single-collapse").length) return;
					e("#product-reviews-content").collapse("show")
				}
				e("#product-reviews-content").length && setTimeout(function() {
					var o = e("#product-reviews-content").offset().top - 60;
					e("html, body").stop().animate({
						scrollTop: o
					}, 800)
				}, 250), o.preventDefault()
			})
		},
		quantityInputs: function() {
			e.fn.TouchSpin && (e(".vertical-quantity").TouchSpin({
				verticalbuttons: !0,
				verticalup: "",
				verticaldown: "",
				verticalupclass: "icon-up-dir",
				verticaldownclass: "icon-down-dir",
				buttondown_class: "btn btn-outline",
				buttonup_class: "btn btn-outline",
				initval: 1,
				min: 1
            }), e(".horizontal-quantity").TouchSpin({
				verticalbuttons: !1,
				buttonup_txt: "",
				buttondown_txt: "",
				buttondown_class: "btn btn-outline btn-down-icon",
				buttonup_class: "btn btn-outline btn-up-icon",
				initval: 1,
				min: 1
			}))
		},
		ajaxLoading: function() {
			e("body").append("<div class='ajaxOverlay'><i class='porto-loading-icon'></i></div>")
		},
		ajaxLoadProduct: function() {
			var o = 0;
			t.click(function(n) {
				n.preventDefault(), e(this).text("Loading ..."), e.ajax({
					url: "ajax/category-ajax-products.html",
					success: function(n) {
						var i = e(n);
						setTimeout(function() {
							i.appendTo(".product-ajax-grid"), t.text("Load More"), ++o >= 2 && t.hide()
						}, 350)
					},
					failure: function() {
						t.text("Sorry something went wrong.")
					}
				})
			})
		},
		toggleFilter: function() {
			e(".filter-toggle a").click(function(o) {
				o.preventDefault(), e(".filter-toggle").toggleClass("opened"), e("main").toggleClass("sidebar-opened")
            }), e(".sidebar-overlay").click(function(o) {
				e(".filter-toggle").removeClass("opened"), e("main").removeClass("sidebar-opened")
            }), e(".sort-menu-trigger").click(function(o) {
				o.preventDefault(), e(".select-custom").removeClass("opened"), e(o.target).closest(".select-custom").toggleClass("opened")
			})
		},
		toggleSidebar: function() {
			e(".sidebar-toggle").click(function() {
				e("main").toggleClass("sidebar-opened")
			})
		},
		scrollToElement: function() {
			e('.scrolling-box a[href^="#"]').on("click", function(o) {
				var t = e(this.getAttribute("href"));
				t.length && (o.preventDefault(), e("html, body").stop().animate({
					scrollTop: t.offset().top - 90
				}, 700))
			})
		},
		loginPopup: function() {
			e(".login-link").click(function(t) {
				t.preventDefault(), o.ajaxLoading();
				setTimeout(function() {
					e.magnificPopup.open({
						type: "ajax",
						mainClass: "login-popup",
						tLoading: "",
						preloader: !1,
						removalDelay: 350,
						items: {
							src: "ajax/login-popup.html"
						},
						callbacks: {
							beforeClose: function() {
								e(".ajaxOverlay").remove()
							}
						},
						ajax: {
							tError: ""
						}
					})
				}, 1500)
			})
		},
		windowClick: function() {
			e(document).click(function(o) {
				e(o.target).closest(".toolbox-item.select-custom").length || e(".select-custom").removeClass("opened")
			})
		}
	};
	e("body").prepend('<div class="loading-overlay"><div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>');
	var t = e(".loadmore .btn");
	jQuery(document).ready(function() {
		o.init()
		}), e(window).on("load", function() {
		e("body").addClass("loaded"), o.scrollBtnAppear()
		}), e(window).on("scroll", function() {
		o.scrollBtnAppear()
	})
}(jQuery);