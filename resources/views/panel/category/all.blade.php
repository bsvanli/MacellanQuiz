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
                searching: false,
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'total_count', defaultContent: 0},
                    {data: 'updated_at'},
                    {data: null, defaultContent: '', orderable: false}
                ],
                createdRow: function ( row, data, index ) {
                    $('td', row).eq(4).addClass('text-right').html('<a href="/panel/category/edit/' + data.id + '" class="btn btn-primary btn-sm mr-1">Düzenle</a>');
                }
            } );
        });
    </script>
@endsection
