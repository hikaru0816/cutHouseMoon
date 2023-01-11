function initMap() {
    const cutHouseMoon = { lat: 33.18845741031135, lng: 129.67993016278365 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: cutHouseMoon,
    });
    const marker = new google.maps.Marker({
        position: cutHouseMoon,
        map: map,
    });
}

window.initMap = initMap;
