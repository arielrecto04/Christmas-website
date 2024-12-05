<div x-data="pieChart">
    <div x-ref="chart"></div>
</div>




@push('js')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        const pieChart = () => ({
            chart: null,
            init() {

                const chartEl = this.$refs.chart;

                var options = {
                    series: [44, 55, 13, 43, 22],
                    chart: {
                        width: 380,
                        type: "pie",
                    },
                    labels: ["Team A", "Team B", "Team C", "Team D", "Team E"],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    }, ],
                };

                this.chart = new ApexCharts(chartEl, options);
                this.chart.render();
            },
        });
    </script>
@endpush
