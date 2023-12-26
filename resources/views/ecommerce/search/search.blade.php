<script>
    $(document).ready(() => {
        $('#search').autocomplete({
            source: (request, response) =>{
                $.ajax({
                    url: "{{ route('search.eco') }}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: (data) => {
                        response(data)
                    }
                });
            },
            select: function(event, ui) {
                if(ui.item.type == 'products'){
                    url = '{{route("producto.producto", ":slug")}}';
                    url = url.replace(':slug', ui.item.slug);
                }else if(ui.item.type == 'categories'){
                    url = '{{ route("category.productos",  ":category") }}';
                    url = url.replace(':category', ui.item.label);
                }else if(ui.item.type == 'posts'){
                    url = '{{ route("blog.show",  ":post") }}'
                    url = url.replace(':post', ui.item.slug);
                }

                window.location.href = url;
            }
        });

        document.getElementById('form__search').addEventListener('submit', event =>{
            value = document.getElementById('search').value;
            if(value.trim().length <= 1){
                event.preventDefault();
            }
        })
    });
</script>
