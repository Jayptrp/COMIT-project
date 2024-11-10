<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <nav>
        <ul>
          <li><a href="#users">Users</a></li>
          <li><a href="#reports">Reports</a></li>
          <li><a href="#logout">Logout</a></li>
        </ul>
      </nav>
    </aside>
    
    <!-- Main Content Area -->
    <main class="main-content">
      <!-- Users Section -->
      <section id="users">
        <h2>Users</h2>
        <p>Manage users here.</p>
        
        <!-- User Table -->
        <table class="user-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Role</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John Doe</td>
              <td>Admin</td>
              <td><button class="remove-btn">Remove</button></td>
            </tr>
            <tr>
              <td>Jane Smith</td>
              <td>Editor</td>
              <td><button class="remove-btn">Remove</button></td>
            </tr>
            <tr>
              <td>Mark Wilson</td>
              <td>Viewer</td>
              <td><button class="remove-btn">Remove</button></td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Reports Section -->
      <section id="reports">
        <h2>Reports</h2>
        <p>Access detailed reports here.</p>
      </section>
    </main>
  </div>
</body>
</html>
