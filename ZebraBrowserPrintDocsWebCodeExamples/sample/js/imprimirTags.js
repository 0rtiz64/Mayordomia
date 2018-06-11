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

var p1="\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW691\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO32,224^GFA,02560,02560,00016,:Z64:\n" +
    "eJztlc9r01AcwL/Jiy/FPbIK/sggrGGrODx1zkOYw24e5sGDF8uubQbzWqagsmnjNiaM4v4BwaEX2cEdvLgpW7Gl9SBz/0FrBfUgayeDRZ19Nj+bxLmBR9kXSvj0k+/7fr8v5AXgMP6/CEeC/8g+4iKcX9MnPjxDv/v4Kt318WNKfRynVPNyhtIND7K1JZrzMEPL9IufaxUPH6Hl+W0PI/qeqft4fSjt4Tb6rqL4uPztto/nNx0+kUgkRsprjTvNawKsjUFL8V3d9jxtxjb9ZVyMoaNG/4v0p1Gfs3+I0h2HoxbXvMzsUOpl0GtrFU8+NDKZnNdnps39w46PW/vr+ghtgDe/3XoerkdU9/Exs3yLQQBfvh0tb4VRPyrdvTVyeZw/lbq5Y3rSm02+7WLlvDhr5uNeMrQxOgXFDmx69hyZ1rqnYE5kTUYxgkB9Ey6KlmcWshi6VJgNmZ5D9V3CV8cjef2e6XEsS6CrHx6ILLZZBLXTzccyiYEqyEVrfaN+OqRiuWT1E0XLq/G5j2g1/3I1ME84ON/e81+EFfgx8ax/um7WZ/KawndKAwKZtNYHTcFYOiqEBZN5yBmMBZm3+oOKIrAS77AASYUHCT0EfsbmHl4jzDqwNqcVVJegAcjxCugEbQKadTxMNtfz+k4iCG5+UuGwJHjrg8nY7W/Y4NhJq38t23MJE15QiPU8SjwtZSW+MaDY8+NFTZ+As08reI/9OpDbKg0hVK0ur/RZzyM8OsOFCuc7uFTRul8lOFQAkUvaPEb4jaLBww6jcIkVcVI16/OfCIrl8zpXH3M8s5CrihzYfJ0wuUJa5Abt/FECuZws4sEpk0OpLOQKMfF4yuqnvfIc7n/Of22/0nbQPP80f4BPJ1pxDYIHrxHMixuPtmoXXqku973+4GO/B8uvBH3ygHzHA9udbXqt1SUjbdVirTeheXTKGiD3BsY4XHjvgauDsOAdk2meL4EvyB8x+HcVfA/3CCbAIT8m9s8O768Pw43flt8XJw==:0CA6\n" +
    "^FO512,224^GFA,03840,03840,00024,:Z64:\n" +
    "eJzt1L9rE2EYB/D3cqEp9bgLGOhBDhMKrpqQJWLwkAap6CDSopsRQTqIxkGtU84fDS5VBIcODsXN/0HwTZW0Q6BL3aq+drBL6KXUIUO41/e9K/rmfZ+rnSXPcDSfPrz3fX8dQqMa1aj+z3pXnKkmJmbnM6+uTr0RfOfk47nqpcnk7OKVW5t/WZs6f30WzWwmM80LUxmh/+eDi1+mv84tXPNubP86wnvTaf44+FsY/8kLjIm1np838B1D6G8t4099t1MMjFpHdLrcWXPy7VLTaHQuC96wt9pmba2kG+5SV/Db9rfOGN7Y140zSwPBH9r7zDuPdDNrfRC8Yv9gvl7Ss1nLEdyx99pOjflZ0xTzjNu4zSKWmsWXxrB70313Y29w8/N4UlwIGyEy8XSlvOINL5CN4CogZNHAvH9qp7wl/cuiNPF6O1NNqm6lV8niW8lzlB5Pr6afV+V+f9ckCfJ+XR0HjHSIG5CbNMhhuD81gB25gLP8KAUMxPIjjcTkXIhxJ8YtyAOEdA/u19RA0fqogVj+BkZ1td/fvbeL8tA4DYqVg1EIvadMoB76wJSd3KVBIwjGZG/5vJ+mJNYwPz+UPpPdY48ic2/YE/z3Od9vSa7zh+vSFob8I8WShznc74qHuV2f4hrkVHHjX14H/LTve3nA2ZZ5haO5c+BI8nD/ckEAe1w/jesfgG75XdnDPBbtx3hPduNwJ6CnKI5xD3SdubT+4T7qPkI1wLUB7KivXLA/5xgPe3jeAsC9KI58gfk559MKz7vomC8/UT8EmC8/id4jVo3395B8v/j8uSv3scC9j5RPaDly5b47kZdlNyNXvjOT0Xt7srMJ5Vh+LDubMDsOwHePoGOUKNPin1q2bidUr6AE9SqqW3xflDgsEIuiE9U1tuk5NQ67vZ7WBZjFocAwrBoByKMaFfoNqMMxWQ==:9E2C\n" +
    "^FT485,314^A0I,42,43^FH\\^FD";

