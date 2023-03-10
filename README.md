# CSE-5335-001-Web-Data-Management
This repository  contains mini projects during the Web Data Management course for the Fall Semester 2022. The technology  stacks mainly focused were AJAX, PHP , Javascript , JAVA , HTML5, CSS3 , Yelp API , SQL ,ApacheMyadmin , XML , JSON , Xpath, XSLT and Xquery  

#Project-1 
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
This project focus on developing  JavaScript program that implements the Breakout game. You should put your code in the JavaScript file breakout.js in project1, which is used by the file breakout.html, that implements the following actions:

initialize: initialize the game
startGame: starts the game (when you click the mouse inside the court or you push Start)
resetGame: resets the game (restores bricks, clears Tries, but doesn't clear Score)
movePaddle: moves the paddle left and right by following the mouse


#Project -2
-----------------------------------------------------------------------------------------------------------------------------------------------------------

The goal of this project is to use the Yelp API for Developers to print the best restaurants in a city based on some search criteria. This project must use JavaScript and AJAX. 

When you write a city name, say "Dallas, Texas", and some search terms in the search text area, say "Indian buffet", and you push the "Find" button, it will clear the display and will find and print in the display the 10 best restaurants in that city that match the search terms. They may be less than 10 (including zero) sometimes. The display area will display various information about these restaurants. It will be an ordered list from 1 to 10 that correspond to the best 10 matches. Each list item in the display area will include the following information about the restaurant: the image "image_url" displayed on the browser with an img tag, the "name" as a clickable "url" to the Yelp page of this restaurant, the categories, the price, the rating (a number between 1-5), the postal address and phone in human readable form. When you search for new terms, it will clear the display area, and will write new information based on the new search.

#Project -3
-----------------------------------------------------------------------------------------------------------------------------------------------------------
This project extends Project 2 by displaying restaurants on a map. It combines two web services: the Yelp API (from Project 2) and Google Maps. After you center your Google Map to a geographical area and enter some terms, such as "Indian Restaurant", your application will find the best matches inside you map area, it will mark their location on the map, and will display some information about these restaurants on the map.

When you move the map to a different place or you zoom in/out, then the displayed area in the map is changed, which means that the next search will use the new map area. After you find the best restaurants inside the map that match the search keys, you do the following for each restaurant:

You put a map overlay marker on the restaurant location on the map (it's OK if the marker falls a little bit outside the displayed map). Each marker will have a label 1 to 10, which indicates the order of this restaurant within the best 10 matches.
The marker must have an event listener for "click" so that when you click on the marker it pops out an info window attached to the marker that displays the restaurant image, name, and rating (a number between 1-5). When you click again on the marker, the info window is removed. When you click on a different marker, this info window is removed and the info window of the other marker pops out (so there is always at most one info window displayed on the map).


#Project -4
----------------------------------------------------------------------------------------------------------------------------------------------------------

This project is based on Project 2. You will develop a web application in PHP that finds the best restaurants in a city, allows you to pick some of them as your favorites, and stores them in your current session. Your project is to write only one PHP program yelp.php. You don't need to use JavaScript. You don't need any proxy. This PHP script must generate HTML with 3 areas:

search-form: an HTML form to search Yelp (like in Project 2) that has two text areas to put the city name and the search terms, a button "Find", and a button "Reset".
search-results: displays the results of the current search where the restaurant image is clickable to allow you to pick this restaurant as one of your favorites (that is, unlike Project 2, the image is not a clickable "url" to a Yelp page).
favorites: displays the list of your current favorite restaurants.
The search-form is on top, and the search-results and the favorites lists at the bottom, displayed in two columns next to each other (you may use an HTML table to structure your page). The city name displayed in the search-form is always the last city you used in your search. The "Reset" button clears the search results and the favorite list (can be implemented as a button widget inside an anchor tag). When you click on a restaurant image, this restaurant is stored in your favorite list but the search results are not cleared (the PHP script always displays the last search results).

You will use 3 PHP session values:

$_SESSION["city"]: stores the last city used in search (a string)
$_SESSION["search"]: the last search results (an array)
$_SESSION["favorites"]: the favorite restaurants (an array)
Your PHP script must respond to the following http calls:

yelp.php?city=Arlington+Texas&keywords=Indian+buffet: It calls the Yelp web service to find the best 10 restaurants in this city that match the keywords (like in Project 2). It converts the JSON response to a PHP object using json-decode Links to an external site.and appends the returned business objects (restaurants) in the array $_SESSION["search"] as new associations from a business id to a PHP object.
yelp.php?store=zIRGIbTPLxjawtBnFULSfw: It copies the restaurant with this business id from the $_SESSION["search"] array to the $_SESSION["favorites"] array.
yelp.php?reset: It clears all the session values.

#Project -5
----------------------------------------------------------------------------------------------------------------------------------------------------------
The goal of this project is to develop a web application using PHP and MySQL. This application will use a database to store and query your all-time favorite restaurants.


You need to re-implement Project 4 using a relational database to store your favorite restaurants. So, like in Project 4, you will store the last city and the search results in the current session, but unlike Project 4, you need to store your favorite restaurants in the database table favorites.

#Project -6
----------------------------------------------------------------------------------------------------------------------------------------------------------

The goal of this project is to develop a photo-album application that uses cloud storage. More specifically, you will use the Dropbox API to create a photo album, in which you can upload, delete, and browse photographs.

You will develop a photo-album application on Dropbox.  To support the following operations:

Provide a form to upload a new image (a local *.jpg file from your PC) on your Dropbox images folder. 
A display window that lists the names of the images in your Dropbox directory. 
An image section that displays the current image. 

#Project -7
----------------------------------------------------------------------------------------------------------------------------------------------------------
You will evaluate DOM, XPath, and XSLT over XML data that represents courses from Reed College, available at reed.xml Links to an external site.with DTD reed.dtd Links to an external site.. More specifically:

Write a plain Java program dom.java that uses the Java DOM API over the XML data in reed.xml to print the titles of all MATH courses that are taught in room LIB 204

Write a plain Java program xpath.java that evaluates the following XPath queries over the XML data in reed.xml:
Print the titles of all MATH courses that are taught in room LIB 204
Print the instructor name who teaches MATH 412
Print the titles of all courses taught by Wieting

Write an XSLT program math.xsl to display all MATH courses in Reed College by transforming the XML file reed.xml to XHTML using XSLT. Your XHTML must contain a table, where each table row is a Math course. Modify the Java program xslt.java Download xslt.javato test your XSLT and then load the resulting html output file on your web browser.


#Project -8
----------------------------------------------------------------------------------------------------------------------------------------------------------

Consider the XML document available at reed.xml Links to an external site.with DTD reed.dtd Links to an external site.used in Project #7. Express the following queries using XQuery and run them against the file reed.xml using Saxon:

For each MATH course taught in room LIB 204, return an element tagged course with the title, the instructor, the start, and the end times of the course.

For each different course, return an element tagged course with the course title and all the instructor names that teach this course.

For each different department, display the department code and the number of courses taught by the department.

For each different instructor, return an element tagged instructor that contains the name of the instructor and the number of courses taught by the instructor.

For each different instructor, return an element tagged instructor that contains the name of the instructor and the titles of all courses taught by the instructor.
