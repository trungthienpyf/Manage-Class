<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2022 {{ date('Y') >2022? '- '.date('Y') : '' }}  ©  {{config('app.name')}}
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-md-block">
                    <a href="javascript: void(0);">Về chúng tôi</a>
                    <a href="javascript: void(0);">Hỗ trợ</a>
                    <a href="javascript: void(0);">Liên hệ chúng tôi</a>
                </div>
            </div>
        </div>
    </div>
</footer>
