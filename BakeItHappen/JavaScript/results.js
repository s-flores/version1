//GLOBAL VARIABLES
var recipeResults;
var recipeId;
var fullRecipeUrl;
var searchValues ;
var randomOffset;

var NUMBER_OF_RESULTS = 10;

var searchForm = document.getElementById("searchForm");

var APIKEY = "a8f4860704d44fa28ba5806a45f72a14";

//URL TO CONNECT TO API
var url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=" + APIKEY;


$(document).ready(function() {
    //get search value from session storage
    searchValues = String(sessionStorage.getItem("searchValues")); 
    recipeResults = document.getElementById("recipe-results");
    recipeSearchValues = document.getElementById("searchResultTitle");
    randomOffset = String(sessionStorage.getItem("randomOffset"));

    //Append search value to url
    url += "&query=";
    url += searchValues;
    // url += "&includeIngredients=" + searchValues;
    url += "&number=" + NUMBER_OF_RESULTS;
    url += "&offset=" + randomOffset;
    url += "&instructionsRequired=true";


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
  recipeSearchValues.innerHTML="";
  recipeSearchValues.innerHTML=searchValues;
  for (i = 0; i < recipeList.results.length; i++) {
      resultUrl = String(recipeList["results"][i].image);
      recipeTitle = String(recipeList["results"][i].title);
      recipeId =  String(recipeList["results"][i].id);
      

      //OUTPUT RECIPES
      //put recipe id in session storage
      // recipeResults.innerHTML += "<a href='fullrecipe.html' onclick='addToSessionVariable("+ recipeId + ");' >" + recipeTitle + "</a>";
      // recipeResults.innerHTML += "<br>";

      recipeResults.innerHTML += `<a href='fullrecipe.html' onclick='addToSessionVariable(`+ recipeId + `);' class='orange-border rounded mt-1 row p-3 recipe-item' >
                                      <div class='col-md-4'>
                                            <div class='image'> 
                                                    <img src=`+ resultUrl + ` class='rounded' width='200px' height='200px'> 
                                              </div>
                                        </div>
              
                                        <div class='col-md-8'>
                                            <div class='description'> 
                                                      <div class='recipe-name m-1 mt-md-5'> `+ recipeTitle +` </div>
                                            </div> 
                                        </div> 
                                  </a>`;
                                           
    }
}


//adds recipe id we click on to the session variable to take us to next page
function addToSessionVariable(recipeId){
    sessionStorage.setItem("recipeId", recipeId);
}