<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UBX Tanzania</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <Link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >

    </head>
    <body>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text-success"><strong>UBX Assignment.</strong></h3>
                    <p>An application to upload a data to database from excel sheet, Retrieve on both API Endpoint and on normal html page.</p>
                    <div class="my-3">
                        <h4>API Endpoints</h4>
                        <p>GET: <em>http://localhost/api/cargo/all</em></p>
                    </div>

                    <div class="card bg-light mt-3">
                        <div class="card-header">
                            Import Data From Excel
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            <br>
                            @endif
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" name="file" class="form-control">
                                <br>
                                <button class="btn btn-success">Import Bulk Data</button>
                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
