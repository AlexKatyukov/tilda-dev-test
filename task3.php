<?php

/**
 * Задача 3: фронт
 * 
 * Вы работаете в компании, присутствующей в нескольких городах РФ. На сайте компании есть страница с контактной информацией. Маркетолог поставил задачу и уехал, к его приезду задача должна быть реализована.
 * На страницу контактов заходят люди из разных городов, нужно чтобы они видели телефон из своего города. По умолчанию, в HTML-страницы прописан телефон 8-800-DIGITS. Телефон размещен в верху и внизу страницы.
 * Вот и все что рассказал маркетолог прежде чем уехать.
 */

?>

<div id="header">
    <div class="description">
        Вверху:
    </div>
    <div class="tel">
        8-800-DIGITS
    </div>
</div>

<div id="footer">
    <div class="description">
        Внизу:
    </div>
    <div class="tel">
        8-800-DIGITS
    </div>
</div>

<script>
let phoneNumber;

navigator.geolocation.getCurrentPosition(success, error, {
    enableHighAccuracy: false,
})

function success({ coords }) {
    const { latitude, longitude } = coords;
    fetch(`task3_ajax.php?coords=${latitude},${longitude}`)
        .then(function(response) {
            return response.text();
        })
        .then(function(text) {
            const elements = document.querySelectorAll(".tel");
            for (var i = 0; i < elements.length; ++i) {
                var item = elements[i];  
                item.innerHTML = text;
            }
        });
}

function error({ message }) {
    fetch('task3_ajax.php')
        .then(function(response) {
            return response.text();
        })
        .then(function(text) {
            const elements = document.querySelectorAll(".tel");
            for (var i = 0; i < elements.length; ++i) {
                var item = elements[i];  
                item.innerHTML = text;
            }
        });
}
</script>
