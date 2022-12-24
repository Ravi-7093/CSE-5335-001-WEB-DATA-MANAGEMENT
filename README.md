# CSE-5335-001-WEB-DATA-MANAGEMENT
This repository  contains mini projects during the Web Data Management course for the Fall Semester 2022. The technology  stacks mainly focused were AJAX, PHP , Javascript , JAVA , HTML5, CSS3 , Yelp API , SQL ,ApacheMyadmin , XML , JSON , Xpath, XSLT and Xquery  

PROJECT -1 
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
This project focus on developing  JavaScript program that implements the Breakout game. You should put your code in the JavaScript file breakout.js in project1, which is used by the file breakout.html, that implements the following actions:

initialize: initialize the game
startGame: starts the game (when you click the mouse inside the court or you push Start)
resetGame: resets the game (restores bricks, clears Tries, but doesn't clear Score)
movePaddle: moves the paddle left and right by following the mouse

The court is 805x500px and the ball is 20x20px. They are all specified in breakout.html. When you click on the Start button or left-click on the court, the ball must start from the middle of the paddle at a random angle between 3π/4 and π/4. The paddle can move left and right at the bottom by just moving the mouse (without clicking the mouse). The ball bounces on the left, top, and right borders of the court and on the bricks.
If the ball hits a brick, the brick becomes invisible (it is removed). If you remove all the bricks (there are 4*20 bricks), your score is incremented. 
If the ball crosses the bottom border but doesn't hit the paddle, the Tries counter is incremented. You would need to click on the Start button or click on the court to continue.

