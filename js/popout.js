// Inject the background.js script into the current tab after the popout has loaded
window.addEventListener('load', function (evt) {
	chrome.extension.getBackgroundPage().chrome.tabs.executeScript(null, {
		file: 'background.js'
	});
});

//Listen to messages from the background.js script
chrome.runtime.onMessage.addListener(function (message) {
	//Save message to the filePath
	// document.getElementById('pagetitle').innerHTML = message;
});

$(#btn-save).addEventListener('click', function () {
	//Write message to file
});