"use strict";

const addressInput = document.getElementById("address");
const latInput = document.getElementById("lat");
const lngInput = document.getElementById("lng");
const postForm = document.getElementById("post-form");
let errorMessage = document.getElementById("error-message");

// 住所入力中のEnterキー送信を止める
addressInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        e.preventDefault(); // 住所欄でEnter押されたときはキャンセル
    }
});

function submitForm() {
    if (!addressInput.value.trim()) {
        errorMessage.textContent = "*住所は入力必須です";
        errorMessage.style.display = "block";
        return;
    }

    //エラーメッセージを消す
    errorMessage.style.display = "none";

    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: addressInput.value }, (results, status) => {
        if (status == "OK") {
            const location = results[0].geometry.location;
            latInput.value = location.lat();
            lngInput.value = location.lng();

            //緯度・経度が入力されたらフォーム送信
            postForm.submit();
        } else {
            errorMessage.textContent = "住所が見つかりません";
            errorMessage.style.display = "block";
        }
    });
}
