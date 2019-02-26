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

var Mp1 = "^XA\n" +
    "^MMT\n" +
    "^PW812\n" +
    "^LL0609\n" +
    "^LS0\n" +
    "^FO608,416^GFA,04608,04608,00024,:Z64:\n" +
    "eJztl89r22YYx583UiKRGUuFFAxTLUEvZYPWOwxeWmMrrD0vgfXWNh6DnVW6URe8+M16aKHQ5i9YA72UFZKOXcxWEhkXcmx336igg40OhkIHVRPH7x7J+mkpI3Q77NAHbL/55qOvnvd5H72SAN7G4YKYc4X61AG8BmAW6caWJxfpNzgv9FE4/7pAFrucu0U859xjeZkgPyxI6DjyowIbCfWihFDf2ivwX/J5O6/f5VucO/l0dP6M81/zfJPf4ntreb2LfLdgwk3+xBvt5uSpLn/iLu2bOZ3zO47k5X04f2JL+4X6beiwSXka9Sp0cjjh/PZpqBfxd7lWyN/l3jDFi2f9OLeP+nAYjM+mZkG8zeZW79H4DzVQjgThDbv89f54HOjBAnK++4jzvfGQrwb6+SA4NsSr/fH4qa/PjD33HnD+23A8HvNRnpxvh3qa9/UNL8fjemEU8A2+NWr28nxT5/tRQ6f55i3+Ouqf1bS+w19FeprXh907fC3vr/MlPerPNK+MWJezPJ/u/zQvpK6XNE+S6Wb44Hos4CF1/WZ4PblcMryQXI4ZHmL7LA9LT4v5JLJ8Ev/Iz5D+hS9/vjj8ZWgeO/aMXFy6GPKC80PX40NM56S+Kf14a5eN/YlLXeunumO1RFXTda0a+VuU1dgJ1rJEo0TLUI7yaVN2mV02rbbY0gI95CkFA9bAaAPIJ2aNmC9TsIgN1iURkBdjHnWD2EarLMqlQA95harIG9bHYknTUvw7Pd2RWNMRmOIJu9KLiNdqxywJPrQ+eqxcUC5Jl9L5lMFozT+WS9VU/hbmUwXDmv9L1uop/xqFWgVvAEChQjO8adVlsMwOaNqMGvMnqGlYMmuZFErlcqUc9b9GW5ZVsS2zqmpKWYt5xXvf2+u9cB3l3c2pB8r6m63vmDfDm5d5GL7u/5Kwm48mPGdTfzDBK2+sC+sML7KQl1Yc3Dk1pe/p0JEkN14vcNGqIjBPYXQGfo/4KrRR1whzJUZFPDTk61hI/8M8waYyNCIevfHTBtsVHFqDuN/aOKT4zR4Shxqp+oOOPrg3u/7SgRLxLiJ1OAngYUuizlYj3ed1GwedQI95Bf31NRw0Eh77f8y7/oHtCb4Owp/o3/ASPvDvABmBS4Y+b2f8cZ5+/hM8LoHOXKxDJv+qrytYHxbomfmqku1KNlUTflwfFeuMfAVmU/Vs1UWV2L5/Jakn1t6oizIJ6386tV6tjqjNo49LtWS9ZsExaKkqsB48pFWoxf3Qd7p8qEvEI/hD4n6AEbz34r7qzazD7Lc3Ryze/4MHMXUhaDd17j/e36S48xf90TSOQn7DOYOd+XxtQ9k806O9qH/Iim3h/vBpX6hoNWrVtcif2Y4hQGvAKppBa1rMk76N+09/QAzNpFa5FOczYAZhbLACJaA11MN8yIBZhBPUNaCWFPPmgLVw31txRNQNKeYvbyPfJ31v+kKGb15nBtwD1pAeAe0JMT+P/nCV2LrvAxl/Az4HW4n0sP7zA9uCL0hf8nUz4XG+LaCECTcxf6MU98+K7Vio90nFz1NL8/5euHJd9vm4PnhD04dQkXaWdb7Cdac7uV6G/zX15uv7P+OP5CLgw+e3dKzmLYJQD9CDOHr+/MLi3OLi/MInc3OL51R83lsI/yVf+ebay+fucqO+s03N1DFXq1/tvHSXm52d7VpKl49Xr31/z20gf6MGBXx9gv+s2F8+BJ/2l68cwKfzT/NSkn/6JUyGEn35/CHy37F0+vg+9sHY38rWzvE/rr+Z+7eBJHDvx21hLholsR7+Cr3MCQjo/qsF6ZqQDQan8Byn7k/ImDThT5eGk7KfKcyynAxifKJsHPRyWvxqmoRx6MMKkknIgsaUD7I3k1kcKptpf2t+G/8y/gYXBLVw:2A50\n" +
    "^FO0,384^GFA,06272,06272,00028,:Z64:\n" +
    "eJztlu9r20YYx+9yIVe2TnIgMI+ZyqZly4sM8mpomxvJ7d7nT6gLgb4pxZA3HjWVPA8EJsh7GVgYG3sz9qZlr/qqkdsRbwzS98sgKoE10BEUWhaXGF3vJMVyfHcqpG/K8AM2xh99754fp+c5ACY2sYlNbGL/d/ug/HL/2uWgfGP949ajh3PPScEcsvfa6wt/rORu3txZ8Bb+fLFe+jxl6vTiR5Uvc1dWZn1zvnLJK11P2bsPLj5bLgcPb3xXrOxX/nn+5KuUzU6bn3Qv5a5U/yqa8+Zv+RIcWfPB8c875Xv/hjt3W3e9b45/XPKGDJdvr7x/Ocivzj5Fe+b06pMRP89q50B7fsqug3faUyAAbfAL+GHICsjVUTMEpIPxADpgC1SHTGHMIYg4M2qIHLgN/DQGouhXHew0W84FFTpkK5/qMHH1PRf1Wq1eATdbxL2f6rCifLbqwi3YJDqCrd5MI9UhV/nieA0eICfUUavbU8JUhzYUY3MDbNOtKPO2Zp6mOvi3Ymhr4AC5mPrrH6i9VAf7ypK6BrchY51qA8OUgb5Sxi7sIXdGR26toY6ymkLXokG7uIALuo5HYgeBokOn09rrOOr3G/p9xR5hVWURIAtajoUbeiE3DYopKypFYA+A1QxRv6bkzo2yTDufwfIsO0fkqHvYRY/P51dHfKGVp4wQ4n16vX/111vt8f0iNmd+WylN2SLWfVG9t/zT14f+OLMsy5wzq1THxRDvV61WLt76XbjmoQeWS/opP4c6SYxvwrr9DEZsMaPxVUhNvp86yPCFZDBN6CqrnwdwINcB4YYJW8pgmi1irH70ZRQ5k+iQL2dA5OgJq2ewcga7kMFUCXtM64dtAaPxXbPuAGTKdMQXBGgytktIAHgWJLqQDx76rH679AO4IwO9D2MdsXXOE+92vB/xCxyzjxOdzyUGw0cWsbo0xprCsThnBiF9jsV/4A5lWMKeETLg2FzMXlKG7DEWO45DEdMTZpEB9MSM+hrKmGVYDY7VEt0mLYQvYbtkIGVEwKoxo/UbjEy/2OJnUaQbL+4bMlq/eoauDxZPoyQXMdOlLDgj8yUMvoZ5Mhb1GLnOzmDgDAwckf84BhLG3ls5o711LNcnZ4SlmtMljL5+QFI/YNGUyZghYvsnzOO7a/KsxoaVL2NAytRQwJKYojkmYYjqR26tpxgz7t1MeoEnZwabxVyfiBscqx7Por6EWNX5Ro8TZic/TzH2MI6mBzc8oofVaAJyPTJyQGUnnh9IUVBaxLh+HV0dNfaGccclTnDM+OEYDBk/VOtD5nOM7WIwBnnGPNfY8UQex5STNQVzEw8Zh6KyRrEL5jTbRiVHvmi+wyDKpye8F9SjGtnC+8RSXFvhPURjrcAS319Um56lUHLvoYsZAbgjQAAOWPWh+LZosS/x/QxozEND5AqV9JmnQkT/9+1NyeWUptqyxEtGaQklKOkEE5vYxN52ewUPynVK:1BC3\n" +
    "^FO192,416^GFA,09984,09984,00052,:Z64:\n" +
    "eJztmD9y3TYQxsFwNEyH0iWPkCMgR0iV1qfITDrQo8Klj6CjiBoVKp0bGBkVKoNMMiNqDGOz3y6AB76nJO7ccGXjkXz74ccFFv+eMYcddthhhx327e3tb7vbOb3iM9Ji3Oa2MY/bmPg280NL2dIy8aXnr43N1S24xa1moJVv5jTJn5mI8IxoYg3hKhojF3DzK/6qhhlTYs5MFLhSyiOtzOEqNuGomws+FI6PwsnM8ajYCmfl6rmKhFctbkwJzDFcr4vMyVMeRbPBkzmBObgSjroVjuF6C4emhEiScVwOFJmDK4lH3ZgThcMWEI8Fp2qyEQ40i3Lg5lYSjhcNc6xwos/ySDk+zRwIOOLmVxKOkwo4Hktj4tbiSmmbahHHwlG3QLFyVnBm5ozolYqQq6HjrP7uxFkRz0zXqlk0lAROgKZyVndHm2sa4bznqrnSd9I1ylkHbmTuH3VjTgJnRtOgf5TDSfBOUm3mDhs4GGhycXO/K0c1wnkAZywcDg8cdAziETfmbODYwknu9jpJBivH0vueI27u/rNyUDk4XjkD3Qlnkk46cfCdf9B4bBq5kTged3uvnGsdOpJ0yqHq9viSwJka56Zw7mXogAONjxxLcfMPL8LhIcCNxPH4m8ckI+W6xNM4jj/EzT29ZOFw9ytnfkoyUh60f3QQgeMlFzC6Hv7M4HCiJXCyt499PK7nBHVzT1E4I9nKee7bzZd2E05UN+aQV80m8eTK0f5hSe0fnSPYzX0MwhnoRjlknzUPhCPJLf0TZPIRN/8xCmegD5v0T57+OuUOI0LNt5Fut+L2R/DK+RTB+ZKnZ83rQTlryWv+ZARzOLBPwYNj6CYgHsrT5278DDK/yfiZ6ENWN25AfysaUg5D+N9qWyh1nFpC8sCNOwp9hVGrnCT/6nwg8eh8YLMObnBWd9IAwhqu2NWuwdTm0xsZXEXjq8YVDlD9/IZC5jeXZFXQxKuctXFUA45RjsJG5IP+rxwsLcwZqJuvlSNXbhtKcjfOXDiicdKKDSHrgufGi+LGK9hcNIvGA42t648GNQKLjAvi5nYa5kRo2jqnsCvCY26wTdw8GdWgw8CJhpAiWE9/QHlLMn0uI4LZysTIH+vFmjzv1+03f//XIn/YYYcddthhh32NDfQjF75enQxngWC+Q6HHA94bJH1o5XyKL2bsFOQY2Wneioa3uTb7pvE4n7biQuNF4+KOI2dN8Sz7pqrB0SAOVDlzAqc9XGRbIleyB+o4o2qw40iNg4crikWKM06YCid1nNCKVYrzeGzh8MfWOCchn14pnMczqwYfW4unbYLjnHFGPsVj0C0zdtNF4+QnAL7HJjhqkeRrm3eaNFRNLL+DSEU49OPcjf3iucZtWlF5xaLh3eaGA8k2b+i6vSbqTlVjq5oomhlNycUvP+kG8Ws4I85HBbB/Nx8bZ6fhDvsVHHpFw28L53GvQSgG+1XJ7U4Dv1g4fErHLnVO8lDeDRrmfDHl55GmqfFAs1RNqBqLtFh0z93lW+EMcoiTDXfRJOFYNGenUY7GM+DYeOJslSM7+jNNbJw7Mq/Eg9t/i8fwMbhW3Mdjimb3boVj+Fhv+jbwGg+G/noRT+XcZ3MRzywnlqXT9PmG3yLMPt/0Vk4sr+eb8Y/Z7PPNfC+3csI6y51UOM9pr0mDdtL0mkY57mkz+3yzJaiLccrzgXJcx2njx29XPxt/EY/FOdvovHw2TnEyRtG/m6aWDgLWKGdq/TNxauCXMhy29zlaBqiuBE2DUMokt+z6R+aAqXFi02g8ZR59Fg71nLFxwu7dcESuk/b5uw1NE/ca+TFzlcXBn+WbKZqpcLp8K+tPPh+nMgh7zSme0zp3Hg9oQaAr3rCLp66noX+3/7MrLNlX+3X7sMMOO+ywww477LBvY/8Ae82fIQ==:2D00\n" +
    "^FO0,0^GFA,06656,06656,00104,:Z64:\n" +
    "eJztzTERAAAIBKDvn8pmWsHJwYMCJAC3+kJ5PB6Px+PxeDwej8fj8Xg8Hs/++WYA9IwyTg==:4608\n" +
    "^FT613,362^A0I,51,50^FH\\^FD2019^FS\n" +
    "^FT502,359^A0I,51,50^FH\\^FD";

