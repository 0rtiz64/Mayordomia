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
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO480,192^GFA,05376,05376,00028,:Z64:\n" +
    "eJztls9rG0cUx996ba8ShFbBCVZg61VcFwo5eHXbgCr5oJD4UIrbBNpT5LqlPSVKCkkMwdoQii8h6A/IJeQfyD9g2JBCoSRKcu2lmyxEOZTulh4ssKvJe7uSs6uZ2dCcStAD2cIff+f9mDdvBmBiE5vYxP6H9n2wM9e9bn+xatdaP59itpNgn5yY6XyVa3zzeUPrbK6caCRZ9X7+2e+5X87qU4c7q817V5Ls9LfHKhe+bpxZnZ3vVD5an06yxtJM58tc4+yh76Y6lemPU+wztqP+cf0Uu1CttZTNF6lY3tfKsAhlGxbL5QJ+W0yxluGDxxRmW21nw+kqboJZJR9eBLdY3tpz1292lWQs9X6v5N/a1gzL89ZZt5LUmaFf9ZWuVqi4zSa7s5nUGS1/q4fM/Ntptf4p/JvU5T3/h1fwWNOReRv6k6Su4PZ6PWR2xbkcXtWfJnWzrv+oB13NQtav6dtJneb6N8mfVXn4092ariZ1quMD5fCp5fm3jUIqPxV6sM62mRmyXwtGPlUXBV5CeaAga9/RcjlwUiwEuAHt+dBc0IowZu74HxJCZMr58+fo+3RxJQ3Rg8rYQK8u7v52Y9dJ6eiDTGksFNdmUrHEiQxQ1zg693zqFcdinVFcmy5ykZE/ZSlXXPvxgVCnGzD/3LrG+wuCv6Q5ok7GyF8+Q6d7cp2+n+GPcSEe6ECyaKQ70hfrovy25Dow5f4g1X9jOlUYDO0f/grlOmw3qT+oZeiEgQ73T8vQqY7EX3sAqYOS1LVZqHgyHdsXJWjHOgYtAYt1zLV51joes9DgmXcS87sUBKGg17zNWNcv8Bm4PjIT2ayA0bmtIOeLFpequsUGqoTV68iccRavVH/KmMKx+ZgxZO44i6Nb7gUBzwoZuiHbw2J74yx/oPtvLK6+Saw5zkoj3YDf3NJIJ2C56KdOPcqtaWfoDtg+WO/BBqyfoctiIXAN+m6G+XlSxlgWczOYI4tTY4MMxkBWT43GAacrvWWSvVWDP4Hfv7hfVCwnr4uZgiWT6RQsC8+GJxnLwvfnkLUdOaPp6Y6z4SnHy115JmYXAQSDMGIqhcKf6WgCaJQCPwuilXRKnZ8hETOpZPzsiVgdu1o0zL0R42ddVP02bd8Cz5r4uUQ3hGB+2iNdlWfGiAnm9ULERG0Wh7dFOo9n2nBN0Z1DZSQmunDp/4lpDs/IzzK2py5AFB/VTFCWKC/aB0HqUYK0f8IHhe7QvguvRny8Ur9oghQwiZBeIeK3Br0IipI3CtQdFL8WMx0XNYWhUOc6quQtFW2f5A0W3fAyGV5mrhRNbGIfir0Bn+jtCA==:4CAC\n" +
    "^FO0,192^GFA,04608,04608,00024,:Z64:\n" +
    "eJztlD1uhDAQhQdRkCLKHsHXSOej4aMh5SI+AiVSEI5Z5s/2UK02lZ+28H6YN8PzAEBXV1dXV9e/K4nCu/mQkr3/lh82n+/4bnN/xzebuzu+vplL3Vk4aO4ZHwV/MM9M+Y/MY94kXAovAFMUzoXhA8aF6Dc4xDt8KX7AhHwFF5gPKf/I3kfmjzN0eqq0Mfd524Q2+Ubm5/+ro3Be/1n4oXZ4VsggN/aL3CU1SfN1uVpefS2ypEgmzIiWNGIeM0V7NkqyacZg1DkEsscbaB3JHjepQ+OEtQ69X2lTnlqxOEJRALPAIc/b2FsFYjUjhb0ewkv02o0V5zGsOJ2RmvKn+EzLTmX6y04j87LTINwpLB+TssCmuC6g7IsCQXMpoO11FGvBi/dRi6MoMWe9V3y07bnAUnNv2lMUW8OHNoRLcxPCJdeEIJ02XWKnTZfYqYVzFHUIVMC0zwVM+1zAxvB5w7u6urpe0R8RqVAn:4004\n" +
    "^FT496,285^A0I,51,50^FH\\^FDPROMOCION 5^FS\n" +
    "^BY5,3,98^FT523,54^BCI,,N,N\n" +
    "^FD>;";


