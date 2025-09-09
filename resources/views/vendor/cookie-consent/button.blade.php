<form action="{!! $url !!}" {!! $attributes !!}>
    @csrf
    <button type="submit" class="{!! $basename !!}__link" style="background-color:#296242;border-color:#296242;">
        <span class="{!! $basename !!}__label">{{ $label }}</span>
    </button>
</form>