var p2 = "^FS\n" +
"^FT659,183^A0I,28,28^FH\\^FD";


var pastP2 = "^FS\n" +
    "^FT659,216^A0I,28,28^FH\\^FD";

var p3 ="^FS\n" +
"^BY4,3,91^FT481,69^BCI,,N,N\n" +
"^FD>:";

var p4 ="^FS\n" +
"^FT173,32^A0I,34,33^FH\\^FD";

var p5 ="^FS\n" +
"^FT451,32^A0I,34,33^FH\\^FD";

var p6 = "^FS\n" +
"^FT639,30^A0I,34,31^FH\\^FD";

var p7="^FS\n" +
"^FT157,103^A0I,25,24^FH\\^FDCELULAR:^FS\n" +
"^FT652,107^A0I,25,24^FH\\^FDEXPEDIENTE:^FS\n" +
"^PQ";

var p8=",0,1,Y^XZ\n";

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
    "^FT485,314^A0I,42,43^FH\\^FDPROMOCION 32^FS\n" +
    "^FT659,216^A0I,28,28^FH\\^FDMELVIN DAVID ORTIZ RAMOS^FS\n" +
    "^BY4,3,91^FT481,69^BCI,,N,N\n" +
    "^FD>:553^FS\n" +
    "^FT173,32^A0I,34,33^FH\\^FD89026282^FS\n" +
    "^FT451,32^A0I,34,33^FH\\^FD0501199706845^FS\n" +
    "^FT639,30^A0I,34,31^FH\\^FD18010000^FS\n" +
    "^FT157,103^A0I,25,24^FH\\^FDCELULAR:^FS\n" +
    "^FT652,107^A0I,25,24^FH\\^FDEXPEDIENTE:^FS\n" +
    "^PQ1,0,1,Y^XZ\n";


