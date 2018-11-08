$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });




});

var available_printers = null;
var selected_category = null;
var default_printer = null;
var selected_printer = null;
var format_start = "^XA^LL200^FO80,50^A0N36,36^FD";
var format_end = "^FS^XZ";
var default_mode = true;

var p1="^XA\n" +
    "^MMT\n" +
    "^PW254\n" +
    "^LL0457\n" +
    "^LS0\n" +
    "^FO0,320^GFA,02560,02560,00016,:Z64:\n" +
    "eJztlL1uFDEQgGftu3UUHdkrUqzEwR7hBRbRcEqk3Yp0iAIkKjiloUWiSZfhRxQIIQpqQMoj5AG8QggkFEUUqdF1lLkS6aKYsXe8OfsVuJFs69uZ8dgzOwZYyUpaqSP+HqL8GHL2NuRJrH8dsvoU7d9E/ChEFCHrX5F9L+LNEKuTkIso3uDS/8CqVMfSXNj5fecJigzU0PM+wHzJPyHlDln9ZlY01gG2vPkGDcGrlbxdMu//jKP4fI1prAGU35ib1mf6gMOhPTyZ3WO2E+1V8v2k28yYCbacMhcDvjczQsgbfL81x1oX75aOS/ryQ8hfOL9D5vH9lks7XTWL8d0lJn11GjKuMz+uHdc1X79CF3/EfMM0rf+J55njQ87fTTN369b1Jc6wy7/l4gyh+tpxZs5wj9Xw3MwP6DR7vj639ZHWn/Fpxvpb5o8xGnd9PpmbMddnaH4Y8m98ffJttTALfOnrk4Mi/Qssj31+JXGC2+jznxDL5AnHo2tprWXfn4/qR+dLZclM9a3MRQqjS87M+QAy7lf6P6Q5z0X2kw0aCvC3hFHKPKUNZlNRcn5tQRQ2IvH9krtNlHrDbPOioHfN97dE923i+9/+/3dcyln2IZlBKjsusEDow6lnOh4EYjumVzXBNxH1qxyEPuJVGnA/fp/S8P0QV8L3QhTh+9B7WMNKVvJ/yT/DZao6:6707\n" +
    "^FO0,0^GFA,02048,02048,00016,:Z64:\n" +
    "eJzV1bENwjAQBVBbKVKmpTODIHkVtqDDsFnYJCNEokkR5eN0d9+RDxcUuHuKZMXnu2/n/nGdDF8M3w0nMjQ9Hk3uMFbdY6p6wFx1wGJ4VY6FN+VE3xPtByxhVZ6jsAcmdhLugBF1P6V78gB05L7mgI09SMfCq3IuR2jxXh7hfPwlNrgz3BvOx59TxcFwbLS1n/U/1nmsenxTX7qftvtkc39w/xz0W7U/D/pZmfuf5+NgfiZpnj9P88rzuzewk6vMA50XZZ5o2/mkbeXdno9XbT8J53y9ab9UouYCNNnBayf3Vr47T3Znaes9st6z360PTXmAAA==:7158\n" +
    "^FT53,330^A0B,28,28^FH\\^FDPROMOCION 5^FS\n" +
    "^BY4,3,71^FT184,353^BCB,,N,N\n" +
    "^FD>;";


var p2 = "^FS\n" +
"^FO99,28^GE79,72,8^FS\n" +
"^FT151,81^A0B,34,33^FH\\^FD";

var p3 = "^FS\n" +
"^FT75,332^A0B,23,24^FB165,1,0,C^FH\\^FDBOLETO PARA ^FS\n" +
"^FT103,332^A0B,23,24^FB165,1,0,C^FH\\^FDTOGA Y BIRRETE^FS\n" +
"^PQ1,0,1,Y^XZ\n";

