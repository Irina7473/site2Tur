function createAjaxObject() {
    let ao = null;

    try {
        ao = new XMLHttpRequest();
    } catch (e) {
        try {
            ao = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            alert('AJAX не поддерживается!');
            return false;
        }
    }
    return ao;
}

function showCities (countryId){

    if (countryId == 0) {
        document.getElementById('cityList').innerHTML = '';
    }

    let ao = createAjaxObject();
    ao.onreadystatechange = function () {
        if (ao.readyState == 4 || ao.status == 200) {
            document.getElementById('cityList').innerHTML = ao.responseText;
        }
    }

    ao.open ('POST', 'pages/ajax1.php', true);
    ao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ao.send('cid=' + countryId);
}

function showHotels (cityId){

    if (cityId == 0) {
        document.getElementById('hotelsList').innerHTML = '';
    }

    let ao = createAjaxObject();
    ao.onreadystatechange = function () {
        if (ao.readyState == 4 || ao.status == 200) {
            document.getElementById('hotelsList').innerHTML = ao.responseText;
        }
    }

    ao.open ('POST', 'pages/ajax2.php', true);
    ao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ao.send( 'cid=' + cityId);
}

