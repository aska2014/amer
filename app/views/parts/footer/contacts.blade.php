<div class="footer-contacts section">
{{ trans('words.any_questions_contact_us') }}:-<br />
    <b>{{ $contactEmail }}</b><br />
{{ trans('words.or_contact_us') }}:-<br />
    <b>{{ isset($mobileNumbers[0]) ? $mobileNumbers[0] : '' }}</b><br />
    <b>{{ isset($mobileNumbers[1]) ? $mobileNumbers[1] : '' }}</b>
</div>