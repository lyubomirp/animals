let slideIndex = 1;
const err  = document.querySelector("#error");
const container = document.querySelector(".slideshow-container");

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

function submitForm(url) {
    const file = document.querySelector("#file-selector").files[0];
    err.innerHTML = '';
    container.innerHTML = '';

    if (!file) {
        err.innerHTML = "No file added";
        return;
    }

    if (file.type !== "application/json") {
        err.innerHTML = "Incorrect format";
        return;
    }

    const fd   = new FormData();
    const xhr  = new XMLHttpRequest();

    xhr.onreadystatechange = function() {

        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    printResponse(JSON.parse(xhr.responseText));
                } catch (e) {
                    err.innerHTML = xhr.responseText;
                }
            } else {
                err.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open("POST", url, true)
    xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');

    fd.append("file", file);

    xhr.send(fd);
}


function printResponse(animals) {
    container.innerHTML = '';

    Object.values(animals).forEach(val => {
        container.innerHTML +=
            `<div class="mySlides">
                <img src="${val.image}" alt="${val.name} picture">
                <ul>
                    <li>Name - ${val.name}</li>
                    <li>Age - ${val.age}</li>
                    <li>Sex - ${val.sex}</li>
                    <li>Species - ${val.species}</li>
                    <li>Date of birth - ${val.dob}</li>
                </ul>
            </div>`
    })

    showSlides(slideIndex);
}