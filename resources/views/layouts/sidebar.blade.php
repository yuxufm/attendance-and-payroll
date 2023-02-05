<nav class="flex flex-col text-sm">
    <!-- logo -->
    <div class="mb-8 p-4">
        <div class="text-sm font-semibold mb-1 mt-4">Aplikasi Absensi & Payroll</div>
        <div class="text-xs">
            {{ session()->get('hak_akses') === 'pegawai' ? 'Pegawai' : 'Admin' }}
        </div>
    </div>


    @if (session()->get('hak_akses') === 'admin')
        <!-- admin menu -->
        <a class="anp-sidebar-menu" href="{{ url('admin/') }}">Beranda</a>
        <a class="anp-sidebar-menu" href="{{ url('admin/absensi') }}">Absensi</a>
        <a class="anp-sidebar-menu" href="{{ url('admin/payslip') }}">Payslip</a>

        <a class="anp-sidebar-menu mt-14" href="{{ url('admin/logout') }}">Logout</a>
    @endif


    @if (session()->get('hak_akses') === 'pegawai')
        <!-- pegawai menu -->
        <a class="anp-sidebar-menu" href="{{ url('pegawai/') }}">Beranda</a>
        <a class="anp-sidebar-menu" href="{{ url('pegawai/absensi') }}">Absensi</a>
        <a class="anp-sidebar-menu" href="{{ url('pegawai/payslip') }}">Payslip</a>

        <a class="anp-sidebar-menu mt-14" href="{{ url('pegawai/logout') }}">Logout</a>
    @endif

</nav>
