function toggle(status){
    let menu = document.getElementById('menu-show');
    if(status === 0){
        menu.classList.toggle('hidden');
    }else if(status === 1){
        menu.classList.remove('hidden')
    }
}

function openMenu(){
    let menu = document.getElementById('menu-open');
    menu.classList.remove('hidden')
}