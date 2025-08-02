<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ユーザー情報の再設定') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("プロフィール画像・ユーザー名・メールアドレスを変更できます") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_image" :value="__('プロフィール画像')" />
            @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" class="h-[200px] w-[200px] border border-gray-500">
            @endif
            <p class="text-sm text-blue-300 flex items-end pl-4 whitespace-nowrap">
            ※プロフィール画像を編集したい場合は、「ファイルを選択」から編集をお願いします
            </p>
        </div>
            <input type="file" name="profile_image" alt="プロフィール画像" />
            <input type="hidden" name="current_profile" value="{{ $user->profile_image }}">

        <div>
            <x-input-label for="name" :value="__('ユーザー名')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存') }}</x-primary-button>

            <!-- @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('保存しました') }}</p>
            @endif -->
        </div>
    </form>
</section>
