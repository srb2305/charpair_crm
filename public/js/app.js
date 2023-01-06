/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

var App = function() {
    var MediaSize = {
        xl: 1200,
        lg: 992,
        md: 991,
        sm: 576
    };
    var ToggleClasses = {
        headerhamburger: '.toggle-sidebar',
        inputFocused: 'input-focused',
    };

    var Selector = {
        mainHeader: '.header.navbar',
        headerhamburger: '.toggle-sidebar',
        fixed: '.fixed-top',
        mainContainer: '.main-container',
        sidebar: '#sidebar',
        sidebarContent: '#sidebar-content',
        sidebarStickyContent: '.sticky-sidebar-content',
        ariaExpandedTrue: '#sidebar [aria-expanded="true"]',
        ariaExpandedFalse: '#sidebar [aria-expanded="false"]',
        contentWrapper: '#content',
        contentWrapperContent: '.container',
        mainContentArea: '.main-content',
        searchFull: '.toggle-search',
        overlay: {
            sidebar: '.overlay',
            cs: '.cs-overlay',
            search: '.search-overlay'
        }
    };

    var toggleFunction = {
        sidebar: function($recentSubmenu) {
            $('.sidebarCollapse').on('click', function (sidebar) {
                sidebar.preventDefault();
                $(Selector.mainContainer).toggleClass("sidebar-closed");
                $(Selector.mainHeader).toggleClass('expand-header');
                $(Selector.mainContainer).toggleClass("sbar-open");
                $('.overlay').toggleClass('show');
                $('html,body').toggleClass('sidebar-noneoverflow');
            });
        },
        overlay: function() {
            $('#dismiss, .overlay, cs-overlay').on('click', function () {
                // hide sidebar
                $(Selector.mainContainer).addClass('sidebar-closed');
                $(Selector.mainContainer).removeClass('sbar-open');
                // hide overlay
                $('.overlay').removeClass('show');
                $('html,body').removeClass('sidebar-noneoverflow');
            });
        },
        search: function() {
            $(Selector.searchFull).click(function(event) {
                $(this).parents('.search-animated').find('.search-full').addClass(ToggleClasses.inputFocused);
                $(this).parents('.search-animated').addClass('show-search');
                $(Selector.overlay.search).addClass('show');
                $(Selector.overlay.search).addClass('show');
            });

            $(Selector.overlay.search).click(function(event) {
                $(this).removeClass('show');
                $(Selector.searchFull).parents('.search-animated').find('.search-full').removeClass(ToggleClasses.inputFocused);
                $(Selector.searchFull).parents('.search-animated').removeClass('show-search');
            });
        }
    }

    var inBuiltfunctionality = {
        mainCatActivateScroll: function() {
            const ps = new PerfectScrollbar('.menu-categories', {
                wheelSpeed:.5,
                swipeEasing:!0,
                minScrollbarLength:40,
                maxScrollbarLength:300,
                suppressScrollX : true
            });
        },
        preventScrollBody: function() {
            $('#sidebar').bind('mousewheel DOMMouseScroll', function(e) {
                var scrollTo = null;

                if (e.type == 'mousewheel') {
                    scrollTo = (e.originalEvent.wheelDelta * -1);
                }
                else if (e.type == 'DOMMouseScroll') {
                    scrollTo = 40 * e.originalEvent.detail;
                }

                if (scrollTo) {
                    e.preventDefault();
                    $(this).scrollTop(scrollTo + $(this).scrollTop());
                }
            });
        },
        functionalDropdown: function() {
            var getDropdownElement = document.querySelectorAll('.more-dropdown .dropdown-item');
            for (var i = 0; i < getDropdownElement.length; i++) {
                getDropdownElement[i].addEventListener('click', function() {
                    document.querySelectorAll('.more-dropdown .dropdown-toggle > span')[0].innerText = this.getAttribute('data-value');
                })
            }
        }
    }

    var _mobileResolution = {
        onRefresh: function() {
            var windowWidth = window.innerWidth;
            if ( windowWidth <= MediaSize.md ) {
                toggleFunction.sidebar();
            }
        },

        // Note : -  _mobileResolution -> onResize | Uncomment it if need for onresize functions for MOBILE RESOLUTION i.e. below or equal to 991px |

        /*
        onResize: function() {
            $(window).on('resize', function(event) {
                event.preventDefault();
                var windowWidth = window.innerWidth;
                if ( windowWidth <= MediaSize.md ) {
                }
            });
        }
        */
    }

    var _desktopResolution = {
        onRefresh: function() {
            var windowWidth = window.innerWidth;
            if ( windowWidth > MediaSize.md ) {
                toggleFunction.sidebar(true);
            }
        },

        // Note : -  _desktopResolution -> onResize | Uncomment it if need, for onresize functions for DESKTOP RESOLUTION i.e. above or equal to 991px |

        /*
        onResize: function() {
            $(window).on('resize', function(event) {
                event.preventDefault();
                var windowWidth = window.innerWidth;
                if ( windowWidth > MediaSize.md ) {
                }
            });
        }
        */
    }

    function sidebarFunctionality() {
        function sidebarCloser() {

            if (window.innerWidth <= 991 ) {

                if (!$('body').hasClass('alt-menu')) {

                    $("#container").addClass("sidebar-closed");
                    $('.overlay').removeClass('show');
                } else {
                    $(".navbar").removeClass("expand-header");
                    $('.overlay').removeClass('show');
                    $('#container').removeClass('sbar-open');
                    $('html, body').removeClass('sidebar-noneoverflow');
                }

            } else if (window.innerWidth > 991 ) {

                if (!$('body').hasClass('alt-menu')) {

                    $("#container").removeClass("sidebar-closed");
                    $(".navbar").removeClass("expand-header");
                    $('.overlay').removeClass('show');
                    $('#container').removeClass('sbar-open');
                    $('html, body').removeClass('sidebar-noneoverflow');
                } else {
                    $('html, body').addClass('sidebar-noneoverflow');
                    $("#container").addClass("sidebar-closed");
                    $(".navbar").addClass("expand-header");
                    $('.overlay').addClass('show');
                    $('#container').addClass('sbar-open');
                }
            }

        }

        function sidebarMobCheck() {
            if (window.innerWidth <= 991 ) {

                if ( $('.main-container').hasClass('sbar-open') ) {
                    return;
                } else {
                    sidebarCloser()
                }
            } else if (window.innerWidth > 991 ) {
                sidebarCloser();
            }
        }

        sidebarCloser();

        $(window).resize(function(event) {
            sidebarMobCheck();
        });

    }

    return {
        init: function() {
            toggleFunction.overlay();
            toggleFunction.search();
            /*
                Desktop Resoltion fn
            */
            _desktopResolution.onRefresh();

            // Note : -  _desktopResolution -> onResize | Uncomment it if need for onresize functions for MOBILE RESOLUTION i.e. above or equal to 991px |

            // _desktopResolution.onResize();

            /*
                Mobile Resoltion fn
            */
            _mobileResolution.onRefresh();

            // Note : -  _mobileResolution -> onResize | Uncomment it if need for onresize functions for DESKTOP RESOLUTION i.e. below or equal to 991px |

            // _mobileResolution.onResize();

            sidebarFunctionality();
            inBuiltfunctionality.mainCatActivateScroll();
            inBuiltfunctionality.preventScrollBody();
            inBuiltfunctionality.functionalDropdown();
        }
    }

}();

