const FunctionWrapper = require('../lib/function-wrapper')

var
wrapper = new FunctionWrapper(),
lastData = {
    width:  -1,
    height: -1,
    left:   -1,
    top:    -1,
},
scroll = window.requestAnimationFrame ||
             window.webkitRequestAnimationFrame ||
             window.mozRequestAnimationFrame ||
             window.msRequestAnimationFrame ||
             window.oRequestAnimationFrame ||
             function(callback){ window.setTimeout(callback, 1000/60) };

function loop() {
    
	var
	doc    = document.documentElement,
	body   = document.getElementsByTagName('body')[0],
	width  = window.innerWidth || doc.clientWidth || body.clientWidth,
	height = window.innerHeight|| doc.clientHeight|| body.clientHeight,
	left   = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0),
	top    = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0)

    if (lastData.width == width &&
        lastData.height == height &&
        lastData.left == left &&
        lastData.top == top) {
        scroll(loop);
        return false;
    }

    lastData.width = width
    lastData.height = height
    lastData.left = left
    lastData.top = top

    wrapper.setArgs([width, height, left, top])
    wrapper.run()

    scroll( loop )
}

loop();

module.exports = wrapper