<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Authorization Request') }}
        </div>
        <!-- Introduction -->
        <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

        <!-- Scope List -->
        @if (count($scopes) > 0)
            <div class="scopes">
                    <p><strong>This application will be able to:</strong></p>

                    <ul>
                        @foreach ($scopes as $scope)
                            <li>{{ $scope->description }}</li>
                        @endforeach
                    </ul>
            </div>
        @endif
        <div class="flex items-center justify-end mt-4">
            <!-- Cancel Button -->
            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                <button class="underline text-sm text-gray-600 hover:text-gray-900 ml-3">
                    {{ __('Cancel') }}
                </button>
            </form>
            <!-- Authorize Button -->
            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                @csrf

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                <x-button class="ml-4">
                    {{ __('Authorize') }}
                </x-button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
