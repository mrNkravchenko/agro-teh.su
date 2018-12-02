jQuery(function () {

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


    var deliveryGood = new Good();
    var deliveryCity = new City();

    reqestToKitBd("get_city_list");

    jQuery("input[list='cityListKit']").on("change", function () {

        reqestToKitBd("is_city", "&city=" + jQuery(this).val());
    });




    function reqestToKitBd(functionName, functionParams) {
        // console.log(functionParams);

        if (functionParams === undefined) {
            var data = {"f": "&f=" + functionName};
        }
        else var data = {"f": "&f=" + functionName+functionParams};

        jQuery.ajax({
            url: "/php/sendRequestToKit.php",
            type: "get",
            dataType: "json",
            data: data,
            success: function (answer) {

                handler(functionName, answer);

            },
            error: function (answer) {
                console.log(answer);
            }

        });
    }

    function handler(actionName, answer) {


        switch (actionName) {
            case "get_city_list":
                var answer = answer.CITY;

                for (var key in answer) {

                    jQuery("#cityListKit").append("<option value='" + answer[key].NAME + "' data-id='" + answer[key].ID + "' data-region='" + answer[key].REGION + "' data-tzone='" + answer[key].TZONEID + "' data-country='" + answer[key].COUNTRY + "' ></option>");

                }
                break;

            case "is_city":

                if (answer !== 0) {


                    var city = answer[0].split(":");
                    deliveryCity.country = city[0];
                    deliveryCity.region = city[1];
                    deliveryCity.tZoneId = city[2];
                    deliveryCity.cityId = city[3];

                    if (deliveryGood.volume != undefined) {
                        reqestToKitBd("price_order", deliveryGood.url() + deliveryCity.url());
                    }


                    // console.log(deliveryCity, deliveryGood);
                }
                break;
            case "price_order":

                if (answer.PRICE.TOTAL > 0) {

                    changeFormField("#daysOfDelivery", answer.DAYS);
                    changeFormField("#priceOfDeliveryKit", answer.PRICE.TOTAL + " рублей");

                    changeTableField(".daysOfDelivery__td", answer.DAYS);
                    changeTableField(".priceOfDeliveryKit__td", answer.PRICE.TOTAL + " рублей");


                    // $("#daysOfDelivery").val(answer.DAYS);
                    // $("#priceOfDeliveryKit").val(answer.PRICE.TOTAL + " рублей");

                    $(".answerKit").fadeIn("slow");

                }

                // написать форму для вывода цены на экран и заполнить значение ценами, а так же подкорректировать форму выбора товара

                // answerKit


                // console.log(answer.PRICE.TOTAL);


        }
    }


    jQuery("#goodsList").on("change", function () {


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

                /*changeFormField("#goodsLength", answer.length);
                changeFormField("#goodsWidth", answer.width);
                changeFormField("#goodsHeight", answer.height);
                changeFormField("#goodsWeight", answer.weight);
                changeFormField("#volumeOfGood", answer.volume);*/

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

    });


    function changeFormField(fieldName, value) {
        document.querySelector(fieldName).value = value;
        // jQuery('"' + fieldName + '"').val(value);
    }

    function changeTableField(fieldName, value) {
        $(fieldName).text(value);
        // jQuery('"' + fieldName + '"').val(value);
    }


    // jQuery.ajax({
    //     url: "/php/requestFromDb.php",
    //     type: "post",
    //     dataType: "json",
    //     data: {"result": "product"},
    //     success: function (answer) {
    //
    //         for (var key in answer) {
    //
    //             jQuery("#goodsList").append("<option value='" + answer[key].title + "' data-id='" + answer[key].id + "'>" + answer[key].title + "</option>");
    //
    //         }
    //
    //     },
    //     error: function (answer) {
    //         console.log("ошибка");
    //         console.log(answer);
    //     }
    //
    // });


});