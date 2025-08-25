<?php 
  require_once('../config.php');
  require_once('inc/header.php');
?>

<!-- User Info Header -->
<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="text-primary mb-1 fw-bold">
          <i class="fas fa-user-circle me-2"></i>
          Welcome back, <?php echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname'] ?>
        </h4>
        <p class="text-muted mb-0">Here's what's happening with your business today</p>
      </div>
      <div class="text-end">
        <span class="badge bg-primary fs-6">
          <i class="fas fa-calendar me-1"></i>
          <?php echo date('F j, Y') ?>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Key Performance Indicators -->
<div class="row mb-4">
  <div class="col-12">
    <h4 class="text-primary mb-3 fw-bold">
      <i class="fas fa-chart-line me-2"></i>
      Key Performance Indicators
    </h4>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-primary bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-shopping-cart text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-primary mb-0">
              <?php 
                $po_count = $conn->query("SELECT COUNT(*) as count FROM `purchase_order_list`")->fetch_assoc()['count'];
                echo $po_count;
              ?>
            </h3>
            <small class="text-muted">Purchase Orders</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-success bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-cash-register text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-success mb-0">
              <?php 
                $sales_count = $conn->query("SELECT COUNT(*) as count FROM `sales_list`")->fetch_assoc()['count'];
                echo $sales_count;
              ?>
            </h3>
            <small class="text-muted">Total Sales</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-info bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-truck text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-info mb-0">
              <?php 
                $receiving_count = $conn->query("SELECT COUNT(*) as count FROM `receiving_list`")->fetch_assoc()['count'];
                echo $receiving_count;
              ?>
            </h3>
            <small class="text-muted">Receiving</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-warning bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-undo text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-warning mb-0">
              <?php 
                $returns_count = $conn->query("SELECT COUNT(*) as count FROM `return_list`")->fetch_assoc()['count'];
                echo $returns_count;
              ?>
            </h3>
            <small class="text-muted">Returns</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Business Metrics -->
<div class="row mb-4">
  <div class="col-12">
    <h4 class="text-primary mb-3 fw-bold">
      <i class="fas fa-chart-pie me-2"></i>
      Business Metrics
    </h4>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-danger bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-exclamation-triangle text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-danger mb-0">
              <?php 
                $back_orders = $conn->query("SELECT COUNT(*) as count FROM `back_order_list`")->fetch_assoc()['count'];
                echo $back_orders;
              ?>
            </h3>
            <small class="text-muted">Back Orders</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-secondary bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-industry text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-secondary mb-0">
                <?php 
                $suppliers = $conn->query("SELECT COUNT(*) as count FROM `supplier_list`")->fetch_assoc()['count'];
                echo $suppliers;
                ?>
            </h3>
            <small class="text-muted">Suppliers</small>
          </div>
        </div>
            </div>
        </div>
    </div>
  
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-dark bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-users text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-dark mb-0">
                <?php 
                $users = $conn->query("SELECT COUNT(*) as count FROM `users`")->fetch_assoc()['count'];
                echo $users;
                ?>
            </h3>
            <small class="text-muted">System Users</small>
          </div>
        </div>
            </div>
        </div>
    </div>
  
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <div class="bg-primary bg-gradient rounded-circle p-3 me-3">
            <i class="fas fa-box text-white fs-4"></i>
          </div>
          <div>
            <h3 class="fw-bold text-primary mb-0">
                <?php 
                $items = $conn->query("SELECT COUNT(*) as count FROM `item_list`")->fetch_assoc()['count'];
                echo $items;
              ?>
            </h3>
            <small class="text-muted">Total Items</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
  <div class="col-12">
    <h4 class="text-primary mb-3 fw-bold">
      <i class="fas fa-bolt me-2"></i>
      Quick Actions
    </h4>
  </div>
  <div class="col-lg-6 col-md-6 mb-3">
    <a href="../purchase_order/" class="text-decoration-none">
      <div class="card h-100">
        <div class="card-body text-center">
          <i class="fas fa-shopping-cart text-primary fs-1 mb-3"></i>
          <h5 class="fw-bold text-primary">Create Purchase Order</h5>
          <small class="text-muted">Add new items to inventory</small>
        </div>
      </div>
    </a>
  </div>
  
  <div class="col-lg-6 col-md-6 mb-3">
    <a href="../sales/" class="text-decoration-none">
      <div class="card h-100">
        <div class="card-body text-center">
          <i class="fas fa-cash-register text-success fs-1 mb-3"></i>
          <h5 class="fw-bold text-success">Process Sale</h5>
          <small class="text-muted">Record customer transactions</small>
        </div>
      </div>
    </a>
  </div>
  
  <div class="col-lg-6 col-md-6 mb-3">
    <a href="../item/" class="text-decoration-none">
      <div class="card h-100">
        <div class="card-body text-center">
          <i class="fas fa-box text-info fs-1 mb-3"></i>
          <h5 class="fw-bold text-info">Manage Items</h5>
          <small class="text-muted">Update product information</small>
        </div>
      </div>
    </a>
  </div>
  
  <div class="col-lg-6 col-md-6 mb-3">
    <a href="../reports/" class="text-decoration-none">
      <div class="card h-100">
        <div class="card-body text-center">
          <i class="fas fa-chart-bar text-warning fs-1 mb-3"></i>
          <h5 class="fw-bold text-warning">View Reports</h5>
          <small class="text-muted">Analyze business performance</small>
        </div>
            </div>
    </a>
        </div>
    </div>
    
