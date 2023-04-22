function slide(evt, tabName) {
    var i, tweetss, tablinks;

    tweetss = document.getElementsByClassName("tweetss");
    for (i = 0; i < tweetss.length; i++) {
        tweetss[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// document.getElementById("defaultOpen").click();
