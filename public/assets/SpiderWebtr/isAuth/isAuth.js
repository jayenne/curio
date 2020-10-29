$(document).ready(function(){

    function defineIsAuth(user, newOptions = {}){
        let options = {
            texts: {
                placeholder:"Type Your Password",
                wrong:"Wrong Password",
                error:"Error",
                button:"Login"
            },
            loginField: 'email'
        };
        var options = extend(options, newOptions);
        let object={
            posterror:function(){
                swal({
                    title:options.texts.error,
                    icon:"error"
                });
            },
            object:this,
            csrf:null,
            isAuth:function(callback){
                fetch("/isAuth")
                .then(data => {
                    if(data.csrf!==object.csrf) object.update_csrf(data.csrf);
                    if (data.logged) {
                        if (callback) callback();
                    }else{
                        object.askPassword(callback);
                    }
                }).catch(error => {
                    object.posterror();
                });
            },
            askPassword:function(callback){
                swal({
                    title: user.name,
                    icon:user.photo,
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: options.texts.placeholder,
                            type: "password"
                        },
                    },
                    button: {
                        text: options.texts.button,
                        closeModal: false,
                    }
                })
                    .then(password => {
                        if(password){
                            data = {
                                username:user[options.loginField],
                                password,
                                loginField: options.loginField
                            };
                           fetch("/ajaxlogin",
                           {
                                method: "POST",
                                body: data
                           })
                            .then(data => {
                                if(data.logged){
                                    swal.stopLoading();
                                    swal.close();
                                    if (callback) callback();
                                }else{
                                    swal({
                                        title:options.texts.wrong,
                                        icon:"warning",
                                        timer: 1000,
                                    });
                                }
                            }).catch(error => {
                                object.posterror();
                            }); 
                           /*
                            $.post("/ajaxlogin",
                                {
                                    username:user[options.loginField],
                                    password,
                                    loginField: options.loginField
                                }
                            ).done(data=> {
                                if(data.logged){
                                    swal.stopLoading();
                                    swal.close();
                                    if (callback) callback();
                                }else{
                                    swal({
                                        title:options.texts.wrong,
                                        icon:"warning",
                                        timer: 1000,
                                    });
                                }
                            }).fail(function () {
                                object.posterror();
                            });
                            */
                        }else{
                            swal.close();
                        }
                    });
            },
            update_csrf:function(newcsrf){
                object.csrf=newcsrf;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': newcsrf
                    }
                });
                $("input[name='_token']").val(newcsrf);
            }
        };
        object.update_csrf($('meta[name="csrf-token"]').attr('content'));
        $("form").submit(function (event) {
            let _this=this;
            event.preventDefault();
            object.isAuth(function () {
                $(_this).unbind('submit').submit();
            });
        });
        return object;
    }

    var extend = function () {
        // Variables
        var extended = {};
        var deep = false;
        var i = 0;
        var length = arguments.length;

        // Check if a deep merge
        if ( Object.prototype.toString.call( arguments[0] ) === '[object Boolean]' ) {
            deep = arguments[0];
            i++;
        }

        // Merge the object into the extended object
        var merge = function (obj) {
            for ( var prop in obj ) {
                if ( Object.prototype.hasOwnProperty.call( obj, prop ) ) {
                    // If deep merge and property is an object, merge properties
                    if ( deep && Object.prototype.toString.call(obj[prop]) === '[object Object]' ) {
                        extended[prop] = extend( true, extended[prop], obj[prop] );
                    } else {
                        extended[prop] = obj[prop];
                    }
                }
            }
        };

        // Loop through each object and conduct a merge
        for ( ; i < length; i++ ) {
            var obj = arguments[i];
            merge(obj);
        }

        return extended;

    };
});