var p2 = "^FS\n" +
"^FO46,46^GE124,116,8^FS\n" +
"^FT142,79^A0I,70,72^FH\\^FD";

var p3 ="^FS\n" +
"^FT603,177^A0I,39,38^FB493,1,0,C^FH\\^FDBOLETO PARA TOGA Y BIRRETE^FS\n" +
"^PQ1,0,1,Y^XZ\n";

var miZpl ="^XA\n" +
    "^MMT\n" +
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO480,192^GFA,05376,05376,00028,:Z64:\n" +
    "eJztls9rG0cUx996ba8ShFbBCVZg61VcFwo5eHXbgCr5oJD4UIrbBNpT5LqlPSVKCkkMwdoQii8h6A/IJeQfyD9g2JBCoSRKcu2lmyxEOZTulh4ssKvJe7uSs6uZ2dCcStAD2cIff+f9mDdvBmBiE5vYxP6H9n2wM9e9bn+xatdaP59itpNgn5yY6XyVa3zzeUPrbK6caCRZ9X7+2e+5X87qU4c7q817V5Ls9LfHKhe+bpxZnZ3vVD5an06yxtJM58tc4+yh76Y6lemPU+wztqP+cf0Uu1CttZTNF6lY3tfKsAhlGxbL5QJ+W0yxluGDxxRmW21nw+kqboJZJR9eBLdY3tpz1292lWQs9X6v5N/a1gzL89ZZt5LUmaFf9ZWuVqi4zSa7s5nUGS1/q4fM/Ntptf4p/JvU5T3/h1fwWNOReRv6k6Su4PZ6PWR2xbkcXtWfJnWzrv+oB13NQtav6dtJneb6N8mfVXn4092ariZ1quMD5fCp5fm3jUIqPxV6sM62mRmyXwtGPlUXBV5CeaAga9/RcjlwUiwEuAHt+dBc0IowZu74HxJCZMr58+fo+3RxJQ3Rg8rYQK8u7v52Y9dJ6eiDTGksFNdmUrHEiQxQ1zg693zqFcdinVFcmy5ykZE/ZSlXXPvxgVCnGzD/3LrG+wuCv6Q5ok7GyF8+Q6d7cp2+n+GPcSEe6ECyaKQ70hfrovy25Dow5f4g1X9jOlUYDO0f/grlOmw3qT+oZeiEgQ73T8vQqY7EX3sAqYOS1LVZqHgyHdsXJWjHOgYtAYt1zLV51joes9DgmXcS87sUBKGg17zNWNcv8Bm4PjIT2ayA0bmtIOeLFpequsUGqoTV68iccRavVH/KmMKx+ZgxZO44i6Nb7gUBzwoZuiHbw2J74yx/oPtvLK6+Saw5zkoj3YDf3NJIJ2C56KdOPcqtaWfoDtg+WO/BBqyfoctiIXAN+m6G+XlSxlgWczOYI4tTY4MMxkBWT43GAacrvWWSvVWDP4Hfv7hfVCwnr4uZgiWT6RQsC8+GJxnLwvfnkLUdOaPp6Y6z4SnHy115JmYXAQSDMGIqhcKf6WgCaJQCPwuilXRKnZ8hETOpZPzsiVgdu1o0zL0R42ddVP02bd8Cz5r4uUQ3hGB+2iNdlWfGiAnm9ULERG0Wh7dFOo9n2nBN0Z1DZSQmunDp/4lpDs/IzzK2py5AFB/VTFCWKC/aB0HqUYK0f8IHhe7QvguvRny8Ur9oghQwiZBeIeK3Br0IipI3CtQdFL8WMx0XNYWhUOc6quQtFW2f5A0W3fAyGV5mrhRNbGIfir0Bn+jtCA==:4CAC\n" +
    "^FO0,192^GFA,04608,04608,00024,:Z64:\n" +
    "eJztlD1uhDAQhQdRkCLKHsHXSOej4aMh5SI+AiVSEI5Z5s/2UK02lZ+28H6YN8PzAEBXV1dXV9e/K4nCu/mQkr3/lh82n+/4bnN/xzebuzu+vplL3Vk4aO4ZHwV/MM9M+Y/MY94kXAovAFMUzoXhA8aF6Dc4xDt8KX7AhHwFF5gPKf/I3kfmjzN0eqq0Mfd524Q2+Ubm5/+ro3Be/1n4oXZ4VsggN/aL3CU1SfN1uVpefS2ypEgmzIiWNGIeM0V7NkqyacZg1DkEsscbaB3JHjepQ+OEtQ69X2lTnlqxOEJRALPAIc/b2FsFYjUjhb0ewkv02o0V5zGsOJ2RmvKn+EzLTmX6y04j87LTINwpLB+TssCmuC6g7IsCQXMpoO11FGvBi/dRi6MoMWe9V3y07bnAUnNv2lMUW8OHNoRLcxPCJdeEIJ02XWKnTZfYqYVzFHUIVMC0zwVM+1zAxvB5w7u6urpe0R8RqVAn:4004\n" +
    "^FT496,285^A0I,51,50^FH\\^FDPROMOCION 5^FS\n" +
    "^BY5,3,98^FT523,54^BCI,,N,N\n" +
    "^FD>;9010^FS\n" +
    "^FO46,46^GE124,116,8^FS\n" +
    "^FT142,79^A0I,70,72^FH\\^FD30^FS\n" +
    "^FT603,177^A0I,39,38^FB493,1,0,C^FH\\^FDBOLETO PARA TOGA Y BIRRETE^FS\n" +
    "^PQ1,0,1,Y^XZ\n";



