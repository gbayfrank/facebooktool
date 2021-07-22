@if (session('gbayvn_notify'))
<div class="row" id="alert">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <strong>{!! session('gbayvn_notify') !!}</strong>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const alert = document.getElementById('alert');
        setTimeout(() => alert.style.display = 'none' , 15000);
    });
</script>
@endif