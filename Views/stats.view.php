<div class="container-back-wrap stats-wrapper">
    <section>
        <div class="banner banner--text banner--header" style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Statistiques</h4>
                <p class="my-0">Retrouvez toutes vos statistiques ici</p>
            </div>
        </div>

        <div class="row mt-8">

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="stats-block flex flex-col align-center">
                    <span class="big-number">20</span>
                    <span class="my-0">Utilisateurs</span>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="stats-block flex flex-col align-center">
                    <span class="big-number">10</span>
                    <span class="my-0">Pages</span>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="stats-block flex flex-col align-center">
                    <span class="big-number">12</span>
                    <span class="my-0">Formations</span>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="stats-block flex flex-col align-center">
                    <span class="big-number">14</span>
                    <span class="my-0">Articles</span>
                </div>
            </div>
            
        </div>

        <div class="row mt-2">

            <div class="col-xl-6 col-sm-12">
                <div class="stats-block">
                    <h1 class="pt-2 mt-0">Nombres d'utilisateurs inscrits</h1>
                    <div class="canvas-wrapper">
                        <canvas id="chart-line-users"></canvas> 
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-sm-12">
                <div class="stats-block">
                    <h1 class="pt-2 mt-0">Nombres de formations par thèmes</h1>
                    <div class="canvas-wrapper">
                        <canvas id="chart-line-course" style="min-height: 200px;"></canvas> 
                    </div>
                </div>
            </div>

        </div>
        
    </section>

</div>

<script>

let options = {
    responsive: true,
    legend: {
        display: true,
        position: 'bottom',
        onClick: null
    },
    maintainAspectRatio: false,
}

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




</script>