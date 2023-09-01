const loginBox = document.querySelector('.box-login')
const registerBox = document.querySelector('.box-register')
const activeSwitch = document.querySelector('.switch > .switch-active')
const box = document.querySelector('.box')

function toggleForm(index) {
    if (index === 1) {
        loginBox.style.transform = 'translateX(0)'
        registerBox.style.transform = 'translateX(110%)'
        activeSwitch.style.transform = `translateX(-50%)`
        box.style.height = '40em'
        return
    }

    if (index !== 2)
        return

    loginBox.style.transform = 'translateX(-110%)'
    registerBox.style.transform = 'translateX(0)'
    activeSwitch.style.transform = `translateX(50%)`
    box.style.height = '48em'
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
