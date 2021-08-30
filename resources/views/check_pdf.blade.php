<body class="antialiased container mt-5">

    <table class="table">
        <thead>
            <tr class="table-primary">
                <td>Product Name</td>
                <td>Price</td>
                <td>In Stock</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($p as $data)
            <tr>
                <td>{{ $data->title }}</td>
                <td>{{ $data->author }}</td>
                <td>{{ $data->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

