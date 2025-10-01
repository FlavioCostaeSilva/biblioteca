window.currencies = [];

$(document).ready(function() {
    $(document).on('click', '#convert', function (e) {
        e.preventDefault();

        convert();
    });

    const confMaskMoney = {
        prefix: 'R$ ',
        showSymbol: true,
        symbol: "R$",
        decimal: ",",
        thousands: ".",
        allowZero: true
    }

    $("#value").maskMoney(confMaskMoney);

    loadCurrencies();
    loadLastQuotations();
});

function convert()
{
    let currency_index = $("#currency_selector");
    let value = $("#value");
    let form_of_payment = $("#form_of_payment").val();

    let currency = parseInt((value.maskMoney('unmasked')[0] * 100).toString());

    let data = '{}';
    data = JSON.parse(data);
    data.pair = window.currencies[currency_index.val()].currency_one.code + '-'
        + window.currencies[currency_index.val()].currency_two.code;
    data.value = currency;
    data.form_of_payment = form_of_payment;

    $.ajax({
        url: '/quote',
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        processData: false,
        success: function (data) {
            processResponse(data.data, '#result');
            value.val('R$ 0,00')
            loadLastQuotations();
        },
        error: function (error) {
            alert(error.responseJSON.message);
        }
    });
}

function processResponse(data, attr, htmlOrAppend = 'html')
{
    let html = '<div class="quotation_result"><strong>Valor para conversão:</strong> ' + formatMoney(data, data.code_in,'code_in_value_to_convert') + '<br>\n' +
        '<strong>Forma de pagamento:</strong> '+ formatFormOfPayment(data.form_of_payment) +'<br>\n' +
        '<strong>Valor da "Moeda de destino" usado para conversão ('+ data.code +'):</strong> ' + formatMoney(data, data.code, 'code_currency_value') +'<br>\n' +
        '<strong>Valor comprado em "Moeda de destino (' + data.code + ')":</strong> '+ formatMoney(data, data.code, 'code_in_currency_purchased') +' (Taxas aplicadas no valor de compra)<br>\n' +
        '<strong>Taxa de pagamento:</strong> '+formatMoney(data, data.code_in, 'tax_payment')+'<br>\n' +
        '<strong>Taxa de conversão:</strong> '+formatMoney(data, data.code_in, 'tax_conv')+'<br>\n' +
        '<strong>Valor utilizado para conversão descontando as taxas:</strong> '+formatMoney(data, data.code_in, 'value_code_tax_deducted')+'<br>\n' +
        '<strong>Data de processamento:</strong> '+ (new Date(data.created_at)).toLocaleString('pt-BR') +
        '</div>';

    if (htmlOrAppend === 'html') {
        $(attr).html(html);
        return;
    }
    $(attr).append(html);
}

function formatMoney(data, code_selected, attr)
{
    let currency_index = $("#currency_selector");
    let code = window.currencies[currency_index.val()].currency_one.code;
    let code_iso_lang = window.currencies[currency_index.val()].currency_one.code_iso_lang;

    if (code_selected !== code) {
        code_iso_lang = 'pt_BR';
    }

    let currency = Intl.NumberFormat(code_iso_lang.replace('_', '-'), {
        style: "currency",
        currency: code_selected,
        minimumFractionDigits: 2
    });

    return currency.format(data[attr]);
}

function formatFormOfPayment(form)
{
    if (form === 'CREDIT_CARD') {
        return 'Cartão de crédito'
    }
    return 'Boleto';
}

function loadCurrencies()
{
    $.ajax({
        url: '/get_pairs',
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            try {
                window.currencies = data.data;
                for (let index = 0; index <= data.data.length; index++) {
                    $('#currency_selector')
                        .append('<option value="' + index + '">'
                            + data.data[index].currency_one.code_name +
                            '</option>');
                }
            } catch (e) {

            }
        },
        error: function () {

        }
    });
}

function loadLastQuotations()
{
    $.ajax({
        url: '/get_last_quotations',
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            try {
                eraseQuotations('#last_quotations');

                for (let index = 0; index <= data.data.length; index++) {
                    processResponse(data.data[index], '#last_quotations', 'append');
                }
            } catch (e) {

            }
        },
        error: function () {

        }
    });
}

function eraseQuotations(attr)
{
    $(attr).html('');
}
