//=require ../../../../../node_modules/mustache/mustache.min.js

/*
 * Class Template
 *
 * <script id="template" type="x-tmpl-mustache">
 * 	<p>Hello {{ name }}!</p>
 * </script>
 *
 * var tmp = new Template('#template');
 * tmp.render({name: 'World!!!'}, '#target');
 */
function Template(selector) {
	var
	elem = document.querySelector(selector),
	html = '',
	rendered = '',
	targets = {};

	if (elem) {
		html = elem.innerHTML;
		Mustache.parse(html);
	}

	var render = function(args, target, mode) {
		rendered = Mustache.render(html, args);

		if (typeof target !== 'undefined') {
			var elems = null;

			if (typeof targets[target] !== 'undefined') {
				elems = targets[target];
			} else {
				elems = document.querySelectorAll(target);
			}

			for (var i = 0, l = elems.length; i < l; i++) {
				if (mode == 'append') {
					elems[i].innerHTML = elems[i].innerHTML + rendered;
				} else if (mode == 'prepend') {
					elems[i].innerHTML = rendered + elems[i].innerHTML;
				} else {
					elems[i].innerHTML = rendered;
				}
			}
			return this;
		}

		return rendered;
	};

	var append = function(args, target) {
		return render(args, target, 'append');
	};

	var prepend = function(args, target) {
		return render(args, target, 'prepend');
	};

	return {
		render: render,
		append: append,
		prepend: prepend
	};
}
