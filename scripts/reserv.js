var global_suma;
var global_picked;
var global_ceny;
var global_info;
var global_id_movie;

function start(id) {
    global_id_movie = id;
    var p1 = document.getElementById("p1")
    p1.classList.add("activeField")
    var b1 = document.getElementById("b1")
    b1.classList.add("activeBox")
    //draw(places)
}

function button1() {
    var check = document.getElementById("regCheck").checked
    if (check) {
        box2()
    } else {
        document.getElementById('alert1').innerHTML = "Nie zaznaczono wymaganych pól!"
    }
}

function box2() {
    document.querySelector(".activeField").classList.remove('activeField')
    document.querySelector(".activeBox").classList.remove('activeBox')
    var p2 = document.getElementById("p2")
    p2.classList.add("activeField")
    var b2 = document.getElementById("b2")
    b2.classList.add("activeBox")
}

function button2(places) {
    var norm = parseInt(document.getElementById("normalny").value)
    var student = parseInt(document.getElementById("studencki").value)
    var ulgo = parseInt(document.getElementById("ulgowy").value)
    var senior = parseInt(document.getElementById("seniorski").value)
    var suma = norm + student + ulgo + senior
    if (suma <= 10 && suma > 0) {
        var ceny = {
            normalny: norm,
            studencki: student,
            ulgowy: ulgo,
            seniorski: senior
        }
        global_ceny = ceny
        box3(suma, places)
    } else if (suma > 10) {
        document.getElementById("alert2").innerHTML = "Maksymalnie można wybrać 10 biletów!"
    } else {
        document.getElementById("alert2").innerHTML = "Proszę wybrać bilety!"
    }
}

function box3(suma, places) {
    document.querySelector(".activeBox").classList.remove('activeBox')
    var b3 = document.getElementById("b3")
    b3.classList.add("activeBox")
    draw(places, suma)
}

function draw(places, suma) {
    console.log(places)
    var checkNew = true;
    let placesNew = places.map((x) => x)
    console.log(placesNew)

    document.getElementById('mapa').innerHTML = ""
    let ekran = document.createElement('div')
    ekran.id = "ekran"
    document.getElementById('mapa').appendChild(ekran)
    write(suma)
    let choosen = 0
    let picked = []
    for (let i = 1; i <= 15; i++) {
        let row = document.createElement('div')
        row.classList.add('row')
        let rowNum = document.createElement('div')
        rowNum.classList.add('numRow')
        rowNum.innerHTML = i
        if (i >= 10) {
            rowNum.style.marginLeft = "-9px"
        }
        row.appendChild(rowNum)

        for (let j = 1; j <= 21; j++) {
            if (checkNew && placesNew.length > 0) {
                var place = placesNew.shift()
                checkNew = false;
                console.log(place)
            }
            let column = 0
            let cell = document.createElement('div')
            if (j != 11) {
                if (j > 11) {
                    cell.innerHTML = j - 1
                    column = j - 1
                } else {
                    cell.innerHTML = j
                    column = j
                }
                if (place) {
                    if (i == place.row && column == place.place) {
                        cell.classList.add('gray')
                        cell.classList.add('blocked')
                        checkNew = true;
                    } else {
                        cell.classList.add('green')
                        cell.onclick = function () {
                            if (cell.classList.contains('green')) {
                                cell.classList.remove('green')
                                cell.classList.add('orange')
                                picked.push({ row: i, column: column })
                                global_picked = picked
                                choosen = suma - picked.length
                                write(choosen)
                            } else {
                                cell.classList.remove('orange')
                                cell.classList.add('green')
                                picked = picked.filter(item => (item.row !== i || item.column !== column))
                                global_picked = picked
                                choosen = suma - picked.length
                                write(choosen)
                            }
                            console.log(picked)
                        }
                    }
                } else {
                    cell.classList.add('green')
                    cell.onclick = function () {
                        if (cell.classList.contains('green')) {
                            cell.classList.remove('green')
                            cell.classList.add('orange')
                            picked.push({ row: i, column: column })
                            global_picked = picked
                            choosen = suma - picked.length
                            write(choosen)
                        } else {
                            cell.classList.remove('orange')
                            cell.classList.add('green')
                            picked = picked.filter(item => (item.row !== i || item.column !== column))
                            global_picked = picked
                            choosen = suma - picked.length
                            write(choosen)
                        }
                        console.log(picked)
                    }
                }
            } else {
                cell.classList.add("blank")
            }
            cell.classList.add('cell')
            row.appendChild(cell)
        }
        document.getElementById('mapa').appendChild(row)
    }
}

