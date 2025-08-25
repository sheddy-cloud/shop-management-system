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
            <label for="client_filter" class="form-label">Client</label>
            <select class="form-control" id="client_filter">
              <option value="">All Clients</option>
              <?php 
                $clients = $conn->query("SELECT DISTINCT client FROM sales_list WHERE client IS NOT NULL AND client != '' ORDER BY client");
                while($client = $clients->fetch_assoc()):
              ?>
              <option value="<?php echo $client['client'] ?>"><?php echo $client['client'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">&nbsp;</label>
            <button type="button" class="btn btn-primary d-block" onclick="generateReport()">
              <i class="fas fa-search me-2"></i>Generate Report
            </button>
          </div>
        </div>
        
        <!-- Summary Cards -->
        <div class="row mb-4" id="summary-cards">
          <div class="col-md-3">
            <div class="card bg-primary text-white">
              <div class="card-body text-center">
                <h4 class="mb-0" id="total-sales">0</h4>
                <small>Total Sales</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-success text-white">
              <div class="card-body text-center">
                <h4 class="mb-0" id="total-amount">₱0.00</h4>
                <small>Total Amount</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-info text-white">
              <div class="card-body text-center">
                <h4 class="mb-0" id="avg-amount">₱0.00</h4>
                <small>Average Sale</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-warning text-white">
              <div class="card-body text-center">
                <h4 class="mb-0" id="top-client">-</h4>
                <small>Top Client</small>
              </div>
            </div>
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
            <tbody id="sales-tbody">
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
  const clientFilter = document.getElementById('client_filter').value;
  
  // Show loading
  const tbody = document.getElementById('sales-tbody');
  tbody.innerHTML = '<tr><td colspan="5" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>';
  
  // Make AJAX request
  $.ajax({
    url: _base_url_ + 'classes/Master.php?f=get_sales_report',
    method: 'POST',
    data: {
      date_from: dateFrom,
      date_to: dateTo,
      client: clientFilter
    },
    dataType: 'json',
    success: function(response) {
      if(response.status === 'success') {
        updateSalesTable(response.data);
        updateSummaryCards(response.summary);
      } else {
        alert('Error generating report: ' + response.msg);
      }
    },
    error: function() {
      alert('Error connecting to server');
    }
  });
}

function updateSalesTable(data) {
  const tbody = document.getElementById('sales-tbody');
  tbody.innerHTML = '';
  
  if(data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5" class="text-center">No sales found for the selected criteria</td></tr>';
    return;
  }
  
  data.forEach(function(sale) {
    const row = `
      <tr>
        <td><span class="badge bg-primary">${sale.sales_code}</span></td>
        <td><strong>${sale.client}</strong></td>
        <td><span class="text-success fw-bold">₱${parseFloat(sale.amount).toLocaleString('en-US', {minimumFractionDigits: 2})}</span></td>
        <td><small class="text-muted">${new Date(sale.date_created).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})}</small></td>
        <td>
          <a href="?page=sales/view_sale&id=${sale.id}" class="btn btn-sm btn-info">
            <i class="fas fa-eye"></i>
          </a>
        </td>
      </tr>
    `;
    tbody.innerHTML += row;
  });
}

function updateSummaryCards(summary) {
  document.getElementById('total-sales').textContent = summary.total_sales;
  document.getElementById('total-amount').textContent = '₱' + parseFloat(summary.total_amount || 0).toLocaleString('en-US', {minimumFractionDigits: 2});
  document.getElementById('avg-amount').textContent = '₱' + parseFloat(summary.avg_amount || 0).toLocaleString('en-US', {minimumFractionDigits: 2});
  document.getElementById('top-client').textContent = summary.top_client || '-';
}

// Initialize with current month
document.addEventListener('DOMContentLoaded', function() {
  const today = new Date();
  const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
  
  document.getElementById('date_from').value = firstDay.toISOString().split('T')[0];
  document.getElementById('date_to').value = today.toISOString().split('T')[0];
  
  // Generate initial report
  generateReport();
});
</script>



