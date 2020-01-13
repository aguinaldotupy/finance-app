Vue.mixin({
    data() {
        return {
            auth: undefined,
            app_name: process.env.MIX_APP_NAME
        }
    },
    created(){
        this.authenticated()
    },
    methods: {
        /**
         *
         * @param email
         * @returns {boolean}
         */
        validateEmail(email) {
            var regex = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            return regex.test(String(email).toLowerCase());
        },
        isEmailValid(email, classSuccess = '', classError = 'parsley-error'){
            return (email === "") ? "" : (this.validateEmail(email)) ? classSuccess : classError;
        },
        existsNifOrEmail(value) {
            axios.get('/admin/user/verify-user-by-nif-or-email', {params: {
                    q: value
                }}).then(response => {
                return response
            }).catch(error => {
                console.log(error)
            })
        },
        previewToken(id){
            console.log(id)
            var field = document.getElementById(id);

            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        },
        openModal(modalIdentifier){
            this.modal = true;
            console.log(modalIdentifier);
            $(modalIdentifier).modal('toggle');
        },
        /**
         *
         * @param method {string}
         * @param uri {string}
         * @param form {object} | Object with information
         * @param callback {boolean} default = api
         */
        persistSubmit: function (method, uri, form, callback= false) {
            this.errors = [];

            return axios[method](uri, form).then(response => {
                if(!callback){
                    window.location = response.data.redirect;
                }
            }).catch(error => {
                if (typeof error.response.data === 'object') {
                    this.errors = formatterErrors(error.response.data.errors);
                } else {
                    this.errors = ['Something went wrong. Please try again.'];
                }

                $('html,body').animate({scrollTop: 0}, 400);
            });
        },
        vueRoute(...args){
            return route(...args);
        },
        authenticated(){
            if(localStorage.getItem('user')){
                this.auth = JSON.parse(localStorage.getItem('user'));
            } else {
                this.auth = this.callUserAuth()
            }

            return this.auth;
        },
        callUserAuth(){
            axios.get(route('api.user')).then(({data}) => {
                this.auth = data;
            }).catch(error => {
                this.auth = {
                    id: 0,
                    name: 'Convidado',
                    email: 'convidado@gmail.com'
                }
            });

            return this.auth;
        },
    }
});