function write(suma) {
    global_suma = suma
    var info = document.getElementById('liczbaM')
    if (suma > 0) {
        info.style.color = "red"
        info.innerHTML = "Proszę wybrać " + suma + " miejsce(a)"
    } else if (suma == 0) {
        info.style.color = "black"
        info.innerHTML = "Wszystkie miejsca zostały wybrane"
    } else {
        info.style.color = "red"
        info.innerHTML = "Wybrano za dużo miejsc!"
    }
}

function button3() {
    if (global_suma == 0) {
        box4()
    } else {
        document.getElementById("alert3").innerHTML = "Wybrano za mało lub za dużo miejsc!"
    }
}

function box4() {
    document.querySelector(".activeField").classList.remove('activeField')
    document.querySelector(".activeBox").classList.remove('activeBox')
    var p3 = document.getElementById("p3")
    p3.classList.add("activeField")
    var b4 = document.getElementById("b4")
    b4.classList.add("activeBox")
}

function back_button4() {
    document.querySelector(".activeField").classList.remove('activeField')
    document.querySelector(".activeBox").classList.remove('activeBox')
    var p2 = document.getElementById("p2")
    p2.classList.add("activeField")
    var b3 = document.getElementById("b3")
    b3.classList.add("activeBox")
}

function button4() {
    var imie = document.getElementById('imie').value
    var nazwisko = document.getElementById('nazwisko').value
    var email = document.getElementById('mail').value
    var tel = document.getElementById('phone').value
    var info = {
        imie: imie,
        nazwisko: nazwisko,
        mail: email,
        phone: tel
    }
    global_info = info

    if (imie.length == 0 || nazwisko.length == 0 || !validateEmail(email) || tel.length != 9) {
        document.getElementById("alert4").innerHTML = "Błąd uzupełniania danych!"
    } else {
        box5(info)
    }
}


function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function box5(info) {
    document.querySelector(".activeField").classList.remove('activeField')
    document.querySelector(".activeBox").classList.remove('activeBox')
    var p4 = document.getElementById("p4")
    p4.classList.add("activeField")
    var b5 = document.getElementById("b5")
    b5.classList.add("activeBox")

    document.getElementById("imiePod").innerHTML = info.imie
    document.getElementById("nazwiskoPod").innerHTML = info.nazwisko
    document.getElementById("mailPod").innerHTML = info.mail
    document.getElementById("phonePod").innerHTML = info.phone


    document.getElementById("normalnyIlosc").innerHTML = global_ceny.normalny
    var cenaNorm = global_ceny.normalny * 34
    document.getElementById("normalnyCena").innerHTML = cenaNorm + ".00 zł"

    document.getElementById("studenckiIlosc").innerHTML = global_ceny.studencki
    var cenaStudent = global_ceny.studencki * 26
    document.getElementById("studenckiCena").innerHTML = cenaStudent + ".00 zł"

    document.getElementById("ulgowyIlosc").innerHTML = global_ceny.ulgowy
    var cenaUlgo = global_ceny.ulgowy * 25
    document.getElementById("ulgowyCena").innerHTML = cenaUlgo + ".00 zł"

    document.getElementById("seniorskiIlosc").innerHTML = global_ceny.seniorski
    var cenaSen = global_ceny.seniorski * 26
    document.getElementById("seniorskiCena").innerHTML = cenaSen + ".00 zł"

    document.getElementById("sumaBiletow").innerHTML = global_ceny.normalny + global_ceny.studencki + global_ceny.ulgowy + global_ceny.seniorski
    var sumaCen = cenaNorm + cenaStudent + cenaUlgo + cenaSen
    document.getElementById("cenaBiletow").innerHTML = sumaCen + ".00 zł"
}

function button5() {
    $(document).ready(function () {
        var data = {
            personal: global_info,
            tickets: global_picked
        }
        console.log(data)
        $.ajax({
            url: "../php/reserv.php",
            method: "POST",
            dataType: "json",
            data: {
                personal: JSON.stringify(global_info),
                tickets: JSON.stringify(global_picked),
                movie: JSON.stringify(global_id_movie)
            },
            success: function (result) {
                console.log("php: ", result)
                if (result == 1) {
                    box6();
                } else {
                    alert("BŁĄD, SPRÓBUJ PONOWNIE PÓŹNIEJ");
                    window.location.href = "../index.php";
                }
            },
            error: function (error) {
                alert("BŁĄD, SPRÓBUJ PONOWNIE PÓŹNIEJ");
                window.location.href = "../index.php";
            }
        })
    })
}

function box6() {
    document.querySelector(".activeBox").classList.remove('activeBox')
    var b6 = document.getElementById("b6")
    b6.classList.add("activeBox")
}

function button6() {
    window.location.href = "../index.php";
}