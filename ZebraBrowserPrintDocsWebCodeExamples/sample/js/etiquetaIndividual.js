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

var p1 = "^XA\n" +
    "^MMT\n" +
    "^PW812\n" +
    "^LL0609\n" +
    "^LS0\n" +
    "^FO0,384^GFA,06272,06272,00028,:Z64:\n" +
    "eJztlr1v20YYxo+iZcqOy3ORRYUPFi2gSKfCXQoWPVtqkCDN2L+gQmt0ysAujQzLEhMH6CbEyZIhQLIlY4Au3UTDgLQ5yNAhUyho8JYSLVDToaDrHUlHZ90d6y5dyseQbein53jvh+5eAHLlypXr/6GFjV/utJ7dufvFlr89XNwh2J2yD+bWvymu7/1w8+P7lz774+u1LY7BOet10bpX/QqXFq0H9bWrHPsI3/gNn9z7fGOr1Lb+2h7+xLEF4F4uWnerC9eWF63vSmsFfs3dk1e7J3svt3Gw7Vd3hvxeLqY6/bm4kP7YMY3AOPW8NjgGbzVvykwdNcxKWAn9AwJG7hHgGCToxy7GuOwcDtwBOfqQY8Y79H3XRo5tH2reMOraPDPR7SPHdMq1AWWH3V2O6Uvo9lvK7E4f+P7AHPPsMWq3nXmnTPpg6B/DlxzTfkWtzYbZsP0+GAWfwp95FqLmJnueNwCjFy24xzEQoOaqveTYXl8b2Bhq55ljYmyX/cO9PsJmkWcN1JhfoXkhB1F3qVzi8wLqqD4PAxh2Dggyl5fOF6NEA/EKzxddXCqAGZXPFogt52zApq9CtWrNepiW6atCSIjD68dPWifeLGes+OiW9XDercvYRvnWlf3CSPCtRFGolT+x9gvrUl/x0bK1f+2+lOEmuLJv/yndiyyGhPUyWJaPhJtqNq75csbiu6RYNX5eJ4NB+aIx0+SLJjGMM1glg0FXzQxPxlh8tP8DtQ80MxjOYKtyFtcPZvgMV85OKdU9FSNe0ZcwGt8pC1FkeuqbAEdkbsKIKwZvgG8T5onM1N4kzEcCWzVSFogMwSc0dspCU2RzLC+sR8Wk2fHvEQ1QV7Ax9YkJTSKedMhEVzDSo8ybZY2EvelNNIH5CaMJVbLfabIF5r33CUVKF4qi6J2KdZivMcvc6ZqzLA24Iyv8xdg4k63/e98Oa1DBB858WSxIyzyVkcFSX430fJWvRntX7SNehs8TToPU92UUuaq8UB9QsQotQyZT5LPCjhGFDzKm8EGaMoGlV7qUpT2oRz4QezBlNC3i4XPGXAlL3tAmQMKeJn+a75fgNN2c+P2LWXzjKBgkbD8Ci4u9QqsHxHMiZh3aLWctwAn9E2PdKbkEzISF6X/nxD6txUw8P42EjaWM7tyI2WzrJlHp8Q0o3gEsU3rsExmrTMJ8kQUpE1MdV04nvbH0HsNpDLL7bzWNXUxLkhjGZPctCzCKXkhCT8rNaiQdRAL21fQ0X8Za7CvmyucJOmPBiWIOoe/SQaMtQ0BnE4hiJtLYOASlIwo9POmjatLH0V2O2Wbk0kncgwojO5VUUo2RuXLlypXrP9HfzAIoFQ==:08AD\n" +
    "^FO608,384^GFA,05376,05376,00024,:Z64:\n" +
    "eJztl8+LHEUUx191Z3fGJcxMYIUmTmZaPLh4kL4I7TLMdMDgNQtZvAhp9OKxBhV7w0hXdkEvIh48eAhJjsGTx4BgOhnIetM/IJDKRtwQQ9LRLBm1pyuvf073dk0SRMhl37JD7bc//Z1Xr171dgEcxEG8iCCwPOeKIlVbeIcsNsVEal8ToiUzb4oHTHaDK8SORK4LIbhEP4K6LzFaDO+LQMK/i3xgVfUm6qFekUlXYELfVPkB6rIJuGIgxM8y/opsAoorLgjxqMqL8DyX8AtC3OSnfQkvLvDmn9X8Uf92ocq/hPphqK4Y6t0RUJk+CDUpPxAbUr0f3inqb61HsSawbg//jsfrVuHyv6EQt1M+1smROKaBEH9N42Er1rGfogjVB2I3HSZ64vkYK/TLNB6+F+uLWR1wxkkdlISf6VcSXS3wEGI+PxX5VJ8KMXVlPOaRrlfRH1w3b9wSP7gm/hCs6j+YipvCk/ATbJQin/p3BU4BqnxTbIkQqv5R+QIJr6I+KfKpf1QgX8KDeJC1Z8kfGz1Nfx+PG4xJ/PELsu4v8/Bmiu/zn4U6Ry/7Py+/WLsVuFMxEb73vht0p4Mg47lxcchMxplmG6umbqb+xKdsyDaAc80aOm/bZsabOrNhB/U6M7jpmVn+7SEMCQfua4z6ppXzbQqUeMAva2D4JmT+0KE6VT2Ln9Na1DFbOd/QdVtlFv+6Doa5Us/9a75Ba/COd0FbpgOnnfM9fdVvwBt867uj/qq5dDnzN6lBu2Ch3qKmqeW8jf4mAGd3Ih1WMn+KeUb62QkOMc8ZD9RoIT/BfGb1AYdalEa6Y9FIn+UDNtexnj1b7+X8InQDd0/44pbXdh91g1n9n7K+s39F5JnrW9FzfiWmLibqSu5PBO4KqO11p580w+iPlG8qHKmVJuF9mDQaPM+f+OCAWSO8Q/w24fn64vM0KhfhTcD15Zl/D0aoU0J4jfk6jPL+wSuIYaUVhp95fZxY95FXPd+a8T4cRR03Lycct2ov8/ehg/oICCc+6p28n6GB+gB57FGAhpL7dCPdwx51iryf8OgOZyI99ScJX5uif/SI6Jb9lSD175T9SYDz9ar+mBBvsoJ/mj+WNdHbGT+Jeb0Z8Tyfb1wfC3X1bFTnQj2TusV6VGenUH/LPGSosb9BnMJ62SZuK+CLbLZe8fpSs93D9V3w/N5sfWsqP/Pj5X5D5eSfSV9lhf5x3cnr2MtwOnxV/Pf+lPLzn293f1i69Aq7z+8u3V291Gf3Mv+p5/pd2B7fxI3mP+R5fZhHaQPGm4pu2jbOOPUn5KqHz5OtL1TbZEPPNFJegTGzVdQVy2S2p+mZPxkzqp5Vv1Sx2kOvbeT5I0+EusXquAqoZ/kfR56M1S2uRfyxnLeRh2vKJq+vgO0dNjL/T7eRv66y4JgDw5PtMv+byvqRP2gl/0jvoD+Fcj7wkboZ7TSb1Wf543zBUVkt2pWeZszq49u4fbeUiPeMvD57V10Khjq+ccwhWM+8f0K/MQG9sXOnEaqT773g/15fOf+i/NP3sUIk72ML6/vjlFWxSCLWX15fP7m2vHbihHXq1NqJZav4fvjx+eHtXR6MNnbP8cJ9rc86w8fbPPh84/E5r2j4wfnhDuoj5/eSHvG724lPSf/w6f6j/f6vIZ/4fPVc/s/IP9KPF3WlPty5zu+NNsonITxHJf5Dr3QI0/B3POaBQ6F8OOv+ioJn4Mi1inr9fjpoXCp9waFa8mq4cOMQ7IsBJt6/uF+NXt+s03tVGWOJ4QcraxXbNORHTUhbI555OfR5NyRJzdHrc76get5JgsmtZefZuRkt4M9BHMRBPC2eAB7wz6k=:0FFC\n" +
    "^FT548,505^A0I,56,57^FH\\^FDESCUELA DE^FS\n" +
    "^FT565,436^A0I,56,60^FH\\^FDMAYORDOMIA^FS\n" +
    "^FT792,348^A0I,45,45^FH\\^FD";

