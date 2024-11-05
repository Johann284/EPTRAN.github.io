var filterIcon = $("#filter-icon"); 
var filterContent = $("#filter-content");
var today = new Date().toISOString().split('T')[0];
var monthAgo = new Date();
monthAgo.setDate((monthAgo.getDate() - 30))
monthAgo = monthAgo.toISOString().split('T')[0];
var dateStart = $("#date-start");
var dateEnd = $("#date-end");
dateEnd.val(today)
dateStart.val(monthAgo)
var seriesIniciais = ['1º série','2º série','3º série','4º série','5º série','6º série','7º série','8º série','9º série']
var seriesFinais = ['6º série','7º série','8º série','9º série']
var ensinoMedio = ['1º série ensino médio','2º série ensino médio','3º série ensino médio','4º série ensino médio']
filterIcon.click(function (){
    filterIcon.toggleClass("fa-filter");
    filterIcon.toggleClass("fa-minus")
    filterContent.toggle()
});

graphArr = [
{
  title: 'Niveis de ensino',
  itemId: 'grafico1',
  itemArr: [
    {title: "Series Finais", items:['1º série','2º série','3º série','4º série','5º série','6º série','7º série','8º série','9º série']},
    ['6º série','7º série','8º série','9º série'], 
    ['1º série ensino médio','2º série ensino médio','3º série ensino médio','4º série ensino médio']]
},
{
  title: 'Gênero',
  itemId: 'grafico2'
  
},
{
  title: 'Cidade',
  itemId: 'grafico3'
},
{
  title: 'Bairro',
  itemId: 'grafico4'
},
{
  title: 'Faixa etária',
  itemId: 'grafico5'
},
{
  title: 'Série',
  itemId: 'grafico6'
},
]

function makeGraph(data, filter){
    
    let totalFinais = data.filter(m => seriesFinais.includes(m.serie_usuario)).length;
    let totalIniciais = data.filter(m => seriesIniciais.includes(m.serie_usuario)).length;
    let totalEnsinoMedio = data.filter(m => ensinoMedio.includes(m.serie_usuario)).length;
    let totalNaoEstuda = data.filter(m => m.serie_usuario == "Não sou estudante").length;

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
console.dir(data)
function drawChart(){
    
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Series Finais',totalFinais],
        ['Series Iniciais',totalIniciais],
        ['Ensino Médio',totalEnsinoMedio],
        ['Não estuda',totalNaoEstuda]
      ]);

      var options = {
        title: 'Estudantes'
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

      chart.draw(data, options);
}

}






