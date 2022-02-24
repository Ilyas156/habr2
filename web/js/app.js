const DOMEN = 'http://habr2.com/'; 


function setLike(id) {
    let like = document.getElementById(`${id}`);
    console.log(like);
    like.classList.toggle('active');
    const current = Number(like.lastElementChild.innerHTML);
    const inc = like.classList.contains("active") ? 1 : -1;
    like.lastElementChild.innerHTML = current + inc;
    sendServer(id);

}

function search(value) {
    $.ajax({  
        url: `${DOMEN}site/search?search=${value}`,  
        cache: false,  
        success: function(html){  
            $('#content').html(html); 
        }  
    })
}


function category(id) {
    $.ajax({  
        url: `${DOMEN}site/category?id=${id}`,  
        cache: false,  
        success: function(html){  
            $('#content').html(html);  
        }  
    })
    
}


function pagination(url, currentPage, value) {
    if (value !== null) {
        $.ajax({  
            url: `${DOMEN}site/${url}${value}&page=${currentPage}&per-page=2`,  
            cache: false,  
            success: function(html){ 
                $('#content').html(html);  
            }  
        })
    } else {

        $.ajax({  
            url: `${DOMEN}site/${url}page=${currentPage}&per-page=2`,  
            cache: false,  
            success: function(html){ 
                $('#content').html(html);  
            }  
        })
    }

}

function sendServer(id) {
    
    fetch(`${DOMEN}site/like?id=${id}`);
    
    return null;
}
