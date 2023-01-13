<form method="post" action="{{ $processUrl }}">
    @csrf

    @error('_general')
    <p>{{ $message }}</p>
    @enderror

    <label for="email">{{ __('general.email') }}:</label>
    <input
            id="email"
            type="text"
            name="email"
            value="{{ old('email') }}"
    >
    @error('email')
    <p>{{ $message }}</p>
    @enderror
    <br>

    <label for="password">{{ __('general.password') }}:</label>
    <input
            id="password"
            type="password"
            name="password"
    >
    @error('password')
    <p>{{ $message }}</p>
    @enderror
    <br>

    <button>
        {{ __('auth.sign_in') }}
    </button>
</form>