var ip1 = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO480,192^GFA,05376,05376,00028,:Z64:\n" +
    "eJztls9rG0cUx996ba8ShFbBCVZg61VcFwo5eHXbgCr5oJD4UIrbBNpT5LqlPSVKCkkMwdoQii8h6A/IJeQfyD9g2JBCoSRKcu2lmyxEOZTulh4ssKvJe7uSs6uZ2dCcStAD2cIff+f9mDdvBmBiE5vYxP6H9n2wM9e9bn+xatdaP59itpNgn5yY6XyVa3zzeUPrbK6caCRZ9X7+2e+5X87qU4c7q817V5Ls9LfHKhe+bpxZnZ3vVD5an06yxtJM58tc4+yh76Y6lemPU+wztqP+cf0Uu1CttZTNF6lY3tfKsAhlGxbL5QJ+W0yxluGDxxRmW21nw+kqboJZJR9eBLdY3tpz1292lWQs9X6v5N/a1gzL89ZZt5LUmaFf9ZWuVqi4zSa7s5nUGS1/q4fM/Ntptf4p/JvU5T3/h1fwWNOReRv6k6Su4PZ6PWR2xbkcXtWfJnWzrv+oB13NQtav6dtJneb6N8mfVXn4092ariZ1quMD5fCp5fm3jUIqPxV6sM62mRmyXwtGPlUXBV5CeaAga9/RcjlwUiwEuAHt+dBc0IowZu74HxJCZMr58+fo+3RxJQ3Rg8rYQK8u7v52Y9dJ6eiDTGksFNdmUrHEiQxQ1zg693zqFcdinVFcmy5ykZE/ZSlXXPvxgVCnGzD/3LrG+wuCv6Q5ok7GyF8+Q6d7cp2+n+GPcSEe6ECyaKQ70hfrovy25Dow5f4g1X9jOlUYDO0f/grlOmw3qT+oZeiEgQ73T8vQqY7EX3sAqYOS1LVZqHgyHdsXJWjHOgYtAYt1zLV51joes9DgmXcS87sUBKGg17zNWNcv8Bm4PjIT2ayA0bmtIOeLFpequsUGqoTV68iccRavVH/KmMKx+ZgxZO44i6Nb7gUBzwoZuiHbw2J74yx/oPtvLK6+Saw5zkoj3YDf3NJIJ2C56KdOPcqtaWfoDtg+WO/BBqyfoctiIXAN+m6G+XlSxlgWczOYI4tTY4MMxkBWT43GAacrvWWSvVWDP4Hfv7hfVCwnr4uZgiWT6RQsC8+GJxnLwvfnkLUdOaPp6Y6z4SnHy115JmYXAQSDMGIqhcKf6WgCaJQCPwuilXRKnZ8hETOpZPzsiVgdu1o0zL0R42ddVP02bd8Cz5r4uUQ3hGB+2iNdlWfGiAnm9ULERG0Wh7dFOo9n2nBN0Z1DZSQmunDp/4lpDs/IzzK2py5AFB/VTFCWKC/aB0HqUYK0f8IHhe7QvguvRny8Ur9oghQwiZBeIeK3Br0IipI3CtQdFL8WMx0XNYWhUOc6quQtFW2f5A0W3fAyGV5mrhRNbGIfir0Bn+jtCA==:4CAC\n" +
    "^FO0,192^GFA,04608,04608,00024,:Z64:\n" +
    "eJztlD1uhDAQhQdRkCLKHsHXSOej4aMh5SI+AiVSEI5Z5s/2UK02lZ+28H6YN8PzAEBXV1dXV9e/K4nCu/mQkr3/lh82n+/4bnN/xzebuzu+vplL3Vk4aO4ZHwV/MM9M+Y/MY94kXAovAFMUzoXhA8aF6Dc4xDt8KX7AhHwFF5gPKf/I3kfmjzN0eqq0Mfd524Q2+Ubm5/+ro3Be/1n4oXZ4VsggN/aL3CU1SfN1uVpefS2ypEgmzIiWNGIeM0V7NkqyacZg1DkEsscbaB3JHjepQ+OEtQ69X2lTnlqxOEJRALPAIc/b2FsFYjUjhb0ewkv02o0V5zGsOJ2RmvKn+EzLTmX6y04j87LTINwpLB+TssCmuC6g7IsCQXMpoO11FGvBi/dRi6MoMWe9V3y07bnAUnNv2lMUW8OHNoRLcxPCJdeEIJ02XWKnTZfYqYVzFHUIVMC0zwVM+1zAxvB5w7u6urpe0R8RqVAn:4004\n" +
    "^FT496,285^A0I,51,50^FH\\^FD";

