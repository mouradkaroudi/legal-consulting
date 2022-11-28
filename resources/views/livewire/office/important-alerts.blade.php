<div>
    @if($uncompletedStatusAlert)
        <x-alert>
            <span>يرجى ملء جميع الحقول المطلوبة في نموذج إعدادات المكتب.</span>
            <a class="underline" href="{{ route('office.settings', $digitalOffice) }}">من هنا</a>
        </x-alert>
    @endif
    @if($uncompletedProfile)
        <x-alert>
            <p>يرجى استكمال صفحة ملفك الشخصي لظهور مكتبك في الموقع.</p>
            <a href="{{ route('account.profile') }}">ملفك الشخصي</a>
        </x-alert>
    @endif
</div>
