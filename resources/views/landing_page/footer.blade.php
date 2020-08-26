{{-- awal footer --}}
<section class="section-footer">
    <footer>
        <br>
        <div class="container">
            <div class="row text-white">
                <div class="col-md-4">
                    <div class="row text-center">
                        <div class="col">
                            <img src="{{ asset("resource/image/logo_putih.png") }}" alt="" width="130px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fas fa-map-marker-alt" ></i>
                                </div>
                                <div class="col-md-11">
                                    <span style="text-align:left">Jl. Pasirluyu Utara, Pasirluyu, Kecamatan.Regol</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="row">
                        <div class="col">
                            <i class="fas fa-phone-volume" style="margin-top: 60px"> +62 123 4567 809</i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-1">
                            <i class="fas fa-envelope"> example@gmail.com</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="row">
                        <div class="col" style="margin-top: 50px">
                            <a href="{{ route("class.index") }}" style="color:#ffffff">
                                Kelas
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route("forum.index") }}" style="color:#ffffff">
                                Forum
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route("blogs.index") }}" style="color:#ffffff">
                                Blog
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="row text-center">
                        <div class="col" style="margin-top: 55px">
                            <a href="">
                                <i class="fab fa-facebook-square" style="font-size: 35px;color: #ffffff"></i>
                            </a>
                        </div>
                        <div class="col" style="margin-top: 55px">
                            <a href="">
                                <i class="fab fa-instagram" style="font-size: 35px;color: #ffffff"></i>
                            </a>
                        </div>
                        <div class="col" style="margin-top: 55px">
                            <a href="">
                                <i class="fab fa-github" style="font-size: 35px;color: #ffffff"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col mt-3">
                    <hr style="border: solid 1px white;width:90%;margin:auto">
                    <br>
                    <h6 class="text-white mb-3">&copy 2020 Pilogon. All Right Reserved</h6>
                </div>
            </div>
        </div>
    </footer>
</section>
{{-- akhir footer --}}

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{ asset("resource/script/script.js") }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @if (session("sukses"))
        <script>
            swal("System Says", "{{ session("sukses") }}","success");
        </script>
    @endif

    @if (session("error"))
        <script>
            swal("System Says", "{{ session("error") }}","error");
        </script>
    @endif

<script>
AOS.init();

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    setTimeout(() => {
        $(".sidenav .sidenav-link").css("transition", "0.5s") ;
    $(".sidenav .sidenav-link").css("opacity", 1) ;
    }, 230);
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    $(".sidenav .sidenav-link").css("transition", "0.1s") ;
    $(".sidenav .sidenav-link").css("opacity", 0) ;
    document.getElementById("mySidenav").style.width = "0";
}
</script>
@yield('script')
</body>

</html>