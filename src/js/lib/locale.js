let
active = false,
langs = {}

function setLocale(lang) {
    active = lang
}

function addTranslations(lang, translations) {
    if (typeof langs[lang] === 'undefined') {
        langs[lang] = {}
    }

    for (base in translations) {
        langs[lang][base] = translations[base]
    }
}

function translate(text, args) {
    if (!text) {
        return ''
    }

    let translation = text

    if (active && typeof langs[active] !== 'undefined' && typeof langs[active][text] !== 'undefined') {
        translation = langs[active][text]
    }

    if (typeof args !== 'undefined' && typeof window['sprintf'] === 'function') {
        translation = sprintf(translation, args)
    }

    return translation
}

window._ = translate

module.exports = {
	setLocale:       setLocale,
	addTranslations: addTranslations,
	translate:       translate,
}