var encabezado = '^XA\n' +
    '^MMT\n' +
    '^PW691\n' +
    '^LL0386\n' +
    '^LS0\n' +
    '^FO32,224^GFA,02560,02560,00016,:Z64:\n' +
    'eJztlc9r01AcwL/Jiy/FPbIK/sggrGGrODx1zkOYw24e5sGDF8uubQbzWqagsmnjNiaM4v4BwaEX2cEdvLgpW7Gl9SBz/0FrBfUgayeDRZ19Nj+bxLmBR9kXSvj0k+/7fr8v5AXgMP6/CEeC/8g+4iKcX9MnPjxDv/v4Kt318WNKfRynVPNyhtIND7K1JZrzMEPL9IufaxUPH6Hl+W0PI/qeqft4fSjt4Tb6rqL4uPztto/nNx0+kUgkRsprjTvNawKsjUFL8V3d9jxtxjb9ZVyMoaNG/4v0p1Gfs3+I0h2HoxbXvMzsUOpl0GtrFU8+NDKZnNdnps39w46PW/vr+ghtgDe/3XoerkdU9/Exs3yLQQBfvh0tb4VRPyrdvTVyeZw/lbq5Y3rSm02+7WLlvDhr5uNeMrQxOgXFDmx69hyZ1rqnYE5kTUYxgkB9Ey6KlmcWshi6VJgNmZ5D9V3CV8cjef2e6XEsS6CrHx6ILLZZBLXTzccyiYEqyEVrfaN+OqRiuWT1E0XLq/G5j2g1/3I1ME84ON/e81+EFfgx8ax/um7WZ/KawndKAwKZtNYHTcFYOiqEBZN5yBmMBZm3+oOKIrAS77AASYUHCT0EfsbmHl4jzDqwNqcVVJegAcjxCugEbQKadTxMNtfz+k4iCG5+UuGwJHjrg8nY7W/Y4NhJq38t23MJE15QiPU8SjwtZSW+MaDY8+NFTZ+As08reI/9OpDbKg0hVK0ur/RZzyM8OsOFCuc7uFTRul8lOFQAkUvaPEb4jaLBww6jcIkVcVI16/OfCIrl8zpXH3M8s5CrihzYfJ0wuUJa5Abt/FECuZws4sEpk0OpLOQKMfF4yuqnvfIc7n/Of22/0nbQPP80f4BPJ1pxDYIHrxHMixuPtmoXXqku973+4GO/B8uvBH3ygHzHA9udbXqt1SUjbdVirTeheXTKGiD3BsY4XHjvgauDsOAdk2meL4EvyB8x+HcVfA/3CCbAIT8m9s8O768Pw43flt8XJw==:0CA6\n' +
    '^FO512,224^GFA,03840,03840,00024,:Z64:\n' +
    'eJzt1L9rE2EYB/D3cqEp9bgLGOhBDhMKrpqQJWLwkAap6CDSopsRQTqIxkGtU84fDS5VBIcODsXN/0HwTZW0Q6BL3aq+drBL6KXUIUO41/e9K/rmfZ+rnSXPcDSfPrz3fX8dQqMa1aj+z3pXnKkmJmbnM6+uTr0RfOfk47nqpcnk7OKVW5t/WZs6f30WzWwmM80LUxmh/+eDi1+mv84tXPNubP86wnvTaf44+FsY/8kLjIm1np838B1D6G8t4099t1MMjFpHdLrcWXPy7VLTaHQuC96wt9pmba2kG+5SV/Db9rfOGN7Y140zSwPBH9r7zDuPdDNrfRC8Yv9gvl7Ss1nLEdyx99pOjflZ0xTzjNu4zSKWmsWXxrB70313Y29w8/N4UlwIGyEy8XSlvOINL5CN4CogZNHAvH9qp7wl/cuiNPF6O1NNqm6lV8niW8lzlB5Pr6afV+V+f9ckCfJ+XR0HjHSIG5CbNMhhuD81gB25gLP8KAUMxPIjjcTkXIhxJ8YtyAOEdA/u19RA0fqogVj+BkZ1td/fvbeL8tA4DYqVg1EIvadMoB76wJSd3KVBIwjGZG/5vJ+mJNYwPz+UPpPdY48ic2/YE/z3Od9vSa7zh+vSFob8I8WShznc74qHuV2f4hrkVHHjX14H/LTve3nA2ZZ5haO5c+BI8nD/ckEAe1w/jesfgG75XdnDPBbtx3hPduNwJ6CnKI5xD3SdubT+4T7qPkI1wLUB7KivXLA/5xgPe3jeAsC9KI58gfk559MKz7vomC8/UT8EmC8/id4jVo3395B8v/j8uSv3scC9j5RPaDly5b47kZdlNyNXvjOT0Xt7srMJ5Vh+LDubMDsOwHePoGOUKNPin1q2bidUr6AE9SqqW3xflDgsEIuiE9U1tuk5NQ67vZ7WBZjFocAwrBoByKMaFfoNqMMxWQ==:9E2C\n' +
    '^FT485,314^A0I,42,43^FH\\^FDPROMOCION 32^FS\n' +
    '^FT670,141^A0I,85,84^FH\\^FD22.IZMAQUIAS^FS\n' +
    '^PQ1,0,1,Y^XZ';

