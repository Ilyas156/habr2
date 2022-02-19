
const likes = Array.from(document.querySelectorAll('.like'));

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
    
    fetch(`http://habr2.com/site/like?id=${id}`);
    
    return null;
}