var Mp2 = "^FS\n" +
    "^FT799,292^A0I,39,38^FH\\^FD";

var Mp3  ="^FS\n" +
    "^BY5,3,137^FT546,107^BCI,,N,N\n" +
    "^FD>;";

var Mp4 ="^FS\n" +
    "^FO79,20^GB650,34,34^FS\n" +
    "^FT729,26^A0I,28,28^FR^FH\\^FDJOSUE 24:15    YO Y MI CASA SERVIREMOS A JEHOVA^FS\n" +
    "^PQ1,0,1,Y^XZ";



var miZpl = "^XA\n" +
    "^MMT\n" +
    "^PW812\n" +
    "^LL0609\n" +
    "^LS0\n" +
    "^FO608,416^GFA,04608,04608,00024,:Z64:\n" +
    "eJztl89r22YYx583UiKRGUuFFAxTLUEvZYPWOwxeWmMrrD0vgfXWNh6DnVW6URe8+M16aKHQ5i9YA72UFZKOXcxWEhkXcmx336igg40OhkIHVRPH7x7J+mkpI3Q77NAHbL/55qOvnvd5H72SAN7G4YKYc4X61AG8BmAW6caWJxfpNzgv9FE4/7pAFrucu0U859xjeZkgPyxI6DjyowIbCfWihFDf2ivwX/J5O6/f5VucO/l0dP6M81/zfJPf4ntreb2LfLdgwk3+xBvt5uSpLn/iLu2bOZ3zO47k5X04f2JL+4X6beiwSXka9Sp0cjjh/PZpqBfxd7lWyN/l3jDFi2f9OLeP+nAYjM+mZkG8zeZW79H4DzVQjgThDbv89f54HOjBAnK++4jzvfGQrwb6+SA4NsSr/fH4qa/PjD33HnD+23A8HvNRnpxvh3qa9/UNL8fjemEU8A2+NWr28nxT5/tRQ6f55i3+Ouqf1bS+w19FeprXh907fC3vr/MlPerPNK+MWJezPJ/u/zQvpK6XNE+S6Wb44Hos4CF1/WZ4PblcMryQXI4ZHmL7LA9LT4v5JLJ8Ev/Iz5D+hS9/vjj8ZWgeO/aMXFy6GPKC80PX40NM56S+Kf14a5eN/YlLXeunumO1RFXTda0a+VuU1dgJ1rJEo0TLUI7yaVN2mV02rbbY0gI95CkFA9bAaAPIJ2aNmC9TsIgN1iURkBdjHnWD2EarLMqlQA95harIG9bHYknTUvw7Pd2RWNMRmOIJu9KLiNdqxywJPrQ+eqxcUC5Jl9L5lMFozT+WS9VU/hbmUwXDmv9L1uop/xqFWgVvAEChQjO8adVlsMwOaNqMGvMnqGlYMmuZFErlcqUc9b9GW5ZVsS2zqmpKWYt5xXvf2+u9cB3l3c2pB8r6m63vmDfDm5d5GL7u/5Kwm48mPGdTfzDBK2+sC+sML7KQl1Yc3Dk1pe/p0JEkN14vcNGqIjBPYXQGfo/4KrRR1whzJUZFPDTk61hI/8M8waYyNCIevfHTBtsVHFqDuN/aOKT4zR4Shxqp+oOOPrg3u/7SgRLxLiJ1OAngYUuizlYj3ed1GwedQI95Bf31NRw0Eh77f8y7/oHtCb4Owp/o3/ASPvDvABmBS4Y+b2f8cZ5+/hM8LoHOXKxDJv+qrytYHxbomfmqku1KNlUTflwfFeuMfAVmU/Vs1UWV2L5/Jakn1t6oizIJ6386tV6tjqjNo49LtWS9ZsExaKkqsB48pFWoxf3Qd7p8qEvEI/hD4n6AEbz34r7qzazD7Lc3Ryze/4MHMXUhaDd17j/e36S48xf90TSOQn7DOYOd+XxtQ9k806O9qH/Iim3h/vBpX6hoNWrVtcif2Y4hQGvAKppBa1rMk76N+09/QAzNpFa5FOczYAZhbLACJaA11MN8yIBZhBPUNaCWFPPmgLVw31txRNQNKeYvbyPfJ31v+kKGb15nBtwD1pAeAe0JMT+P/nCV2LrvAxl/Az4HW4n0sP7zA9uCL0hf8nUz4XG+LaCECTcxf6MU98+K7Vio90nFz1NL8/5euHJd9vm4PnhD04dQkXaWdb7Cdac7uV6G/zX15uv7P+OP5CLgw+e3dKzmLYJQD9CDOHr+/MLi3OLi/MInc3OL51R83lsI/yVf+ebay+fucqO+s03N1DFXq1/tvHSXm52d7VpKl49Xr31/z20gf6MGBXx9gv+s2F8+BJ/2l68cwKfzT/NSkn/6JUyGEn35/CHy37F0+vg+9sHY38rWzvE/rr+Z+7eBJHDvx21hLholsR7+Cr3MCQjo/qsF6ZqQDQan8Byn7k/ImDThT5eGk7KfKcyynAxifKJsHPRyWvxqmoRx6MMKkknIgsaUD7I3k1kcKptpf2t+G/8y/gYXBLVw:2A50\n" +
    "^FO0,384^GFA,06272,06272,00028,:Z64:\n" +
    "eJztlu9r20YYx+9yIVe2TnIgMI+ZyqZly4sM8mpomxvJ7d7nT6gLgb4pxZA3HjWVPA8EJsh7GVgYG3sz9qZlr/qqkdsRbwzS98sgKoE10BEUWhaXGF3vJMVyfHcqpG/K8AM2xh99754fp+c5ACY2sYlNbGL/d/ug/HL/2uWgfGP949ajh3PPScEcsvfa6wt/rORu3txZ8Bb+fLFe+jxl6vTiR5Uvc1dWZn1zvnLJK11P2bsPLj5bLgcPb3xXrOxX/nn+5KuUzU6bn3Qv5a5U/yqa8+Zv+RIcWfPB8c875Xv/hjt3W3e9b45/XPKGDJdvr7x/Ocivzj5Fe+b06pMRP89q50B7fsqug3faUyAAbfAL+GHICsjVUTMEpIPxADpgC1SHTGHMIYg4M2qIHLgN/DQGouhXHew0W84FFTpkK5/qMHH1PRf1Wq1eATdbxL2f6rCifLbqwi3YJDqCrd5MI9UhV/nieA0eICfUUavbU8JUhzYUY3MDbNOtKPO2Zp6mOvi3Ymhr4AC5mPrrH6i9VAf7ypK6BrchY51qA8OUgb5Sxi7sIXdGR26toY6ymkLXokG7uIALuo5HYgeBokOn09rrOOr3G/p9xR5hVWURIAtajoUbeiE3DYopKypFYA+A1QxRv6bkzo2yTDufwfIsO0fkqHvYRY/P51dHfKGVp4wQ4n16vX/111vt8f0iNmd+WylN2SLWfVG9t/zT14f+OLMsy5wzq1THxRDvV61WLt76XbjmoQeWS/opP4c6SYxvwrr9DEZsMaPxVUhNvp86yPCFZDBN6CqrnwdwINcB4YYJW8pgmi1irH70ZRQ5k+iQL2dA5OgJq2ewcga7kMFUCXtM64dtAaPxXbPuAGTKdMQXBGgytktIAHgWJLqQDx76rH679AO4IwO9D2MdsXXOE+92vB/xCxyzjxOdzyUGw0cWsbo0xprCsThnBiF9jsV/4A5lWMKeETLg2FzMXlKG7DEWO45DEdMTZpEB9MSM+hrKmGVYDY7VEt0mLYQvYbtkIGVEwKoxo/UbjEy/2OJnUaQbL+4bMlq/eoauDxZPoyQXMdOlLDgj8yUMvoZ5Mhb1GLnOzmDgDAwckf84BhLG3ls5o711LNcnZ4SlmtMljL5+QFI/YNGUyZghYvsnzOO7a/KsxoaVL2NAytRQwJKYojkmYYjqR26tpxgz7t1MeoEnZwabxVyfiBscqx7Por6EWNX5Ro8TZic/TzH2MI6mBzc8oofVaAJyPTJyQGUnnh9IUVBaxLh+HV0dNfaGccclTnDM+OEYDBk/VOtD5nOM7WIwBnnGPNfY8UQex5STNQVzEw8Zh6KyRrEL5jTbRiVHvmi+wyDKpye8F9SjGtnC+8RSXFvhPURjrcAS319Um56lUHLvoYsZAbgjQAAOWPWh+LZosS/x/QxozEND5AqV9JmnQkT/9+1NyeWUptqyxEtGaQklKOkEE5vYxN52ewUPynVK:1BC3\n" +
    "^FO192,416^GFA,09984,09984,00052,:Z64:\n" +
    "eJztmD9y3TYQxsFwNEyH0iWPkCMgR0iV1qfITDrQo8Klj6CjiBoVKp0bGBkVKoNMMiNqDGOz3y6AB76nJO7ccGXjkXz74ccFFv+eMYcddthhhx327e3tb7vbOb3iM9Ji3Oa2MY/bmPg280NL2dIy8aXnr43N1S24xa1moJVv5jTJn5mI8IxoYg3hKhojF3DzK/6qhhlTYs5MFLhSyiOtzOEqNuGomws+FI6PwsnM8ajYCmfl6rmKhFctbkwJzDFcr4vMyVMeRbPBkzmBObgSjroVjuF6C4emhEiScVwOFJmDK4lH3ZgThcMWEI8Fp2qyEQ40i3Lg5lYSjhcNc6xwos/ySDk+zRwIOOLmVxKOkwo4Hktj4tbiSmmbahHHwlG3QLFyVnBm5ozolYqQq6HjrP7uxFkRz0zXqlk0lAROgKZyVndHm2sa4bznqrnSd9I1ylkHbmTuH3VjTgJnRtOgf5TDSfBOUm3mDhs4GGhycXO/K0c1wnkAZywcDg8cdAziETfmbODYwknu9jpJBivH0vueI27u/rNyUDk4XjkD3Qlnkk46cfCdf9B4bBq5kTged3uvnGsdOpJ0yqHq9viSwJka56Zw7mXogAONjxxLcfMPL8LhIcCNxPH4m8ckI+W6xNM4jj/EzT29ZOFw9ytnfkoyUh60f3QQgeMlFzC6Hv7M4HCiJXCyt499PK7nBHVzT1E4I9nKee7bzZd2E05UN+aQV80m8eTK0f5hSe0fnSPYzX0MwhnoRjlknzUPhCPJLf0TZPIRN/8xCmegD5v0T57+OuUOI0LNt5Fut+L2R/DK+RTB+ZKnZ83rQTlryWv+ZARzOLBPwYNj6CYgHsrT5278DDK/yfiZ6ENWN25AfysaUg5D+N9qWyh1nFpC8sCNOwp9hVGrnCT/6nwg8eh8YLMObnBWd9IAwhqu2NWuwdTm0xsZXEXjq8YVDlD9/IZC5jeXZFXQxKuctXFUA45RjsJG5IP+rxwsLcwZqJuvlSNXbhtKcjfOXDiicdKKDSHrgufGi+LGK9hcNIvGA42t648GNQKLjAvi5nYa5kRo2jqnsCvCY26wTdw8GdWgw8CJhpAiWE9/QHlLMn0uI4LZysTIH+vFmjzv1+03f//XIn/YYYcddthhh32NDfQjF75enQxngWC+Q6HHA94bJH1o5XyKL2bsFOQY2Wneioa3uTb7pvE4n7biQuNF4+KOI2dN8Sz7pqrB0SAOVDlzAqc9XGRbIleyB+o4o2qw40iNg4crikWKM06YCid1nNCKVYrzeGzh8MfWOCchn14pnMczqwYfW4unbYLjnHFGPsVj0C0zdtNF4+QnAL7HJjhqkeRrm3eaNFRNLL+DSEU49OPcjf3iucZtWlF5xaLh3eaGA8k2b+i6vSbqTlVjq5oomhlNycUvP+kG8Ws4I85HBbB/Nx8bZ6fhDvsVHHpFw28L53GvQSgG+1XJ7U4Dv1g4fErHLnVO8lDeDRrmfDHl55GmqfFAs1RNqBqLtFh0z93lW+EMcoiTDXfRJOFYNGenUY7GM+DYeOJslSM7+jNNbJw7Mq/Eg9t/i8fwMbhW3Mdjimb3boVj+Fhv+jbwGg+G/noRT+XcZ3MRzywnlqXT9PmG3yLMPt/0Vk4sr+eb8Y/Z7PPNfC+3csI6y51UOM9pr0mDdtL0mkY57mkz+3yzJaiLccrzgXJcx2njx29XPxt/EY/FOdvovHw2TnEyRtG/m6aWDgLWKGdq/TNxauCXMhy29zlaBqiuBE2DUMokt+z6R+aAqXFi02g8ZR59Fg71nLFxwu7dcESuk/b5uw1NE/ca+TFzlcXBn+WbKZqpcLp8K+tPPh+nMgh7zSme0zp3Hg9oQaAr3rCLp66noX+3/7MrLNlX+3X7sMMOO+ywww477LBvY/8Ae82fIQ==:2D00\n" +
    "^FO0,0^GFA,06656,06656,00104,:Z64:\n" +
    "eJztzTERAAAIBKDvn8pmWsHJwYMCJAC3+kJ5PB6Px+PxeDwej8fj8Xg8Hs/++WYA9IwyTg==:4608\n" +
    "^FT613,362^A0I,51,50^FH\\^FD2018^FS\n" +
    "^FT502,359^A0I,51,50^FH\\^FDPROMOCION 5^FS\n" +
    "^FT782,286^A0I,45,45^FH\\^FDNOMBRE DE LA OVEJA^FS\n" +
    "^BY5,3,137^FT546,107^BCI,,N,N\n" +
    "^FD>;4090^FS\n" +
    "^FO79,20^GB650,34,34^FS\n" +
    "^FT729,26^A0I,28,28^FR^FH\\^FDJOSUE 24:15    YO Y MI CASA SERVIREMOS A JEHOVA^FS\n" +
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

           sendDataEtiqueta(datos[0],datos[1],datos[2],datos[3],datos[4],datos[5]);



        }
    });
    return false;
}


function sendDataEtiqueta(nombre,numEquipo,nombreEquipo,idIntegrante,orden,promocion)
{

    console.log("INICIANDO SEND DATA");

    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {

            if(orden == 1){

                var contraPleca = String.fromCharCode(92);

                var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");
                console.log(nombreNuevo);
                var nombreEquipoNuevo = nombreEquipo.replace("Ñ",contraPleca+"A5");
                var promocionNueva = promocion.replace("Ñ",contraPleca+"A5");
                //  console.log(nombre+"-"+numEquipo+"."+nombreEquipo+"-"+idIntegrante);
                selected_printer.send(Mp1+promocionNueva+Mp2+nombreNuevo+Mp3+idIntegrante+Mp4);
                alert("IMPRIMIENDO");
            }else{
                    alertify.error("INTEGRANTE NO ENLAZADO EN PROMOCION ACTUAL");
            }




        }
        else
        {
            alert("IMPRESORA NO LISTA");
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