var p2 = "^FS\n" +
    "^FT555,274^A0I,51,52^FH\\^FD";

var p3 = ".";

var p4 ="^FS\n" +
    "^BY4,3,160^FT542,97^BCI,,N,N\n" +
    "^FD>:";

var p5 ="^FS\n" +
    "^FT781,53^A0I,28,28^FH\\^FD#A\\A4oDelReposo^FS\n" +
    "^FT338,41^A0I,17,14^FH\\^FDVALIDO UNICAMENTE PARA CLASES DE MAYORDOMIA^FS\n" +
    "^FT212,59^A0I,31,31^FH\\^FD2018^FS\n" +
    "^PQ1,0,1,Y^XZ";


var miZpl = "^XA\n" +
    "^MMT\n" +
    "^PW812\n" +
    "^LL0609\n" +
    "^LS0\n" +
    "^FO0,384^GFA,06272,06272,00028,:Z64:\n" +
    "eJztlr1v20YYxo+iZcqOy3ORRYUPFi2gSKfCXQoWPVtqkCDN2L+gQmt0ysAujQzLEhMH6CbEyZIhQLIlY4Au3UTDgLQ5yNAhUyho8JYSLVDToaDrHUlHZ90d6y5dyseQbein53jvh+5eAHLlypXr/6GFjV/utJ7dufvFlr89XNwh2J2yD+bWvymu7/1w8+P7lz774+u1LY7BOet10bpX/QqXFq0H9bWrHPsI3/gNn9z7fGOr1Lb+2h7+xLEF4F4uWnerC9eWF63vSmsFfs3dk1e7J3svt3Gw7Vd3hvxeLqY6/bm4kP7YMY3AOPW8NjgGbzVvykwdNcxKWAn9AwJG7hHgGCToxy7GuOwcDtwBOfqQY8Y79H3XRo5tH2reMOraPDPR7SPHdMq1AWWH3V2O6Uvo9lvK7E4f+P7AHPPsMWq3nXmnTPpg6B/DlxzTfkWtzYbZsP0+GAWfwp95FqLmJnueNwCjFy24xzEQoOaqveTYXl8b2Bhq55ljYmyX/cO9PsJmkWcN1JhfoXkhB1F3qVzi8wLqqD4PAxh2Dggyl5fOF6NEA/EKzxddXCqAGZXPFogt52zApq9CtWrNepiW6atCSIjD68dPWifeLGes+OiW9XDercvYRvnWlf3CSPCtRFGolT+x9gvrUl/x0bK1f+2+lOEmuLJv/yndiyyGhPUyWJaPhJtqNq75csbiu6RYNX5eJ4NB+aIx0+SLJjGMM1glg0FXzQxPxlh8tP8DtQ80MxjOYKtyFtcPZvgMV85OKdU9FSNe0ZcwGt8pC1FkeuqbAEdkbsKIKwZvgG8T5onM1N4kzEcCWzVSFogMwSc0dspCU2RzLC+sR8Wk2fHvEQ1QV7Ax9YkJTSKedMhEVzDSo8ybZY2EvelNNIH5CaMJVbLfabIF5r33CUVKF4qi6J2KdZivMcvc6ZqzLA24Iyv8xdg4k63/e98Oa1DBB858WSxIyzyVkcFSX430fJWvRntX7SNehs8TToPU92UUuaq8UB9QsQotQyZT5LPCjhGFDzKm8EGaMoGlV7qUpT2oRz4QezBlNC3i4XPGXAlL3tAmQMKeJn+a75fgNN2c+P2LWXzjKBgkbD8Ci4u9QqsHxHMiZh3aLWctwAn9E2PdKbkEzISF6X/nxD6txUw8P42EjaWM7tyI2WzrJlHp8Q0o3gEsU3rsExmrTMJ8kQUpE1MdV04nvbH0HsNpDLL7bzWNXUxLkhjGZPctCzCKXkhCT8rNaiQdRAL21fQ0X8Za7CvmyucJOmPBiWIOoe/SQaMtQ0BnE4hiJtLYOASlIwo9POmjatLH0V2O2Wbk0kncgwojO5VUUo2RuXLlypXrP9HfzAIoFQ==:08AD\n" +
    "^FO608,384^GFA,05376,05376,00024,:Z64:\n" +
    "eJztl8+LHEUUx191Z3fGJcxMYIUmTmZaPLh4kL4I7TLMdMDgNQtZvAhp9OKxBhV7w0hXdkEvIh48eAhJjsGTx4BgOhnIetM/IJDKRtwQQ9LRLBm1pyuvf073dk0SRMhl37JD7bc//Z1Xr171dgEcxEG8iCCwPOeKIlVbeIcsNsVEal8ToiUzb4oHTHaDK8SORK4LIbhEP4K6LzFaDO+LQMK/i3xgVfUm6qFekUlXYELfVPkB6rIJuGIgxM8y/opsAoorLgjxqMqL8DyX8AtC3OSnfQkvLvDmn9X8Uf92ocq/hPphqK4Y6t0RUJk+CDUpPxAbUr0f3inqb61HsSawbg//jsfrVuHyv6EQt1M+1smROKaBEH9N42Er1rGfogjVB2I3HSZ64vkYK/TLNB6+F+uLWR1wxkkdlISf6VcSXS3wEGI+PxX5VJ8KMXVlPOaRrlfRH1w3b9wSP7gm/hCs6j+YipvCk/ATbJQin/p3BU4BqnxTbIkQqv5R+QIJr6I+KfKpf1QgX8KDeJC1Z8kfGz1Nfx+PG4xJ/PELsu4v8/Bmiu/zn4U6Ry/7Py+/WLsVuFMxEb73vht0p4Mg47lxcchMxplmG6umbqb+xKdsyDaAc80aOm/bZsabOrNhB/U6M7jpmVn+7SEMCQfua4z6ppXzbQqUeMAva2D4JmT+0KE6VT2Ln9Na1DFbOd/QdVtlFv+6Doa5Us/9a75Ba/COd0FbpgOnnfM9fdVvwBt867uj/qq5dDnzN6lBu2Ch3qKmqeW8jf4mAGd3Ih1WMn+KeUb62QkOMc8ZD9RoIT/BfGb1AYdalEa6Y9FIn+UDNtexnj1b7+X8InQDd0/44pbXdh91g1n9n7K+s39F5JnrW9FzfiWmLibqSu5PBO4KqO11p580w+iPlG8qHKmVJuF9mDQaPM+f+OCAWSO8Q/w24fn64vM0KhfhTcD15Zl/D0aoU0J4jfk6jPL+wSuIYaUVhp95fZxY95FXPd+a8T4cRR03Lycct2ov8/ehg/oICCc+6p28n6GB+gB57FGAhpL7dCPdwx51iryf8OgOZyI99ScJX5uif/SI6Jb9lSD175T9SYDz9ar+mBBvsoJ/mj+WNdHbGT+Jeb0Z8Tyfb1wfC3X1bFTnQj2TusV6VGenUH/LPGSosb9BnMJ62SZuK+CLbLZe8fpSs93D9V3w/N5sfWsqP/Pj5X5D5eSfSV9lhf5x3cnr2MtwOnxV/Pf+lPLzn293f1i69Aq7z+8u3V291Gf3Mv+p5/pd2B7fxI3mP+R5fZhHaQPGm4pu2jbOOPUn5KqHz5OtL1TbZEPPNFJegTGzVdQVy2S2p+mZPxkzqp5Vv1Sx2kOvbeT5I0+EusXquAqoZ/kfR56M1S2uRfyxnLeRh2vKJq+vgO0dNjL/T7eRv66y4JgDw5PtMv+byvqRP2gl/0jvoD+Fcj7wkboZ7TSb1Wf543zBUVkt2pWeZszq49u4fbeUiPeMvD57V10Khjq+ccwhWM+8f0K/MQG9sXOnEaqT773g/15fOf+i/NP3sUIk72ML6/vjlFWxSCLWX15fP7m2vHbihHXq1NqJZav4fvjx+eHtXR6MNnbP8cJ9rc86w8fbPPh84/E5r2j4wfnhDuoj5/eSHvG724lPSf/w6f6j/f6vIZ/4fPVc/s/IP9KPF3WlPty5zu+NNsonITxHJf5Dr3QI0/B3POaBQ6F8OOv+ioJn4Mi1inr9fjpoXCp9waFa8mq4cOMQ7IsBJt6/uF+NXt+s03tVGWOJ4QcraxXbNORHTUhbI555OfR5NyRJzdHrc76get5JgsmtZefZuRkt4M9BHMRBPC2eAB7wz6k=:0FFC\n" +
    "^FT548,505^A0I,56,57^FH\\^FDESCUELA DE^FS\n" +
    "^FT565,436^A0I,56,60^FH\\^FDMAYORDOMIA^FS\n" +
    "^FT792,348^A0I,45,45^FH\\^FDMELVIN DAVID ORTIZ RAMOS^FS\n" +
    "^FT555,274^A0I,51,52^FH\\^FD1.MESULAM^FS\n" +
    "^BY4,3,160^FT542,97^BCI,,N,N\n" +
    "^FD>;1338^FS\n" +
    "^FT781,53^A0I,28,28^FH\\^FD#A\\A4oDelReposo^FS\n" +
    "^FT338,41^A0I,17,14^FH\\^FDVALIDO UNICAMENTE PARA CLASES DE MAYORDOMIA^FS\n" +
    "^FT212,59^A0I,31,31^FH\\^FD2018^FS\n" +
    "^PQ1,0,1,Y^XZ";


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




function tomarDatosDetalleIntegrante(idIntegrante){
    var url = 'php/buscar_detalleIntegrante.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'nombrePersona='+idIntegrante,
        success: function(valores){
                var datos= eval(valores);

           sendDataEtiqueta(datos[0],datos[1],datos[2],datos[3],datos[4]);



        }
    });
    return false;
}


function sendDataEtiqueta(nombre,numEquipo,nombreEquipo,idIntegrante,orden)
{

    console.log("INICIANDO SEND DATA");

    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {

            if(orden == 1){
                var contraPleca = String.fromCharCode(92);

                var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");
                var nombreEquipoNuevo = nombreEquipo.replace("Ñ",contraPleca+"A5");
                //  console.log(nombre+"-"+numEquipo+"."+nombreEquipo+"-"+idIntegrante);

                selected_printer.send(p1+nombreNuevo+p2+numEquipo+p3+nombreEquipoNuevo+p4+idIntegrante+p5);
            }else{
                    alertify.error("INTEGRANTE NO ENLAZADO EN PROMOCION ACTUAL");
            }




        }
        else
        {
            printerError(text);
        }
})
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


