
const ROOT = document.querySelector('.header__logo a').getAttribute('href')


/**
 * Request sending function
 * @param {string} url
 * @param {object} body
 * @param {string} method
 * @param {object} headers
 * @returns {object}
 */
async function request(url, body = null, method = "get", headers = { 'Accept': 'application/json' }) {

    if (method.toLowerCase() === "post" && JSON.stringify(headers) === JSON.stringify({ 'Accept': 'application/json' }))
        headers = {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }

    const options = {
        method: method,
        headers: headers,
    }

    if (method.toLowerCase() === "post")
        options.body = JSON.stringify(body)


    return await fetch(url, options)
        .then(res => res.ok ? res.json() : { 'success': false, 'msg': 'Response failed!' })
        .catch(error => { return { 'success': false, 'msg': error, 'occured_in': 'Catch block of postData()' } })
}


/**
 * Search box suggestions
 */
const searchList = document.getElementById('search-list')
const searchField = document.querySelector('.search__field')
const dataList = document.querySelectorAll('#search-list option')
const data = Array.from(dataList)

searchList.innerHTML = ""
searchField.addEventListener('keyup', () => {
    const filtered = data.filter(item => item.value.toLowerCase().includes(searchField.value.toLowerCase()))
    searchList.innerHTML = ""
    for (let i = 0; i < filtered.length; i++) {
        if (i === 5) break
        searchList.appendChild(filtered[i])
    }
})


/**
 * Session validation
 */
let userActive = false;

window.addEventListener('DOMContentLoaded', async () => {
    const res = await request(`${ROOT}/session/state`)
    if (!res.loggedIn) return;

    const updateState = () => {
        userActive = true;
        setTimeout(() => {
            userActive = false;
        }, 1000);
    }

    document.addEventListener('mousemove', updateState)
    document.addEventListener('scroll', updateState)
    document.addEventListener('keyup', updateState)

    const processId = setInterval(async () => {
        if (!userActive) return;
        const res = await request(`${ROOT}/session/validate`, {}, "post")
        if (!res.loggedIn) clearInterval(processId)
    }, 1000);
})

