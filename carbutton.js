function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(response, idQuestion) {
    window.location.href = '/fullstack/quiz.php?response=' + response + '&idQuestion=' + idQuestion;
}
