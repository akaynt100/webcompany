(function () {
    'use strict';

    angular
        .module('registration')
        .controller('RegistrationController', RegistrationController);


    function RegistrationController($scope){
        var vm = this;

        vm.formValid = false;
        vm.patternForEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
        vm.watchModels = ['vm.email', 'vm.password', 'vm.passwordConfirm', 'vm.accepted'];

        activate();

        function activate(){
            watchModels();
        }

        function watchModels(){
            $scope.$watchGroup(vm.watchModels, watchActions);

            function watchActions(currentValues, originalValues){
                toggleSubmitBtnState(currentValues);
            }
        }

        function toggleSubmitBtnState(currentValues){
            vm.formValid = validate(currentValues);
        }

        function validate(currentValues){
            var fields = {
                email: currentValues[0] || '',
                password: currentValues[1] || '',
                passwordConfirm: currentValues[2] || '',
                accepted: currentValues[3]
            };

            return validateEmail() && validatePasswords() && validatePasswordConfirm() && validateAccept();


            function validateEmail(){
                return vm.patternForEmail.test(fields.email.trim());
            }

            function validatePasswords(){
                return (fields.password.trim().length && fields.passwordConfirm.trim().length) ? true : false;
            }

            function validatePasswordConfirm(){
                return fields.password === fields.passwordConfirm;
            }

            function validateAccept(){
                return fields.accepted;
            }

        }
    }

})();