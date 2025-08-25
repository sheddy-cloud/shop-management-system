<?php 
  // These files are included through the main index.php, so we don't need to include them again
  // The config and header are already included by the main index.php
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie me-2"></i>
          Inventory Report
        </h3>
      </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card bg-primary text-white">
              <div class="card-body text-center">
                <h4 class="mb-0">
                  <?php 
                    $total_items = $conn->query("SELECT COUNT(*) as count FROM item_list")->fetch_assoc()['count'];
                    echo $total_items;
                  ?>
                </h4>
                <small>Total Items</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-success text-white">
              <div class="card-body text-center">
                <h4 class="mb-0">
                  <?php 
                    $total_stock = $conn->query("SELECT COUNT(*) as count FROM stock_list")->fetch_assoc()['count'];
                    echo $total_stock;
                  ?>
                </h4>
                <small>Stock Records</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-warning text-white">
              <div class="card-body text-center">
                <h4 class="mb-0">
                  <?php 
                    $low_stock_query = "
                      SELECT COUNT(*) as count FROM (
                        SELECT 
                          i.id,
                          COALESCE(SUM(CASE WHEN s.type = 1 THEN s.quantity ELSE 0 END), 0) - 
                          COALESCE(SUM(CASE WHEN s.type = 2 THEN s.quantity ELSE 0 END), 0) as current_stock
                        FROM item_list i
                        LEFT JOIN stock_list s ON i.id = s.item_id
                        GROUP BY i.id
                        HAVING current_stock <= 10 AND current_stock > 0
                      ) as low_stock_items
                    ";
                    $low_stock_count = $conn->query($low_stock_query)->fetch_assoc()['count'];
                    echo $low_stock_count;
                  ?>
                </h4>
                <small>Low Stock Items</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-danger text-white">
              <div class="card-body text-center">
                <h4 class="mb-0">
                  <?php 
                    $out_of_stock_query = "
                      SELECT COUNT(*) as count FROM (
                        SELECT 
                          i.id,
                          COALESCE(SUM(CASE WHEN s.type = 1 THEN s.quantity ELSE 0 END), 0) - 
                          COALESCE(SUM(CASE WHEN s.type = 2 THEN s.quantity ELSE 0 END), 0) as current_stock
                        FROM item_list i
                        LEFT JOIN stock_list s ON i.id = s.item_id
                        GROUP BY i.id
                        HAVING current_stock <= 0
                      ) as out_of_stock_items
                    ";
                    $out_of_stock_count = $conn->query($out_of_stock_query)->fetch_assoc()['count'];
                    echo $out_of_stock_count;
                  ?>
                </h4>
                <small>Out of Stock</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover" id="inventory-table">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Current Stock</th>
                <th>Status</th>
                <th>Last Updated</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $inventory_query = "
                  SELECT 
                    i.name,
                    i.date_updated,
                    COALESCE(SUM(CASE WHEN s.type = 1 THEN s.quantity ELSE 0 END), 0) - 
                    COALESCE(SUM(CASE WHEN s.type = 2 THEN s.quantity ELSE 0 END), 0) as current_stock
                  FROM item_list i
                  LEFT JOIN stock_list s ON i.id = s.item_id
                  GROUP BY i.id, i.name, i.date_updated
                  ORDER BY current_stock ASC
                ";
                $inventory_result = $conn->query($inventory_query);
                while($row = $inventory_result->fetch_assoc()):
                  $status_class = $row['current_stock'] <= 0 ? 'bg-danger' : ($row['current_stock'] <= 5 ? 'bg-warning' : 'bg-success');
                  $status_text = $row['current_stock'] <= 0 ? 'Out of Stock' : ($row['current_stock'] <= 5 ? 'Low Stock' : 'In Stock');
              ?>
              <tr>
                <td><strong><?php echo $row['name'] ?></strong></td>
                <td><span class="fw-bold"><?php echo $row['current_stock'] ?></span></td>
                <td><span class="badge <?php echo $status_class ?>"><?php echo $status_text ?></span></td>
                <td><small class="text-muted"><?php echo date('M j, Y', strtotime($row['date_updated'])) ?></small></td>
                <td>
                  <a href="?page=maintenance/item" class="btn btn-sm btn-info">
                    <i class="fas fa-edit"></i>
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



