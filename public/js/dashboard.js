const data = {
    servicesByCategory: {
        labels: ['Design', 'Development', 'Marketing', 'Writing', 'Admin Support'],
        values: [45, 60, 35, 30, 25]
    },
    serviceStatus: {
        labels: ['Active', 'Pending', 'Reported'],
        values: [70, 20, 10]
    },
    userDistribution: {
        labels: ['Freelancers', 'Clients'],
        values: [60, 40]
    }
};

const colors = {
    primary: '#8A4FFF',
    secondary: '#FF4F8A',
    tertiary: '#4FD1FF'
};

document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('servicesByCategoryChart'), {
        type: 'bar',
        data: {
            labels: data.servicesByCategory.labels,
            datasets: [{
                label: 'Number of Services',
                data: data.servicesByCategory.values,
                backgroundColor: colors.primary,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    new Chart(document.getElementById('serviceStatusChart'), {
        type: 'doughnut',
        data: {
            labels: data.serviceStatus.labels,
            datasets: [{
                data: data.serviceStatus.values,
                backgroundColor: [colors.primary, colors.secondary, colors.tertiary],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } },
            cutout: '60%'
        }
    });

    new Chart(document.getElementById('userDistributionChart'), {
        type: 'pie',
        data: {
            labels: data.userDistribution.labels,
            datasets: [{
                data: data.userDistribution.values,
                backgroundColor: [colors.primary, colors.secondary],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});