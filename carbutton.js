let car1 = document.querySelector('.carimg');
const canvas = document.querySelector('.container');
let moveBy = 60;
var answers = document.getElementById('.answer');


//making car moving
/*window.addEventListener('load', () => {
    car1.style.position = 'absolute';
    car1.style.left = 0;
    car1.style.top = 0;
});

window.addEventListener('keyup', (e) => {

    
    const canvasRect = canvas.getBoundingClientRect();
    const canvasWidth = canvasRect.width;
    const canvasHeight = canvasRect.height;

    const car1Rect = car1.getBoundingClientRect();
    const car1Width = car1Rect.width;
    const car1Height = car1Rect.height;

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
        default:
            return;
    }

// Check if the new position exceeds the canvas boundaries
car1.style.left = Math.max(0, Math.min(parseInt(car1.style.left), canvasWidth - car1Width)) + 'px';
car1.style.top = Math.max(0, Math.min(parseInt(car1.style.top), canvasHeight - car1Height)) + 'px';

});*/

function allowDrop(ev)
{
    ev.preventDefault();
}

function drag(ev)
{
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev)
{
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var el = ev.target;
    if(!el.classList.contains('dropzone'))
    {
        //choose answer
        el = ev.target.parentNode;
        ev.target.appendChild(document.getElementById(data));
        document.getElementById("selectedAnswer").value = data;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    car1.addEventListener("dragstart", drag);
});
