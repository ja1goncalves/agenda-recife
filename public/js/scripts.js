(function($) {
    "use strict";

    /*================================
    Preloader
    ==================================*/

    var preloader = $('#preloader');
    $(window).on('load', function() {
        preloader.fadeOut('slow', function() { $(this).remove(); });
    });

    /*================================
    sidebar collapsing
    ==================================*/
    $('.nav-btn').on('click', function() {
        $('.page-container').toggleClass('sbar_collapsed');
    });

    /*================================
    Start Footer resizer
    ==================================*/
    var e = function() {
        var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
        (e -= 67) < 1 && (e = 1), e > 67 && $(".main-content").css("min-height", e + "px")
    };
    $(window).ready(e), $(window).on("resize", e);

    /*================================
    sidebar menu
    ==================================*/
    $("#menu").metisMenu();

    /*================================
    slimscroll activation
    ==================================*/
    $('.menu-inner').slimScroll({
        height: 'auto'
    });
    $('.nofity-list').slimScroll({
        height: '435px'
    });
    $('.timeline-area').slimScroll({
        height: '500px'
    });
    $('.recent-activity').slimScroll({
        height: 'calc(100vh - 114px)'
    });
    $('.settings-list').slimScroll({
        height: 'calc(100vh - 158px)'
    });

    /*================================
    stickey Header
    ==================================*/
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop(),
            mainHeader = $('#sticky-header'),
            mainHeaderHeight = mainHeader.innerHeight();

        // console.log(mainHeader.innerHeight());
        if (scroll > 1) {
            $("#sticky-header").addClass("sticky-menu");
        } else {
            $("#sticky-header").removeClass("sticky-menu");
        }
    });

    /*================================
    form bootstrap validation
    ==================================*/
    $('[data-toggle="popover"]').popover()

    /*------------- Start form Validation -------------*/
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);


    /*================================
    Slicknav mobile menu
    ==================================*/
    $('ul#nav_menu').slicknav({
        prependTo: "#mobile_menu"
    });

    /*================================
    login form
    ==================================*/
    $('.form-gp input').on('focus', function() {
        $(this).parent('.form-gp').addClass('focused');
    });
    $('.form-gp input').on('focusout', function() {
        if ($(this).val().length === 0) {
            $(this).parent('.form-gp').removeClass('focused');
        }
    });

    /*================================
    slider-area background setting
    ==================================*/
    $('.settings-btn, .offset-close').on('click', function() {
        $('.offset-area').toggleClass('show_hide');
        $('.settings-btn').toggleClass('active');
    });


    /*================================
    Fullscreen Page
    ==================================*/

    if ($('#full-view').length) {

        var requestFullscreen = function(ele) {
            if (ele.requestFullscreen) {
                ele.requestFullscreen();
            } else if (ele.webkitRequestFullscreen) {
                ele.webkitRequestFullscreen();
            } else if (ele.mozRequestFullScreen) {
                ele.mozRequestFullScreen();
            } else if (ele.msRequestFullscreen) {
                ele.msRequestFullscreen();
            } else {
                console.log('Fullscreen API is not supported.');
            }
        };

        var exitFullscreen = function() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else {
                console.log('Fullscreen API is not supported.');
            }
        };

        var fsDocButton = document.getElementById('full-view');
        var fsExitDocButton = document.getElementById('full-view-exit');

        fsDocButton.addEventListener('click', function(e) {
            e.preventDefault();
            requestFullscreen(document.documentElement);
            $('body').addClass('expanded');
        });

        fsExitDocButton.addEventListener('click', function(e) {
            e.preventDefault();
            exitFullscreen();
            $('body').removeClass('expanded');
        });
    }

    //============== Custom ===========

    $('.refound-percentage').off('keyup');
    $('.refound-percentage').on('keyup', function()
        {
            var baseValue = $(this).closest('.refound').find('.base-value'),
                value = $(this).closest('.refound').find('.total'),
                percentage = $(this).val(),
                finalValue = 'R$ ' + formatMoney(parseFloat(calcPercentage(baseValue.html(), percentage)));
            value.html(finalValue);
        }
    );

    $('.amount_to_pay').off('keyup');
    $('.amount_to_pay').on('keyup', function()
        {
            var baseValue = $(this).closest('.pay-reserve').find('.base-value'),
                value = $(this).closest('.pay-reserve').find('.total'),
                percentage = $(this).val();
            value.html('R$ ' + formatMoney(calcPercentage(baseValue.html(), percentage)));
        }
    );

    $('.payment_type').off('click');
    $('.payment_type').on('click', function()
        {
            let value = $(this).val(),
                registration_numer = $(this).data('registration_numer'),
                box_payment_type = $('.box-payment-type-'+registration_numer);
            if(value == 10) {
                $(box_payment_type).addClass('dnone');
            } else {
                $(box_payment_type).removeClass('dnone');
            }
        }
    );

    $('#user-email').off('blur');
    $('#user-email').on('blur', function()
        {
            let email = $(this).val();
            if(email != '') {
                hasEmail(email);
            }
        }
    );

    if($('input[name="range_dates"]').length){
        $('input[name="range_dates"]').daterangepicker({
            "autoApply": true,
            "startDate" : startDate,
            "endDate" : endDate,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Do",
                    "Se",
                    "Te",
                    "Qa",
                    "Qi",
                    "Se",
                    "Sa"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agost0",
                    "Setember",
                    "Outobro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            },
        });
    }

    if($('#years').length){
        $('#years').tagit({
            fieldName: "years",
            allowSpaces: true,
            allowNewTags: false,
            beforeTagAdded: function(event, ui) {
                console.log(ui.tagLabel);
                $('#years-hidden').val(ui.tagLabel);
            }
        });
        // $('#years').find('input').attr('type', 'number');
    }

    $('#checkAll').off('click');
    $('#checkAll').on('click', function()
        {
            if($(this).is(':checked')) {
                $('.user_modules').prop('checked', true);
                $('.user_parent').prop('checked', true);
            } else {
                $('.user_modules').prop('checked', false);
                $('.user_parent').prop('checked', false);
            }
        }
    );

    $('.user_modules').off('click');
    $('.user_modules').on('click', function()
        {
            var id = $(this).data('id');
            if($(this).is(':checked')) {
                $('.user_parent_'+id).prop('checked', true);
            } else {
                $('.user_parent_'+id).prop('checked', false);
            }
        }
    );

    $('.user_parent').off('click');
    $('.user_parent').on('click', function()
        {
            var user_parent = $(this).data('user_parent');
            console.log(user_parent);
            if($(this).is(':checked')) {
                $('#module-'+user_parent).prop('checked', true);
            } else {
                var uncheck = true;
                $('.user_parent_'+user_parent).each(
                    function()
                    {
                        if($(this).is(':checked')) {
                            uncheck = false;
                        }
                    }
                )
                if(uncheck) {
                    $('#module-'+user_parent).prop('checked', false);
                }
            }
        }
    );
    removerBoxTemporada();
    $('.add-box-temporada').off('click');
    $('.add-box-temporada').on('click', function()
    {
        var box_temporada = $('template#box-temporada').html();
        $('.box-temporada').append(box_temporada);
        removerBoxTemporada();
    });

    $('.money').mask('#.##0,00', {reverse: true});
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('.phone').mask(SPMaskBehavior, spOptions);

    var dateFormat = "dd/mm/yy",
        dateCalendar = $( ".date-calendar" )
        .datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1,
            dateFormat: dateFormat,
        })
        .on( "change", function() {
            afterDateCalendar.datepicker( "option", "minDate", getDate( this ) );
        }),
        afterDateCalendar = $( ".after-date-calendar" ).datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1,
            dateFormat: dateFormat,
        })
        .on( "change", function() {
            dateCalendar.datepicker( "option", "maxDate", getDate( this ) );
        });

    function getDate( element ) {
        var date;
        try {
            console.log(element.value, dateFormat);
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }
        return date;
    }
    //=========== End Custom ==========

})(jQuery);

