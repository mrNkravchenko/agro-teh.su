/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.

// const jQuery = require('jquery');
const $ = require('jquery');
const _ = require('lodash');
const Swal = require('sweetalert2');
require('./helper');
require('bootstrap');
require('@fortawesome/fontawesome-free/js/all.min');
require('slick-carousel');
require('flexslider');
// require('./jquery.carousel.min');
// require('./jquery.easing.min');
// require('./custom');
require('jquery.scrollto');
// require ('jquery.kladr/jquery.kladr.min');
require ('./jquery-master/jquery.fias.min');
require('./mapGenerator');
require('./sendEmail');
require('trumbowyg');
require('./page/spare-parts/index');
require('select2');

import '@fancyapps/fancybox';

$.trumbowyg.svgPath = '/assets/img/icons.svg';


/*Yandex counter*/
$(document).on('yaCounter47365036inited', function () {
    console.log('счетчик yaCounter47365036 можно использовать');
});


$('.html_redactor').trumbowyg({
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ]
});

//SLICK SLIDER

$('.single-slide').slick(
    {
        //Large screen options To do: ???
        infinite: false,
        arrows: false,
        dots: false,
        speed: 600,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        mobileFirst: true,

        adaptiveHeight: true,

        //Adaptive options To do: Change values
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                infinite: true
            }
        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                dots: true
            }
        }, {
            breakpoint: 300,
            settings: "unslick" // destroys slick
        }]

    });

