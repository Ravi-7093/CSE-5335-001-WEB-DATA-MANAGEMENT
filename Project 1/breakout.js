var dx = 1, dy = -1;       /* displacement at every dt */
var x, y;         /* ball location */
var score = 0;    /* # of walls you have cleaned */
var tries = 0;    /* # of tries to clean the wall */
var started = false;  /* false means ready to kick the ball */
var ball, court, paddle, brick, msg;
var court_height, court_width, paddle_left;

var bricks = new Array(4);  // rows of bricks
var colors = ["red", "blue", "yellow", "green"];
var speed;

//alert(speed);


var bricksHit = 0;

var intervalId = null;

/* get an element by id */
function id(s) { return document.getElementById(s); }

/* convert a string with px to an integer, eg "30px" -> 30 */
function pixels(pix) {
    pix = pix.replace("px", "");
    num = Number(pix);
    return num;
}

/* place the ball on top of the paddle */
function readyToKick() {
    x = pixels(paddle.style.left) + paddle.width / 2.0 - ball.width / 2.0;
    y = pixels(paddle.style.top) - 2 * ball.height;
    ball.style.left = x + "px";
    ball.style.top = y + "px";
}

/* paddle follows the mouse movement left-right */
function movePaddle(e) {
    if (!court) return
    var ox = e.pageX - court.getBoundingClientRect().left;
    paddle.style.left = (ox < 0) ? court_width / 2 + paddle.width / 2
        : ((ox > court_width - paddle.width)
            ? court_width - paddle.width + "px"
            : ox + "px");
    if (!started)
        readyToKick();
}
function getoption() {
    var val = document.getElementById('level');
    var sd = val.options[val.selectedIndex].value;
    return sd
}
function initialize() {
    court = id("court");
    ball = id("ball");
    paddle = id("paddle");
    wall = id("wall");
    msg = id("messages");
    brick = id("red");
    court_height = pixels(court.style.height);
    court_width = pixels(court.style.width);
   // var msg="Game Started!!!"
    //id('messages').innerHTML = `${msg}`
    //console.log(speed)
   
    for (i = 0; i < 4; i++) {
        // each row has 20 bricks
        bricks[i] = new Array(20);
        var b = id(colors[i]);
        for (j = 0; j < 20; j++) {
            var x = b.cloneNode(true);
            x.setAttribute('id', `${i}-${j}`);
            bricks[i][j] = x;
            wall.appendChild(x);
        }
        b.style.visibility = "hidden";
    }
    started = false;
}

/* true if the ball at (x,y) hits the brick[i][j] */
function hits_a_brick(x, y, i, j) {
    var top = i * brick.height - 450;
    var left = j * brick.width;
    return (x >= left && x <= left + brick.width
        && y >= top && y <= top + brick.height);
}

function hitsPaddle() {
    const left =  +paddle.style.left.split('px')[0]
    const right = left + paddle.width
    return x < right && x > left && y + ball.height + paddle.height === 0//get ball within the paddl'e width
}

function moveBall() {
    speed=getoption()
    console.log(speed)
    x = (x + speed * dx)
    y = (y + speed * dy)

    if(hitsPaddle()){
 
        dy *= -1
    }else{
        if (x > (court_width - ball.width) || x < 0) {
            dx *= -1
        }
    
        if (y >0|| y < (-court_height + ball.height) ) {
            dy *= -1
        }
    
        if(y >0){
    
            tries +=  1;
            id('tries').innerHTML = `${tries}`
            clearInterval(intervalId)
            started = false;
            readyToKick();
        }
    }


    ball.style.left = x + "px";
    ball.style.top = y + "px";
}

function updateHitBricks() {
    for (i = 0; i < 4; i++) {
        for (j = 0; j < 20; j++) {
            const ele = id(`${i}-${j}`)
            if (hits_a_brick(x, y, i, j) && ele.style.visibility !== 'hidden') {
                bricksHit += 1;
                ele.style.visibility = 'hidden'
                if (bricksHit === 80) {
                    console.log('Bricks are over !!!')
                    var msg="Game Ended!!!"
                    score = score + 1
                    id('score').innerHTML = `${score}`
                    clearInterval(intervalId)
                    id('messages').innerHTML = `${msg}`

                    
                }
            }
        }
    }

}

function update() {
    var msg="Game Started!!!"
    id('messages').innerHTML = `${msg}`
    updateHitBricks();
    moveBall();
}

function startGame() {
    initialize();
    started = true
    intervalId = setInterval(update, 10)
}

function resetGame() {
    window.location.reload();
   
}
