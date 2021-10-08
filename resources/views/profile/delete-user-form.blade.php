<x-jet-action-section>
    <x-slot name="title">
        حذف الحساب
    </x-slot>

    <x-slot name="description">
        احذف حسابك بشكل دائم.

    </x-slot>

    <x-slot name="content">
        <div>
            بمجرد حذف حسابك ، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف حسابك ، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.
        </div>

        <div class="mt-3">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                حذف الحساب
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
               حذف الحساب
            </x-slot>

            <x-slot name="content">
                هل انت متأكد انك تريد حذف حسابك؟ بمجرد حذف حسابك ، سيتم حذف جميع موارده وبياناته نهائيًا. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك بشكل دائم.

                <div class="mt-2 w-md-75" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="كلمة المرور"
                                 x-ref="password"
                                 wire:model.defer="password"
                                 wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')"
                                        wire:loading.attr="disabled">
                    إلغاء
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="deleteUser" wire:loading.attr="disabled">
                    <div wire:loading wire:target="deleteUser" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">تحميل...</span>
                    </div>

                   حذف الحساب
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>

</x-jet-action-section>
