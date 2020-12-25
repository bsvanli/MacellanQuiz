@extends('panel.master')
@section('title') @if(isset($category)) Kategori Düzenle @else Kategori Ekle @endif @endsection

@section('content')
    <div class="content col-md-6">
        <h2>@if(isset($category)) Kategori Düzenle @else Kategori Ekle @endif</h2>

        <form id="category-form">
            <div class="form-group">
                <label for="category-name">Kategori Adı</label>
                <input type="text" class="form-control" id="category-name" name="name" placeholder="Kategori adını giriniz" @isset($category) value="{{ $category->name }}" @endisset>
            </div>
            <div class="form-group">
                <label for="product-description">Bağlı olduğu kategori</label>
                <div class="just-padding">
                    <div class="category-list list-group-root well">
                            <div class="category-item">
                                <label><input type="radio" name="parent" value="0" @if(isset($category) && $category->parent_id == null) checked="checked" @endif/> Ana Kategori</label>
                            </div>
                        @each('panel.partials.category', $categories, 'category')
                    </div>
                </div>
            </div>

            <button id="send" type="button" class="btn btn-primary">Kaydet</button>
        </form>
    </div>

@endsection

@section('script')
    <script>
        $(function(){
            let method = 'POST'
            $(document).on('click', '#send', send);
            function send(){
                let button = $(this);
                $.ajax({
                    url: '{{ $endpoint }}',
                    method: method,
                    data: $('#category-form').serialize(),
                    beforeSend: function(){
                        button.text('Lütfen bekleyiniz');
                        button.attr('disabled', true);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert(jqXHR.responseJSON.message);
                    },
                    success: function (response) {
                        alert(response.message);
                        location.href = response.data.redirect;
                    },
                    complete: function(){
                        button.text('Kaydet');
                        button.attr('disabled', false);
                    }
                });
            }
        });
    </script>
@endsection
