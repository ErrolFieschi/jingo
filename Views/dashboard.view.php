<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header"
             style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Tableau de bord</h4>
                <p class="my-0">L'endroit pour configurer ton site comme tu le souhaites</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <section class="col-lg-7">
                <div class="row row--space-around">
                    <div class="col-md-6 col-sm-12">
                        <div class="card-center card--shadow">
                            <img class="svg-dashboard" src="/Content/Images/create_courses.svg" alt="register">
                        </div>
                        <p>Créer un cours</p>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xl-6">
                        <div class="card-center card--shadow">
                            <img class="svg-dashboard" src="/Content/Images/create_lesson.svg" alt="lesson">
                        </div>
                        <p>Créer une leçon</p>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card-center card--shadow">
                            <img class="svg-dashboard" src="/Content/Images/create_page.svg" alt="import page">
                        </div>
                        <p>Créer un cours</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card-center card--shadow">
                            <img class="svg-dashboard" src="/Content/Images/import_file.svg" alt="files">
                        </div>
                        <p>Créer une leçon</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card-center card--shadow">
                            <img class="svg-dashboard" src="/Content/Images/my_photo.svg" alt="photos">
                        </div>
                        <p>Créer un cours</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card-center card--shadow">
                            <img class="svg-dashboard" src="/Content/Images/my_video.svg" alt="register">
                        </div>
                        <p>Créer une leçon</p>
                    </div>
                </div>
            </section>
            <section class="col-lg-5 col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-center card--shadow p-10 dashboard-stats">
                            <h4 class="mt-0 tc">Nombres de formations par thèmes</h4>
                            <div style="min-height: 250px;">
                                <canvas id="chart-line-course"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>

<script>

    $(document).ready(function () {
        showChartDonutTraining();
    });

    function showChartDonutTraining() {
        if(document.getElementById('chart-line-course')!= null) {
            new Chart(document.getElementById('chart-line-course').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: [<?php echo '"'.implode('","', $trainingsByTagName).'"' ?>],
                    datasets: [{
                        data: [<?php echo '"'.implode('","', $trainingsByTagData).'"' ?>],
                        backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom',
                        onClick: null
                    },
                    maintainAspectRatio: false,
                },
            });
        }
    }

</script>