Object.defineProperty(String.prototype, 'replaceAll',{
    value: function(search, replacement) {
	    return this.replace(new RegExp(search, 'g'), replacement);
    }
});

Object.defineProperty(Object.prototype, 'sequenceAttributes',{
    value: function() {
        var
        val = this,
        args = Array.prototype.slice.call(arguments);
        
        for (var i in args) {
            if (typeof val[args[i]] === 'undefined') {
                return undefined;
            }

            val = val[args[i]];
        }

        return val;
    }
});

Object.defineProperty(Object.prototype, 'isNode',{
    value: function() {
		if (typeof Node === 'object') {
			return this instanceof Node
		}

		return this &&
				typeof this === "object" &&
				typeof this.nodeType === 'number' &&
				typeof this.nodeName === 'string'
    }
});

Object.defineProperty(Object.prototype, 'isElement',{
    value: function() {
		if (typeof HTMLElement === 'object') {
			return this instanceof HTMLElement
		}
		
		return this &&
				typeof this === 'object' &&
				this !== null &&
				this.nodeType === 1 &&
				typeof this.nodeName === 'string'
    }
});


Object.defineProperty(Object.prototype, 'getVisibleArea',{
    value: function() {
		if (!this.isElement()) {
			return false;
		}

		var
		rect = this.getBoundingClientRect(),
		html = document.documentElement

		var
		area = (rect.bottom - rect.top) * (rect.right - rect.left),
		width = Math.max(0, Math.min(rect.right, (window.innerWidth || html.clientWidth)) - Math.max(rect.left, 0) ),
		height = Math.max(0, Math.min(rect.bottom, (window.innerHeight || html.clientHeight)) - Math.max(rect.top, 0) )

		return width * height / area
    }
});

Object.defineProperty(Object.prototype, 'isInViewport',{
    value: function(full) {
		if (!this.isElement()) {
			return false;
		}

		var visibleArea = this.getVisibleArea()
		return full ? 1 == visibleArea : visibleArea > 0
    }
});