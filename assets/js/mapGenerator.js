
// Функция ymaps.ready() будет вызвана, когда
// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
ymaps.ready(init);
function init(){
    // Создание карты.





    /*var myPlacemark = new ymaps.Placemark([55.76, 37.64], {
        // Хинт показывается при наведении мышкой на иконку метки.
        hintContent: 'Содержимое всплывающей подсказки',
        // Балун откроется при клике по метке.
        balloonContent: 'Содержимое балуна'
    });

// После того как метка была создана, ее
// можно добавить на карту.
    myMap.geoObjects.add(myPlacemark);*/

    // Осуществляет поиск объекта с именем "Москва".
// Полученный результат сразу отображается на карте.




    if (document.querySelector('#hangarMap') !== null) {

        var address = document.querySelector('.hangars__address').innerText;
        address = $.trim(address);

        var textOfHangar = '';
        textOfHangar += document.querySelector('.hangars__type').innerText + ', ';
        textOfHangar += document.querySelector('.hangars__dimentions').innerText + ', ';
        textOfHangar += document.querySelector('.hangars__address').innerText + ', ';
        textOfHangar += document.querySelector('.hangars__costumers').innerText;

        console.log(textOfHangar);

        var oneHangar = new Query('https://geocode-maps.yandex.ru/1.x/', {'geocode': address, 'format': 'json'}, textOfHangar, textOfHangar);

        oneHangar.run();

    }

    if (document.querySelector('#hangarsMap') !== null) {

        var allHangarsMap = new ymaps.Map("hangarsMap", {
            // Координаты центра карты.
            // Порядок по умолчнию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [46.181345, 41.077155],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 6
        });


        var addresses = document.querySelectorAll('.hangars__address');

        for (address in addresses){
            if (addresses[address].innerText !== undefined){

                var textForHangars = '';
                var parent = addresses[address].parentNode;
                var hangarAddress = $.trim(addresses[address].innerText);

                textForHangars += $.trim($(parent).children('.hangars__type').text()) + ', ';
                textForHangars += $.trim($(parent).children('.hangars__dimentions').text()) + ', ';
                textForHangars += $.trim($(parent).children('.hangars__address').text()) + ', ';
                textForHangars += $.trim($(parent).children('.hangars__costumers').text()) /*+ ', '*/;

                var oneOfHangar = new Query('https://geocode-maps.yandex.ru/1.x/', {'geocode': hangarAddress, 'format': 'json'}, textForHangars, textForHangars);

                oneOfHangar.run();

            }

        }

    }


    function mapCallback(answer, hint, balloon){

        var point = new GetGeoPoint(answer.response.GeoObjectCollection.featureMember["0"].GeoObject.Point.pos).point;
        point = $.trim(point);
        point = point.replace(' ', ', ');
        point = point.split(',');
        point = [parseFloat(point[1]), parseFloat(point[0])];
        console.log(point);

        // проверяем где отображается карта, в общем списке или в конкретном ангаре

        if (document.querySelector('#hangarMap') !== null) {

            var myMap = new ymaps.Map("hangarMap", {
                // Координаты центра карты.
                // Порядок по умолчнию: «широта, долгота».
                // Чтобы не определять координаты центра карты вручную,
                // воспользуйтесь инструментом Определение координат.
                center: point,
                // Уровень масштабирования. Допустимые значения:
                // от 0 (весь мир) до 19.
                zoom: 11
            });

            var oneHangar = new ymaps.Placemark(point, {
                // Хинт показывается при наведении мышкой на иконку метки.
                hintContent: hint,
                // Балун откроется при клике по метке.
                balloonContent: balloon
            }, {
                preset: 'islands#redHomeCircleIcon'
            });

            myMap.geoObjects.add(oneHangar);

        }
        if (document.querySelector('#hangarsMap') !== null) {

            var oneOfHangars = new ymaps.Placemark(point, {
                // Хинт показывается при наведении мышкой на иконку метки.
                hintContent: hint,
                // Балун откроется при клике по метке.
                balloonContent: balloon
            }, {
                preset: 'islands#redHomeCircleIcon'
            });

            allHangarsMap.geoObjects.add(oneOfHangars);

        }

    }


    function GetGeoPoint(point){
        this.point = point;
    }

    function Query(server, params, hint, balloon) {

        this.server = server;

        this.params = params;

        this.run = run;

        function run() {

            return $.ajax({

                url: server,

                dataType: 'json',

                type: 'get',

                data: params,

                ajaxError: function (msg) {

                    console.log('ajaxError ' + msg)

                },

                complete: function (msg) {

                    // console.log('complete ' + msg.status)

                },

                success: function (answer) {

                    mapCallback(answer, hint, balloon);

                },

                error: function (error) {

                    console.log('error ' + error.status);

                }

            });
        }
    }

}