var miZpl ="^XA\n" +
    "^MMT\n" +
    "^PW254\n" +
    "^LL0457\n" +
    "^LS0\n" +
    "^FO0,320^GFA,02560,02560,00016,:Z64:\n" +
    "eJztlL1uFDEQgGftu3UUHdkrUqzEwR7hBRbRcEqk3Yp0iAIkKjiloUWiSZfhRxQIIQpqQMoj5AG8QggkFEUUqdF1lLkS6aKYsXe8OfsVuJFs69uZ8dgzOwZYyUpaqSP+HqL8GHL2NuRJrH8dsvoU7d9E/ChEFCHrX5F9L+LNEKuTkIso3uDS/8CqVMfSXNj5fecJigzU0PM+wHzJPyHlDln9ZlY01gG2vPkGDcGrlbxdMu//jKP4fI1prAGU35ib1mf6gMOhPTyZ3WO2E+1V8v2k28yYCbacMhcDvjczQsgbfL81x1oX75aOS/ryQ8hfOL9D5vH9lks7XTWL8d0lJn11GjKuMz+uHdc1X79CF3/EfMM0rf+J55njQ87fTTN369b1Jc6wy7/l4gyh+tpxZs5wj9Xw3MwP6DR7vj639ZHWn/Fpxvpb5o8xGnd9PpmbMddnaH4Y8m98ffJttTALfOnrk4Mi/Qssj31+JXGC2+jznxDL5AnHo2tprWXfn4/qR+dLZclM9a3MRQqjS87M+QAy7lf6P6Q5z0X2kw0aCvC3hFHKPKUNZlNRcn5tQRQ2IvH9krtNlHrDbPOioHfN97dE923i+9/+/3dcyln2IZlBKjsusEDow6lnOh4EYjumVzXBNxH1qxyEPuJVGnA/fp/S8P0QV8L3QhTh+9B7WMNKVvJ/yT/DZao6:6707\n" +
    "^FO0,0^GFA,02048,02048,00016,:Z64:\n" +
    "eJzV1bENwjAQBVBbKVKmpTODIHkVtqDDsFnYJCNEokkR5eN0d9+RDxcUuHuKZMXnu2/n/nGdDF8M3w0nMjQ9Hk3uMFbdY6p6wFx1wGJ4VY6FN+VE3xPtByxhVZ6jsAcmdhLugBF1P6V78gB05L7mgI09SMfCq3IuR2jxXh7hfPwlNrgz3BvOx59TxcFwbLS1n/U/1nmsenxTX7qftvtkc39w/xz0W7U/D/pZmfuf5+NgfiZpnj9P88rzuzewk6vMA50XZZ5o2/mkbeXdno9XbT8J53y9ab9UouYCNNnBayf3Vr47T3Znaes9st6z360PTXmAAA==:7158\n" +
    "^FT53,330^A0B,28,28^FH\\^FDPROMOCION 5^FS\n" +
    "^BY4,3,71^FT184,353^BCB,,N,N\n" +
    "^FD>;1234^FS\n" +
    "^FO99,28^GE79,72,8^FS\n" +
    "^FT151,81^A0B,34,33^FH\\^FD30^FS\n" +
    "^FT75,332^A0B,23,24^FB165,1,0,C^FH\\^FDBOLETO PARA ^FS\n" +
    "^FT103,332^A0B,23,24^FB165,1,0,C^FH\\^FDTOGA Y BIRRETE^FS\n" +
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








function imprimirTagsTogas(idEquipo) {

 var url = 'php/tagsToga.php';



    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidEquipo: idEquipo
        },
        success: function (response) {

            sendData(response);

            return false;
        }
    });

    return false;
}




function sendData(response)
{

    console.log("INICIANDO SEND DATA");
    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {

            var jsonData = JSON.parse(response);
            var contador =0;
            var contadorB = 0;

            //console.log(Object.keys(jsonData));
            //console.log(String(jsonData));
            for( var i=0; i< Object.keys(jsonData).length; i++){
                //console.log("VALOR DE CONTADOR I: "+ i);
                for (var b = 0; b<(Object.keys(jsonData).length); b++){
                    //console.log("VALOR DE CONTADOR B:" +b);
                    //console.log(String(jsonData[i][b]));


                    var idInterno= String (jsonData[i][0]);
                   var numEquipo = String (jsonData[i][1]);


                }


               selected_printer.send(p1+idInterno+p2+numEquipo+p3);

            }






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


