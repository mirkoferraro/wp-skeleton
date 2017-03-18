window.$ = window.jQuery = require('jquery')

require('./lib/extend.js')

require('./main/conditionizr.js')
require('./vue/vue.js')

var ResizeWrapper = require('./events/resize-wrapper')
ResizeWrapper.put('test', function(width, height, is_landscape) {
    console.log('screen sizes', width, height)
})

var ScrollWrapper = require('./events/scroll-wrapper')
ScrollWrapper.put('test', function(top, left, height, width) {
    console.log('scroll top is at ', top)
})

var gmaps = require('./main/gmaps')
gmaps.onMapLoaded(function(){
    console.log('gmaps is initialized!!!')
})

var locale = require('./lib/locale')
locale.setLocale('en')
locale.addTranslations('it', { "hello world": "ciao mondo" })

require('./lib/requireAll.js')(require.context('../views/', true, /\.js$/))
