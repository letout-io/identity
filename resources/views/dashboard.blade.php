<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!

                    @if(!auth()->user()->two_factor_secret)
                        You have not enabled Two Factor yet
                        <form method="POST" action="{{ route('two-factor.enable') }}">
                            @csrf
                            
                            <x-button class="ml-3">
                                {{ __('Enable') }}
                            </x-button>
                        </form>
                    @else
                        You have enabled Two Factor yet. Good !!!
                        <form method="POST" action="{{ route('two-factor.disable') }}">
                            @csrf
                            @method('DELETE')
                            <x-button class="ml-3">
                                {{ __('Disable') }}
                            </x-button>
                        </form>
                    @endif
                    
                    @if(session('status') == 'two-factor-authentication-enabled')
                        You have now enabled it. please scan

                        {!! auth()->user()->twoFactorQrCodeSvg() !!}

                        @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                            {{ trim($code) }} <br />
                        @endforeach

                        
                        <form method="POST" action="{{ route('two-factor.confirm') }}">
                            @csrf

                            <!-- Password -->
                            <div>
                                <x-label for="code" :value="__('Code')" />

                                <x-input id="code" class="block mt-1 w-full"
                                                type="text"
                                                name="code"
                                                required/>
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-button>
                                    {{ __('Confirm') }}
                                </x-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
