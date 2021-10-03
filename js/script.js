const realFileBtn = document.getElementById("file");
const customBtn = document.getElementById("upload");
const customTxt = document.getElementById("profile");

customBtn.addEventListener("click", function () {
    realFileBtn.click();
});

realFileBtn.addEventListener("change", function () {
    if (realFileBtn.value) {
        customTxt.value = realFileBtn.value;
    }
});