<!-- resources/views/payment/payment-interface.blade.php -->
@extends ('backend.layouts.app')

@section('content')
<form id="form">
  <div class="input-group">
    <input type="text" id="linkInput" value="https://example.com" readonly>
    <button id="copyButton" onclick="copyToClipboard()">Copy</button>
</div>
</form>
  
   
@endsection
@push ('after-scripts')
<script>
    function copyToClipboard() {
    /* Get the text field */
    var linkInput = document.getElementById("linkInput");

    /* Select the text field */
    linkInput.select();
    linkInput.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field to the clipboard */
    document.execCommand("copy");

    /* Change the button text to indicate successful copy */
    var copyButton = document.getElementById("copyButton");
    copyButton.innerHTML = "Copied!";
    setTimeout(function () {
        copyButton.innerHTML = "Copy";
    }, 2000); // Reset button text after 2 seconds
}
</script>
{{-- 
<script>
    function copyAddress() {
        var usdtAddress = document.getElementById("usdt_address");
        usdtAddress.select();
        document.execCommand("copy");
        alert("Address copied to clipboard: " + usdtAddress.value);
    }
</script> --}}
@endpush