window.$ = window.jQuery = require('jquery')

require('./lib/extend.js')
require('./main/conditionizr.js')
require('./main/event-wrapper.js')
require('./main/gmaps.js')
require('./vue/vue.js')

require('./lib/requireAll.js')(require.context('../views/', true, /\.js$/))