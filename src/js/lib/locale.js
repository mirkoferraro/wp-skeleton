let
active = false,
langs = {}

window.setLocale = function(lang) {
    active = lang
}

window.addTranslations = function(lang, translations) {
    if (typeof langs[lang] === 'undefined') {
        langs[lang] = {}
    }

    for (base in translations) {
        langs[lang][base] = translations[base]
    }
}

window._ = function(text, args) {
    if (!text) {
        return ''
    }

    let translation = text

    if (active && typeof langs[active] !== 'undefined' && typeof langs[active][text] !== 'undefined') {
        translation = langs[active][text]
    }

    if (typeof args !== 'undefined' && typeof root['sprintf'] === 'function') {
        translation = sprintf(translation, args)
    }

    return translation
}
