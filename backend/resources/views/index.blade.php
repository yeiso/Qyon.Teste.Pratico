<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Lista de Movimentações</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Conta_ID</th>
                    <th>Conta</th>
                    <th>Valor</th>
                    <th>Movimento</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transfer as $transfer)
                <tr>
                    <th scope="row">{{ $transfer->id }}</th>
                    <td>{{ $transfer->conta_id }}</td>
                    <td>{{ $transfer->conta }}</td>
                    <td>{{ $transfer->valor }}</td>
                    <td>{{ $transfer->movimento }}</td>
                    <td>{{ $transfer->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <th></th>
                    <td></td>
                    <td>Nenhum Registro cadastrado</td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>