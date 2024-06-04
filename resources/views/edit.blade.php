<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Xe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Sửa Thông Tin Xe</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('cars.update', $car->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $car->description }}">
                            </div>
                            <div class="form-group">
                                <label for="model">Model:</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}">
                            </div>
                            <div class="form-group">
                                <label for="produced_on">Produced On:</label>
                                <input type="text" class="form-control" id="produced_on" name="produced_on" value="{{ $car->produced_on }}">
                            </div>
                            <div class="form-group">
                                <label for="current_image">Hình ảnh hiện tại:</label>
                                <br>
                                <img src="/images/{{ $car->image }}" alt="Car image" id="currentImage">
                            </div>
                            <div class="form-group">
                                <label for="image">Hình ảnh mới:</label>
                                <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật Thông Tin Xe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('currentImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
