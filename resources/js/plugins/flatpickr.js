const flatpickr = require("flatpickr");


// https://github.com/flatpickr/flatpickr/issues/1342#issuecomment-389154824
const Czech = require('flatpickr/dist/l10n/cs').default.cs;
const Danish = require('flatpickr/dist/l10n/da').default.da;
const German = require('flatpickr/dist/l10n/de').default.de;
const Spanish = require('flatpickr/dist/l10n/es').default.es;
const Finnish = require('flatpickr/dist/l10n/fi').default.fi;
const French = require('flatpickr/dist/l10n/fr').default.fr;
const Hungarian = require('flatpickr/dist/l10n/hu').default.hu;
const Dutch = require('flatpickr/dist/l10n/nl').default.nl;
const Polish = require('flatpickr/dist/l10n/pl').default.pl;
const Swedish = require('flatpickr/dist/l10n/sv').default.sv;
const Slovak = require('flatpickr/dist/l10n/sk').default.sk;
const Portuguese = require("flatpickr/dist/l10n/pt.js").default.pt;

const langMap = {
    cs: Czech,
    da: Danish,
    de: German,
    es: Spanish,
    fi: Finnish,
    fr: French,
    hu: Hungarian,
    nl: Dutch,
    pl: Polish,
    sv: Swedish,
    sk: Slovak,
    en: '',
    pt: Portuguese
};

/* global locale */
var locale = getLang();

function getLang() {
	if (navigator.languages !== undefined){
		return navigator.languages[0];
	} else {
		return navigator.language;
	}
}

if (locale !== 'en' && langMap[locale] !== undefined){
	flatpickr.localize(langMap[locale]);
}

// require("flatpickr/dist/themes/material_blue.css");
