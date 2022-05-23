<table>
    <thead>
    <tr>
        <th><b>ID Compra</b></th> 
        <th><b>Hecha por</b></th> 
        <th><b>Cliente</b></th>
        <th><b>Telefono</b></th>
        <th><b>Documento</b></th>
        <th><b>Productos</b></th>
        <th><b>Precio</b></th>
        <th><b>fecha</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($ventas as $venta)
        <tr>
            <td>{{$venta->id }}</td>
            <td>{{$venta->name }}</td>
            <td>{{$venta->clientName}}</td>
            <td>{{$venta->cell}}</td>
            <td>{{$venta->document}}</td>
            <td><?php foreach ($productos as $key => $value) {
                if ($venta->id == $value->id) {     
                    echo $value->name.'<br>';
                }
             } ?>
            </td>
            <td>{{$venta->price}}</td>
            <td>{{$venta->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
