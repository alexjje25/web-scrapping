class Online {

 time = 5000;

constructor(){
    let self = this;
    self.online();
}

online() {
    let self = this;
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id')

    fetch(
       'public/_php/online.php',
       {
          headers: {
             'Accept': 'application/json',
             'Content-Type': 'application/json',
             'X-Requested-With': 'XMLHttpRequest'
          },
          method: "POST",
          body: JSON.stringify({
            'id' : id
          })
       })
       .then(response => response.json())
       .then(data => {
        setTimeout(function(){
            self.online();
        }, self.time);

       }).catch(function (erro) {
              alert('Erro ao atualizar status do cliente!');
              console.log(erro);
       });
    }
}

new Online();