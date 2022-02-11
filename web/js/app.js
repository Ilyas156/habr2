
const likes = Array.from(document.querySelectorAll('.like'));
let xhr = new XMLHttpRequest();


likes.forEach((like, index) => {
    like.addEventListener('click', () => {
        like.classList.toggle('active');
        const current = Number(like.lastElementChild.innerHTML);
        const inc = like.classList.contains("active") ? 1 : -1;
        like.lastElementChild.innerHTML = current + inc;
        sendServer(+like.id);
    })
});

function sendServer(id) {
    xhr.open('GET', `http://habr2.com/site/like?id=${id}`, false);
    xhr.send();
    if (xhr.status !== 200) {
        // обработать ошибку
        alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
    }
}