$('.article-slide').slick({
    dots: false,
    infinite: true,
    adaptiveHeight: true,
    draggable: true,
    autoplay: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1440,
            settings: {
                autoplay: true,
                draggable: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                autoplay: true,
                draggable: true,
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                draggable: true,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 479,
            settings: 'unslick'
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

$('.tech-image-slide').slick({
    prevArrow: '<button type="button" class="slick-prev bg-primary">Previous</button>',
    nextArrow: '<button type="button" class="slick-next bg-primary">Next</button>',
    dots: true,
    infinite: true,
    adaptiveHeight: true,
    draggable: true,
    autoplay: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1440,
            settings: {
                autoplay: true,
                draggable: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                autoplay: true,
                draggable: true,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                draggable: true,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 479,
            settings: 'unslick'
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
$('.tech-spare-slide').slick({
    prevArrow: '<button type="button" class="slick-prev bg-primary">Previous</button>',
    nextArrow: '<button type="button" class="slick-next bg-primary">Next</button>',
    dots: true,
    infinite: true,
    adaptiveHeight: true,
    draggable: true,
    autoplay: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1440,
            settings: {
                autoplay: true,
                draggable: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                autoplay: true,
                draggable: true,
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                draggable: true,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 479,
            settings: 'unslick'
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


$('.tech-image').fancybox({
    arrows: true,
    buttons: [
        // "zoom",
        //"share",
        // "slideShow",
        // "fullScreen",
        //"download",
        // "thumbs",
        "close"
    ],
});

$('[data-fancybox="gallery"]').fancybox({
    // Options will go here

        // Enable infinite gallery navigation
        loop: false,

        // Horizontal space between slides
        gutter: 50,

        // Enable keyboard navigation
        keyboard: true,

        // Should display navigation arrows at the screen edges
        arrows: true,

        // Should display counter at the top left corner
        infobar: true,

        // Should display close button (using `btnTpl.smallBtn` template) over the content
        // Can be true, false, "auto"
        // If "auto" - will be automatically enabled for "html", "inline" or "ajax" items
        smallBtn: "auto",

        // Should display toolbar (buttons at the top)
        // Can be true, false, "auto"
        // If "auto" - will be automatically hidden if "smallBtn" is enabled
        toolbar: "auto",

        // What buttons should appear in the top right corner.
        // Buttons will be created using templates from `btnTpl` option
        // and they will be placed into toolbar (class="fancybox-toolbar"` element)
        buttons: [
            "zoom",
            //"share",
            //"slideShow",
            //"fullScreen",
            //"download",
            "thumbs",
            "close"
        ],

        // Detect "idle" time in seconds
        idleTime: 3,

        // Disable right-click and use simple image protection for images
        protect: false,

        // Shortcut to make content "modal" - disable keyboard navigtion, hide buttons, etc
        modal: false,

        image: {
            // Wait for images to load before displaying
            //   true  - wait for image to load and then display;
            //   false - display thumbnail and load the full-sized image over top,
            //           requires predefined image dimensions (`data-width` and `data-height` attributes)
            preload: false
        },

        ajax: {
            // Object containing settings for ajax request
            settings: {
                // This helps to indicate that request comes from the modal
                // Feel free to change naming
                data: {
                    fancybox: true
                }
            }
        },

        iframe: {
            // Iframe template
            tpl:
                '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen allowtransparency="true" src=""></iframe>',

            // Preload iframe before displaying it
            // This allows to calculate iframe content width and height
            // (note: Due to "Same Origin Policy", you can't get cross domain data).
            preload: true,

            // Custom CSS styling for iframe wrapping element
            // You can use this to set custom iframe dimensions
            css: {},

            // Iframe tag attributes
            attr: {
                scrolling: "auto"
            }
        },

        // Default content type if cannot be detected automatically
        defaultType: "image",

        // Open/close animation type
        // Possible values:
        //   false            - disable
        //   "zoom"           - zoom images from/to thumbnail
        //   "fade"
        //   "zoom-in-out"
        //
        animationEffect: "zoom",

        // Duration in ms for open/close animation
        animationDuration: 366,

        // Should image change opacity while zooming
        // If opacity is "auto", then opacity will be changed if image and thumbnail have different aspect ratios
        zoomOpacity: "auto",

        // Transition effect between slides
        //
        // Possible values:
        //   false            - disable
        //   "fade'
        //   "slide'
        //   "circular'
        //   "tube'
        //   "zoom-in-out'
        //   "rotate'
        //
        transitionEffect: "fade",

        // Duration in ms for transition animation
        transitionDuration: 366,

        // Custom CSS class for slide element
        slideClass: "",

        // Custom CSS class for layout
        baseClass: "",

        // Base template for layout
        baseTpl:
            '<div class="fancybox-container" role="dialog" tabindex="-1">' +
            '<div class="fancybox-bg"></div>' +
            '<div class="fancybox-inner">' +
            '<div class="fancybox-infobar">' +
            "<span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span>" +
            "</div>" +
            '<div class="fancybox-toolbar">{{buttons}}</div>' +
            '<div class="fancybox-navigation">{{arrows}}</div>' +
            '<div class="fancybox-stage"></div>' +
            '<div class="fancybox-caption"></div>' +
            "</div>" +
            "</div>",

        // Loading indicator template
        spinnerTpl: '<div class="fancybox-loading"></div>',

        // Error message template
        errorTpl: '<div class="fancybox-error"><p>{{ERROR}}</p></div>',

        btnTpl: {
            download:
                '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;">' +
                '<svg viewBox="0 0 40 40">' +
                '<path d="M13,16 L20,23 L27,16 M20,7 L20,23 M10,24 L10,28 L30,28 L30,24" />' +
                "</svg>" +
                "</a>",

            zoom:
                '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}">' +
                '<svg viewBox="0 0 40 40">' +
                '<path d="M18,17 m-8,0 a8,8 0 1,0 16,0 a8,8 0 1,0 -16,0 M24,22 L31,29" />' +
                "</svg>" +
                "</button>",

            close:
                '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">' +
                '<svg viewBox="0 0 40 40">' +
                '<path d="M10,10 L30,30 M30,10 L10,30" />' +
                "</svg>" +
                "</button>",

            // This small close button will be appended to your html/inline/ajax content by default,
            // if "smallBtn" option is not set to false
            smallBtn:
                '<button data-fancybox-close class="fancybox-close-small" title="{{CLOSE}}"><svg viewBox="0 0 32 32"><path d="M10,10 L22,22 M22,10 L10,22"></path></svg></button>',

            // Arrows
            arrowLeft:
                '<a data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}" href="javascript:;">' +
                '<svg viewBox="0 0 40 40">' +
                '<path d="M18,12 L10,20 L18,28 M10,20 L30,20"></path>' +
                "</svg>" +
                "</a>",

            arrowRight:
                '<a data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}" href="javascript:;">' +
                '<svg viewBox="0 0 40 40">' +
                '<path d="M10,20 L30,20 M22,12 L30,20 L22,28"></path>' +
                "</svg>" +
                "</a>"
        },

        // Container is injected into this element
        parentEl: "body",

        // Focus handling
        // ==============

        // Try to focus on the first focusable element after opening
        autoFocus: false,

        // Put focus back to active element after closing
        backFocus: true,

        // Do not let user to focus on element outside modal content
        trapFocus: true,

        // Module specific options
        // =======================

        fullScreen: {
            autoStart: false
        },

        // Set `touch: false` to disable dragging/swiping
        touch: {
            vertical: true, // Allow to drag content vertically
            momentum: true // Continue movement after releasing mouse/touch when panning
        },

        // Hash value when initializing manually,
        // set `false` to disable hash change
        hash: null,

        // Customize or add new media types
        // Example:
        /*
            media : {
                youtube : {
                    params : {
                        autoplay : 0
                    }
                }
            }
            */
        media: {},

        slideShow: {
            autoStart: false,
            speed: 4000
        },

        thumbs: {
            autoStart: false, // Display thumbnails on opening
            hideOnClose: true, // Hide thumbnail grid when closing animation starts
            parentEl: ".fancybox-container", // Container is injected into this element
            axis: "y" // Vertical (y) or horizontal (x) scrolling
        },

        // Use mousewheel to navigate gallery
        // If 'auto' - enabled for images only
        wheel: "auto",

        // Callbacks
        //==========

        // See Documentation/API/Events for more information
        // Example:
        /*
            afterShow: function( instance, current ) {
                console.info( 'Clicked element:' );
                console.info( current.opts.$orig );
            }
        */

        onInit: $.noop, // When instance has been initialized

        beforeLoad: $.noop, // Before the content of a slide is being loaded
        afterLoad: $.noop, // When the content of a slide is done loading

        beforeShow: $.noop, // Before open animation starts
        afterShow: $.noop, // When content is done loading and animating

        beforeClose: $.noop, // Before the instance attempts to close. Return false to cancel the close.
        afterClose: $.noop, // After instance has been closed

        onActivate: $.noop, // When instance is brought to front
        onDeactivate: $.noop, // When other instance has been activated

        // Interaction
        // ===========

        // Use options below to customize taken action when user clicks or double clicks on the fancyBox area,
        // each option can be string or method that returns value.
        //
        // Possible values:
        //   "close"           - close instance
        //   "next"            - move to next gallery item
        //   "nextOrClose"     - move to next gallery item or close if gallery has only one item
        //   "toggleControls"  - show/hide controls
        //   "zoom"            - zoom image (if loaded)
        //   false             - do nothing

        // Clicked on the content
        clickContent: function(current, event) {
            return current.type === "image" ? "zoom" : false;
        },

        // Clicked on the slide
        clickSlide: "close",

        // Clicked on the background (backdrop) element;
        // if you have not changed the layout, then most likely you need to use `clickSlide` option
        clickOutside: "close",

        // Same as previous two, but for double click
        dblclickContent: false,
        dblclickSlide: false,
        dblclickOutside: false,

        // Custom options when mobile device is detected
        // =============================================

        mobile: {
            idleTime: false,
            clickContent: function(current, event) {
                return current.type === "image" ? "toggleControls" : false;
            },
            clickSlide: function(current, event) {
                return current.type === "image" ? "toggleControls" : "close";
            },
            dblclickContent: function(current, event) {
                return current.type === "image" ? "zoom" : false;
            },
            dblclickSlide: function(current, event) {
                return current.type === "image" ? "zoom" : false;
            }
        },

        // Internationalization
        // ====================

        lang: "en",
        i18n: {
            en: {
                CLOSE: "Close",
                NEXT: "Next",
                PREV: "Previous",
                ERROR: "The requested content cannot be loaded. <br/> Please try again later.",
                PLAY_START: "Start slideshow",
                PLAY_STOP: "Pause slideshow",
                FULL_SCREEN: "Full screen",
                THUMBS: "Thumbnails",
                DOWNLOAD: "Download",
                SHARE: "Share",
                ZOOM: "Zoom"
            },
            de: {
                CLOSE: "Schliessen",
                NEXT: "Weiter",
                PREV: "Zurück",
                ERROR: "Die angeforderten Daten konnten nicht geladen werden. <br/> Bitte versuchen Sie es später nochmal.",
                PLAY_START: "Diaschau starten",
                PLAY_STOP: "Diaschau beenden",
                FULL_SCREEN: "Vollbild",
                THUMBS: "Vorschaubilder",
                DOWNLOAD: "Herunterladen",
                SHARE: "Teilen",
                ZOOM: "Maßstab"
            }
        }
});


$('.flexslider').flexslider({
    animation: 'fade',
    controlNav: true,
    directionNav: true,
    prevText: '',
    nextText: '',
    slideshow: true,
    pauseOnAction: true,
    pauseOnHover: false,
    animationSpeed: 300,
    slideshowSpeed: 5000,

});

$('.at-select2').select2();


// KLADR
(function () {
    var $container = $(document.getElementById('address_multiple_fields'));

    var $tooltip = $('#tooltip');

    var $zip = $container.find('[name="address[zip]"]'),
        $region = $container.find('[name="address[region]"]'),
        $region_index = $container.find('[name="address[region_index]"]'),
        $district = $container.find('[name="address[district]"]'),
        $city = $container.find('[name="address[city]"]'),
        $street = $container.find('[name="address[street]"]'),
        $building = $container.find('[name="address[building]"]');
    $()
        .add($region)
        .add($district)
        .add($city)
        .add($street)
        .add($building)
        .fias({
            parentInput: $container.find('.js-form-address'),
            verify: true,
            select: function (obj) {
                console.log(obj);
                if (obj.contentType === 'region') $region_index.val(obj.type);
                if (obj.zip) $zip.val(obj.zip);//Обновляем поле zip
                setLabel($(this), obj.type);
                $tooltip.hide();
            },
            check: function (obj) {
                var $input = $(this);

                if (obj) {
                    setLabel($input, obj.type);
                    $tooltip.hide();
                }
                else {
                    showError($input, 'Ошибка');
                }
            },
            checkBefore: function () {
                var $input = $(this);

                if (!$.trim($input.val())) {
                    $tooltip.hide();
                    return false;
                }
            }
        });

    $region.fias('type', $.fias.type.region);
    $district.fias('type', $.fias.type.district);
    $city.fias('type', $.fias.type.city);
    $street.fias('type', $.fias.type.street);
    $building.fias('type', $.fias.type.building);

    $district.fias('withParents', true);
    $city.fias('withParents', true);
    $street.fias('withParents', true);

    // Отключаем проверку введённых данных для строений
    $building.fias('verify', false);

    // Подключаем плагин для почтового индекса
    $zip.fiasZip($container);

    function setLabel($input, text) {
        text = text.charAt(0).toUpperCase() + text.substr(1).toLowerCase();
        $input.parent().find('label').text(text);
    }

    function showError($input, message) {
        $tooltip.find('span').text(message);

        var inputOffset = $input.offset(),
            inputWidth = $input.outerWidth(),
            inputHeight = $input.outerHeight();

        var tooltipHeight = $tooltip.outerHeight();
        var tooltipWidth = $tooltip.outerWidth();

        $tooltip.css({
            left: (inputOffset.left + inputWidth - tooltipWidth) + 'px',
            top: (inputOffset.top + (inputHeight - tooltipHeight) / 2 - 1) + 'px'
        });

        $tooltip.fadeIn();
    }
})();

$('a[data-toggle="tab"]:first').tab('show');

$('a[data-toggle="tab"]').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    // console.log(this);
});

/*$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    e.target // newly activated tab
    e.relatedTarget // previous active tab
    console.log(this);
    $(this).tab('show');
})*/

/*DELIVERY DATA*/

function City(country, region, tZoneId, cityId) {
    this.country = country;
    this.region = region;
    this.tZoneId = tZoneId;
    this.cityId = cityId;
    this.url = getUrlCode;
    function getUrlCode() {
        return "&RLAND=" + this.country +"&RZONE=" + this.tZoneId +"&RCODE=" + this.cityId + "&RREGIO=" + this.region;
    }
}

function Good(length, width, height, weight, volume, price) {
    this.length = parseFloat(length);
    this.width = parseFloat(width);
    this.height = parseFloat(height);
    this.weight = weight;
    this.volume = parseFloat(volume);
    this.price = price;
    this.url = getUrlCode;
    function getUrlCode() {
        return "&I_DELIVER=0&I_PICK_UP=1&WEIGHT=" + this.weight + "&VOLUME=" + this.volume + "&LENGTH=" + this.length*100 + "&WIDTH=" + this.width*100 + "&HEIGHT=" + this.height*100 + "&SLAND=RU&SZONE=0000006110&SCODE=610001100000&SREGIO=61&PRICE=" + this.price + "&I_HAVE_DOC=1";
    }
}

const table = $('#good_dimentions');


const deliveryGood = new Good(table.data('length'), table.data('width'), table.data('height'), table.data('weight'), table.data('volume'), table.data('price'));
const deliveryCity = new City();

reqestToKitBd("get_city_list");

$('input[list="cityListKit"]').on('change input', function(){
    if ($(this).val() != '') {
        $('.send-kit').removeAttr('disabled');
    } else {
        $('.send-kit').prop('disabled', true);
    }
});

$(".send-kit").on("click", function () {

    reqestToKitBd("is_city", "&city=" + $('input[list="cityListKit"]').val());
    $('.send-kit').loader('on');

});




function reqestToKitBd(functionName, functionParams) {
    // console.log(functionParams);

    let data;

    if (functionParams === undefined) {
        data = {"f": "&f=" + functionName};
    }
    else data = {"f": "&f=" + functionName+functionParams};

    jQuery.ajax({
        url: "/api/getTechDelivery",
        type: "get",
        dataType: "json",
        data: data,
        success: function (answer) {

            handler(functionName, answer);

        },
        error: function (answer) {

        }

    });
}

function handler(actionName, answer) {
    const response = JSON.parse(answer);


    switch (actionName) {
        case "get_city_list":


            const cities = response['CITY'];


            for (let key in cities) {

                $("#cityListKit").append("<option value='" + cities[key].NAME + "' data-id='" + cities[key].ID + "' data-region='" + cities[key].REGION + "' data-tzone='" + cities[key].TZONEID + "' data-country='" + cities[key].COUNTRY + "' ></option>");

            }
            break;

        case "is_city":

            if (response !== 0) {

                const city = response[0].split(":");
                deliveryCity.country = city[0];
                deliveryCity.region = city[1];
                deliveryCity.tZoneId = city[2];
                deliveryCity.cityId = city[3];

                if (deliveryGood.volume != undefined) {
                    reqestToKitBd("price_order", deliveryGood.url() + deliveryCity.url());
                }

            }
            break;
        case "price_order":
            console.log(response);

            $('.send-kit').loader('off');

            if (response.PRICE.TOTAL > 0) {

                /*changeFormField("#daysOfDelivery", response.DAYS);
                changeFormField("#priceOfDeliveryKit", response.PRICE.TOTAL + " рублей");*/

                changeTableField(".daysOfDelivery__td", response.DAYS);
                changeTableField(".priceOfDeliveryKit__td", response.PRICE.TOTAL + " рублей");


                // $("#daysOfDelivery").val(answer.DAYS);
                // $("#priceOfDeliveryKit").val(answer.PRICE.TOTAL + " рублей");

                console.log($(".answerKit"));

                // $(".answerKit").fadeIn("slow");
                $(".answerKit").show("slow");

            }

    }
}


/*$("#goodsList").on("change", function () {


    var name_product = jQuery(this).val();


    jQuery.ajax({
        url: "/php/requestFromDb.php",
        type: "post",
        dataType: "json",
        data: {"result": "param", "name_product": name_product},
        success: function (answer) {

            // console.log(answer);

            deliveryGood.length = answer.length;
            deliveryGood.width = answer.width;
            deliveryGood.height = answer.height;
            deliveryGood.weight = answer.weight;
            deliveryGood.volume = answer.volume;
            deliveryGood.price = answer.price;


            // данные для формы

            /!*changeFormField("#goodsLength", answer.length);
            changeFormField("#goodsWidth", answer.width);
            changeFormField("#goodsHeight", answer.height);
            changeFormField("#goodsWeight", answer.weight);
            changeFormField("#volumeOfGood", answer.volume);*!/

            // данные для таблицы

            changeTableField(".goodsLength__td", answer.length);
            changeTableField(".goodsWidth__td", answer.width);
            changeTableField(".goodsHeight__td", answer.height);
            changeTableField(".goodsWeight__td", answer.weight);
            changeTableField(".volumeOfGood__td", answer.volume);

            // $(".goodsParams__table").fadeIn("slow");
            $("div.goodsList").removeClass("full-width")
                .addClass("one-half");
            $(".goodsParams__table").removeClass("fantome");
            $(".cityListKit").removeClass("fantome");

            // changeFormField("#priceOfGood", answer.price);

        }
    });

});*/


function changeFormField(fieldName, value) {
    document.querySelector(fieldName).value = value;
    // jQuery('"' + fieldName + '"').val(value);
}

function changeTableField(fieldName, value) {
    $(fieldName).text(value);
    // jQuery('"' + fieldName + '"').val(value);
}

/*PRELOADER*/

window.onload = function () {
    var loader = document.getElementById("preloader");
    if (loader) {
        setTimeout(function () {

            loader.style.display = "none";
        }, 100)
    }

};

function closeModal() {
    document.getElementById('modal_window').style.display = "none";
}

$(document).ready(()=>{

    /*MORE-INFO*/

    $('.more-info').on('click', (e)=>{

       const location = $(e.target).find('a').attr('href');
       console.log(location);
       document.location.replace(location);
    });

    /*SIDE MENU*/
    $('p[data-toggle="collapse"]').on('click', function () {
        const element = $(this);
        const sign = element.children('svg');
        //toggle plus minus
        if (sign.hasClass('fa-plus')) {
            sign
                .removeClass('fa-plus')
                .addClass('fa-minus');
        } else {
            sign
                .removeClass('fa-minus')
                .addClass('fa-plus');
        }
    });

    const checkWindowWidth = ()=>{
        if (window.innerWidth > 420) {
            $('[data-toggle="tooltip"]').tooltip();
        }

        if (window.innerWidth < 600) {
            $('.single-slide').hide();
            console.log(window);
        } else {
            $('.single-slide').show();
        }
    };

    const checkWindowHeight = ()=>{
        const body = document.body;
        const html = document.documentElement;
        const height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
    };
    checkWindowWidth();
    checkWindowHeight();



    $(window).resize(function() {
        checkWindowWidth();
        checkWindowHeight();
    });

    const menu = $('#menu-group-1');

    _.forEach(menu.find('a'), (a)=>{
        if ($('body').hasClass($(a).data('initial'))) {
            const parents = $(a).parents('p');
            parents.trigger('click');
            $(a).css({color: 'red'});
        }
    });


    function request(url = '', type = 'get', dataType = 'json', data = {}, success, error, elem) {
        $.ajax({
            url: url,
            type: type,
            dataType: dataType,
            data: data,
            success: function (answer) {
                if (typeof (success) == 'function') {
                    success(answer, elem);
                }
            },
            error: function (answer) {
                if (typeof (error) == 'function') {
                    error(answer, elem);
                }
            }
        });
    }

// TODO PAGE SCRIPTS

    function successFilter(value, elem) {
        $('#innerContent').html(value);
        $(elem).removeClass('btn-animation');
        $(elem).children().prop('disabled', false);
    }
    function errorFilter(value, elem) {
        $('#innerContent').html('');
        $(elem).removeClass('btn-animation');
        $(elem).children().prop('disabled', false);
    }

    $('#selectFilterTechs').on('change', (e)=>{
        const elem = e.target;
        const parent = $(elem).parents('div.form-group');
        parent.addClass('btn-animation');
        $(elem).prop('disabled', true);
        request('/spare-parts/filter', 'get', 'json', {tech_id : $(elem).val()}, successFilter, errorFilter, parent);
    });

});

