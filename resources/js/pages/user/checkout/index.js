"use strict";

var KTEcommerceCheckout = function () {
    // Base elements
    var _wizardEl;
    var _formEl;
    var _wizardObj;
    var _validations = [];

    // Private functions
    var _initWizard = function () {
        // Initialize form wizard
        _wizardObj = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: false  // allow step clicking
        });

        // Validation before going to next page
        _wizardObj.on('change', function (wizard) {
            if (wizard.getStep() > wizard.getNewStep()) {
                return; // Skip if stepped back
            }

            // Validate form before change wizard step
            var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step

            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        wizard.goTo(wizard.getNewStep());

                        KTUtil.scrollTop();
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light"
                            }
                        }).then(function () {
                            KTUtil.scrollTop();
                        });
                    }
                });
            }

            return false;  // Do not change wizard step, further action will be handled by he validator
        });

        // Change event
        _wizardObj.on('changed', function (wizard) {
            KTUtil.scrollTop();
        });

        // Submit event
        _wizardObj.on('submit', function (wizard) {
            Swal.fire({
                text: "All is good! Please confirm the form submission.",
                icon: "success",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, submit!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                    cancelButton: "btn font-weight-bold btn-default"
                }
            }).then(function (result) {
                if (result.value) {
                    _formEl.submit(); // Submit form
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been submitted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    var _initValidation = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    address1: {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            }
                        }
                    },
                    postcode: {
                        validators: {
                            notEmpty: {
                                message: 'Postcode is required'
                            }
                        }
                    },
                    city_id: {
                        validators: {
                            notEmpty: {
                                message: 'City is required'
                            }
                        }
                    },
                    province_id: {
                        validators: {
                            notEmpty: {
                                message: 'Province is required'
                            }
                        }
                    },
                    country: {
                        validators: {
                            notEmpty: {
                                message: 'Country is required'
                            }
                        }
                    },
                    shipping_name: {
                        validators: {
                            notEmpty: {
                                message: 'Shipping name is required'
                            }
                        }
                    },
                    shipping_service: {
                        validators: {
                            notEmpty: {
                                message: 'Shipping service is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    payment_method_id: {
                        validators: {
                            notEmpty: {
                                message: 'Payment method is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));
    }

    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard');
            _formEl = KTUtil.getById('kt_form');

            _initWizard();
            _initValidation();
        }
    };
}();

var KTSelect = function() {
    var main = function() {
        $('#province_id').on('change', function () {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: `${HOST_URL}/locations/cities`,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        province_id: province_id
                    },
                    success: function (data) {
                        $('#city_id').empty();
                        $.each(data, function(key, value) {
                            $('#city_id').append($("<option></option>").attr("value", value.id).text(value.name));
                        });
                    }
                });
            }
        });

        $('.count-cost').on('change', function () {
            var city_id = $('#city_id').val();
            var shipping_name = $('#shipping_name').val();
            if(city_id && shipping_name){
                $.ajax({
                    url: `${HOST_URL}/shipping/cost`,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        city_id: city_id,
                        shipping_name: shipping_name,
                    },
                    success: function (data) {
                        let services = [];
                        if(data[0]){
                            services = data[0].costs;
                        }
                        $('#shipping_service').empty();
                        $.each(services, function (index, value) {
                            $('#shipping_service').append(`
                                    <option value="${value.service} (${value.cost[0].etd} day)">${value.service} (${value.cost[0].etd} day) - Rp${value.cost[0].value.toLocaleString()}</option>
                                `);
                        });

                        $('#shipping_service').trigger('change');
                    }
                });
            }
        });

        $('#shipping_service').on('change', function () {
            let text =  $(this).find('option:selected').text();
            let val = text.split(' - ');
            let cost = parseInt(val[1].replace('Rp', '').replace(',', '').replace('.', ''));
            let grand_total = parseInt($('.grand-total').text().replace('Rp', '').replace(',', '').replace('.', ''));

            $('#shipping_cost').val(cost);
            $('.delivery-fee').text(`Rp${cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`);
            $('.grand-total').text(`Rp${(grand_total + cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`);
        });
    }

    // Public functions
    return {
        init: function() {
            main();
        }
    };
}();

jQuery(document).ready(function () {
    KTEcommerceCheckout.init();
    KTSelect.init();
});
