<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="mb-3">
    <h2>Relatório - Ranking dos 10 Produtos Mais Vendidos</h2>
    <hr class="text-muted">

    <canvas id="rankingChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('rankingChart').getContext('2d');
        const rankingData = {
            labels: <?= json_encode(array_column($ranking, 'nome')) ?>,
            datasets: [{
                label: 'Total de Saídas',
                data: <?= json_encode(array_column($ranking, 'total_saidas')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: rankingData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>