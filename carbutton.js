var score = 0;

function allowDrop(ev)
{
    ev.preventDefault();
}

function drag(ev)
{
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(userValue)
{
    const rep = document.getElementById('rep').value;
    if (userValue === rep){
        score++;
        document.getElementById('score').innerHTML = score;
        
    }else
    {
        window.alert('Wrong Answer');
        //Reload the page to move to the next question
        window.location.reload();
       
        
    }
}

/*function updateScore(score)
{
    //Send an AJAX request to a PHP script to update the score on the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'quiz.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechanged = function()
    {
        if(xhr.readyState === 4 && xhr.status === 200)
        {
            console.log("Score updated!");
        }
    };
    xhr.send('score=' + score);
}*/


