function addProducto(cod_pro, token) {
    let url = '../clases/carrito.php'
    let formData = new FormData()
    formData.append('cod_pro', cod_pro)
    formData.append('token', token)
    
    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
      }).then(response => response.json())
      .then(data => {
        
        if (data.ok) {
          let elemento = document.getElementById("num_cart")
          elemento.innerHTML = data.numero
        }
      })
  }