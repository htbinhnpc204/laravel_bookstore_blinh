@if (Session::has('success') || Session::get('warning') ||Session::get('info')||Session::get('error') || $errors->any())
    <div aria-live="polite" aria-atomic="true" class="position-fixed" style="top: 100px; z-index: 99999; right: 0">
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast show">
            <div class="toast-header">
                <strong class="me-auto">Thông báo</strong>
                <small class="text-muted">Ngay lúc này</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @if ($message = Session::get('success'))
                    {{ $message }}
                @endif
                @if ($message = Session::get('error'))
                    {{ $message }}
                @endif
                @if ($message = Session::get('warning'))
                    {{ $message }}
                @endif
                @if ($message = Session::get('info'))
                    {{ $message }}
                @endif
                @if ($errors->any())
                    Dữ liệu form nhập vào không hợp lệ
                @endif
            </div>
        </div>
    </div>
@endif
