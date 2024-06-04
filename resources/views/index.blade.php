<!doctype html>
<html lang="en">
<head>
    <title>Danh sách xe</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* Định dạng bảng */
        table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        /* Định dạng container */
        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Danh sách xe</h1>
        <h4>Lê Văn Vũ</h4>

        <!-- Hiển thị tổng số xe -->
        <p>Danh sách này có {{ $totalCars }} xe.</p>

        <!-- Form tìm kiếm -->
        <form action="{{ route('cars.search') }}" method="post" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="txtSearch" class="form-control" placeholder="Tìm kiếm" aria-describedby="button-search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-search">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <!-- Thêm mới xe -->
        <a class="btn btn-success mb-3" href="{{ route('cars.create') }}" role="button">Thêm mới 1 xe</a>

        <!-- Hiển thị thông báo -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Bảng hiển thị danh sách xe -->
        <table class="table">
            <thead>
                <tr>
                    <th>Số Thứ Tự</th>
                    <th scope="col">ID</th>
                    <th scope="col">Description</th>
                    <th scope="col">Model</th>
                    <th scope="col">Produced On</th>
                    <th scope="col">Namespace</th>
                    <th scope="col">Image</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $key => $car)
                    <tr>
                        <td>{{ $cars->firstItem() + $key }}</td> <!-- Sử dụng firstItem() để tính số thứ tự đúng khi phân trang -->
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->description }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->produced_on }}</td>
                        <td>{{ $car->mf->mf_name }}</td>
                        <td><img src="/images/{{ $car->image }}" alt="Car image" style="width: 100px; height: auto;"></td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('cars.show', ['car' => $car->id]) }}" role="button">Chi tiết</a>
                            <a class="btn btn-info" href="{{ route('cars.edit', ['car' => $car->id]) }}" role="button">Sửa</a>
                            <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Hiển thị liên kết phân trang với tệp Blade tùy chỉnh -->
        {{ $cars->links('vendor.pagination.custom') }}
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
