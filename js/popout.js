//Popout.html interactivity

var filepath = null;

function save(recipeData) {

	//Add button eventListener to save recipeData
	document.getElementById("yesButton").addEventListener("click", function() {
		//
	});
}

//Add button eventListener to input filepath
function initFP() {
	document.getElementById("label").addEventListener("onchange", function() {
		//Update the filepath when the input changes
		var fname = document.getElementById("label").value()
		console.log(fname)
		self.filepath = fname
	})
}

function saveFile() {
	
}

function init() {
	var recipeData = chrome.extension.getBackgroundPage().selectedRecipe;
  	if (recipeData) {save(recipeData)}
  	initFP()

}

window.onload = init;

