// Define public jQuery
window.$ = window.jQuery = require('jquery')

// Extends Javascript properties
require('./lib/extend.js')

// Debouncer for viewport resize event
var ResizeDebouncer = require('./events/resize-debouncer')
ResizeDebouncer.put('test', function(width, height, is_landscape) {
    console.log('screen sizes', width, height)
})

// Throttler for scroll event
var ScrollThrottler = require('./events/scroll-throttler')
ScrollThrottler.put('test', function(top, left, height, width) {
    console.log('scroll top is at ', top)
})

// Function wrapper on animation frame event
var AnimationFrame = require('./events/animation-frame')
AnimationFrame.put('test', function(top, left, height, width) {
    console.log('animation frame top is at ', top)

    // var animationElements = document.getElementsByClassName('anim')
    // for (var i = 0, l = animationElements.length; i < l; i++) {
    //     var visibleArea = getVisibleArea(animationElements[i])

    //     if (visibleArea == 0) {
    //         console.log('element is not visible')
    //     } else if (visibleArea < 1) {
    //         console.log('element is quite visible')
    //     } else {
    //         console.log('element is totally visible')
    //     }
    // }
})

// GMaps functions manager
var gmaps = require('./main/gmaps')
gmaps.onMapLoaded(function(){
    console.log('gmaps is initialized!!!')
})

// Locale manager
var locale = require('./lib/locale')
locale.setLocale('en')
locale.addTranslations('it', { "hello world": "ciao mondo" })   

// Require all *.js files in views folder
require('./lib/requireAll.js')(require.context('../views/', true, /\.js$/))
