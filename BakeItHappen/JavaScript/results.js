//GLOBAL VARIABLES
var recipeResults;
var recipeId;
var fullRecipeUrl;

var NUMBER_OF_RESULTS = 10;

var searchForm = document.getElementById("searchForm");

var APIKEY = "a8f4860704d44fa28ba5806a45f72a14";

//URL TO CONNECT TO API
var url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=" + APIKEY;


$(document).ready(function() {
    //get search value from session storage
    var searchValues = String(sessionStorage.getItem("searchValues")); 
    recipeResults = document.getElementById("recipe-results");

    //Append search value to url
    url += "&query=";
    url += searchValues;
    // url += "&includeIngredients=" + searchValues;
    url += "&number=" + NUMBER_OF_RESULTS;

    //CALL THE FUNCTION TO CONNECT TO API and return the recipe list
    getRecipesAsync()
    .then(function(data){ 
        var recipeList = data;
        showRecipes(recipeList);
    }); 

});

//FUNCTION THAT CONNECTS TO THE API
async function getRecipesAsync() 
{
  let response = await fetch(url);
  let data = await response.json();
  return data;
}

//FUNCTION THAT HAPPENS AFTER WE CONNECT TO THE API
function showRecipes(recipeList){
  recipeResults.innerHTML = "";
  
  for (i = 0; i < recipeList.results.length; i++) {
      resultUrl = recipeList["results"][i].url;
      recipeTitle = recipeList["results"][i].title;
      recipeId =  recipeList["results"][i].id;

      //put recipe id in session storage
      recipeResults.innerHTML += "<a href='fullrecipe.html' onclick='addToSessionVariable("+ recipeId + ");' >" + recipeTitle + "</a>";
      recipeResults.innerHTML += "<br>";
    }
}


//adds recipe id we click on to the session variable to take us to next page
function addToSessionVariable(recipeId){
    sessionStorage.setItem("recipeId", recipeId);
}