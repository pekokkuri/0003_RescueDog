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
        const latMaker = post.lat;
        const lngMaker = post.lng;
        const iconMaker = {
            url: post.image_path
            ? `/storage/${post.image_path}` //投稿画像を表示
            : `/images/NoImage.png`,        //投稿画像がない場合はNoimageを表示
            scaledSize: new google.maps.Size(40, 40),
        };

        const marker = new google.maps.Marker({
            map: mapObj,
            position: {lat: latMaker, lng:lngMaker},
            title: post.address,
            icon: iconMaker,
        });

        marker.addListener("click", () => {
            window.location.href = `/posts/${post.id}`;
        });
    });
}
