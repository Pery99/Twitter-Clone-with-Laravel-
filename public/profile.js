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
    document.querySelector(".main-edit").style.display = "flex";
    document.querySelector('body').style.overflow = 'hidden';
}

function exit() {
    document.querySelector(".main-edit").style.display = "none";
    document.querySelector('body').style.overflow = 'auto';
}
window.addEventListener('click', (e) => {
    if(e.target === document.querySelector(".main-edit")) {
        document.querySelector(".main-edit").style.display = "none";
        document.querySelector('body').style.overflow = 'auto';
    }
});
function showPhoto() {
    document.querySelector(".photo-display").style.display = "block";
    document.querySelector(".second_side").style.filter = "blur(5px)";
}

function exitPhoto() {
    document.querySelector(".photo-display").style.display = "none";
    document.querySelector(".second_side").style.filter = "none";
}
