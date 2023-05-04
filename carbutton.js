let car1 = document.querySelector('.carimg');
let moveBy = 60;

window.addEventListener('load', () => {
    car1.style.position = 'absolute';
    car1.style.left = 0;
    car1.style.top = 0;
});

window.addEventListener('keyup', (e) => {
    switch(e.key){
        case 'ArrowLeft':
            car1.style.left = parseInt(car1.style.left) + moveBy + 'px';
            break;
        case 'ArrowRight':
            car1.style.left = parseInt(car1.style.left) - moveBy + 'px';
            break;
        case 'ArrowUp':
            car1.style.top = parseInt(car1.style.top) + moveBy + 'px';
            break;
        case 'ArrowDown':
            car1.style.top = parseInt(car1.style.top) - moveBy + 'px';
            break;
    }

});
