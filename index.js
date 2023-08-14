const express = require('express');
const axios = require('axios');
const querystring = require('querystring');
const cheerio = require('cheerio');
const fs = require('fs');
const app = express();
const port = 3003;

app.set('view engine', 'ejs');

app.use(express.urlencoded({ extended: true }));
app.use(express.static('public'));

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

app.post('/results', (req, res) => {
  const baseUrl = 'https://www.clickbus.com.br/onibus/';

  const params = {
    departureCity: req.body.departureCity,
    arrivalCity: req.body.arrivalCity,
    departureDate: req.body.departureDate,
    departureReturnDate: req.body.departureReturnDate
  };

  const formattedParams = {
    departureCity: params.departureCity,
    arrivalCity: params.arrivalCity,
    departureDate: params.departureDate,
    departureReturnDate: params.departureReturnDate
  };

  const queryString = querystring.stringify(formattedParams);

  // Construct the URL
  let url = `${baseUrl}${formattedParams.departureCity}/${formattedParams.arrivalCity}?departureDate=${formattedParams.departureDate}`;
  
  if (formattedParams.departureReturnDate) {
    url += `&departureReturnDate=${formattedParams.departureReturnDate}`;
  }

  axios.get(url)
    .then(response => {
      const html = response.data;
      const $ = cheerio.load(html);

      const priceValueIda = $('.c-drJHVl.price').map((index, element) => {
        return $(element).text();
      }).get();

      const priceValuesVolta = $('.c-ezPmQU.price-value').map((index, element) => {
        return $(element).text();
      }).get();

      const horarioPartida = $('.departure-time').map((index, element) => {
        return $(element).text();
      }).get();

      const horarioChegada = $('.return-time').map((index, element) => {
        return $(element).text();
      }).get();

      const origem = $('.station-departure').map((index, element) => {
        return $(element).text();
      }).get();

      const destino = $('.station-arrival').map((index, element) => {
        return $(element).text();
      }).get();

      const duration = $('.duration').map((index, element) => {
        return $(element).text();
      }).get();

      const dataContentValues = $('.c-eJHfkr.company').map((index, element) => {
        return $(element).attr('data-content');
      }).get();

      const dataContentValuesLeito = $('.c-qmjgJ').map((index, element) => {
        return $(element).text();
      }).get();

      // Formatar os dados para serem enviados ao arquivo PHP
      if (
        priceValueIda.length === 0 &&
        priceValuesVolta.length === 0 &&
        horarioPartida.length === 0 &&
        horarioChegada.length === 0 &&
        origem.length === 0 &&
        destino.length === 0 &&
        duration.length === 0 &&
        dataContentValues.length === 0 &&
        dataContentValuesLeito.length === 0
      ) {
        // Mostrar um alerta para o usuário
        res.send('<script>alert("Nenhum resultado encontrado."); window.location.href = "/";</script>');
      } else {
      
      const scrapedData = {
        priceValueIda,
        priceValuesVolta,
        departureTime: horarioPartida,
        chegadaTime: horarioChegada,
        empresa: dataContentValues,
        duration: duration,
        destino: destino,
        origem: origem,
        dataContentValuesLeito: dataContentValuesLeito
      };
      
      console.log(origem)
      const jsonData = JSON.stringify(scrapedData);

    // Escrevendo os dados no arquivo data.json
    fs.writeFile('data.json', jsonData, (err) => {
      if (err) {
        console.error('Erro ao escrever dados no arquivo data.json:', err);
        res.status(500).send('Erro ao escrever dados no arquivo data.json.');
      } else {
        console.log('Dados escritos no arquivo data.json com sucesso.');

        // Enviar os dados para o arquivo PHP
        axios.post('https://passagem-de-onibus-online.shop/checkout.php', scrapedData)
          .then(response => {
            console.log('Resposta do PHP:', response.data);
            res.render('result', {
              priceValueIda,
              priceValuesVolta,
              departureTime: horarioPartida,
              chegadaTime: horarioChegada,
              empresa: dataContentValues,
              duration: duration,
              destino: destino,
              origem: origem,
              dataContentValuesLeito: dataContentValuesLeito
            });
          })
          .catch(error => {
            console.error('Erro ao enviar dados para o PHP:', error);
            res.status(500).send('Erro ao acessar o site');
          });
      }
    });
  }
  })
    .catch(error => {
      console.error('Erro:', error);
      res.status(500).send('Erro ao acessar o site');
    });
});

app.listen(port, () => {
  console.log(`Servidor rodando em http://localhost:${port}`);
});