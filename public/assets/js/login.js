
function toggleForm(index) {
    const box = document.querySelector('.box')

    if (index === 1) {
        box.classList.contains('register') && box.classList.remove('register')
        box.classList.contains('login') || box.classList.add('login')
        return
    }

    if (index === 2) {
        box.classList.contains('login') && box.classList.remove('login')
        box.classList.contains('register') || box.classList.add('register')
    }

}


// toggle show password
function togglePassword(index) {

    const a = document.getElementById(`passwd-${index}`);
    const b = document.getElementById(`eye-${index}`);
    const c = document.getElementById(`eye-slash-${index}`);

    if (a.type === "password") {
        a.type = "text"
        b.style.opacity = "0";
        c.style.opacity = "1";

    } else {
        a.type = "password"
        b.style.opacity = "1";
        c.style.opacity = "0";

    }

}

function login() {
    const email = document.getElementById('email'),
        passwd = document.getElementById('passwd-1')

    const req = { url: 'http://localhost/giftzone/public/login', body: { email: email.value, password: passwd.value } }

    postData(req)
}

async function postData(req) {
    const res = await fetch(req.url, {
        method: 'post',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(req.body)
    })
        .then(res => res.ok ? res.json() : { 'success': false, 'msg': 'Response failed!' })
        .catch(error => { return { 'success': false, 'msg': error, 'occured_in': 'Catch block of postData()' } })

    // console.log(res)
}

// Popup message
const popup = document.querySelector('.popup-box'),
    popupClose = document.querySelector('.popup-close'),
    popupMsg = document.querySelector('.popup-msg')

let popupHasHover = false

function hidePopup() {
    if (!popup) return
    setTimeout(() => {
        if (popupHasHover) return
        popup.style.opacity = '0'
        setTimeout(() => {
            if (popup.style.opacity != '0') return
            popup.style.visibility = 'hidden'
        }, 2000);
    }, 5000)
}

function holdPopup() {
    if (!popup) return
    if (!popupHasHover) return
    popup.style.opacity = '1'
}

// Events
window.addEventListener('load', () => {
    if (!popup) return
    if(popupMsg.value === '') return
    popup.style.visibility = 'visible'
    popup.style.opacity = '1'
    hidePopup()
})

if (popup) {
    popup.addEventListener('mouseenter', () => {
        popupHasHover = true
        holdPopup()
    })
    popup.addEventListener('mouseleave', () => {
        popupHasHover = false
        hidePopup()
    })

    popupClose.addEventListener('click', () => popup.style.visibility = 'hidden')
}

