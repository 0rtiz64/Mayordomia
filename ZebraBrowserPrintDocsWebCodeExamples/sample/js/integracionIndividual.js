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

var Ip1 = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO32,224^GFA,02560,02560,00016,:Z64:\n" +
    "eJztlc9r01AcwL/Jiy/FPbIK/sggrGGrODx1zkOYw24e5sGDF8uubQbzWqagsmnjNiaM4v4BwaEX2cEdvLgpW7Gl9SBz/0FrBfUgayeDRZ19Nj+bxLmBR9kXSvj0k+/7fr8v5AXgMP6/CEeC/8g+4iKcX9MnPjxDv/v4Kt318WNKfRynVPNyhtIND7K1JZrzMEPL9IufaxUPH6Hl+W0PI/qeqft4fSjt4Tb6rqL4uPztto/nNx0+kUgkRsprjTvNawKsjUFL8V3d9jxtxjb9ZVyMoaNG/4v0p1Gfs3+I0h2HoxbXvMzsUOpl0GtrFU8+NDKZnNdnps39w46PW/vr+ghtgDe/3XoerkdU9/Exs3yLQQBfvh0tb4VRPyrdvTVyeZw/lbq5Y3rSm02+7WLlvDhr5uNeMrQxOgXFDmx69hyZ1rqnYE5kTUYxgkB9Ey6KlmcWshi6VJgNmZ5D9V3CV8cjef2e6XEsS6CrHx6ILLZZBLXTzccyiYEqyEVrfaN+OqRiuWT1E0XLq/G5j2g1/3I1ME84ON/e81+EFfgx8ax/um7WZ/KawndKAwKZtNYHTcFYOiqEBZN5yBmMBZm3+oOKIrAS77AASYUHCT0EfsbmHl4jzDqwNqcVVJegAcjxCugEbQKadTxMNtfz+k4iCG5+UuGwJHjrg8nY7W/Y4NhJq38t23MJE15QiPU8SjwtZSW+MaDY8+NFTZ+As08reI/9OpDbKg0hVK0ur/RZzyM8OsOFCuc7uFTRul8lOFQAkUvaPEb4jaLBww6jcIkVcVI16/OfCIrl8zpXH3M8s5CrihzYfJ0wuUJa5Abt/FECuZws4sEpk0OpLOQKMfF4yuqnvfIc7n/Of22/0nbQPP80f4BPJ1pxDYIHrxHMixuPtmoXXqku973+4GO/B8uvBH3ygHzHA9udbXqt1SUjbdVirTeheXTKGiD3BsY4XHjvgauDsOAdk2meL4EvyB8x+HcVfA/3CCbAIT8m9s8O768Pw43flt8XJw==:0CA6\n" +
    "^FO512,224^GFA,03840,03840,00024,:Z64:\n" +
    "eJzt1L9rE2EYB/D3cqEp9bgLGOhBDhMKrpqQJWLwkAap6CDSopsRQTqIxkGtU84fDS5VBIcODsXN/0HwTZW0Q6BL3aq+drBL6KXUIUO41/e9K/rmfZ+rnSXPcDSfPrz3fX8dQqMa1aj+z3pXnKkmJmbnM6+uTr0RfOfk47nqpcnk7OKVW5t/WZs6f30WzWwmM80LUxmh/+eDi1+mv84tXPNubP86wnvTaf44+FsY/8kLjIm1np838B1D6G8t4099t1MMjFpHdLrcWXPy7VLTaHQuC96wt9pmba2kG+5SV/Db9rfOGN7Y140zSwPBH9r7zDuPdDNrfRC8Yv9gvl7Ss1nLEdyx99pOjflZ0xTzjNu4zSKWmsWXxrB70313Y29w8/N4UlwIGyEy8XSlvOINL5CN4CogZNHAvH9qp7wl/cuiNPF6O1NNqm6lV8niW8lzlB5Pr6afV+V+f9ckCfJ+XR0HjHSIG5CbNMhhuD81gB25gLP8KAUMxPIjjcTkXIhxJ8YtyAOEdA/u19RA0fqogVj+BkZ1td/fvbeL8tA4DYqVg1EIvadMoB76wJSd3KVBIwjGZG/5vJ+mJNYwPz+UPpPdY48ic2/YE/z3Od9vSa7zh+vSFob8I8WShznc74qHuV2f4hrkVHHjX14H/LTve3nA2ZZ5haO5c+BI8nD/ckEAe1w/jesfgG75XdnDPBbtx3hPduNwJ6CnKI5xD3SdubT+4T7qPkI1wLUB7KivXLA/5xgPe3jeAsC9KI58gfk559MKz7vomC8/UT8EmC8/id4jVo3395B8v/j8uSv3scC9j5RPaDly5b47kZdlNyNXvjOT0Xt7srMJ5Vh+LDubMDsOwHePoGOUKNPin1q2bidUr6AE9SqqW3xflDgsEIuiE9U1tuk5NQ67vZ7WBZjFocAwrBoByKMaFfoNqMMxWQ==:9E2C\n" +
    "^FT485,314^A0I,42,43^FH\\^FDINTEGRACION^FS\n" +
    "^FO338,252^GE58,54,6^FS\n" +
    "^FT659,216^A0I,28,28^FH\\^FD";


