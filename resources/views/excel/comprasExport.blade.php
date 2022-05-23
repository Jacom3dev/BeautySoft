<table>
    <thead>
    <tr>
        <th><b>ID Compra</b></th> 
        <th><b>Comprado por</b></th> 
        <th><b>Proveedor</b></th>
        <th><b>Telefono</b></th>
        <th><b>Empresa</b></th>
        <th><b>Productos</b></th>
        <th><b>Precio</b></th>
        <th><b>fecha</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($compras as $compra)
        <tr>
            <td>{{$compra->id }}</td>
            <td>{{$compra->name }}</td>
            <td>{{$compra->supplier}}</td>
            <td>{{$compra->cell}}</td>
            <td>{{$compra->enterprise}}</td>
            <td><?php foreach ($productos as $key => $value) {
                if ($compra->id == $value->id) {     
                    echo $value->name.'<br>';
                }
             } ?>
            </td>
            <td>{{$compra->price}}</td>
            <td>{{$compra->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
