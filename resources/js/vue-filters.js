Vue.filter('firstAndLastName', function(fullName) {
    var names = fullName.split(' ');
    var firstName = '';
    var lastName = '';
    if (!names || names.length <= 1) {
        firstName = names;
        lastName = '';
    } else {
        firstName = names[0];
        lastName = names.pop();
    }

    return firstName + ' ' +lastName;
});

Vue.filter('capitalize_words', function (str) {
    if (!str) return '';
    return str.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
});

Vue.filter('formatDate', function(value) {
    if (value) {
        return momentJS(String(value)).format('DD/MM/YYYY h:mm:ss')
    }
});

Vue.filter('formatHour', function(value) {
    if (value) {
        return momentJS(String(value)).format('h:mm:ss')
    }
});

Vue.filter('toCurrency', function (value) {
    let val = (value / 1).toFixed(2).replace('.', ',');
    return `R$ ${val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
});
