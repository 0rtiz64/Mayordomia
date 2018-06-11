$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })


});

var available_printers = null;
var selected_category = null;
var default_printer = null;
var selected_printer = null;
var format_start = "^XA^LL200^FO80,50^A0N36,36^FD";
var format_end = "^FS^XZ";
var default_mode = true;

var p1="\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW812\n" +
    "^LL0812\n" +
    "^LS0\n" +
    "^FO0,576^GFA,11264,11264,00044,:Z64:\n" +
    "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:77E6\n" +
    "^FT746,721^A0I,48,45^FH\\^FDMEGACENTER S.A.^FS\n" +
    "^FT761,638^A0I,51,50^FH\\^FDTEL: 2566-0426/27^FS\n" +
    "^FT768,494^A0I,25,24^FH\\^FD";




var p2="^FS\n" +
    "^FT765,396^A0I,37,36^FH\\^FDNUMERO DE FACTURA:";

var p3="^FS\n" +
    "^FT760,329^A0I,28,33^FH\\^FD";



var p4 ="^FS\n" +
    "^FT760,295^A0I,28,33^FH\\^FD";

var p5 ="^FS\n" +
    "^FT760,261^A0I,28,33^FH\\^FD";

var p6="^FS\n" +
    "^FO1,155^GB803,0,5^FS\n" +
    "^FO8,560^GB803,0,5^FS\n" +
    "^FO1,185^GB803,0,5^FS\n" +
    "^FT493,164^A0I,23,21^FH\\^FDIMPORTANTE^FS\n" +
    "^FT763,102^A0I,28,28^FB696,1,0,C^FH\\^FDLa etiqueta no debe retirarse del producto hasta que haya^FS\n" +
    "^FT763,68^A0I,28,28^FB696,1,0,C^FH\\^FDsido adquirido por el consumidor final.^FS\n" +
    "^FT269,15^A0I,25,24^FH\\^FD"
//FECHA
var p7="^FS\n" +
"^PQ";
//CANTIDAD
var p8 =",0,1,Y^XZ";



var miZpl = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW812\n" +
    "^LL0812\n" +
    "^LS0\n" +
    "^FO0,576^GFA,11264,11264,00044,:Z64:\n" +
    "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:77E6\n" +
    "^FT746,721^A0I,48,45^FH\\^FDMEGACENTER S.A.^FS\n" +
    "^FT761,638^A0I,51,50^FH\\^FDTEL: 2566-0426/27^FS\n" +
    "^FT768,494^A0I,25,24^FH\\^FDNOMBRE DEL CLIENTE SELECCIONADO EN INPUT^FS\n" +
    "^FT765,396^A0I,37,36^FH\\^FDNUMERO DE FACTURA: 1234^FS\n" +
    "^FT760,329^A0I,28,33^FH\\^FDOBSERVACIONES OBSERVACIONES OBSERVACIONES^FS\n" +
    "^FT760,295^A0I,28,33^FH\\^FDOBSERVACIONES OBSERVACIONES OBSERVACIONES^FS\n" +
    "^FT760,261^A0I,28,33^FH\\^FDOBSERVACIONES OBSERVACIONES OBSERVACIONES^FS\n" +
    "^FT760,227^A0I,28,33^FH\\^FDOBSERVACIONES OBSERVACIONES OBSERVACIONES^FS\n" +
    "^FO1,155^GB803,0,5^FS\n" +
    "^FO8,560^GB803,0,5^FS\n" +
    "^FO1,185^GB803,0,5^FS\n" +
    "^FT493,164^A0I,23,21^FH\\^FDIMPORTANTE^FS\n" +
    "^FT763,102^A0I,28,28^FB696,1,0,C^FH\\^FDLa etiqueta no debe retirarse del producto hasta que haya^FS\n" +
    "^FT763,68^A0I,28,28^FB696,1,0,C^FH\\^FDsido adquirido por el consumidor final.^FS\n" +
    "^FT269,15^A0I,25,24^FH\\^FD25 ENERO 2018 14:54:18^FS\n" +
    "^PQ1,0,1,Y^XZ\n";


function setup_web_print()
{
    $('#printer_select').on('change', onPrinterSelected);
    showLoading("Loading Printer Information...");
    default_mode = true;
    selected_printer = null;
    available_printers = null;
    selected_category = null;
    default_printer = null;

    BrowserPrint.getDefaultDevice('printer', function(printer)
        {
            default_printer = printer
            if((printer != null) && (printer.connection != undefined))
            {
                selected_printer = printer;
                var printer_details = $('#printer_details');
                var selected_printer_div = $('#selected_printer');

                selected_printer_div.text("Using Default Printer: " + printer.name);
                hideLoading();
                printer_details.show();
                $('#print_form').show();

            }
            BrowserPrint.getLocalDevices(function(printers)
            {
                available_printers = printers;
                var sel = document.getElementById("printers");
                var printers_available = false;
                sel.innerHTML = "";
                if (printers != undefined)
                {
                    for(var i = 0; i < printers.length; i++)
                    {
                        if (printers[i].connection == 'usb')
                        {
                            var opt = document.createElement("option");
                            opt.innerHTML = printers[i].connection + ": " + printers[i].uid;
                            opt.value = printers[i].uid;
                            sel.appendChild(opt);
                            printers_available = true;
                        }
                    }
                }

                if(!printers_available)
                {
                    showErrorMessage("No Zebra Printers could be found!");
                    hideLoading();
                    $('#print_form').hide();
                    return;
                }
                else if(selected_printer == null)
                {
                    default_mode = false;
                    changePrinter();
                    $('#print_form').show();
                    hideLoading();
                }
            }, undefined, 'printer');
        },
        function(error_response)
        {
            showBrowserPrintNotFound();
        });
};
function showBrowserPrintNotFound()
{
    showErrorMessage("An error occured while attempting to connect to your Zebra Printer. You may not have Zebra Browser Print installed, or it may not be running. Install Zebra Browser Print, or start the Zebra Browser Print Service, and try again.");

};

