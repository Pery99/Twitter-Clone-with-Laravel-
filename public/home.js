function tabSwitch(event, change) {
    var i, prefrence, tabLink;

    prefrence = document.querySelectorAll(".prefrence");
    for (let i = 0; i < prefrence.length; i++) {
        prefrence[i].style.display = "none";
    }

    tabLink = document.querySelectorAll(".tabLink");
    for (let i = 0; i < tabLink.length; i++) {
        tabLink[i].className = tabLink[i].className.replace(" active", "");
    }

    document.getElementById(change).style.display = "block";
    event.currentTarget.className += " active";
}