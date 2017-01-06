$(document).ready(function(){
              $("#from_date").datepicker({
                minDate: 0,
                maxDate: '+1Y+6M',
                onSelect: function (dateStr) {
        var min = $(this).datepicker('getDate'); // Get selected date
        $("#to_date").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
      }
    });

              $("#to_date").datepicker({
                minDate: '0',
                maxDate: '+1Y+6M',
                onSelect: function (dateStr) {
        var max = $(this).datepicker('getDate'); // Get selected date
        $('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Set other max, default to +18 months
        var start = $("#from_date").datepicker("getDate");
        var end = $("#to_date").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
        $("#rental_days").val(days);
      }
    });

$('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            store_id: {
                validators: {
                    notEmpty: {
                        message: 'Please select your store'
                    }
                }
            },
            
            }
        })
        
              
});//]]> 