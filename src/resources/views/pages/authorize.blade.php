<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>

        <div class="d-flex align-items-center justify-content-center">
            <div class="card mb-3 w-50">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://www.myemdesigns.com/uploads/images/Imagen_o_foto_de_animal_digital.jpg" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Authorization Request</h5>
                            <p class="card-text"><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>
                            
                            <div class="buttons">
                                <!-- Authorize Button -->
                                <form method="post" action="{{ $client->redirect }}?code={{ $code }}&state={{ $request->state }}">
                                    @csrf

                                    <input type="hidden" name="state" value="{{ $request->state }}">
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <input type="hidden" name="code" value="{{ $code }}">
                                    <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                                </form>

                                <!-- Cancel Button -->
                                <form method="post" action="">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="state" value="{{ $request->state }}">
                                    <input type="hidden" name="client_id" value="{{ $client->uuid }}">
                                    <input type="hidden" name="code" value="{{ $code }}">
                                    <button class="btn btn-danger">Cancel</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>