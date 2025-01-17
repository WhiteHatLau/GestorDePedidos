// Función para ordenar la tabla
function ordenarTabla(n) {
    const tabla = document.getElementById("tablaUsuarios");
    let filas, i, x, y, debeCambiar, direccion, contador = 0;
    let cambiando = true;
    direccion = "asc";

    while (cambiando) {
        cambiando = false;
        filas = tabla.rows;

        for (i = 1; i < (filas.length - 1); i++) {
            debeCambiar = false;
            x = filas[i].getElementsByTagName("TD")[n];
            y = filas[i + 1].getElementsByTagName("TD")[n];

            if (direccion === "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    debeCambiar = true;
                    break;
                }
            } else if (direccion === "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    debeCambiar = true;
                    break;
                }
            }
        }

        if (debeCambiar) {
            filas[i].parentNode.insertBefore(filas[i + 1], filas[i]);
            cambiando = true;
            contador++;
        } else {
            if (contador === 0 && direccion === "asc") {
                direccion = "desc";
                cambiando = true;
            }
        }
    }
}

// Función para buscar en la tabla
function buscar() {
    const input = document.getElementById("buscar");
    const filtro = input.value.toLowerCase();
    const tabla = document.getElementById("tablaUsuarios");
    const tr = tabla.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        const td = tr[i].getElementsByTagName("td");

        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                const texto = td[j].textContent || td[j].innerText;
                if (texto.toLowerCase().indexOf(filtro) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}



