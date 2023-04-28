function slide(evt, tabName) {
    var i, tweetss, tablinks;

    tweetss = document.getElementsByClassName("tweetss");
    for (let i = 0; i < tweetss.length; i++) {
        tweetss[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

function menue(id) {
    var post = document.getElementById(id);
    var first = post.querySelector(".men-ue");
    first.classList.toggle("men-ue1");
}

function edit() {
    document.querySelector(".edit-profile").style.display = "block";
    document.querySelector(".second_side").style.filter = "blur(5px)";
}

function exit() {
    document.querySelector(".edit-profile").style.display = "none";
    document.querySelector(".second_side").style.filter = "none";
}
function showPhoto() {
    document.querySelector(".photo-display").style.display = "block";
    document.querySelector(".second_side").style.filter = "blur(5px)";
}

function exitPhoto() {
    document.querySelector(".photo-display").style.display = "none";
    document.querySelector(".second_side").style.filter = "none";
}