function  consultarIdParaCarnet() {
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/buscarUltIdParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(idIntegrante){

            consultarCorrelativoParaCarnet(idIntegrante);



            return false;


        }
    });
    return false;
}

function consultarCorrelativoParaCarnet(idIntegrante) {
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/buscarUltCorrelativoParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(correlativo){

            sendData(idIntegrante,correlativo);



            return false;


        }
    });
    return false;
}


//INICIO FUNCION CARNET MODAL
function  consultarIdParaCarnetModal() {
    var identidad = $('#identidadRegistrarModal').val();
    var url = 'php/buscarUltIdParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(idIntegrante){

            consultarCorrelativoParaCarnetModal(idIntegrante);



            return false;


        }
    });
    return false;
}


function consultarCorrelativoParaCarnetModal(idIntegrante) {
    var identidad = $('#identidadRegistrarModal').val();
    var url = 'php/buscarUltCorrelativoParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(correlativo){

            sendDataModal(idIntegrante,correlativo);



            return false;


        }
    });
    return false;
}


function sendDataModal(idIntegrante,correlativo)
{

    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {
            var nombre1 =$('#NombreRegistroModal').val();
            var id =$('#identidadRegistrarModal').val();
            //var corr =$('#numeroExpedienteRegistrar').val();
            var nombre = nombre1.toUpperCase();
            var promocion = $('#promoAc').val();
            var promocion1 =promocion.toUpperCase()
            //var corrVisible = $('#correlativo').val();

            var contraPleca = String.fromCharCode(92);

            var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");

            selected_printer.send(p1+promocion1+p2+nombreNuevo+p3+id+p4+correlativo+p5+idIntegrante+p6, printComplete, printerError);
            //$('#formularioRegistro')[0].reset();
        }
        else
        {
            printerError(text);
        }
    });
};

// FIN FUNCION CARNET MODAL




function sendData(idIntegrante,correlativo)
{


    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {
            var nombre1 =$('#NombreRegistro').val();
            var id =$('#identidadRegistrar').val();
            //var corr =$('#numeroExpedienteRegistrar').val();
            var nombre = nombre1.toUpperCase();
            var promocion = $('#promoAc').val();
            var promocion1 =promocion.toUpperCase()
            //var corrVisible = $('#correlativo').val();

            var contraPleca = String.fromCharCode(92);

            var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");

            selected_printer.send(p1+promocion1+p2+nombreNuevo+p3+id+p4+correlativo+p5+idIntegrante+p6, printComplete, printerError);
            //$('#formularioRegistro')[0].reset();
        }
        else
        {
            printerError(text);
        }
    });
};

function checkPrinterStatus(finishedFunction)
{
    selected_printer.sendThenRead("~HQES",
        function(text){
            var that = this;
            var statuses = new Array();
            var ok = false;
            var is_error = text.charAt(70);
            var media = text.charAt(88);
            var head = text.charAt(87);
            var pause = text.charAt(84);
            // check each flag that prevents printing
            if (is_error == '0')
            {
                ok = true;
                statuses.push("Ready to Print");
            }
            if (media == '1')
                statuses.push("Paper out");
            if (media == '2')
                statuses.push("Ribbon Out");
            if (media == '4')
                statuses.push("Media Door Open");
            if (media == '8')
                statuses.push("Cutter Fault");
            if (head == '1')
                statuses.push("Printhead Overheating");
            if (head == '2')
                statuses.push("Motor Overheating");
            if (head == '4')
                statuses.push("Printhead Fault");
            if (head == '8')
                statuses.push("Incorrect Printhead");
            if (pause == '1')
                statuses.push("Printer Paused");
            if ((!ok) && (statuses.Count == 0))
                statuses.push("Error: Unknown Error");
            finishedFunction(statuses.join());
        }, printerError);
};
function hidePrintForm()
{
    $('#print_form').hide();
};
function showPrintForm()
{
    $('#print_form').show();
};
function showLoading(text)
{
    $('#loading_message').text(text);
    $('#printer_data_loading').show();
    hidePrintForm();
    $('#printer_details').hide();
    $('#printer_select').hide();
};
function printComplete()
{
    hideLoading();
    alert ("Printing complete");

}
function hideLoading()
{
    $('#printer_data_loading').hide();
    if(default_mode == true)
    {
        showPrintForm();
        $('#printer_details').show();
    }
    else
    {
        $('#printer_select').show();
        showPrintForm();
    }
};
function changePrinter()
{
    default_mode = false;
    selected_printer = null;
    $('#printer_details').hide();
    if(available_printers == null)
    {
        showLoading("Finding Printers...");
        $('#print_form').hide();
        setTimeout(changePrinter, 200);
        return;
    }
    $('#printer_select').show();
    onPrinterSelected();

}
function onPrinterSelected()
{
    selected_printer = available_printers[$('#printers')[0].selectedIndex];
}
function showErrorMessage(text)
{
    $('#main').hide();
    $('#error_div').show();
    $('#error_message').html(text);
}
function printerError(text)
{
    showErrorMessage("An error occurred while printing. Please try again." + text);
}
function trySetupAgain()
{
    $('#main').show();
    $('#error_div').hide();
    setup_web_print();
    //hideLoading();
}


