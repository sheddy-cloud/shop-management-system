<?php 
  // These files are included through the main index.php, so we don't need to include them again
  // The config and header are already included by the main index.php
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-line me-2"></i>
          Sales Report
        </h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3">
            <label for="date_from" class="form-label">Date From</label>
            <input type="date" class="form-control" id="date_from" name="date_from">
          </div>
          <div class="col-md-3">
            <label for="date_to" class="form-label">Date To</label>
            <input type="date" class="form-control" id="date_to" name="date_to">
          </div>
          <div class="col-md-3">
            <label class="form-label">&nbsp;</label>
            <button type="button" class="btn btn-primary d-block" onclick="generateReport()">
              <i class="fas fa-search me-2"></i>Generate Report
            </button>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover" id="sales-table">
            <thead>
              <tr>
                <th>Sales Code</th>
                <th>Client</th>
                <th>Total Amount</th>
                <th>Date Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $sales_query = "SELECT * FROM sales_list ORDER BY date_created DESC";
                $sales_result = $conn->query($sales_query);
                while($row = $sales_result->fetch_assoc()):
              ?>
              <tr>
                <td><span class="badge bg-primary"><?php echo $row['sales_code'] ?></span></td>
                <td><strong><?php echo $row['client'] ?></strong></td>
                <td><span class="text-success fw-bold">₱<?php echo number_format($row['amount'], 2) ?></span></td>
                <td><small class="text-muted"><?php echo date('M j, Y', strtotime($row['date_created'])) ?></small></td>
                <td>
                  <a href="?page=sales/view_sale&id=<?php echo $row['id'] ?>" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i>
                  </a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function generateReport() {
  const dateFrom = document.getElementById('date_from').value;
  const dateTo = document.getElementById('date_to').value;
  
  if (!dateFrom || !dateTo) {
    alert('Please select both date range values.');
    return;
  }
  
  // Here you would typically make an AJAX call to filter the data
  // For now, we'll just show an alert
  alert('Report generation feature will be implemented here.');
}
</script>



