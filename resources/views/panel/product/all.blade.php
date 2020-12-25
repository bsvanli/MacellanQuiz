@extends('panel.master')
@section('title') Ürünler @endsection

@section('content')

    <div class="content">
        <h2 class="mt-4">Ürünler
            <a href="{{ route('panel.product.add') }}" class="btn btn-success float-right">Yeni Ürün Ekle</a> </h2>
        <table id="products" class="table table-striped display nowrap">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Ürün Adı</th>
                <th>Bulunduğu Kategori</th>
                <th>Son Güncelleme</th>
                <th class="text-right">Seçenekler</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script>
        let endpoint = '{{ route('panel.product.ajax.all') }}';
        let dt;
        $(function(){
            dt = $('#products').DataTable( {
                ajax: endpoint,
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'categories', orderable: false,searchable: false},
                    {data: 'updated_at'},
                    {data: null, defaultContent: '', orderable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(4).addClass('text-right').html('<a href="/panel/product/edit/' + data.id + '" class="btn btn-primary btn-sm mr-1">Düzenle</a> <a href="/api/products/' + data.id + '" class="delete btn btn-danger btn-sm">Sil</a>');
                }
            } );
            $(document).on('click', '.delete', deleteProduct);
        });
        function deleteProduct(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                method: 'DELETE',
                error: function(jqXHR, textStatus, errorThrown){
                    alert(jqXHR.responseJSON.message);
                },
                success: function (response) {
                    dt.ajax.reload()
                }
            });
        }
    </script>
@endsection
