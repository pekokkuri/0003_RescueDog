function initMap() {
  const map = document.getElementById("map");
  const center = { lat: post.lat, lng: post.lng }; //ユーザーが投稿した住所をセンターに

  //オプション指定
  opt = {
      zoom: 17.5,
      center: center,
  };

  const mapObj = new google.maps.Map(map, opt);
  
  // posts.forEach((post) => {
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
          optimized: false,  //投稿画像を丸くするためにfalse
      });
  // });
}
