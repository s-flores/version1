var searchForm = document.getElementById("searchForm");
var searchButton = document.getElementById("search-button");
var randomButton = document.getElementById("random-button");

//setup buttons with functions
searchButton.onclick = startRegularSearch;
randomButton.onclick = startRandomSearch;

//FUNCTION THAT HAPPENS WHEN WE DO A REGULAR SEARCH
function startRegularSearch(event) {
    //prevent the default submit action 
    event.preventDefault();

    searchValues = document.getElementById("search").value;

    //Save search value into a session variable
    sessionStorage.setItem("searchValues", searchValues);
    window.location.href = "resultpage.html";

} 

//FUNCTION THAT HAPPENS WHEN WE DO A RANDOM SEARCH
function startRandomSearch(event) {
    //prevent the default submit action 
    event.preventDefault();


    randomId = getRndInteger(0, 999999) 

    //Take us to a full Recipe page that is random
    sessionStorage.setItem("recipeId", randomId);
    window.location.href = "fullrecipe.html";

} 

//Random Number Generator 
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
  }