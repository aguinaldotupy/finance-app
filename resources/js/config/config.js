let configs = require('./config.json');

window.config = function() {
    let args = arguments[0].split('.');
    let name = args[0];
    let key = args [1];
    console.log(args)
    if (configs[name] === undefined) {
        console.error('Unknown config ', name);
    } else if(configs[name][key] === undefined) {
        console.error(`Unknown config ${name}.${key}`);
    } else {
        return configs[name][key];
    }
};
