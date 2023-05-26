let car1 = document.querySelector('.carimg');
let moveBy = 60;
var answerA = document.getElementById("answer-a");
var answerB = document.getElementById("answer-b");
var answerC = document.getElementById("answer-c");

//making car moving
window.addEventListener('load', () => {
    car1.style.position = 'absolute';
    car1.style.left = 0;
    car1.style.top = 0;
});

window.addEventListener('keyup', (e) => {

    const canvas = document.querySelector('.container');
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
            return; //Ignorer les autres touches
    }
 // Check if the new position exceeds the canvas boundaries
 car1.style.left = Math.max(0, Math.min(car1.style.left, canvasWidth - car1Width));
 car1.style.top = Math.max(0, Math.min(car1.style.top, canvasHeight - car1Height));

 car1.style.transform = `transate(${carX}px, ${carY}px)`;

 checkCollisions();
    
});

// Fonction pour vérifier les collisions entre la voiture et les objets de réponse
function checkCollisions() {
    const carRect = car1.getBoundingClientRect();
    const answerARect = answerA.getBoundingClientRect();
    const answerBRect = answerB.getBoundingClientRect();
    const answerCRect = answerC.getBoundingClientRect();
  
    if (isColliding(carRect, answerARect)) {
      // La voiture touche l'objet A
      handleCollision(answerA);
    } else if (isColliding(carRect, answerBRect)) {
      // La voiture touche l'objet B
      handleCollision(answerB);
    } else if (isColliding(carRect, answerCRect)) {
      // La voiture touche l'objet C
      handleCollision(answerC);
    }
  }
  
  // Fonction pour vérifier si deux éléments se chevauchent
  function isColliding(car1, answerA) {
    return (
        car1.left < answerA.right &&
        car1.right > answerA.left &&
        car1.top < answerA.bottom &&
        car1.bottom > answerA.top
    );
  }
  
  // Fonction pour gérer les collisions avec les objets de réponse
  function handleCollision(answerA) {
    // Faites ce que vous voulez lorsque la voiture touche l'objet spécifié
    const objectText = answerA.textContent;
    const message = `La voiture a touché l'objet ${objectText}`;
    communicationText.value = message;
  }