var APIKEY = "a8f4860704d44fa28ba5806a45f72a14";
var recipeInstructions = document.getElementById('instructions');
var recipeIngredients = document.getElementById('ingredients');
var recipeTitle = document.getElementById('recipeTitle');
var fullRecipeUrl;
var ingredientsUrl;
var recipeIdFromStorage;

// WHEN THE PAGE IS LOADED DO THIS
$(document).ready(function() {
    getFullRecipe();
});

//Function that gets the full recipe on the new page
function getFullRecipe(){

    //get recipe id from session storage
    recipeIdFromStorage = String(sessionStorage.getItem("recipeId")); 
    fullRecipeUrl = "https://api.spoonacular.com/recipes/"+ recipeIdFromStorage +"/analyzedInstructions?apiKey=" + APIKEY;

    // TODO: USE THIS LINK INSTEAD BECAUSE IT WILL GIVE RECIPE INFORMATION AS WELL
    // https://api.spoonacular.com/recipes/716429/information?includeNutrition=false

    ingredientsUrl =  "https://api.spoonacular.com/recipes/"+ recipeIdFromStorage +"/ingredientWidget.json?apiKey=" + APIKEY;

    //CALL THE FUNCTION TO Connect to api to get INGREDIENTS
    getIngredientsAsync()
    .then(function(data){ 
        var ingredients = data;
        showIngredients(ingredients);
    }); 


    //CALL THE FUNCTION TO CONNECT TO API To GET INSTRUCTIONS
    getFullRecipeAsync()
    .then(function(data){ 
        var fullRecipe = data;
        showFullRecipe(fullRecipe);
    }); 
    
}

//CONNECTS TO THE API to get ingredients
async function getIngredientsAsync() 
{
  let response = await fetch(ingredientsUrl);
  let data = await response.json();
  return data;
}

// OUTPUTS INGREDIENTS
function showIngredients(ingredients){
   
    for(i = 0; i< ingredients["ingredients"].length; i++){
        var ingredientName= String(ingredients["ingredients"][i].name);
        var ingredientAmountValue= String(ingredients["ingredients"][i]["amount"]["us"].value);
        var ingredientAmountUnit= String(ingredients["ingredients"][i]["amount"]["us"].unit);
        recipeIngredients.innerHTML += ingredientName;
        recipeIngredients.innerHTML += " - ";
        recipeIngredients.innerHTML += ingredientAmountValue;
        recipeIngredients.innerHTML += " ";
        recipeIngredients.innerHTML += ingredientAmountUnit;
        recipeIngredients.innerHTML += "</br>";
    }
}

//FUNCTION THAT CONNECTS TO THE API to get instructions
async function getFullRecipeAsync() 
{
  let response = await fetch(fullRecipeUrl);
  let data = await response.json();
  return data;
}

// OUTPUTS THE FULL RECIPE INSTRUCTIONS
function showFullRecipe(fullRecipe){

    for(i = 0; i < fullRecipe.length; i++){
        var name = String(fullRecipe[i].name);
    
        recipeInstructions.innerHTML += name;
        recipeInstructions.innerHTML += "</br>";
        for(j = 0; j < fullRecipe[i]["steps"].length; j++){
            var stepNumber = String(fullRecipe[i]["steps"][j].number);
            var stepInstruction = String(fullRecipe[i]["steps"][j].step);
            recipeInstructions.innerHTML += stepNumber;
            recipeInstructions.innerHTML += "</br>";
            recipeInstructions.innerHTML += stepInstruction;
            recipeInstructions.innerHTML += "</br>";
        }
    } 
}


