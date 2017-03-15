(function () {
    'use strict';

    angular
        .module('login')
        .controller('LoginController', LoginController);


    function LoginController($scope){
        var vm = this;

        vm.formValid = false;
        vm.patternForEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
        vm.watchModels = ['vm.email', 'vm.password'];

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
                password: currentValues[1] || ''
            };

            return validateEmail() && validatePassword();


            function validateEmail(){
                return vm.patternForEmail.test(fields.email.trim());
            }

            function validatePassword(){
                return fields.password.trim().length;
            }

        }
    }

})();