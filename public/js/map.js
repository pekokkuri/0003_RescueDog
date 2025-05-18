function initMap() {
    const map = document.getElementById("map");
    const center = { lat: 35.6812, lng: 139.7671 }; //東京駅

    //オプション指定
    opt = {
        zoom: 7,
        center: center,
    };

    mapObj = new google.maps.Map(map, opt);
}
