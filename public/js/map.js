function initMap() {
    const map = document.getElementById("map");
    const center = { lat: 35.6812, lng: 139.7671 }; //東京駅

    //オプション指定
    opt = {
        zoom: 7,
        center: center,
    };

    const mapObj = new google.maps.Map(map, opt);
    
    posts.forEach((post) => {
        console.log(post.lat, post.lng, post.address);
        const latMaker = post.lat;
        const lngMaker = post.lng;

        const marker = new google.maps.Marker({
            map: mapObj,
            position: {lat: latMaker, lng:lngMaker},
            title: post.address,
        });

        marker.addListener("click", () => {
            window.location.href = `/posts/${post.id}`;
        });
    });
}
