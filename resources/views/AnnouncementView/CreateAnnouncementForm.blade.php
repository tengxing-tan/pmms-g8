<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col-md-12">
                <h2>Create New Announcement</h2>
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="post" action="{{url('save-announcement')}}">
                    @csrf
                    <div class="md-3">
                        <label class="form-lebel">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{old('title')}}">
                        @error('title')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="md-3">
                        <label class="form-lebel">Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter Description" rows="4" cols="50">{{old('description')}}</textarea>
                        @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div><br>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url('admin-announcement-list')}}" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
