jQuery('#eliminaModal').on('show.bs.modal', function (event) {
            
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
    buttonElimina.value = id                       
 })


function actualizaCantidad(cantidad, cod_pro) {
    let url = '../clases/actualizar_carrito.php'
    let formData = new FormData()
    formData.append('action', 'agregar')
    formData.append('cod_pro', cod_pro)
    formData.append('cantidad', cantidad)

    fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if (data.ok) {

                let divsubtotal = document.getElementById('subtotal_' + cod_pro)
                divsubtotal.innerHTML = data.sub

                let total = 0.00
                let list = document.getElementsByName('subtotal[]')

                for(let i = 0; i < list.length; i++){

                    total += parseFloat(list[i].innerHTML.replace('.', '').replace(',', '.').replace('€',''))
                }

                document.getElementById('total').innerHTML =
                 total.toLocaleString('es-ES', { minimumFractionDigits: 2 }).replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "€";
                 //Este código pone los decimales con comas y los millares con puntos cada 3 números para la suma del subtotal.
            }
        })
}



function eliminar() {
let botonElimina = document.getElementById('btn-elimina')
let id = botonElimina.value


let url = '../clases/actualizar_carrito.php'
let formData = new FormData()
formData.append('action', 'eliminar')
formData.append('cod_pro', id)


fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
    .then(data => {
        if (data.ok) {
        location.reload()
            
        }
    })
}