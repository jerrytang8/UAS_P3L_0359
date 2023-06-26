         <div class="deznav">
             <div class="deznav-scroll">
                 <ul class="metismenu" id="menu">
                     <li>
                         <a href="{{ url('/dashboard') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-networking"></i>
                             <span class="nav-text">Dashboard</span>
                         </a>
                     </li>
                     <?php if(session('role')=='admin') { ?>
                     <li>
                         <a href="{{ url('/kasir') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-user-2"></i>
                             <span class="nav-text">Kasir</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/instruktur') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-user-2"></i>
                             <span class="nav-text">Instruktur</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/member') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Member</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/pegawai') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Pegawai</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/promo') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Promo</span>
                         </a>
                     </li>
                     <?php } ?>
                     <?php if(session('role')=='kasir') { ?>
                     <li>
                         <a href="{{ url('/member') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Member</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/aktivasi') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Aktivasi Tahunan</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/deposit_reguler') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Deposit Reguler</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/deposit_kelas') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Deposit Kelas</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/presensi_gym') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Presensi GYM</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/presensi_kelas/index_kasir') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Presensi Kelas</span>
                         </a>
                     </li>
                     <?php } ?>
                     <?php if(session('role')=='manager') { ?>
                     <li>
                         <a href="{{ url('/kelas') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card-1"></i>
                             <span class="nav-text">Kelas</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/jadwaldef') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-calendar"></i>
                             <span class="nav-text">Jadwal Default</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/jadwalhar') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-calendar-7"></i>
                             <span class="nav-text">Jadwal Harian</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/ijin_instruktur') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-user-8"></i>
                             <span class="nav-text">Ijin Instruktur</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/lap_pendapatan') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-network"></i>
                             <span class="nav-text">Lap. Perdapatan</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/lap_gym') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-network"></i>
                             <span class="nav-text">Lap. GYM</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/lap_kelas') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-network"></i>
                             <span class="nav-text">Lap. Kelas</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/lap_kinerja') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-network"></i>
                             <span class="nav-text">Lap. Kinerja</span>
                         </a>
                     </li>
                     <?php } ?>
                     <?php if(session('role')=='instruktur') { ?>
                     <li>
                         <a href="{{ url('/ijin_instruktur') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-calendar-7"></i>
                             <span class="nav-text">Ijin Instruktur</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('/presensi_kelas') }}" class="ai-icon" aria-expanded="false">
                             <i class="flaticon-381-id-card"></i>
                             <span class="nav-text">Presensi Kelas</span>
                         </a>
                     </li>
                     <?php } ?>
                 </ul>
                 <div class="copyright">
                 </div>
             </div>
         </div>
