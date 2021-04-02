<div class="alert alert-success validation" style="{{session()->has('success')?'':'display: none;'}}">
      <button type="button" class="close alert-close"><span>×</span></button>
      <p class="text-left">{!! session()->has('success')?session()->get('success'):'' !!}</p>
</div>
<div class="alert alert-danger validation" style="display: none;">
      <button type="button" class="close alert-close"><span>×</span></button>
      <ul class="text-left">
      </ul>
</div>