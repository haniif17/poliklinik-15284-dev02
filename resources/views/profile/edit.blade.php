<x-layouts.app title="Profil">
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Profil</h1>
            <p class="mt-1 text-sm text-slate-500">Perbarui password untuk menjaga keamanan akun.</p>
        </div>

        <section class="rounded-xl border border-slate-200 bg-white p-6">
            <h2 class="mb-5 text-lg font-semibold text-slate-800">Ganti Password</h2>

            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                <div>
                    <label for="current_password" class="mb-2 block text-sm font-medium text-slate-700">Password lama</label>
                    <input id="current_password" name="current_password" type="password" required autocomplete="current-password"
                        class="input input-bordered w-full @error('current_password') input-error @enderror">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password baru</label>
                    <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password"
                        class="input input-bordered w-full @error('password') input-error @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi password baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password"
                        class="input input-bordered w-full @error('password_confirmation') input-error @enderror">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan Password
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-layouts.app>