function calcPercentage(value, percentage) {
    value = removeMoneyFormat(value);
    value = (value * (percentage / 100));
    return value;
}

function removeMoneyFormat(value) {
    value = value.replace('R$ ', '');
    value = value.replace('.', '');
    value = value.replace(',', '.');
    return value;
}

function formatMoney(number, hundred, ten, unit) {
    var hundred = isNaN(hundred = Math.abs(hundred)) ? 2 : hundred,
        ten = ten == undefined ? "," : ten,
        unit = unit == undefined ? "." : unit,
        separetor = number < 0 ? "-" : "",
        i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(hundred))),
        j = (j = i.length) > 3 ? j % 3 : 0;

    return separetor + (j ? i.substr(0, j) + unit : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + unit) + (hundred ? ten + Math.abs(number - i).toFixed(hundred).slice(2) : "");
}


function confirmReservation(url) {
    $.confirm({
        title: 'Confirmação de pagamento',
        content: 'Deseja realmente confirmar o pagamento desta reserva?',
        autoClose: 'cancelAction',
        escapeKey: 'cancelAction',
        buttons: {
            confirm: {
                btnClass: 'btn-green',
                text: 'Sim',
                action: function () {
                    location.href = url;
                }
            },
            cancelAction: {
                text: 'Não',
                action: function () {
                }
            }
        }
    });
}

function convertDoubleToUS(value)
{
    console.log(value);
        return isNaN(value) == false ? parseFloat(value) : parseFloat(value.replace("R$","").replace(".","").replace(".","").replace(".","").replace(".","").replace(",","."));

}

function convertDoubleToBR(n, c, d, t)
{
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}


function deleteRegister(url) {
    $.confirm({
        title: 'Exclusão de usuário',
        content: 'Deseja realmente remover este usuário?',
        autoClose: 'cancelAction',
        escapeKey: 'cancelAction',
        buttons: {
            confirm: {
                btnClass: 'btn-green',
                text: 'Sim',
                action: function () {
                    location.href = url;
                }
            },
            cancelAction: {
                text: 'Não',
                action: function () {
                }
            }
        }
    });
}

function hasEmail(email = '')
{
    if(email == '') {
        email = $('#user-email').val();
    }
    let _token = $('input[name="_token"]').val();
    $.ajax({
        method: "POST",
        url: baseUrl + '/has-user',
        headers: {'X-CSRF-TOKEN': _token},
        data: {email: email}
    })
    .done(function( data ) {
        if(data == 'true') {
            alert('Email já cadastrado');
            $('#user-email').focus();
            return false;
        }
        return true;
    });
}

function removerBoxTemporada()
{
    $('.remove-box-temporada').off('click');
    $('.remove-box-temporada').on('click', function()
    {
        $(this).closest('.list-temporada').remove();
        if($('.list-temporada').length == 0) {
            $('.add-box-temporada').trigger('click');
        }
    });
}