var En1 = '^XA\n' +
'^MMT\n' +
'^PW691\n' +
'^LL0386\n' +
'^LS0\n' +
'^FO32,224^GFA,02560,02560,00016,:Z64:\n' +
'eJztlc9r01AcwL/Jiy/FPbIK/sggrGGrODx1zkOYw24e5sGDF8uubQbzWqagsmnjNiaM4v4BwaEX2cEdvLgpW7Gl9SBz/0FrBfUgayeDRZ19Nj+bxLmBR9kXSvj0k+/7fr8v5AXgMP6/CEeC/8g+4iKcX9MnPjxDv/v4Kt318WNKfRynVPNyhtIND7K1JZrzMEPL9IufaxUPH6Hl+W0PI/qeqft4fSjt4Tb6rqL4uPztto/nNx0+kUgkRsprjTvNawKsjUFL8V3d9jxtxjb9ZVyMoaNG/4v0p1Gfs3+I0h2HoxbXvMzsUOpl0GtrFU8+NDKZnNdnps39w46PW/vr+ghtgDe/3XoerkdU9/Exs3yLQQBfvh0tb4VRPyrdvTVyeZw/lbq5Y3rSm02+7WLlvDhr5uNeMrQxOgXFDmx69hyZ1rqnYE5kTUYxgkB9Ey6KlmcWshi6VJgNmZ5D9V3CV8cjef2e6XEsS6CrHx6ILLZZBLXTzccyiYEqyEVrfaN+OqRiuWT1E0XLq/G5j2g1/3I1ME84ON/e81+EFfgx8ax/um7WZ/KawndKAwKZtNYHTcFYOiqEBZN5yBmMBZm3+oOKIrAS77AASYUHCT0EfsbmHl4jzDqwNqcVVJegAcjxCugEbQKadTxMNtfz+k4iCG5+UuGwJHjrg8nY7W/Y4NhJq38t23MJE15QiPU8SjwtZSW+MaDY8+NFTZ+As08reI/9OpDbKg0hVK0ur/RZzyM8OsOFCuc7uFTRul8lOFQAkUvaPEb4jaLBww6jcIkVcVI16/OfCIrl8zpXH3M8s5CrihzYfJ0wuUJa5Abt/FECuZws4sEpk0OpLOQKMfF4yuqnvfIc7n/Of22/0nbQPP80f4BPJ1pxDYIHrxHMixuPtmoXXqku973+4GO/B8uvBH3ygHzHA9udbXqt1SUjbdVirTeheXTKGiD3BsY4XHjvgauDsOAdk2meL4EvyB8x+HcVfA/3CCbAIT8m9s8O768Pw43flt8XJw==:0CA6\n' +
'^FO512,224^GFA,03840,03840,00024,:Z64:\n' +
'eJzt1L9rE2EYB/D3cqEp9bgLGOhBDhMKrpqQJWLwkAap6CDSopsRQTqIxkGtU84fDS5VBIcODsXN/0HwTZW0Q6BL3aq+drBL6KXUIUO41/e9K/rmfZ+rnSXPcDSfPrz3fX8dQqMa1aj+z3pXnKkmJmbnM6+uTr0RfOfk47nqpcnk7OKVW5t/WZs6f30WzWwmM80LUxmh/+eDi1+mv84tXPNubP86wnvTaf44+FsY/8kLjIm1np838B1D6G8t4099t1MMjFpHdLrcWXPy7VLTaHQuC96wt9pmba2kG+5SV/Db9rfOGN7Y140zSwPBH9r7zDuPdDNrfRC8Yv9gvl7Ss1nLEdyx99pOjflZ0xTzjNu4zSKWmsWXxrB70313Y29w8/N4UlwIGyEy8XSlvOINL5CN4CogZNHAvH9qp7wl/cuiNPF6O1NNqm6lV8niW8lzlB5Pr6afV+V+f9ckCfJ+XR0HjHSIG5CbNMhhuD81gB25gLP8KAUMxPIjjcTkXIhxJ8YtyAOEdA/u19RA0fqogVj+BkZ1td/fvbeL8tA4DYqVg1EIvadMoB76wJSd3KVBIwjGZG/5vJ+mJNYwPz+UPpPdY48ic2/YE/z3Od9vSa7zh+vSFob8I8WShznc74qHuV2f4hrkVHHjX14H/LTve3nA2ZZ5haO5c+BI8nD/ckEAe1w/jesfgG75XdnDPBbtx3hPduNwJ6CnKI5xD3SdubT+4T7qPkI1wLUB7KivXLA/5xgPe3jeAsC9KI58gfk559MKz7vomC8/UT8EmC8/id4jVo3395B8v/j8uSv3scC9j5RPaDly5b47kZdlNyNXvjOT0Xt7srMJ5Vh+LDubMDsOwHePoGOUKNPin1q2bidUr6AE9SqqW3xflDgsEIuiE9U1tuk5NQ67vZ7WBZjFocAwrBoByKMaFfoNqMMxWQ==:9E2C\n' +
'^FT485,314^A0I,42,43^FH\\^FD';

var En2='^FS\n' +
'^FT670,141^A0I,85,84^FH\\^FD';

var En3 = '^FS\n' +
'^PQ1,0,1,Y^XZ';

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