var Ip2 ="^FS\n" +
"^BY4,3,91^FT516,91^BCI,,N,N\n" +
"^FD>:";

var Ip3 = "^FS\n" +
"^FT180,101^A0I,31,31^FH\\^FD";

var Ip4 = "^FS\n" +
"^FT451,54^A0I,34,33^FH\\^FD";

var Ip5 = "^FS\n" +
"^FT680,100^A0I,31,31^FH\\^FD";

var Ip6 = "^FS\n" +
"^FT153,136^A0I,25,24^FH\\^FDTELEFONO2:^FS\n" +
"^FT652,141^A0I,25,24^FH\\^FDTELEFONO1:^FS\n" +
"^FT382,267^A0I,28,28^FH\\^FD";


var Ip7 = "^FS\n" +
"^PQ";

var Ip8 =",0,1,Y^XZ\n";

var miZpl ="\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO32,224^GFA,02560,02560,00016,:Z64:\n" +
    "eJztlc9r01AcwL/Jiy/FPbIK/sggrGGrODx1zkOYw24e5sGDF8uubQbzWqagsmnjNiaM4v4BwaEX2cEdvLgpW7Gl9SBz/0FrBfUgayeDRZ19Nj+bxLmBR9kXSvj0k+/7fr8v5AXgMP6/CEeC/8g+4iKcX9MnPjxDv/v4Kt318WNKfRynVPNyhtIND7K1JZrzMEPL9IufaxUPH6Hl+W0PI/qeqft4fSjt4Tb6rqL4uPztto/nNx0+kUgkRsprjTvNawKsjUFL8V3d9jxtxjb9ZVyMoaNG/4v0p1Gfs3+I0h2HoxbXvMzsUOpl0GtrFU8+NDKZnNdnps39w46PW/vr+ghtgDe/3XoerkdU9/Exs3yLQQBfvh0tb4VRPyrdvTVyeZw/lbq5Y3rSm02+7WLlvDhr5uNeMrQxOgXFDmx69hyZ1rqnYE5kTUYxgkB9Ey6KlmcWshi6VJgNmZ5D9V3CV8cjef2e6XEsS6CrHx6ILLZZBLXTzccyiYEqyEVrfaN+OqRiuWT1E0XLq/G5j2g1/3I1ME84ON/e81+EFfgx8ax/um7WZ/KawndKAwKZtNYHTcFYOiqEBZN5yBmMBZm3+oOKIrAS77AASYUHCT0EfsbmHl4jzDqwNqcVVJegAcjxCugEbQKadTxMNtfz+k4iCG5+UuGwJHjrg8nY7W/Y4NhJq38t23MJE15QiPU8SjwtZSW+MaDY8+NFTZ+As08reI/9OpDbKg0hVK0ur/RZzyM8OsOFCuc7uFTRul8lOFQAkUvaPEb4jaLBww6jcIkVcVI16/OfCIrl8zpXH3M8s5CrihzYfJ0wuUJa5Abt/FECuZws4sEpk0OpLOQKMfF4yuqnvfIc7n/Of22/0nbQPP80f4BPJ1pxDYIHrxHMixuPtmoXXqku973+4GO/B8uvBH3ygHzHA9udbXqt1SUjbdVirTeheXTKGiD3BsY4XHjvgauDsOAdk2meL4EvyB8x+HcVfA/3CCbAIT8m9s8O768Pw43flt8XJw==:0CA6\n" +
    "^FO512,224^GFA,03840,03840,00024,:Z64:\n" +
    "eJzt1L9rE2EYB/D3cqEp9bgLGOhBDhMKrpqQJWLwkAap6CDSopsRQTqIxkGtU84fDS5VBIcODsXN/0HwTZW0Q6BL3aq+drBL6KXUIUO41/e9K/rmfZ+rnSXPcDSfPrz3fX8dQqMa1aj+z3pXnKkmJmbnM6+uTr0RfOfk47nqpcnk7OKVW5t/WZs6f30WzWwmM80LUxmh/+eDi1+mv84tXPNubP86wnvTaf44+FsY/8kLjIm1np838B1D6G8t4099t1MMjFpHdLrcWXPy7VLTaHQuC96wt9pmba2kG+5SV/Db9rfOGN7Y140zSwPBH9r7zDuPdDNrfRC8Yv9gvl7Ss1nLEdyx99pOjflZ0xTzjNu4zSKWmsWXxrB70313Y29w8/N4UlwIGyEy8XSlvOINL5CN4CogZNHAvH9qp7wl/cuiNPF6O1NNqm6lV8niW8lzlB5Pr6afV+V+f9ckCfJ+XR0HjHSIG5CbNMhhuD81gB25gLP8KAUMxPIjjcTkXIhxJ8YtyAOEdA/u19RA0fqogVj+BkZ1td/fvbeL8tA4DYqVg1EIvadMoB76wJSd3KVBIwjGZG/5vJ+mJNYwPz+UPpPdY48ic2/YE/z3Od9vSa7zh+vSFob8I8WShznc74qHuV2f4hrkVHHjX14H/LTve3nA2ZZ5haO5c+BI8nD/ckEAe1w/jesfgG75XdnDPBbtx3hPduNwJ6CnKI5xD3SdubT+4T7qPkI1wLUB7KivXLA/5xgPe3jeAsC9KI58gfk559MKz7vomC8/UT8EmC8/id4jVo3395B8v/j8uSv3scC9j5RPaDly5b47kZdlNyNXvjOT0Xt7srMJ5Vh+LDubMDsOwHePoGOUKNPin1q2bidUr6AE9SqqW3xflDgsEIuiE9U1tuk5NQ67vZ7WBZjFocAwrBoByKMaFfoNqMMxWQ==:9E2C\n" +
    "^FT485,314^A0I,42,43^FH\\^FDINTEGRACION^FS\n" +
    "^FO338,252^GE58,54,6^FS\n" +
    "^FT659,216^A0I,28,28^FH\\^FDNOMBRE NOMBRE APELLIDO APELLIDO^FS\n" +
    "^BY4,3,91^FT516,91^BCI,,N,N\n" +
    "^FD>:553^FS\n" +
    "^FT180,101^A0I,31,31^FH\\^FD8902-6282^FS\n" +
    "^FT451,54^A0I,34,33^FH\\^FD0501199706845^FS\n" +
    "^FT650,100^A0I,31,31^FH\\^FD18010000^FS\n" +
    "^FT153,136^A0I,25,24^FH\\^FDCELULAR:^FS\n" +
    "^FT652,141^A0I,25,24^FH\\^FDEXPEDIENTE:^FS\n" +
    "^FT382,267^A0I,28,28^FH\\^FD14^FS\n" +
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





















function sendDataIntegracionIndividual(cel,nombre,tel,expediente,idIntegrante,numEquipo)
{

    console.log("INICIANDO SEND DATA");
    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {

            var contraPleca = String.fromCharCode(92);
            var idUs= '0'+idIntegrante;
           // alert(typeof(idUs));
var integracion ="INTEGRACION";
            var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");
            selected_printer.send(Ip1+nombreNuevo+Ip2+idUs+Ip3+tel+Ip4+expediente+Ip5+cel+Ip6+numEquipo+Ip7+1+Ip8);
            console.log(numEquipo);
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


