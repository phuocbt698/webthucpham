<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{route('homepage')}}"><img src="{{asset($config->logo)}}"
                                alt=""></a>
                    </div>
                    <ul>
                        <li>Address: <span id="addressWeb"></span></li>
                        <li>Phone: {{$config->phone ?? ''}}</li>
                        <li>Email: {{$config->email ?? ''}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Đây là trang website đầu tiên với laravel của tôi</h6>
                    <p>Hy vọng tôi nhận được các đánh giá của mọi người! Và tất nhiên vẫn còn một số thứ cần cải thiện trong tương lai! Tôi đang có cải thiện kiến thức của bản thân mình! Cảm ơn mọi người!:</p>
                    <div class="footer__widget__social">
                        <a target="_blank" href="{{$config->facebook ?? ''}}"><i class="fa fa-facebook"></i></a>
                        <a target="_blank" href="{{$config->git ?? ''}}"><i class="fa fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Cảm ơn rất nhiều | Về template free của <i
                                class="fa fa-heart" aria-hidden="true"></i> <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->