<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-5">
    <h2 class="mb-4">Dashboard Thống Kê</h2>

    <div class="row text-center mb-4">
        <div class="col-md-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Tổng danh mục</h5>
                    <h3><?= count($listdanhmuc) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Tổng sản phẩm</h5>
                    <h3><?= count($listsanpham) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Người dùng</h5>
                    <h3><?= count($listnguoidung) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Admin</h5>
                    <h3><?= $admin_count ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5>Người dùng thường</h5>
                    <h3><?= $user_count ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Bình luận</h5>
                    <h3><?= count($listbinhluan) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="row mt-5">
        <div class="col-md-6">
            <h5 class="text-center">Thống kê người dùng</h5>
            <canvas id="userChart"></canvas>
        </div>
        <div class="col-md-6">
            <h5 class="text-center">Thống kê sản phẩm & bình luận</h5>
            <canvas id="productChart"></canvas>
        </div>
    </div>
</div>

<script>
    const userChart = new Chart(document.getElementById('userChart'), {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Người dùng thường'],
            datasets: [{
                data: [<?= $admin_count ?>, <?= $user_count ?>],
                backgroundColor: ['#ffc107', '#6c757d'],
            }]
        }
    });

    const productChart = new Chart(document.getElementById('productChart'), {
        type: 'bar',
        data: {
            labels: ['Sản phẩm', 'Bình luận'],
            datasets: [{
                label: 'Số lượng',
                data: [<?= count($listsanpham) ?>, <?= count($listbinhluan) ?>],
                backgroundColor: ['#0d6efd', '#dc3545']
            }]
        }
    });
</script>
