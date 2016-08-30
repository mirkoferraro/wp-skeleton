//=require ../conditionizr/conditionizr.js
//=require ../conditionizr/ie11.js
//=require ../conditionizr/ie10.js
//=require ../conditionizr/chrome.js

conditionizr.config({
	tests: {
		'ie11': ['class'],
		'ie10': ['class'],
		'chrome': ['class']
	}
});