<!-- Recent Activity & Analytics -->
<div class="row">
  <div class="col-12">
    <h4 class="text-primary mb-3 fw-bold">
      <i class="fas fa-chart-line me-2"></i>
      Recent Activity & Analytics
    </h4>
  </div>
  
  <!-- Recent Sales -->
  <div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0 fw-bold">
          <i class="fas fa-cash-register me-2"></i>
          Recent Sales
        </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Invoice</th>
                <th>Client</th>
                <th>Amount</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                $recent_sales = $conn->query("SELECT * FROM `sales_list` ORDER BY `date_created` DESC LIMIT 5");
                while($row = $recent_sales->fetch_assoc()):
              ?>
              <tr>
                <td><span class="badge bg-primary"><?php echo $row['sales_code'] ?></span></td>
                <td><strong><?php echo $row['client'] ?></strong></td>
                <td><span class="text-success fw-bold">₱<?php echo number_format($row['amount'], 2) ?></span></td>
                <td><small class="text-muted"><?php echo date('M j, Y', strtotime($row['date_created'])) ?></small></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
            </div>
        </div>
    </div>
  
  <!-- Low Stock Items -->
  <div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0 fw-bold">
          <i class="fas fa-exclamation-triangle me-2"></i>
          Low Stock Items
        </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Item</th>
                <th>Current Stock</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                // Get current stock levels by calculating IN - OUT for each item
                $low_stock_query = "
                  SELECT 
                    i.name,
                    COALESCE(SUM(CASE WHEN s.type = 1 THEN s.quantity ELSE 0 END), 0) - 
                    COALESCE(SUM(CASE WHEN s.type = 2 THEN s.quantity ELSE 0 END), 0) as current_stock
                  FROM item_list i
                  LEFT JOIN stock_list s ON i.id = s.item_id
                  GROUP BY i.id, i.name
                  HAVING current_stock <= 10 AND current_stock > 0
                  ORDER BY current_stock ASC
                  LIMIT 5
                ";
                $low_stock = $conn->query($low_stock_query);
                while($row = $low_stock->fetch_assoc()):
                  $status_class = $row['current_stock'] <= 5 ? 'bg-danger' : 'bg-warning';
                  $status_text = $row['current_stock'] <= 5 ? 'Critical' : 'Low';
              ?>
              <tr>
                <td><strong><?php echo $row['name'] ?></strong></td>
                <td><span class="fw-bold"><?php echo $row['current_stock'] ?></span></td>
                <td><span class="badge <?php echo $status_class ?>"><?php echo $status_text ?></span></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
            </div>
        </div>
    </div>

<!-- Additional Stats Row -->
<div class="row">
  <div class="col-lg-4 mb-3">
    <div class="card">
      <div class="card-body text-center">
        <i class="fas fa-users text-primary fs-1 mb-3"></i>
        <h4 class="fw-bold text-primary">
                <?php 
            $active_users = $conn->query("SELECT COUNT(*) as count FROM `users` WHERE `type` = 2")->fetch_assoc()['count'];
            echo $active_users;
                ?>
        </h4>
        <p class="text-muted mb-0">Active Staff Users</p>
            </div>
        </div>
    </div>
  
  <div class="col-lg-4 mb-3">
    <div class="card">
      <div class="card-body text-center">
        <i class="fas fa-warehouse text-success fs-1 mb-3"></i>
        <h4 class="fw-bold text-success">
                <?php 
            $stock_items = $conn->query("SELECT COUNT(*) as count FROM `stock_list`")->fetch_assoc()['count'];
            echo $stock_items;
                ?>
        </h4>
        <p class="text-muted mb-0">Stock Records</p>
            </div>
        </div>
    </div>
  
  <div class="col-lg-4 mb-3">
    <div class="card">
      <div class="card-body text-center">
        <i class="fas fa-calendar-day text-info fs-1 mb-3"></i>
        <h4 class="fw-bold text-info">
                <?php 
            $today_sales = $conn->query("SELECT COUNT(*) as count FROM `sales_list` WHERE DATE(`date_created`) = CURDATE()")->fetch_assoc()['count'];
            echo $today_sales;
                ?>
        </h4>
        <p class="text-muted mb-0">Today's Sales</p>
            </div>
        </div>
    </div>
</div>

<?php require_once('inc/footer.php') ?>