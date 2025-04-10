// Gráfico combinado barra + línea

const ctx1 = document.getElementById('barLineChart')?.getContext('2d');
if (ctx1) {
  new Chart(ctx1, {
    data: {
      labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      datasets: [
        {
          type: 'bar',
          label: 'Capitalización',
          data: [150, 160, 165, 163, 162, 160, 130, 115, 145, 130, 120, 100],
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderRadius: 5
        },
        {
          type: 'line',
          label: 'Dominancia de Mercado',
          data: [10, 11, 11, 12, 12, 13, 20, 50, 60, 55, 50, 40],
          borderColor: 'rgba(0,0,0,0.7)', 
          fill: false,
          tension: 0.4,
          yAxisID: 'y1'
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          title: {
            display: true,
            text: 'Capitalización (en miles de millones $)'
          }
        },
        y1: {
          position: 'right',
          min: 0,
          max: 100,
          title: {
            display: true,
            text: 'Participación de mercado (%)'
          },
          grid: {
            drawOnChartArea: false
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Capitalización de Bitcoin y Dominancia de Mercado'
        }
      }
    }
  });
}

// Gráfico de torta
const ctx2 = document.getElementById('pieChart')?.getContext('2d');
if (ctx2) {
  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['BTC', 'ETH', 'XRP', 'LTC', 'DASH', 'XEM', 'Otros'],
      datasets: [{
        label: 'Participación de mercado',
        data: [45.2, 20.5, 5, 2.5, 1.5, 1, 23.8],
        backgroundColor: [
          '#4e79a7',
          '#59a14f',
          '#f28e2b',
          '#e15759',
          '#76b7b2',
          '#edc949',
          '#bab0ac'
        ]
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Líderes del Mercado de Criptomonedas'
        }
      }
    }
  });
}
