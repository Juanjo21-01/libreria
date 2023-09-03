<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-success bg-gradient']) }}>
    {{ $slot }}
</button>
