//Popout.html interactivity

var filepath = null;

function save(recipeData) {

	//Add button eventListener to save recipeData
	document.getElementById("submit").addEventListener("click", function() {
		//
	});
}

//Add button eventListener to input filepath
function initFP() {
	document.getElementById("filepath").addEventListener("onchange", function() {
		//Update the filepath when the input changes
		var fname = document.getElementById("filepath").value()
		console.log(fname)
		self.filepath = fname
	})
}


function init() {
	var recipeData = chrome.extension.getBackgroundPage().selectedRecipe;
  	if (recipeData) {save(recipeData)}
  	initFP()

}

window.onload = init;