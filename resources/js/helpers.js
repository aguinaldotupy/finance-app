const selectorDatatableDefault = '#global-datatable';
const selectorInputSearchDefault = '#searchInputTable';
const delayDefault = 500;

HelperJS = {
    delayQuery: function(callback, ms){
        let timer = 0;
        return function() {
            let context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    },

    searchInputTable(selectorDatatable = selectorDatatableDefault, selectorInputSearch = selectorInputSearchDefault, delay = 500) {
        $(selectorInputSearch).keyup(HelperJS.delayQuery(function () {
            // if( this.value.length < 3 ) return;
            $(selectorDatatable).DataTable().search(this.value).draw();
        }, delay))
    },

    commonFunctionDatatable: function(selectorDatatable = selectorDatatableDefault, selectorInputSearch = selectorInputSearchDefault, delay = delayDefault){
        setTimeout(removeFilter => {
            $('.dataTables_filter').remove();
        });

        HelperJS.searchInputTable(selectorDatatable, selectorInputSearch, delay);

        //$.fn.dataTable.ext.errMode = 'throw';
        $(selectorDatatable).on('error.dt', function(e, settings, techNote, message) {
            console.error(message);
            //function javascript no SeetAlert
            alertErrorDatatable();
        });
    },

    getLang: function() {
        if (navigator.languages !== undefined){
            return navigator.languages[0];
        } else {
            return navigator.language;
        }
    },
    processAlert: function (attributes) {
        if(typeof attributes === 'object'){
            let message = attributes.message;
            let timer = attributes.timer;
            let type = attributes.type;
            let position = attributes.position;
            let typeAlert = attributes.typeAlert;
            switch (typeAlert) {
                case 'swall':
                    swallCustom(message, type, position, timer);
                    break;

                case 'toast':
                    toastMessage(message, type, position, timer);
                    break;

                default:
            }
        }
    },
    getCookie: function (name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    },
    accessCookie(cookieName){
        let name = cookieName + "=";
        let allCookieArray = document.cookie.split(';');
        for(let i = 0; i < allCookieArray.length; i++) {
            let temp = allCookieArray[i].trim();
            if (temp.indexOf(name) === 0){
                return temp.substring(name.length,temp.length);
            }
        }
        return "Não encontrado";
    }
};


window.formatterErrors = (object) => {
    let errors = [];

    if(typeof object === 'object'){
        Object.keys(object).forEach(key => {
            errors.push(object[key][0])
        });
    } else {
        return object;
    }

    return errors;
};

window.deleteEntryDatatable = (buttonVar, nameUser = false, message = 'Tem certeza que deseja apagar este item?') => {
    let button = $(buttonVar);
    let route = button.attr('data-route');
    let row = $("a[data-route='"+route+"']").closest('tr');

    const swallWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true
    });

    let htmlReturn = '';

    if(nameUser){
        console.log(nameUser);

        htmlReturn = `<b>${nameUser}!</b><br/>`;
    }

    htmlReturn = htmlReturn + message;

    swallWithBootstrapButtons.fire({
        html: htmlReturn,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Apagar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            axios.delete(route).then(response => {
                toastSuccess('Apagado com sucesso!');

                // Remove the row from the datatable
                row.remove();
            }).catch(error => {
                toastError();
                console.log(error)
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            toastInfo();
        }
    }).catch(error => {
        toastError()
    });
};
