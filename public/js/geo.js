const addressInput = document.getElementById("address");
const latInput = document.getElementById("lat");
const lngInput = document.getElementById("lng");

addressInput.addEventListener("change", () => {
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: addressInput.value }, (results, status) => {
        if (status == "OK") {
            const location = results[0].geometry.location;
            latInput.value = location.lat();
            lngInput.value = location.lng();
        } else {
            alert("住所が見つかりません：" + status);
        }
    });
});

function submitForm() {
    const form = document.getElementById('post-form');
    form.submit();
}