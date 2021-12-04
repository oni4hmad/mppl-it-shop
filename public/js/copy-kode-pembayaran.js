document.addEventListener("DOMContentLoaded", function () {
    let tempTimeout;
    function hideTooltip(btn) {
        tempTimeout = setTimeout(function () {
            btn.tooltip("hide");
        }, 1000);
    }

    let clipboard = new ClipboardJS('#copy-kode-pembayaran');
    clipboard.on('success', function(e) {
        let btn = $("[data-bs-toggle='tooltip']");
        clearTimeout(tempTimeout);
        btn.tooltip('show');
        hideTooltip(btn);
    });
});
// DOMContentLoaded  end
