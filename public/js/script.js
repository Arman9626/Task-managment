if (location.href.split("?")[1] !== "") {
    if (
    location.href.split("?")[1].split("&")[0].split("=")[1] === ""
    ) {
    location.href = location.href.split("?")[0];
}
} else {
    location.href = location.href.split("?")[0];
}
