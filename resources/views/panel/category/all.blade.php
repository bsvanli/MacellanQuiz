@extends('panel.master')
@section('title') Kategoriler @endsection

@section('content')

    <div class="content">
        <h2 class="mt-4">Kategoriler
            <a href="{{ route('panel.category.add') }}" class="btn btn-success float-right">Yeni Kategori Ekle</a> </h2>
        <table id="categories" class="table table-striped display nowrap">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Kategori Adı</th>
                <th>Ürün Sayısı</th>
                <th>Bağlı Olduğu Kategori</th>
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
        let endpoint = '{{ route('panel.category.ajax.all') }}';
        let dt;
        $(function(){
            dt = $('#categories').DataTable( {
                ajax: endpoint,
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'product_count'},
                    {data: 'parent.name', defaultContent: 'Ana Kategori'},
                    {data: 'updated_at'},
                    {data: null, defaultContent: '', orderable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(5).addClass('text-right').html('<a href="/panel/category/edit/' + data.id + '" class="btn btn-primary btn-sm mr-1">Düzenle</a> <a href="/api/products/' + data.id + '" class="delete btn btn-danger btn-sm">Sil</a>');
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
                    alert(jqXHR.responseJSON.messages[0]);
                },
                success: function (response) {
                    dt.ajax.reload()
                }
            });
        }
    </script>
@endsection