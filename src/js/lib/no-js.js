var
doc = document.documentElement,
classes = doc.className.split(' ')
classes.splice(classes.indexOf('no-js'), 1)
doc.className = classes.join(' ')