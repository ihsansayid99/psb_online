document.getElementById('btnToggle').addEventListener('click', btnToggle)

function btnToggle(e){
    e.stopPropagation();
    const asideBar = document.getElementById('NavbarText');
    asideBar.classList.toggle('sidebar-open')
}

document.addEventListener('click', function(evt){
    const sidebar = document.getElementById('NavbarText')
    let targetElement = evt.target

    do{
        if(targetElement == sidebar){
            return;
        }
        targetElement = targetElement.parentNode
    } while (targetElement)

    sidebar.classList.remove('sidebar-open')
})

const elems = document.getElementsByClassName('confirm')
const confirmIt = function(e){
    if(!confirm('Apakah yakin akan dihapus?')) 
    e.preventDefault()
}
for (let i = 0, l = elems.length; i < l; i++) {
    elems[i].addEventListener('click', confirmIt, false);
}