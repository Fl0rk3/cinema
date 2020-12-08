function view(name) {
    close()
    var x = document.getElementById(name);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function close() {
    var x = document.getElementsByClassName("box");
    for (var i of x) {
        if (i.style.display === "block") {
            i.style.display = "none";
        }
    }
}