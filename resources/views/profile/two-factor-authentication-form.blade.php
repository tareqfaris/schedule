<x-jet-action-section>
    <x-slot name="title">
        المصادقة الثنائية
    </x-slot>

    <x-slot name="description">
        أضف أمانًا إضافيًا إلى حسابك باستخدام المصادقة الثنائية.
    </x-slot>

    <x-slot name="content">
        <h3 class="h5 font-weight-bold">
            @if ($this->enabled)
            لقد قمت بتمكين المصادقة الثنائية.
            @else
            لم تقم بتمكين المصادقة الثنائية.
            @endif
        </h3>

        <p class="mt-3">
            عند تمكين المصادقة الثنائية ، ستتم مطالبتك برمز مميز آمن وعشوائي أثناء المصادقة. يمكنك استرداد هذا الرمز المميز من تطبيق Google Authenticator بهاتفك. ممكن
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-3">
                    تم تمكين المصادقة الثنائية الآن. امسح رمز الاستجابة السريعة التالي ضوئيًا باستخدام تطبيق المصادقة بهاتفك.
                </p>

                <div class="mt-3">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-3">
                    قم بتخزين رموز الاسترداد هذه في مدير كلمات مرور آمن. يمكن استخدامها لاستعادة الوصول إلى حسابك في حالة فقد جهاز المصادقة الثنائية الخاص بك.
                </p>

                <div class="bg-light rounded p-3">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-3">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                       تفعيل
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="me-3">
                            <div wire:loading wire:target="regenerateRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">تحميل...</span>
                            </div>

                            إعادة تكوين رمز الاستعادة
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="me-3">
                            <div wire:loading wire:target="showRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">تحميل...</span>
                            </div>

                            عرض رموز الاستعادة
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        <div wire:loading wire:target="disableTwoFactorAuthentication" class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">تحميل...</span>
                        </div>

                       تعطيل
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>