var ip2 ="^FS\n" +
"^BY5,3,98^FT523,54^BCI,,N,N\n" +
"^FD>;";

var ip3 = "^FS\n" +
"^FO46,46^GE124,116,8^FS\n" +
"^FT142,79^A0I,70,72^FH\\^FD";

var ip4 = "^FS\n" +
"^FT603,177^A0I,39,38^FB493,1,0,C^FH\\^FDBOLETO PARA TOGA Y BIRRETE^FS\n" +
"^PQ1,0,1,Y^XZ\n";


var miIzpl  = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO480,192^GFA,05376,05376,00028,:Z64:\n" +
    "eJztls9rG0cUx996ba8ShFbBCVZg61VcFwo5eHXbgCr5oJD4UIrbBNpT5LqlPSVKCkkMwdoQii8h6A/IJeQfyD9g2JBCoSRKcu2lmyxEOZTulh4ssKvJe7uSs6uZ2dCcStAD2cIff+f9mDdvBmBiE5vYxP6H9n2wM9e9bn+xatdaP59itpNgn5yY6XyVa3zzeUPrbK6caCRZ9X7+2e+5X87qU4c7q817V5Ls9LfHKhe+bpxZnZ3vVD5an06yxtJM58tc4+yh76Y6lemPU+wztqP+cf0Uu1CttZTNF6lY3tfKsAhlGxbL5QJ+W0yxluGDxxRmW21nw+kqboJZJR9eBLdY3tpz1292lWQs9X6v5N/a1gzL89ZZt5LUmaFf9ZWuVqi4zSa7s5nUGS1/q4fM/Ntptf4p/JvU5T3/h1fwWNOReRv6k6Su4PZ6PWR2xbkcXtWfJnWzrv+oB13NQtav6dtJneb6N8mfVXn4092ariZ1quMD5fCp5fm3jUIqPxV6sM62mRmyXwtGPlUXBV5CeaAga9/RcjlwUiwEuAHt+dBc0IowZu74HxJCZMr58+fo+3RxJQ3Rg8rYQK8u7v52Y9dJ6eiDTGksFNdmUrHEiQxQ1zg693zqFcdinVFcmy5ykZE/ZSlXXPvxgVCnGzD/3LrG+wuCv6Q5ok7GyF8+Q6d7cp2+n+GPcSEe6ECyaKQ70hfrovy25Dow5f4g1X9jOlUYDO0f/grlOmw3qT+oZeiEgQ73T8vQqY7EX3sAqYOS1LVZqHgyHdsXJWjHOgYtAYt1zLV51joes9DgmXcS87sUBKGg17zNWNcv8Bm4PjIT2ayA0bmtIOeLFpequsUGqoTV68iccRavVH/KmMKx+ZgxZO44i6Nb7gUBzwoZuiHbw2J74yx/oPtvLK6+Saw5zkoj3YDf3NJIJ2C56KdOPcqtaWfoDtg+WO/BBqyfoctiIXAN+m6G+XlSxlgWczOYI4tTY4MMxkBWT43GAacrvWWSvVWDP4Hfv7hfVCwnr4uZgiWT6RQsC8+GJxnLwvfnkLUdOaPp6Y6z4SnHy115JmYXAQSDMGIqhcKf6WgCaJQCPwuilXRKnZ8hETOpZPzsiVgdu1o0zL0R42ddVP02bd8Cz5r4uUQ3hGB+2iNdlWfGiAnm9ULERG0Wh7dFOo9n2nBN0Z1DZSQmunDp/4lpDs/IzzK2py5AFB/VTFCWKC/aB0HqUYK0f8IHhe7QvguvRny8Ur9oghQwiZBeIeK3Br0IipI3CtQdFL8WMx0XNYWhUOc6quQtFW2f5A0W3fAyGV5mrhRNbGIfir0Bn+jtCA==:4CAC\n" +
    "^FO0,192^GFA,04608,04608,00024,:Z64:\n" +
    "eJztlD1uhDAQhQdRkCLKHsHXSOej4aMh5SI+AiVSEI5Z5s/2UK02lZ+28H6YN8PzAEBXV1dXV9e/K4nCu/mQkr3/lh82n+/4bnN/xzebuzu+vplL3Vk4aO4ZHwV/MM9M+Y/MY94kXAovAFMUzoXhA8aF6Dc4xDt8KX7AhHwFF5gPKf/I3kfmjzN0eqq0Mfd524Q2+Ubm5/+ro3Be/1n4oXZ4VsggN/aL3CU1SfN1uVpefS2ypEgmzIiWNGIeM0V7NkqyacZg1DkEsscbaB3JHjepQ+OEtQ69X2lTnlqxOEJRALPAIc/b2FsFYjUjhb0ewkv02o0V5zGsOJ2RmvKn+EzLTmX6y04j87LTINwpLB+TssCmuC6g7IsCQXMpoO11FGvBi/dRi6MoMWe9V3y07bnAUnNv2lMUW8OHNoRLcxPCJdeEIJ02XWKnTZfYqYVzFHUIVMC0zwVM+1zAxvB5w7u6urpe0R8RqVAn:4004\n" +
    "^FT496,285^A0I,51,50^FH\\^FDPROMOCION 5^FS\n" +
    "^BY5,3,98^FT523,54^BCI,,N,N\n" +
    "^FD>;9010^FS\n" +
    "^FO46,46^GE124,116,8^FS\n" +
    "^FT142,79^A0I,70,72^FH\\^FD30^FS\n" +
    "^FT603,177^A0I,39,38^FB493,1,0,C^FH\\^FDBOLETO PARA TOGA Y BIRRETE^FS\n" +
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


function togaIndividual(idIntegrante) {
    var url = "php/togaIndividualDatos.php";

    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidIntegrante: idIntegrante
        },
        success: function (datos) {
var data = eval(datos);
var numEquipo = data[0];
var promocion = data[1];
            sendDataTogaIndividual(idIntegrante,numEquipo,promocion);

            return false;
        }
    });

    return false;
}


function sendDataTogaIndividual(idIntegrante,numEquipo,promocion)
{

    console.log("INICIANDO SEND DATA");
    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {
                selected_printer.send(ip1+promocion+ip2+idIntegrante+ip3+numEquipo+ip4);
        }
        else
        {
            printerError(text);
        }
    });
};

function sendData(response)
{

    console.log("INICIANDO SEND DATA");
    console.log(response);
   // console.log(response);
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
                   var promocion = String (jsonData[i][2]);


                }


               selected_printer.send(ip1+promocion+ip2+idInterno+ip3+numEquipo+ip4);
               console.log(ip1+promocion+ip2+idInterno+ip3+numEquipo+ip4);

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


