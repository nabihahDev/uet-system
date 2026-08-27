<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Tanda Tangan & PIN Kelulusan') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Muat naik tanda tangan digital dan tetapkan 4-digit PIN keselamatan untuk pengesahan permohonan.') }}
        </p>
    </header>

    {{-- Status Alerts --}}
    @if (session('status') === 'signature-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="mt-2 text-sm text-green-600 dark:text-green-400">
            {{ __('Maklumat tanda tangan dan PIN berjaya dikemas kini.') }}
        </p>
    @elseif (session('status') === 'signature-deleted')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ __('Gambar tanda tangan berjaya dipadamkan.') }}
        </p>
    @endif

    {{-- Current Signature Preview --}}
    @if ($user->signature_path)
        <div class="mt-4 p-4 border rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Tanda Tangan Semasa:') }}</p>
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $user->signature_path) }}" alt="Tanda Tangan User" class="h-20 object-contain border bg-white p-2 rounded" />
                
                <form method="post" action="{{ route('profile.signature.destroy') }}">
                    @csrf
                    @method('delete')
                    <x-danger-button type="submit" onclick="return confirm('Adakah anda pasti ingin memadamkan tanda tangan ini?')">
                        {{ __('Padam Tanda Tangan') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    @endif

    <form method="post" action="{{ route('profile.signature.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Signature Upload --}}
        <div>
            <x-input-label for="signature" :value="__('Muat Naik Gambar Tanda Tangan (PNG, JPG - Max 2MB)')" />
            <input id="signature" name="signature" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/png, image/jpeg, image/jpg" />
            <x-input-error class="mt-2" :messages="$errors->get('signature')" />
        </div>

        {{-- Approval PIN --}}
        <div>
            <x-input-label for="approval_pin" :value="__('PIN Kelulusan (4-Digit)')" />
            <x-text-input id="approval_pin" name="approval_pin" type="password" maxlength="4" class="mt-1 block w-1/2" placeholder="****" autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('approval_pin')" />
        </div>

        {{-- Confirm Approval PIN --}}
        <div>
            <x-input-label for="approval_pin_confirmation" :value="__('Sahkan PIN Kelulusan')" />
            <x-text-input id="approval_pin_confirmation" name="approval_pin_confirmation" type="password" maxlength="4" class="mt-1 block w-1/2" placeholder="****" autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('approval_pin_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>
</section>