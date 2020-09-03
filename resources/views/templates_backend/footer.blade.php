<footer class="main-footer">
    <div class="footer-left">
    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
    </div>
    <div class="footer-right">
    2.3.0
    </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset("assets/vendor/jquery/jquery.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{ asset("assets/vendor/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset('assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/select2.full.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
@yield('script')

<!-- Page Specific JS File -->
</body>
</html>
