
let options = {
    responsive: true,
    legend: {
        display: true,
        position: 'bottom',
        onClick: null
    },
    mainAspectRatio: false,
}

if(document.getElementById('chart-line-users')!= null){
    new Chart(document.getElementById('chart-line-users').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            datasets: [{
                label: ' Utilisateurs',
                data: [12, 19, 3, 5, 5, 3, 9, 6, 10, 7, 3, 14],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 0.2)',
            }]
        },
        options: options,
    });
}
if(document.getElementById('chart-line-course')!= null) {
    new Chart(document.getElementById('chart-line-course').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Développement', 'Marketing', 'Communication'],
            datasets: [{
                label: ' Utilisateurs',
                data: [6, 4, 2],
                backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',],
                borderWidth: 1
            }]
        },
        options: options,
    });
}
