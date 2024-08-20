@if($message = Session::get('notification'))
<div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
    <!-- Toast container for spacing between toasts -->
    <div class="toast-container">
        <!-- Toast -->
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small class="text-body-secondary">{{ now() }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif
