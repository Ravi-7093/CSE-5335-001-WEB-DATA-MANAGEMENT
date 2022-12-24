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


PROJECT -2
-----------------------------------------------------------------------------------------------------------------------------------------------------------

The goal of this project is to use the Yelp API for Developers to print the best restaurants in a city based on some search criteria. This project must use JavaScript and AJAX. 

You need to edit the HTML file yelp.html and the JavaScript file yelp.js. Your HTML web page must have 2 sections:

text areas to put the city name and the search terms, and a button "Find"
a display area
When you write a city name, say "Dallas, Texas", and some search terms in the search text area, say "Indian buffet", and you push the "Find" button, it will clear the display and will find and print in the display the 10 best restaurants in that city that match the search terms. They may be less than 10 (including zero) sometimes. The display area will display various information about these restaurants. It will be an ordered list from 1 to 10 that correspond to the best 10 matches. Each list item in the display area will include the following information about the restaurant: the image "image_url" displayed on the browser with an img tag, the "name" as a clickable "url" to the Yelp page of this restaurant, the categories, the price, the rating (a number between 1-5), the postal address and phone in human readable form. When you search for new terms, it will clear the display area, and will write new information based on the new search.

Note that everything should be done asynchronously and your web page should never be redrawn completely. You should not use any JavaScript library, such as JQuery.