$(document).on('click','.column_sort',function () {
   var column_name = $(this).attr("id");
   var order = $(this).data("order");
   var arrow = '';
    var equipo = $('#selectEquipo').val();
    //fa fa-sort-desc ||hacia Arriba
    //fa fa-sort-asc ||hacia Abajo
alert(equipo);
    if (order =='desc'){
        arrow ='&nbsp;<span class="fa fa-sort-asc"></span>';
    }else{
        arrow ='&nbsp;<span class="fa fa-sort-desc"></span>';
    }

    $.ajax({
        url : 'php/sortInscripcionTag.php',
        method: "POST",
        data: {column_name : column_name,order:order,idEquipo:equipo},
        success:function (data) {
            $('#tablaIntegrantes').html(data);
            $('#'+column_name+'').append(arrow);
        }
    })
});



$('#selectEquipo').change(function () {
    var equipo = $('#selectEquipo').val();
    var url = 'php/tagsIntegrantes.php';
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidEquipo: equipo
        },
        success: function (datos) {

            $('#tablaIntegrantes').html(datos);
            return false;
        }
    });



/*
$('#tablaRegistrosIntegrantes').DataTable({

    "ajax":{
        "method":"POST",
        "url":url,
        data: {
            phpidEquipo: equipo
        },
    },
    "columns":[
        {"data":"nombre_integrante"},
        {"data":"num_identidad"},
        {"data":"correlativo"}
    ]

});
*/

//$('#tablaRegistrosIntegrantes').DataTable();
    return false;
});


function imprimirTags() {
    var equipo = $('#selectEquipo').val();
    var cantidad = $('#cantidadTagsImprimir').val();
    var url = 'php/tagsEquipos.php';

    if (equipo.trim().length==""){
        alertify.error("EQUIPO VACIO");
        return false;
    }else{
        if(cantidad.trim().length==""){
            alertify.error("CANTIDAD VACIO");
            return false;
        }
    }




    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidEquipo: equipo
        },
        success: function (response) {

            sendData(response);

            /* var jsonData = JSON.parse(response);
             var contador =0;
             var contadorB = 0;

             for (var i = 0;i <Object.keys(jsonData).length;i++){
                 for (var b =0; b<((Object.keys(jsonData[b]).length)/2) ;b++){
                     //sendData([i][b]);
                     var nombre = String (jsonData[i][0]);
                     var numEquipo = String (jsonData[i][1]);
                     var nombreEquipo =String (jsonData[i][2]);
                     var idIntegrante =String (jsonData[i][3]);

                     //AQUI ENVIA A SEND DATA.
                     sendData(nombre,numEquipo,nombreEquipo,idIntegrante)
                     console.log("IMPRIMIENDO");

                 }
                 contador++;
             }*/
            return false;
        }
    });
    return false;
}



function consultarEncabezado() {
    var idEquipoEncabezado = document.getElementById('selectEquipo').value;
var url = 'php/equipoEncabezado.php';
    if(idEquipoEncabezado.trim().length==""){
        alertify.error("EQUIPO VACIO");
        return false
    }
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidEquipo: idEquipoEncabezado
        },
        success: function (datos) {
var respuesta = eval(datos);

            sendEncabezado(respuesta[0],respuesta[1],respuesta[2]);


            return false;
        }
    });
    return false;

}

function sendEncabezado(promocion,numeroEquipo,nombreEquipo)
{

    console.log("INICIANDO SEND DATA");
    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {

                //  console.log(nombre+"-"+numEquipo+"."+nombreEquipo+"-"+idIntegrante);
            var contraPleca = String.fromCharCode(92);
                var equipoNuevo = nombreEquipo.replace("Ñ",contraPleca+"A5");
            selected_printer.send(En1+promocion+En2+numeroEquipo+"."+nombreEquipo+En3);
            //selected_printer.send
            }else{
            printerError(text);
        }
    });
};

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
                    var cantidad = $('#cantidadTagsImprimir').val();
                    var nombre = String (jsonData[i][0]);
                    var identidad = String (jsonData[i][3]);
                    var cel =String (jsonData[i][1]);
                    var expediente=String (jsonData[i][2]);
                    var idIntegrante=String (jsonData[i][4]);
                    var promocion=String (jsonData[i][5]);
var integracion="INTEGRACION";
                    var contraPleca = String.fromCharCode(92);

                    var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");
                    //var nombreEquipoNuevo = nombreEquipo.replace("Ñ",contraPleca+"A5");

                }

                  console.log(promocion+"-"+nombreNuevo+"."+idIntegrante+"-"+cel+"-"+identidad+"-"+expediente+"-"+cantidad);
               selected_printer.send(p1+integracion+p2+nombreNuevo+p3+idIntegrante+p4+cel+p5+identidad+p6+expediente+p7+cantidad+p8);

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


