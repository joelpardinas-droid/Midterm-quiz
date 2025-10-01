<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container my-5">
    <h1 class="text-center mb-4">Product Information</h1>

    <!-- Flash message -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Product Input Form -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form class="row g-3" method="POST" action="{{ url('/products') }}">
          @csrf
          <div class="col-md-6">
            <label class="form-label">Product ID</label>
            <input type="text" name="product_id" class="form-control" placeholder="Enter Product ID" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Category</label>
            <input type="text" name="product_category" class="form-control" placeholder="Enter Category" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Product Quantity</label>
            <input type="number" name="product_quantity" class="form-control" placeholder="Enter Quantity" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Product Price</label>
            <input type="number" step="0.01" name="product_price" class="form-control" placeholder="Enter Price" required>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary me-2">Add Product</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Table for Product List Information -->
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Product List</h5>
          <!-- Search Bar -->
          <form class="d-flex" method="GET" action="{{ url('/products/search') }}">
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search product name..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $p)
              <tr>
                <td>{{ $p['id'] }}</td>
                <td>{{ $p['name'] }}</td>
                <td>{{ $p['category'] }}</td>
                <td>{{ $p['quantity'] }}</td>
                <td>{{ $p['price'] }}</td>
                <td class="d-flex">
                  <a href="{{ url('/products/'.$p['id'].'/edit') }}" class="btn btn-sm btn-warning me-1">Edit</a>
                  <form method="POST" action="{{ url('/products/'.$p['id']) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">No products found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>