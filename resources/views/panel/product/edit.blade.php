@extends('panel.master')
@section('title') @if(isset($product)) Ürün Düzenle @else Ürün Ekle @endif @endsection

@section('content')
    <div class="content col-md-6">
        <h2>@if(isset($product)) Ürün Düzenle @else Ürün Ekle @endif</h2>

        <form id="product-form">
            <div class="form-group">
                <label for="product-name">Ürün Adı</label>
                <input type="text" class="form-control" id="product-name" name="name" placeholder="Ürün adını giriniz" @isset($product) value="{{ $product->name }}" @endisset>
            </div>
            <div class="form-group">
                <label for="product-price">Ürün Fiyatı</label>
                <input type="text" class="form-control" id="product-price" name="price" placeholder="Ürün fiyatını giriniz" @isset($product) value="{{ $product->price }}" @endisset>
            </div>
            <div class="form-group">
                <label for="product-description">Bağlı olduğu kategoriler</label>
                <div class="just-padding">
                    <div class="category-list list-group-root well">
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
                    data: $('#product-form').serialize(),
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
